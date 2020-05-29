@extends('layouts.app')

@section('content')
@include('layouts.navs.home1')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h4>Stock</h4>
        </div>

        <div class="card-body">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Retailer</th>
                        <th>Product</th>
                        <th>Sku</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">In Stock</th>
                        <th class="text-right">Last Updated</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $item)
                        <tr>
                            <td>{{ $item->retailer->name }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->sku }}</td>
                            <td class="text-center">${{ $item->price ? number_format($item->price / 100, 2) : 0 }}</td>
                            <td class="text-center">{{ $item->in_stock ? 'Yes' : 'No' }}</td>
                            <td class="text-right">{{ ($item->updated_at)->toDayDateTimeString() }}</td>
                            <td class="text-right">
                                <a href="{{ route('stock.show', $item->id) }}" class="btn btn-link py-0">Details</a>
                                <a href="{{ route('stock.edit', $item->id) }}" class="btn btn-link py-0">Edit</a>
                                <a href="{{ $item->url }}" class="btn btn-link py-0" target="_new">Visit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- {{ dd($stock) }} --}}
@endsection
