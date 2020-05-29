@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h4 class="text-center">What do you want to do now?</h4>

            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('retailer.index') }}">View Retailers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add Retailer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">View Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">View Product History</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
