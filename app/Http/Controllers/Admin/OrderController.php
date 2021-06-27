<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AddOrderRequest;
use App\Http\Requests\Order\EditOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::all();
        return view('backend.order.index', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $order = Order::orderBy('sku', 'desc')->first();
        if (!empty($order)) {
            $sku = explode('/', $order['sku'])[1];
            $sku_new = (int)$sku + 1;
            $sku_int = (int)$sku;
            $sku = str_replace($sku_int, $sku_new, $sku);
        }
        $order = !empty($order) ? $sku : '00001';
        $sku_order = 'DSC' . Carbon::now()->format('y') . '/' . $order;

        return view('backend.order.create', compact('sku_order'));
    }

    /**
     * @param AddOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddOrderRequest $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                // create order
                $user = User::where('sku', $request['customer_sku'])->first();
                $order = new Order();
                $data = $request->only($order->getFillable());
                $data['order_date'] = Carbon::now()->format('Y-m-d H:i:s');
                $data['status_code'] = Order::STATUS_1;
                $data['user_id'] = $user->id;
                $data['total_amount'] = !empty($request['amount']) ? $request['amount'] : 0;
                $order->fill($data)->save();

                // create order_items
               $this->addOrUpdateOrderItem($request->all(), $order);

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
                'data' => null,
            ], 200);
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 500);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customer(Request $request)
    {
        if ($request->ajax()) {
            $customer = User::where('sku', $request['sku'])->first();
            $customer = !empty($customer) ? $customer : null;
            return response()->json([
                'statusCode' => 1,
                'data' => $customer
            ], 200);
        }

        return response()->json([
            'statusCode' => 0,
            'data' => null
        ], 500);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function product(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('details')->where('sku', $request->sku)->first();
            if (!empty($product)) {
                if (!empty($product->details->toArray())) {
                    foreach ($product->details as $key => $item) {
                        $product->details[$key]['detail'] = $product->name . '/' . $item->size . '/' . $item->color . '(' . $item->stock->quantity . ')';
                        $product->details[$key]['quantity'] = $item->stock->quantity;
                    }
                }
            }

            if (!empty($product)) {
                return response()->json([
                    'statusCode' => 1,
                    'data' => $product,
                ], 200);
            } else {
                return response()->json([
                    'statusCode' => 0,
                    'data' => null,
                ], 200);
            }

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
    public function edit($id)
    {
        $order = Order::find($id);
        $order->shipping_start_date = !empty($order->shipping_start_date) ? strtotime($order->shipping_start_date) : '';
        if (!empty($order->orderItems->toArray())) {
            foreach ($order->orderItems as $index => $item) {
                $product_details = ProductDetail::where('product_id', $item->product->product_id)->get();
                $array = array();
                if (!empty($product_details->toArray())) {
                    foreach ($product_details as $key => $product_detail) {
                        $array[] = [
                            'id' => $product_detail->id,
                            'product_detail' => $product_detail->product->name . '/'. $product_detail->size .'/' .$product_detail->color.'('. $product_detail->stock->quantity.')',
                            'stock' => $product_detail->stock->quantity,
                            'price' => $product_detail->price,
                        ];
                    }
                }
                $order->orderItems[$index]['product_details'] = $array;
            }
        }

        return view('backend.order.edit', compact('order'));
    }

    /**
     * @param EditOrderRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditOrderRequest $request, $id)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $user = User::where('sku', $request['customer_sku'])->first();
                $order = Order::find($id);
                $data = $request->only($order->getFillable());
                $data['user_id'] = $user->id;
                $data['total_amount'] = !empty($request['amount']) ? $request['amount'] : 0;
                $order->fill($data)->save();

                //delete orderItems
                if (!empty($order->orderItems->toArray())) {
                    foreach ($order->orderItems as $orderItem) {
                        $stock = Stock::where('product_detail_id', $orderItem->product_detail_id)->first();
                        if (!empty($stock)) {
                            $stock['quantity'] += $orderItem->quantity;
                            $stock->save();
                        }
                    }
                }

                // delete product
                $order->orderItems()->delete();

                // create order_items
                $this->addOrUpdateOrderItem($request->all(), $order);

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
        DB::beginTransaction();
        try {
            $order = Order::find($id);
            if (!empty($order->orderItems->toArray())) {
                foreach ($order->orderItems as $orderItem) {
                    $stock = Stock::where('product_detail_id', $orderItem->product_detail_id)->first();
                    if (!empty($stock)) {
                        $stock['quantity'] += $orderItem->quantity;
                        $stock->save();
                    }
                }
            }

            // delete product
            $order->orderItems()->delete();
            $order->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Delete order error');
        }

        return redirect()->back()->with('success', 'Delete order successfully');
    }

    /**
     * @param $request
     * @param $order
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function addOrUpdateOrderItem($request, $order)
    {
        $array = array();
        if (!empty($request['product_name'])) {
            foreach ($request['product_name'] as $key => $value) {
                $array[$value][$key] = [
                    'product_item' => $value,
                    'sku' => $request['product_sku'][$key],
                    'quantity' => $request['quantity_product_detail'][$key],
                    'price' => $request['price'][$key],
                    'discount' => $request['discount'][$key],
                    'total_amount' => $request['total_product_detail'][$key],
                ];
            }
        }

        if (!empty($array)) {
            foreach ($array as $item) {
                $total_amount = 0;
                $quantity = 0;
                $discount = 0;
                $product_detail_id = '';
                if (!empty($item)) {
                    foreach ($item as $value) {
                        $total_amount += !empty($value['total_amount']) ? $value['total_amount'] : 0;
                        $quantity += !empty($value['quantity']) ? $value['quantity'] : 0;
                        $discount += !empty($value['discount']) ? $value['discount'] : 0;
                        $product_detail_id = !empty($value['product_item']) ? $value['product_item'] : null;
                    }
                }

                $stock = Stock::where('product_detail_id', $product_detail_id)->first();
                if (!empty($stock) && $stock['quantity'] >= $quantity) {
                    $order_item = new OrderItem();
                    $order_item['order_id'] = $order->id;
                    $order_item['product_detail_id'] = $product_detail_id;
                    $order_item['quantity'] = $quantity;
                    $order_item['price'] = $total_amount;
                    $order_item['discount'] = $discount;
                    $order_item->save();

                    // stock product
                    $stock['quantity'] = $stock['quantity'] - $quantity;
                    $stock->save();
                } else {
                    return response()->json([
                        'statusCode' => 0,
                        'data' => null,
                    ], 500);
                }
            }
        }

        return true;
    }
}
