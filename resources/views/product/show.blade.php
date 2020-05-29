@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#secondaryNav" aria-controls="secondaryNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="secondaryNav">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4>
                        Product:
                        {{ $product->name }}
                    </h4>
                </div>

                <div class="col-6">
                    <div class="text-right">
                        <a href="{{ route('stock.create', ['product_id' => $product->id]) }}" class="btn btn-sm btn-success">Add Tracker</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-sm table-hover">
                <thead class="border-top-0">
                    <tr>
                        <th class="border-top-0">URL</th>
                        <th class="border-top-0 text-right">Price</th>
                        <th class="border-top-0 text-right">In Stock</th>
                        <th class="border-top-0 text-right">Last Checked</th>
                        <th class="border-top-0"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($product->stock as $item)
                    <tr>
                        <td>{{ $item->url }}</td>
                        <td class="text-right">{{ $item->price ? number_format($item->price / 100, 2) : 0 }}</td>
                        <td class="text-right">{{ $item->in_stock ? 'Yes' : 'No' }}</td>
                        <td class="text-right">{{ ($item->updated_at)->toDayDateTimeString() }}</td>
                        <th class="text-right">
                            <a href="{{ route('stock.edit', ['stock' => $item->id, 'product_id' => $product->id, 'retailer_id' => $item->retailer_id]) }}">Edit</a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
