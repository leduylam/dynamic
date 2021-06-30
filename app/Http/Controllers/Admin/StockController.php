<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\EditStockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $stocks = Stock::with('productDetail')->get();
        foreach ($stocks as $index => $stock){
            $name = $stock->productDetail->product->name.'/'.$stock->productDetail->size.'/'.$stock->productDetail->color.'('.$stock->productDetail->price.')';
            $stocks[$index]['name'] = $name;
        }

        return view('backend.stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditStockRequest $request, $id)
    {
        if ($request->ajax()) {
            $stock = Stock::find($id);
            $stock['quantity'] = !empty($request['quantity']) ? $request['quantity'] : $stock['quantity'];
            $stock->save();

            return response()->json([
               'statusCode' => 1,
               'data' => null
            ], 200);
        }

        return response()->json([
           'statusCode' => '0',
           'data' => null
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
