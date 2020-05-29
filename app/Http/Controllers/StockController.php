<?php

namespace App\Http\Controllers;

use App\Product;
use App\Retailer;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $retailer_id = '';
        $product_id = '';

        if (request()->retailer_id) {
            $retailer_id = request()->retailer_id;
        }

        if (request()->product_id) {
            $product_id = request()->product_id;
        }

        // These needs to be helpers
        $retailers = Retailer::select('id','name')->get()->unique()->sort();
        $products = Product::select('id','name')->get()->unique()->sort();

        return view('stock.create', [
            'retailers' => $retailers,
            'products' => $products,
            'retailer_id' => $retailer_id,
            'product_id' => $product_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
