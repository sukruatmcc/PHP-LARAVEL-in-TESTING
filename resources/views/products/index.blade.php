@extends('master');
@section('title')
    Index
@endsection
@section('content')
    <div class="card-header">
        <div>
            <h2>Products</h2>
        </div>
        @auth
            <a href="{{ route('product.create') }}" class="btn btn-primary float-end">Create Product</a>
        @endauth
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->type }}</td>
                        <td>
                            <button class="btn btn-success btn-sm">Buy</button>
                            <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('product.destroy',$product->id) }}" class="btn btn-danger btn-sm">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
