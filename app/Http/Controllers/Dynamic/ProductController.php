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
    public function listing($name){
        $categoryCount = Category::where(['name' => $name, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::categoryDetail($name);
            $categoryProduct = Product::where('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();
            // echo "<pre>"; print_r($categoryDetails); die;
        }
    }
    public function index(){
        $categories = Category::all();
        $products = Product::all();
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }
        return view('dynamicsportsvn.product.index', compact('categories', 'products'));
    }

    public function tableProduct(){
        $categories = Category::all();
        $products = Product::with('images', 'details', 'colors', 'sizes')->get();
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }
        $products = json_decode(json_encode($products));
        // echo "<pre>"; print_r($products); die;
        return view('dynamicsportsvn.product.table-product', compact('categories', 'products'));
    }

    public function productDetail($id){
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $product = Product::with('images','details', 'sizes', 'colors')->find($id);
        $stocks = Stock::with('productDetail')->get();
        foreach ($stocks as $index => $stock){
            $name = $stock->productDetail->product->name.'/'.$stock->productDetail->size.'/'.$stock->productDetail->color.'('.$stock->productDetail->price.')';
            $stocks[$index]['name'] = $name;
        }
        if (!empty($product->details->toArray())) {
            foreach ($product->details as $index => $detail) {
                $product->details[$index]['stock'] = !empty($detail->stock) ? $detail->stock->quantity : null;
            }
        }
        
        $stocks = json_decode($stocks);
        // echo "<pre>"; print_r($stocks); die;
        return view('dynamicsportsvn.product.product-detail.index', compact('categories', 'product', 'colors', 'sizes', 'stocks'));
    }
}
