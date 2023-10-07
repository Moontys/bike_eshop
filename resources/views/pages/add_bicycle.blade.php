@extends('layouts.app')

@section('title')
    ADD NEW BICYCLE
@endsection

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
            {{Session::put('success', null)}}
        </div>
    @endif

    <form action="{{url('/save-product')}}" method="POST" class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group">
            <label>Product Brand</label>
            <input type="text" name="product_brand" placeholder="Bicycle Brand" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Product Price</label>
            <input type="text" name="product_price" placeholder="Bicycle Price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea name="product_description" cols="100" rows="10" placeholder="Bicycle Description" class="form-control" required></textarea>
        </div>
        <input type="submit" value="Add Product" class="btn btn-primary">
    </form>

@endsection