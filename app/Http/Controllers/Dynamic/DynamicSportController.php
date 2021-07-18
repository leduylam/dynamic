<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\ProductImage;
use App\Models\Image;

class DynamicSportController extends Controller
{
    public function home(){
        $cart = 0;
        if (auth()->user()) {
            $cart = Cart::content();
            if (!empty($cart->toArray())) {
                $cart = count($cart);
            }
        }

        $getCategory = Category::where(['parent_id_1' => 0, 'parent_id_2' => 0])->get();
        // dd($getCategory);
        $banner = Banner::where('status', 1)->first();

        $products = Product::orderBy('id', 'Desc')->limit(8)->get();
        foreach ($products as $index => $product) {
            $image_id = ProductImage::where('product_id', $product->id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $products[$index]['image'] = $image->description;
            }
        }
        $products = json_decode(json_encode($products));
        return view('welcome', compact('products', 'banner', 'getCategory', 'cart'));
    }

}
