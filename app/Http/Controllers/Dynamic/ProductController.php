<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Image;
use App\Models\Size;
use App\Models\Color;
use App\Models\Stock;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        // dd($products);
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }
        return view('dynamicsportsvn.product.index', compact('products'));
    }

    public function tableProduct(){
        $sizes = Size::get();
        $products = Product::with('images', 'details', 'colors', 'sizes')->get();
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }
        $products = json_decode(json_encode($products));
        return view('dynamicsportsvn.product.table-product', compact('products', 'sizes'));
    }

    public function productDetail($id){
        $product = Product::with('images','details', 'sizes', 'colors')->find($id);
        $product = json_decode($product);
        // dd($product);
        if (!empty($product->details)) {
            foreach($product->details as $key => $detail){
                $product->details['brand'] = !empty($detail->brand) ? $detail->brand : null;
                $product->details['stock'] = !empty($detail->stock) ? $detail->stock->quantity : null;
            }
        }
        // dd($product);
        return view('dynamicsportsvn.product.product-detail.index', compact('product'));
    }

    public function addtoCard(Request $request){
        $data = $request->all();
        echo "<pre>"; print_r($data); die;
    }
}
