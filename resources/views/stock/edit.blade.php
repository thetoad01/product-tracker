@extends('layouts.app')

@section('content')
@include('layouts.navs.home1')

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Stock Item Being Tracked</h4>
                </div>

                <div class="col-6 text-right">
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('stock.update', $stock->id) }}" method="POST">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="retailer">Retailer</label>
                    <select class="form-control" id="retailer" name="retailer_id">
                        <option value="" selected>Select Retailer</option>
                        @foreach ($retailers as $retailer)
                            <option value="{{ $retailer->id }}" @if ($retailer->id == $stock->retailer_id || old('retailer_id') == $retailer->id) selected @endif>{{ $retailer->name }}</option>
                        @endforeach
                    </select>
                    @error('retailer_id')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="product">Product</label>
                    <select class="form-control" id="product" name="product_id">
                        <option value="" selected>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if ($product->id == $stock->product_id) selected @endif>{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control" value="{{ old('url') ?? $stock->url }}">
                    @error('url')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku') ?? $stock->sku }}">
                    @error('sku')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') ?? $stock->price }}">
                    @error('price')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="inStock" name="in_stock" @if ($stock->in_stock) checked @endif>
                        <label class="custom-control-label" for="inStock">Currently In Stock?</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('stock.destroy', $stock->id) }}" method="POST">
                @csrf
                @method('delete')

                <div class="modal-body">
                    <p>You are about to delete a stock item that is being tracked.</p>
                    <p>All history for this item will also be deleted.</p>
                    <p class="font-weight-bold">Do you really want to do this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
