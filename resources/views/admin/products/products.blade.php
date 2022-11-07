@extends('layouts.app')

@section('content')

<!-- <div class="bg-warning"> -->
    <div class="bg-light">
        <section class="py-1 text-center container">
            <div class="row pt-5 pb-1">
                <div class="col-lg-11 col-md-10 mx-auto">
                    <h1 class="fw-light">Admin Panel</h1>
                </div>
            </div>
            <!-- create New product -->
            <a href="/admin/products/create" class="btn btn-success w-100 mb-1">Create New Product</a>
            <!-- search form -->
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control bg-dark text-secondary" placeholder="Search products by title, description or category">
                    <button class="btn btn-success" type="submit" name="search">Search</button>
                </div>
            </form>
        </section>
    </div>

    <div class="container">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @if (count($products) == 0)
                    <tr><td><p>No products found!</p></td></tr>
                @else
                    @foreach ($products as $i => $product)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td><a href="/products/{{$product->id}}"><img style="width:50px;" src="{{$product->image ? asset('storage/' . $product->image) : asset('images/no-image.png')}}" alt=""></a></td>
                            <td>{{$product->title}}</td>
                            <td>${{$product->price}}</td>
                            <td>
                                <a href="/admin/products/edit/{{$product->id}}" class="btn btn-info btn-sm">Edit</a>
                                <form action="/admin/products/delete/{{$product->id}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
               
            </tbody>
        </table>
    </div>

@endsection