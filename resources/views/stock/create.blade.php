@extends('layouts.app')

@section('content')
@include('layouts.navs.home1')

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4>Add New Stock to Track</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('stock.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="retailer">Retailer</label>
                    <select class="form-control" id="retailer" name="retailer_id">
                        <option value="" selected>Select Retailer</option>
                        @foreach ($retailers as $retailer)
                            <option value="{{ $retailer->id }}" @if ($retailer_id == $retailer->id) selected @endif>{{ $retailer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="product">Product</label>
                    <select class="form-control" id="product" name="product_id">
                        <option value="" selected>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if ($product_id == $product->id) selected @endif>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" name="sku" id="sku" class="form-control">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control">
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="inStock" name="in_stock">
                        <label class="custom-control-label" for="inStock">Current In Stock?</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
