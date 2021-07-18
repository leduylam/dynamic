<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductDetail;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(){
        $cart = Cart::content();
        $array = array();
        $total_amount = 0;
        foreach ($cart as $index => $item) {
            $total_amount += $item->qty * $item->price;
            $array[$index] = [
                'product_detail_id' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'size' => $item->options['size'],
                'color' => $item->options['color'],
                'total' => $item->qty * $item->price,
                'name' => $item->options['name'],
                'image' => $item->options['image'],
            ];
        }

        return view('dynamicsportsvn.cart.index', compact('array', 'total_amount', 'cart'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function checkout(Request $request){

        if (!empty($request)) {
            foreach ($request['quantity'] as $index => $item) {
                Cart::update($index, ['qty' => $item]);
            }
        }

        $total_amount = 0;
        $cart = Cart::content();
        foreach ($cart as $item) {
            $total_amount += $item->qty * $item->price;
        }

        return view('dynamicsportsvn.cart.checkout', compact('cart', 'total_amount'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'name' => 'required',
            'phone' => 'required|max:11',
            'address' => 'required|max:255',
            'memo' => 'max:255',
        ]);

        DB::beginTransaction();
        try {
            $cart = Cart::content();
            // add order
            $order = Order::orderBy('sku', 'desc')->first();
            if (!empty($order)) {
                $sku = explode('/', $order['sku'])[1];
                $sku_new = (int)$sku + 1;
                $sku_int = (int)$sku;
                $sku = str_replace($sku_int, $sku_new, $sku);
            }
            $order = !empty($order) ? $sku : '00001';
            $sku_order = 'DSC' . Carbon::now()->format('y') . '/' . $order;
            $query = new Order();
            $query['sku'] = $sku_order;
            $query['order_date'] = Carbon::now()->format('Y-m-d');
            $query['user_id'] = auth()->user()->id;
            $query['status_code'] = Order::STATUS_1;
            $query['total_amount'] = $request['total_amount'];
            $query['memo'] = !empty($request['memo']) ? $request['memo'] : null;
            $query['address'] = !empty($request['address']) ? $request['address'] : null;
            $query['customer'] = !empty($request['name']) ? $request['name'] : null;
            $query['email'] = !empty($request['email']) ? $request['email'] : null;
            $query->save();

            foreach ($cart as $item) {
                $category = Product::find($item->options['product_id']);
                if (!empty($category)) {
                    $array_category = json_decode($category->category_id);
                }

                // create order detail
                $order_detail = new OrderItem();
                $order_detail['order_id'] = $query->id;
                $order_detail['product_detail_id'] = $item->name;
                $order_detail['quantity'] = $item->qty;
                $order_detail['price'] = $item->qty * $item->price;
                $order_detail['product_id'] = $item->options['product_id'];
                $order_detail['category_id'] = !empty($array_category) ? end($array_category) : null;
                $order_detail->save();

                // update rating product_detail
                $product_detail = ProductDetail::find($item->id);
                if (!empty($product_detail)) {
                    $product_detail['rating'] += 1;
                    $product_detail->save();
                }
            }

           DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Bạn đã order không thành công!');
        }

        return redirect()->route('product.index')->with('success', 'Bạn đã order thành công!');
    }
}
