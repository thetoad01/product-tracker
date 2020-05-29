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

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4>Products</h4>
                </div>

                <div class="col-6">
                    <div class="text-right">
                        <a href="#" class="btn btn-sm btn-success">Add</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($products as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                        <li class="list-group-item hoverable border-0">
                            <div class="row">   
                                <div class="col-2 text-left">
                                    {{ $product->name }}
                                </div> 
                                <div class="col-8 text-left">
                                    {{ $product->url }}
                                </div>
            
                                <div class="col-2 text-right">
                                    {{ ($product->created_at)->toFormattedDateString() }}
                                </div>
                            </div>
                        </li>
                    </a>

                    
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
