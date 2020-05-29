@extends('layouts.app')

@section('content')
@include('layouts.navs.home1')

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4>Stock for {{ $item->product->name }}</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2">Retailer:</div>
                <div class="col-10">{{ $item->retailer->name }}</div>
            </div>
            
            <div class="row">
                <div class="col-2">Price:</div>
                <div class="col-10">${{ $item->price ? number_format($item->price / 100, 2) : 0.00 }}</div>
            </div>
            
            <div class="row">
                <div class="col-2">In Stock:</div>
                <div class="col-10">{{ $item->in_stock ? 'Yes' : 'No' }}</div>
            </div>
            
            <div class="row">
                <div class="col-2">Last Checked:</div>
                <div class="col-10">{{ ($item->updated_at)->diffForHumans() }}</div>
            </div>
            
            <div class="row">
                <div class="col-2">Link:</div>
                <div class="col-10">
                    <a href="{{ $item->url }}" target="_new">{{ $item->url }}</a>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <a href="#" class="btn btn-sm btn-primary">View History</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- {{ dd($stock) }} --}}
@endsection
