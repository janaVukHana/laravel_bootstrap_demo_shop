@extends('layouts.app')

@section('content')
<!-- <div class="bg-warning"> -->
    <div class="bg-light">
        <section class="py-1 text-center container">
            <div class="row pt-3 pb-1">
            <div class="col-lg-11 col-md-10 mx-auto">
                <h1 class="fw-light">Shop Products Page</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
                <p>
                    @auth
                        {{-- Add something here maybe. It will look better --}}
                    @else    
                        <a href="/users/register" class="btn btn-success my-2">Registration link</a>
                    @endauth
                </p>
            </div>
            </div>

            <!-- search form -->
            <x-search  />

        </section>
    </div>

    <div class="album py-5 bg-secondary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($products as $product)
                    <!-- Item -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <a class="" href="/products/{{$product->id}}"><img class="w-100" src="{{$product->image ? asset('storage/' . $product->image) : asset('images/no-image.png')}}" alt=""></a>
                            <div class="card-body">
                                <h2 class="card-text h4">{{$product->title}}</h2>
                                <div class="float-left h5">

                                    <x-category :categorys="$product->category" />

                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-dark mt-2">${{$product->price}}</p>
                                    <div class="btn-group">
                                        <form action="/{{$product->id}}" method="post">
                                            @csrf   
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mt-2">
        {{$products->links()}}
        {{-- {!! $products->links() !!} --}}
    </div>
@endsection