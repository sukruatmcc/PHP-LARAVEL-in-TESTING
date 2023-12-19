@extends('master');
@section('title')
    Create
@endsection
@section('content')
    <div class="card-header">
        <div>
            <h2>Product Create</h2>
        </div>
        <a href="{{ route('product.index') }}" class="btn btn-primary float-end">Product Index</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('product.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"><br>
            </div>
            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-select @error('name') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Open this select type</option>
                    <option value="Software">Software</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Computer">Computer</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
