@extends('layouts.app')

@section('content')
<div class="container col-xxl-8 px-4 py-5">
    <div class="row d-flex align-center">
        <!-- breadcrumbs -->
        <nav class="col-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
            </ol>
        </nav>
        
        <!-- search form -->
        <div class="col-9">
            <x-search />
        </div>

    </div>
    <!-- Single product -->
    <div class="row flex-lg-row-reverse align-items-center py-5 shadow">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{$product->image ? asset('storage/' . $product->image) : asset('images/no-image.png')}}" class="d-block mx-lg-auto img-fluid" alt="{{$product->title}}" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">{{$product->title}}</h1>
            <p class="lead">{{$product->description}}</p>
            <div class="row">
                <p class="col-10 h4">
                    ${{$product->price}}
                </p>
                <p class="col-2 d-flex h5">

                    <x-category :categorys="$product->category" />

                </p>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-success btn-lg px-4 me-md-2"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
            </div>
        </div>
    </div>
</div>

@endsection