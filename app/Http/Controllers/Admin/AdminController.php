<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddAdminRequest;
use App\Http\Requests\Admin\EditAdminRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        // total order day
        $is_check_day = false;
        $date_start = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        $date_end = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
        $date_start_yes = Carbon::yesterday()->startOfDay()->format('Y-m-d H:i:s');
        $date_end_yes = Carbon::yesterday()->endOfDay()->format('Y-m-d H:i:s');
        $order_date_yes = Order::whereBetween('order_date',[$date_start_yes, $date_end_yes])->get();
        $order_date = Order::whereBetween('order_date',[$date_start, $date_end])->get();
        $total_order_date = $this->totalOrderPrice($order_date);
        $total_order_yes = $this->totalOrderPrice($order_date_yes);
        if ($total_order_date > $total_order_yes) {
            $is_check_day = true;
        }

        // total order month
        $is_check_month = false;
        $date_start_month = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $date_end_month = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        $date_start_month_yes = Carbon::now()->startOfMonth()->subDays(1)->format('Y-m-d H:i:s');
        $date_end_month_yes = Carbon::now()->endOfMonth()->subDays(1)->format('Y-m-d H:i:s');
        $order_month = Order::whereBetween('order_date',[$date_start_month, $date_end_month])->get();
        $total_order_month = $this->totalOrderPrice($order_month);
        $order_month_yes = Order::whereBetween('order_date',[$date_start_month_yes, $date_end_month_yes])->get();
        $total_order_month_yes = $this->totalOrderPrice($order_month_yes);
        if ($total_order_month > $date_end_month_yes) {
            $is_check_month = true;
        }

        // total order year
        $is_check_year = false;
        $date_start_year = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
        $date_end_year = Carbon::now()->endOfYear()->format('Y-m-d H:i:s');
        $order_year = Order::whereBetween('order_date',[$date_start_year, $date_end_year])->get();
        $total_order_year = $this->totalOrderPrice($order_year);
        $date_start_year_yes = Carbon::now()->startOfYear()->subDays('365')->format('Y-m-d H:i:s');
        $date_end_year_yes = Carbon::now()->endOfYear()->subDays('365')->format('Y-m-d H:i:s');
        $order_year_yes = Order::whereBetween('order_date',[$date_start_year_yes, $date_end_year_yes])->get();
        $total_order_year_yes = $this->totalOrderPrice($order_year_yes);
        if ($total_order_year > $total_order_year_yes) {
            $is_check_year = true;
        }

        // custom top 5 by month
        $query = Order::select(\DB::raw('count(*) as user_count, user_id'))
            ->whereBetween('order_date',[$date_start_month, $date_end_month])
            ->groupBy('user_id')
            ->orderBy('user_count', 'desc')->limit(5)
            ->pluck('user_id')->toArray();
        $total_amount_by_month_name = [];
        $total_amount_by_month_amount = [];
        if (!empty($query)) {
            foreach ($query as $index => $item) {
                $user = User::find($item);
                $total_amount_by_month_amount[$index] = 0;
                $total_amount_by_month_name[$index] = $user['name'];
                $orders = Order::where('user_id', $item)->whereBetween('order_date',[$date_start_month, $date_end_month])->get();
                foreach ($orders as $order) {
                    $total_amount_by_month_amount[$index] += $order->total_amount;
                }
            }
        }

        // custom top 5 by year
        $customer_year = Order::select(\DB::raw('count(*) as user_count, user_id'))
            ->whereBetween('order_date',[$date_start_year, $date_end_year])
            ->groupBy('user_id')
            ->orderBy('user_count', 'desc')->limit(5)
            ->pluck('user_id')->toArray();
        $total_amount_by_year_name = [];
        $total_amount_by_year_amount = [];
        if (!empty($customer_year)) {
            foreach ($customer_year as $index => $item) {
                $user = User::find($item);
                $total_amount_by_year_amount[$index] = 0;
                $total_amount_by_year_name[$index] = $user['name'];
                $orders = Order::where('user_id', $item)->whereBetween('order_date',[$date_start_month, $date_end_month])->get();
                foreach ($orders as $order) {
                    $total_amount_by_year_amount[$index] += $order->total_amount;
                }
            }
        }

        // order by category
        $order_category_month = OrderItem::with('category');
        $order_category_month->whereHas('order', function ($q) use ($date_start_month, $date_end_month) {
            $q->whereBetween('order_date',[$date_start_month, $date_end_month]);
        })->select(\DB::raw('order_items.*,sum(price) as total_amount ,count(*) as category_count, category_id'))
            ->groupBy('category_id')
            ->orderBy('category_count', 'desc')->limit(5);
        $order_category_month = $order_category_month->get();
        $order_category_month_name = [];
        $order_category_month_total = [];
        if (!empty($order_category_month->toArray())) {
            foreach ($order_category_month as $index => $item){
                $order_category_month_name[$index] = $item->category->name;
                $order_category_month_total[$index] = $item->total_amount;
            }
        }

        $order_category_year = OrderItem::query();
        $order_category_year->whereHas('order', function ($q) use ($date_start_year, $date_end_year) {
                    $q->whereBetween('order_date',[$date_start_year, $date_end_year]);
                })->select(\DB::raw('order_items.*,sum(price) as total_amount ,count(*) as category_count, category_id'))
                    ->groupBy('category_id')
                    ->orderBy('category_count', 'desc')->limit(5)->get();
        $order_category_year = $order_category_year->get();
        $order_category_year_name = [];
        $order_category_year_total = [];
        if (!empty($order_category_year->toArray())) {
            foreach ($order_category_year as $index => $item){
                $order_category_year_name[$index] = $item->category->name;
                $order_category_year_total[$index] = $item->total_amount;
            }
        }


        return view('backend.dashboard',
            compact('total_order_date',
                'total_amount_by_month_amount',
                'total_amount_by_month_name',
                'total_order_month',
                'total_order_year',
            'total_amount_by_year_amount',
            'total_amount_by_year_name',
            'is_check_day',
            'is_check_month',
            'is_check_year',
            'order_category_month_total',
            'order_category_month_name',
            'order_category_year_name',
            'order_category_year_total'
            )
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listAdmin()
    {
        $admins = Admin::all();

        return view('backend.admin.index', compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.admin.create');
    }

    /**
     * @param AddAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['confirmation_code'] = md5(uniqid(mt_rand(), true));
        $data['confirmed'] = true;
        $data['status'] = true;
        Admin::create($data);

        return redirect()->route('admin.list')->with('success', 'Admin created successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('backend.admin.edit', compact('admin'));
    }

    /**
     * @param EditAdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditAdminRequest $request, $id)
    {
        $admin = Admin::find($id);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $admin->update($data);

        return redirect()->route('admin.list')->with('success', 'Admin update successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Delete category successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function timeDay(Request $request)
    {
        if ($request->ajax()){
            $date = Carbon::parse($request['date'])->format('Y/m/d');
            $date_start = Carbon::parse($request['date'])->startOfDay()->format('Y-m-d H:i:s');
            $date_end = Carbon::parse($request['date'])->endOfDay()->format('Y-m-d H:i:s');
            $order_date = Order::whereBetween('order_date',[$date_start, $date_end])->get();
            $total_order_date = $this->totalOrderPrice($order_date);

            return response()->json([
               'status' => 1,
               'data' => [$total_order_date, $date],
            ], 200);
        }

        return response()->json([
           'status' => 0,
           'data' => null
        ], 500);
    }

    public function timeMonth(Request $request)
    {
        if ($request->ajax()){
            $date = Carbon::parse($request['date'])->format('Y/m');
            $date_start = Carbon::parse($request['date'])->startOfDay()->format('Y-m-d H:i:s');
            $date_end = Carbon::parse($request['date'])->endOfMonth()->format('Y-m-d H:i:s');
            $order_date = Order::whereBetween('order_date',[$date_start, $date_end])->get();
            $total_order_date = $this->totalOrderPrice($order_date);

            return response()->json([
               'status' => 1,
               'data' => [$total_order_date, $date],
            ], 200);
        }

        return response()->json([
           'status' => 0,
           'data' => null
        ], 500);
    }

    public function timeYear(Request $request)
    {
        if ($request->ajax()){
            $date_start_year = Carbon::createFromDate($request['date'], 1,1)->format('Y/m/d');
            $date_end_year = Carbon::createFromDate($request['date'], 12, 31)->format('Y/m/d');
            $order_date = Order::whereBetween('order_date',[$date_start_year, $date_end_year])->get();
            $total_order_date = $this->totalOrderPrice($order_date);

            return response()->json([
               'status' => 1,
               'data' => [$total_order_date, $date_start_year, $date_end_year],
            ], 200);
        }

        return response()->json([
           'status' => 0,
           'data' => null
        ], 500);
    }

    /**
     * @param $order_date
     * @return int
     */
    public function totalOrderPrice($order_date)
    {
        $total_order_date = 0;
        if (!empty($order_date->toArray())) {
            foreach ($order_date as $value) {
                $total_order_date += $value->total_amount;
            }
        }

        return $total_order_date;
    }
}
