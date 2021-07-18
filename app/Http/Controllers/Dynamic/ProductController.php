<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Image;
use App\Models\Size;
use App\Models\Color;
use App\Models\Stock;

class ProductController extends Controller
{
    public function index(Request $request){
        $query = Product::query();
        if (!empty($request['order_by']) || !empty($request['search'])) {
            if ($request['search']) {
                $query = $query->where('name', 'like' ,'%'.$request['search'].'%');
            }else if ($request['order_by'] == 'desc') {
                $query = $query->orderBy('created_at', 'desc');
            }else {
                $query = $query->orderBy('created_at', 'acs');
            }
        }

        $products = $query->get();
        $products = $this->getImage($products);

        // product new
        $product_news = Product::orderBy('created_at', 'desc')->get();
        $product_news = $this->getImage($product_news);

        return view('dynamicsportsvn.product.index', compact('products', 'product_news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tableProduct(){
        $sizes = Size::get();
        $products = Product::with('images', 'details', 'colors', 'sizes')->get();
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
            if (!empty($product->details->toArray())) {
                foreach ($product->details as $index => $detail) {
                    $product->details[$index]['stock'] = !empty($detail->stock) ? $detail->stock->quantity : null;
                }
            }
            // dd($product);
        }
        $products = json_decode(json_encode($products));
        return view('dynamicsportsvn.product.table-product', compact('products', 'sizes'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function productDetail($id){
        $product = Product::with('images','details', 'sizes', 'colors')->find($id);
        $product = json_decode($product);
        $sizes = Size::all();
        $colors = Color::all();
        // dd($product);
        if (!empty($product->details)) {
            foreach($product->details as $key => $detail){
                $product->details['brand'] = !empty($detail->brand) ? $detail->brand : null;
                $product->details['stock'] = !empty($detail->stock) ? $detail->stock->quantity : null;
            }
        }
        // dd($product);
        return view('dynamicsportsvn.product.product-detail.index', compact('product', 'colors', 'sizes'));
    }

    public function addtoCard(Request $request){
        if ($request->ajax()) {
            $request->session()->forget('cart');
            $array = array();
            $product = ProductDetail::where('product_id', $request['product'])->where('color_id', $request['color_id'])->where('size_id', $request['size_id'])->first();
            $product_img = ProductImage::where('product_id', $product->product->id)->orderBy('created_at', 'desc')->first();
            $img = Image::find($product_img->image_id);
            $id = $product->id.'_'.$product->size_id.'_'.$product->color_id ;
            if (!empty($product)) {
                $array[] = [
                    'id' => $id,
                    'name' => $product->id,
                    'price' => $product->product->price,
                    'qty' => $request['stock'],
                    'options' => [
                        'size' => $product->size->size,
                        'color' => $product->color->color,
                        'image' => $img->description,
                        'name' => $product->product->name,
                        'product_id'  => $request['product'],
                        'user_id' => !empty(auth()->user()) ? auth()->user()->id : null,
                    ]
                ];

                Cart::add($array);
            }

            $count = count(Cart::content());
            return response()->json([
                'statusCode' => 1,
                'data' => !empty($count) ? $count : 0,
            ], 200);
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showItem(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request['product']) && !empty($request['color_id']) && !empty($request['size_id'])) {
                $product_detail = ProductDetail::where('product_id', $request['product'])->where('color_id', $request['color_id'])->where('size_id', $request['size_id'])->first();
                if (!empty($product_detail)) {
                    $stock = Stock::where('product_detail_id', $product_detail->id)->first();
                    if (!empty($stock)) {
                        return response()->json([
                            'statusCode' => 1,
                            'data' => $stock->quantity,
                        ], 200);
                    }

                }
            }else {
                return response()->json([
                    'statusCode' => 0,
                    'data' => null
                ], 200);
            }
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkStock(Request $request)
    {
        if ($request->ajax()){
            $quantity = 0;
            $product_detail = ProductDetail::find($request['product']);
            if (!empty($product_detail)) {
                $quantity = $product_detail->stock->quantity;
            }

            return response()->json([
                'statusCode' => 1,
                'data' => $quantity,
            ], 200);
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 200);
    }

    public function getImage($products)
    {
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }

        return $products;
    }
}
