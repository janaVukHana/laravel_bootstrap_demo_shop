@extends('layouts.app')

@section('content')


<!-- <div class="bg-warning"> -->
    <div class="bg-light">
        <section class="py-1 text-center container">
            <div class="row pt-5 pb-1">
                <div class="col-lg-11 col-md-10 mx-auto">
                    <h1 class="fw-light">Shopping Cart page</h1>
                </div>
                <form action="/products/shopping-cart/destroy" method="POST">
                    @csrf
                
                    <button class="btn btn-outline-secondary">Remove all from cart</button>
                </form>
            </div>
        </section>
    </div>

    <div class="container">
        <form action="/products/order">
            @csrf
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

                    @if (!session()->has('cart') || !session()->get('cart')->items)
                        <tr><td><p>No products found!</p></td></tr>
                    @else
                        @php
                            $cartItems = session()->get('cart')->items;
                        @endphp

                        @foreach ($cartItems as $i => $product)
                            <tr>
                                <td>{{$i + 1}}</td>
                                {{-- <td><a href="/products/{{$product['item']->id}}"><img style="width:50px;" src="{{asset('images/no-image.png')}}" alt=""></a></td> --}}
                                <td><a href="/products/{{$product['item']->id}}"><img style="width:50px;" src="{{$product['item']->image ? asset('storage/'.$product['item']->image) : asset('images/no-image.png')}}" alt=""></a></td>
                                <td>{{$product['item']->title}}</td>
                                <td>${{$product['item']->price}}</td>
                                <td>
                                    <input 
                                        type="number" 
                                        name="{{'id-'.$product['item']->id}}" 
                                        step="1" 
                                        min="1" 
                                        max="10" 
                                        value="{{$product['quantity']}}"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
            </table>

                <button class="btn btn-success" type="submit">Checkout</button>
        </form>
    </div>

@endsection