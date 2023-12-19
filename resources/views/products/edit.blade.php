@extends('master');
@section('title')
    Create
@endsection
@section('content')
    <div class="card-header">
        <div>
            <h2>Product Edit</h2>
        </div>
        <a href="{{ route('product.index') }}" class="btn btn-primary float-end">Product Index</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('product.update',$product->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name"><br>
            </div>
            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-select @error('name') is-invalid @enderror" aria-label="Default select example">
                    <option {{ $product->type == "Software" ? 'Selected' : ''}} value="Software">Software</option>
                    <option {{ $product->type == "Fruit" ? 'Selected' : ''}} value="Fruit">Fruit</option>
                    <option {{ $product->type == "Computer" ? 'Selected' : ''}} value="Computer">Computer</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection
