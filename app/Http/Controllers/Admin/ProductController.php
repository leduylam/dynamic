<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::all();
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }

        return view('backend.product.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::where('parent_id_1', 0)->where('parent_id_2', 0)->get();
        $sizes = Size::all();
        $colors = Color::all();

        return view('backend.product.create', compact('categories', 'sizes', 'colors'));
    }

    /**
     * @param AddProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddProductRequest $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                // create product
                $product = new Product();
                $data = $request->only($product->getFillable());
                $data['status'] = true;
                $category = array();
                foreach ($request->all() as $key => $value) {
                    if (strpos($key, 'category') === false) {
                        continue;
                    }

                    if ($value[0] == 'null') {
                        continue;
                    } else {
                        $category[] = $value;
                    }
                }

                if (!empty($category)) {
                    $category = array_filter($category);
                    $data['category_id'] = json_encode($category);
                }

                $product->fill($data)->save();
                // image product
                if (!empty($request['img_url'])) {
                    $images = array_chunk($request['img_url'], 2);
                    foreach ($images as $item) {
                        $img = $this->uploadImage($item[0], 'product');
                        $image = new Image();
                        $image['name'] = $item[1];
                        $image['description'] = $img;
                        $image->save();

                        if (!empty($image)) {
                            $product_image = new ProductImage();
                            $product_image['product_id'] = $product->id;
                            $product_image['image_id'] = $image->id;
                            $product_image->save();
                        }
                    }
                }

                // create product detail
               $this->createOrUpdateProductDetail($request->all(), $product);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'statusCode' => 0,
                    'data' => null
                ], 500);
            }

            return response()->json([
                'statusCode' => 1,
                'data' => null
            ], 200);
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 500);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('backend.product.show', compact('product'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $category_big = array();
        $category_mid = array();
        $category_small = array();
        $array_category_small = array();
        $array_category_mid = array();
        $product = Product::with('images','details')->find($id);
        $categories = Category::where('parent_id_1', 0)->where('parent_id_2', 0)->get();
        $list_category = json_decode($product->category_id);
        if (!empty($list_category)) {
            if (!empty($list_category[0])) {
                $category_big = Category::find($list_category[0]);
                $array_category_mid = Category::where('parent_id_1', $list_category[0])->where('parent_id_2', 0)->get();
            }

            if (!empty($list_category[1])) {
                $category_mid = Category::find($list_category[1]);
                $array_category_small = Category::where('parent_id_1', $list_category[0])->where('parent_id_2', $list_category[1])->get();
            }

            if (!empty($list_category[2])) {
                $category_small = Category::find($list_category[2]);
            }
        }

        // get stock
        if (!empty($product->details->toArray())) {
            foreach ($product->details as $index => $detail) {
                $product->details[$index]['stock'] = !empty($detail->stock) ? $detail->stock->quantity : null;
            }
        }

        return view('backend.product.edit', compact(
            'product',
            'categories',
            'category_big',
            'category_mid',
            'category_small',
            'array_category_small',
            'array_category_mid',
            'colors',
            'sizes'
        ));
    }

    /**
     * @param EditProductRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditProductRequest $request, $id)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                // update product
                $product = Product::with('details')->find($id);
                $data = $request->only($product->getFillable());
                $category = array();
                foreach ($request->all() as $key => $value) {
                    if (strpos($key, 'category') === false) {
                        continue;
                    }

                    if ($value[0] == 'null') {
                        continue;
                    } else {
                        $category[] = $value;
                    }
                }

                if (!empty($category)) {
                    $category = array_filter($category);
                    $data['category_id'] = json_encode($category);
                }

                $product->fill($data)->save();
                // delete_image
                if (!empty($request->images)) {
                    //delete image
                    $img = $product->images->pluck('id')->toArray();
                    $img_diff = array_diff($img, $request->images);

                    //sync image
                    $images_id = Image::whereIn('id', $request->images)->pluck('id')->toArray();
                    $product->images()->sync($images_id);
                } else {
                    $img_diff = $product->images->pluck('id')->toArray();
                    $product->images()->detach();
                }

                // delete image to storage
                if (!empty($img_diff)) {
                    $image_name = Image::whereIn('id', $img_diff)->get();
                    foreach ($image_name as $item) {
                        \File::delete(public_path() . '/storage/product/' . $item->description);
                    }

                    Image::whereIn('id', $img_diff)->delete();
                }

                // image product
                if (!empty($request['img_url'])) {
                    $images = array_chunk($request['img_url'], 2);
                    foreach ($images as $item) {
                        $img = $this->uploadImage($item[0], 'product');
                        $image = new Image();
                        $image['name'] = $item[1];
                        $image['description'] = $img;
                        $image->save();

                        if (!empty($image)) {
                            $product_image = new ProductImage();
                            $product_image['product_id'] = $product->id;
                            $product_image['image_id'] = $image->id;
                            $product_image->save();
                        }
                    }
                }

                // create or update product_detail and stock
                if (!empty($product->details->toArray())) {
                    foreach ($product->details as $detail) {
                        $stock = Stock::where('product_detail_id', $detail->id)->first();
                        if (!empty($stock)) {
                            $stock->delete();
                        }
                    }

                    $product->details()->delete();
                }

                $this->createOrUpdateProductDetail($request->all(), $product);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'statusCode' => 0,
                    'data' => null
                ], 500);
            }

            return response()->json([
                'statusCode' => 1,
                'data' => null
            ], 200);
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 500);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        // delete image
        $images = $product->images->pluck('id')->toArray();
        $image_name = Image::whereIn('id', $images)->get();
        foreach ($image_name as $item) {
            \File::delete(public_path() . '/storage/product/' . $item->description);
        }

        Image::whereIn('id', $images)->delete();

        // delete product
        $product->images()->detach();
        $product->delete();

        return redirect()->back()->with('success', 'Delete category successfully');
    }

    /**
     * @param $image
     * @return string
     */
    public function uploadImage($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $fileName;
    }

    /**
     * @param $request
     * @param $product
     * @return bool
     */
    public function createOrUpdateProductDetail($request, $product)
    {
        if (!empty($request['size']) || !empty($request['color'])
            || !empty($request['brand']) || !empty($request['model'])
            || !empty($request['quantity']) || !empty($request['price_detail'])) {
            foreach ($request['size'] as $index => $value) {
                $product_detail = new ProductDetail();
                $product_detail['product_id'] = $product->id;
                $product_detail['size'] = $value;
                $product_detail['brand'] = !empty($request['brand']) ? $request['brand'][$index] : null;
                $product_detail['color'] = !empty($request['color']) ? $request['color'][$index] : null;
                $product_detail['model'] = !empty($request['model']) ? $request['model'][$index] : null;
                $product_detail['price'] = !empty($request['price_detail']) ? $request['price_detail'][$index] : null;
                $product_detail['rating'] = null;
                $product_detail->save();

                // create stock
                if (!empty($request['quantity'])) {
                    $stock = new Stock();
                    $stock['product_detail_id'] = $product_detail->id;
                    $stock['quantity'] = !empty($request['quantity']) ? $request['quantity'][$index] : null;
                    $stock->save();
                }
            }
        }

        return true;
    }
}
