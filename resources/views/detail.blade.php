@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Product Detail</div>
            <div class="card-body text-center">                   
                @if(isset($details))
                <div class="card-body">
                    <h2>Product details</h2>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr><td>Sku</td><td>{{$details->sku}}</td></tr>
                            <tr><td>Name</td><td>{{$details->name}}</td></tr>
                            <tr><td>Brand</td><td>{{$details->brand}}</td></tr>
                            <tr><td>Retail</td><td>{{$details->msrp}}</td></tr>
                            <tr><td>Map</td><td>{{$details->price}}</td></tr>
                            <tr><td>Cost</td><td>{{$details->cost}}</td></tr>
                            <tr><td>Ship Cost</td><td>{{$details->ship_cost}}</td></tr>
                            <tr><td>Options</td><td>{{$details->options}}</td></tr>
                        </tbody>
                    </table>                
                </div>
                @else
                @if(isset($message))
                <p>  {{ $message }}</p>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection