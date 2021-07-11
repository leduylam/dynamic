<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Image;

class DynamicSportController extends Controller
{
    public function home(){
        // dd($categories);
        
        $category = Category::where('parent_id_1', 0)->orderBy('name')->first();
        $products = Product::with('images')->paginate(8);
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                if($image['image_id'] == $image_id){
                    $products[$index]['image'] = $image->description;
                }
                
            }
        }
        // echo "<pre>"; print_r($category); die;
        return view('welcome', compact('products', 'category'));
    }
}