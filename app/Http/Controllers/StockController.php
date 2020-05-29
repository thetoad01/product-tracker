<?php

namespace App\Http\Controllers;

use App\Product;
use App\Retailer;
use App\Stock;
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
        $validated = $request->validate([
            'retailer_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'url' => 'required|url',
            'sku' => 'required',
            'price' => 'required|numeric',
        ]);

        $in_stock = isset($request->in_stock) ? true : false;

        $stock = Stock::updateOrCreate(
            [
                'retailer_id' => $validated['retailer_id'],
                'product_id' => $validated['product_id'],
                'url' => $validated['url'],
            ],
            [
                'sku' => $validated['sku'],
                'price' => (int) ($validated['price'] * 100),
                'in_stock' => $in_stock,
            ]
        );

        return redirect()->route('product.show', $validated['product_id']);
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

        $stock = Stock::find($id);
        
        return view('stock.edit', [
            'retailers' => $retailers,
            'products' => $products,
            'stock' => $stock,
        ]);
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
        $validated = $request->validate([
            'retailer_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'url' => 'required|url',
            'sku' => 'required',
            'price' => 'required|numeric',
        ]);

        $in_stock = isset($request->in_stock) ? true : false;

        Stock::where('id', $id)
            ->update([
                'retailer_id' => $validated['retailer_id'],
                'product_id' => $validated['product_id'],
                'url' => $validated['url'],
                'sku' => $validated['sku'],
                'price' => (int) ($validated['price'] * 100),
                'in_stock' => $in_stock,
            ]);

        return redirect()->route('product.show', $validated['product_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);

        $stock->delete();

        return redirect()->route('product.index');
    }
}
