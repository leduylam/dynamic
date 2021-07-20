<?php

namespace App\Http\Controllers\Dynamic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\EditUserRequest;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function account(){
        return view('dynamicsportsvn.customer.account');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function historyOrder(){
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('dynamicsportsvn.customer.history', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function historyDetail($id){
        $order = Order::find($id);
        $order_items = OrderItem::with('productDetail')->where('order_id', $id)->orderBy('created_at', 'desc')->get();
        foreach ($order_items as $index => $item){
            $image_id = ProductImage::where('product_id', $item->product_id)->orderBy('created_at', 'desc')->first();
            if (!empty($image_id)) {
                $image = Image::find($image_id->image_id);
                $order_items[$index]['image'] = $image->description;
            }
        }

        return view('dynamicsportsvn.customer.history_detail', compact('order', 'order_items'));
    }

    /**
     * @param EditUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detail(EditUserRequest $request)
    {
        $user = User::find(auth()->id());
        $user['email'] = !empty($request['email']) ? $request['email'] : $user->email;
        $user['name'] = !empty($request['name']) ? $request['name'] : $user->name;
        $user['phone'] = !empty($request['phone']) ? $request['phone'] : $user->phone;
        $user['address'] = !empty($request['address']) ? $request['address'] : $user->address;
        $user->save();

        return redirect()->back()->with('success', 'Update success');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
           'password' => 'required|string|min:6|max:12',
           'password_new' => 'required|string|min:6|max:12|confirmed',
        ]);

        $password = bcrypt($request['password']);
        if ($password == auth()->user()->getAuthPassword()){
            $user = User::find(auth()->id());
            $user['password'] = bcrypt($request['password_new']);
            $user->save();

            return redirect()->back('success', 'Update user success');
        }

        return redirect()->back('error', 'Update user error');
    }

}
