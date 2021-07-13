<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categoryReport(Request $request){
        if (!empty($request['date_start']) || !empty($request['date_end'])) {
            $date_start = !empty($request['date_start']) ? Carbon::parse($request['date_start'])->startOfDay()->format('Y-m-d H:i:s') : Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $date_end = !empty($request['date_end']) ? Carbon::parse($request['date_end'])->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
            $products = OrderItem::whereBetween('created_at', [$date_start, $date_end])->orderBy('id','desc')->groupBy('product_id')->pluck('product_id')->toArray();
        }else {
            $products = OrderItem::orderBy('id','desc')->groupBy('product_id')->pluck('product_id')->toArray();
        }
        
        $category_reports = [];
        $all_quantity = 0;
        $all_amount = 0;
        if (!empty($products)) {
            foreach ($products as $index => $product) {
                $product_name = Product::find($product);
                $category = json_decode($product_name->category_id);
                $category = end($category);
                $category_name = Category::find($category);
                // dd($category_name);
                $quantity = 0;
                $total_amount = 0;
                $order_items = OrderItem::where('product_id', $product)->get();
                foreach ($order_items as $item) {
                    $quantity += $item->quantity;
                    $total_amount += $item->price;
                }

                $all_quantity += $quantity;
                $all_amount += $total_amount;
                $category_reports[$index] = [
                    'name' => $category_name->name,
                    'quantity' => $quantity,
                    'total_amount' => $total_amount,
                    'id' => $product_name->id,
                ];
            }
        }

        return view('backend.report.category-report.index',compact('category_reports','all_amount','all_quantity'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showCategoryReport(Request $request, $id){
        $data = [];
        if (!empty($request['date_start']) || !empty($request['date_end'])) {
            $date_start = !empty($request['date_start']) ? Carbon::parse($request['date_start'])->startOfDay()->format('Y-m-d H:i:s') : Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $date_end = !empty($request['date_end']) ? Carbon::parse($request['date_end'])->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $products = OrderItem::with('order')->whereBetween('created_at', [$date_start, $date_end])->where('product_id', $id)->get();
        }else {
            $products = OrderItem::with('order')->where('product_id', $id)->get();
        }

        $quantity = 0;
        $total_amount = 0;
        $amount = 0;
        if (!empty($products->toArray())) {
            foreach ($products as $index => $product) {
                $product_detail = ProductDetail::find($product->product_detail_id);
                $category = $product_detail->product->category_id;
                $category = json_decode($category);
                $category = end($category);
                $category_name = Category::find($category);
                $data[$index] = [
                    'sku' => $product->order->sku,
                    'order_date' => $product->order->order_date,
                    'sku_product' => $product_detail->product->sku,
                    'name' => $product_detail->product->name,
                    'size' => $product_detail->size->size,
                    'color' => $product_detail->color->color,
                    'quantity' => $product->quantity,
                    'total_amount' => $product->price,
                    'amount' => $product->quantity * $product_detail->price,
                    'category' => $category_name->name,
                ];

                $quantity += $product->quantity;
                $total_amount += $product->price;
                $amount += $product->quantity * $product_detail->price;
            }
        }

        return view('backend.report.category-report.show', compact('id','quantity','total_amount','amount','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        if (!empty($request['date_start']) || !empty($request['date_end'])) {
            $date_start = !empty($request['date_start']) ? Carbon::parse($request['date_start'])->startOfDay()->format('Y-m-d H:i:s') : Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $date_end = !empty($request['date_end']) ? Carbon::parse($request['date_end'])->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
            $users = Order::whereBetween('created_at', [$date_start, $date_end])->orderBy('created_at', 'desc')->groupBy('user_id')->pluck('user_id')->toArray();
        }else {
            $users = Order::orderBy('created_at', 'desc')->groupBy('user_id')->pluck('user_id')->toArray();
        }

        $data = [];
        $all_amount = 0;
        $all_quantity = 0;
        if (!empty($users)) {
            foreach ($users as $index => $user) {
                $orders = Order::where('user_id', $user)->get();
                $quantity = 0;
                $total_amount = 0;
                if (count($orders) > 0) {
                    foreach ($orders as $order) {
                        if (!empty($order->orderItems->toArray())) {
                            foreach ($order->orderItems as $item) {
                                $quantity += $item->quantity;
                                $total_amount += $item->price;
                            }
                        }
                    }
                }

                $all_quantity += $quantity;
                $all_amount += $total_amount;
                $user_detail = User::find($user);
                $data[$index] = [
                    'quantity' => $quantity,
                    'total_amount' => $total_amount,
                    'sku' => $user_detail->sku,
                    'name' => $user_detail->name,
                    'address' => $user_detail->address,
                    'id' => $user,
                ];
            }
        }

        return view('backend.report.customer-report.index', compact('data', 'all_amount', 'all_quantity'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id){
        $array = [];
        $quantity = 0;
        $total_amount = 0;
        $amount = 0;
        if (!empty($request['date_start']) || !empty($request['date_end'])) {
            $date_start = !empty($request['date_start']) ? Carbon::parse($request['date_start'])->startOfDay()->format('Y-m-d H:i:s') : Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $date_end = !empty($request['date_end']) ? Carbon::parse($request['date_end'])->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
            $orders = Order::whereBetween('created_at', [$date_start, $date_end])->where('user_id', $id)->get();
        }else {
            $orders = Order::where('user_id', $id)->get();
        }

        $user = User::find($id);
        if (!empty($orders->toArray())) {
            foreach ($orders as $index => $order){
                if (!empty($order->orderItems->toArray())) {
                    foreach ($order->orderItems as $key => $item) {
                        $product = ProductDetail::find($item->product_detail_id);
                        $category = json_decode($product->product->category_id);
                        $category = end($category);
                        $category_name = Category::find($category);
                        $quantity += $item->quantity;
                        $total_amount += $item->price;
                        $amount += $item->price * $item->quantity;
                        $array[$index][$key] = [
                            'sku' => $order->sku,
                            'order_date' => $order->order_date,
                            'sku_product' => !empty($product->product) ? $product->product->sku : '',
                            'name' => !empty($product->product) ? $product->product->name : '',
                            'size' => !empty($product->size) ? $product->size->size : '',
                            'quantity' => $item->quantity,
                            'total_amount' => $item->price,
                            'amount' => $item->quantiy * $item->price,
                            'discount' => $item->discount,
                            'category_name' => $category_name->name,
                            'user_name' => $user->name,
                        ];

                    }
                }
            }
        }

        $results = [];
        foreach ($array as $index => $item) {
            foreach ($item as $value) {
                array_push($results, $value);
            }
        }

        return view('backend.report.customer-report.show', compact('id', 'results','amount','total_amount', 'quantity'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detailedReport(Request $request){
        $results = [];

        if (!empty($request['date_start']) || !empty($request['date_end'])) {
            $date_start = !empty($request['date_start']) ? Carbon::parse($request['date_end'])->startOfDay()->format('Y-m-d H:i:s') : Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $date_end = !empty($request['date_end']) ? Carbon::parse($request['date_end'])->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
            $product_details = OrderItem::whereBetween('created_at', [$date_start, $date_end])->orderBy('id','desc')->groupBy('product_detail_id')->pluck('product_detail_id')->toArray();
        }else {
            $product_details = OrderItem::orderBy('id','desc')->groupBy('product_detail_id')->pluck('product_detail_id')->toArray();
        }

        if (!empty($product_details)) {
            foreach ($product_details as $index => $detail) {
                $items = OrderItem::with('order')->where('product_detail_id', $detail)->get();
                $results[$index] = $items;
            }
        }

        $array = [];
        $all_total_amount = 0;
        $all_quantity = 0;
        $all_amount = 0;
        if (!empty($results)) {
            foreach ($results as $index => $result){
                $total_amount = 0;
                $quantity = 0;
                $discount = 0;
                $amount = 0;
                foreach ($result as $item) {
                    $quantity += $item['quantity'];
                    $discount += $item['discount'];
                    $product = ProductDetail::find($item->product_detail_id);
                    $amount += $product['price'] * $item['quantity'];
                    $total_amount += $item['price'];
                    $array[$index] = [
                        'sku' => !empty($product) ? $product->product->sku : '',
                        'name' => !empty($product) ? $product->product->name : '',
                        'size' => $product->size->size,
                        'color' => $product->color->color,
                        'brand' => $product->brand,
                        'model' => $product->model,
                    ];
                }

                $array[$index]['total_amount'] = $total_amount;
                $array[$index]['quantity'] = $quantity;
                $array[$index]['discount'] = $discount;
                $array[$index]['amount'] = $amount;
                $all_total_amount += $total_amount;
                $all_amount += $amount;
                $all_quantity += $quantity;
            }
        }

        return view('backend.report.detailed-report.index',compact('array','all_quantity','all_amount','all_total_amount'));
    }
}
