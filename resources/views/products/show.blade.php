@extends('layouts.app')

{{-- @php
    dd($comments);
@endphp --}}

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
                <form action="/{{$product->id}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg px-4 me-md-2"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                </form>
            </div>
        </div>
    </div>

    {{-- here goes comments --}}
    <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://demo-shop-1.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<script id="dsq-count-scr" src="//demo-shop-1.disqus.com/count.js" async></script>
{{-- <div class="row d-flex align-center mt-3 p-3 shadow">
        @auth
            <div class="container my-3">
                <h2>Add comment ...</h2>
                <form action="/products/comment/add" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$product->id}}">
                    <div class="my-1">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea 
                            type="text" 
                            id="comment" 
                            name="comment" 
                            class="form-control"
                        >{{old('comment')}}</textarea>
                        @error('comment')
                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" id="addCommentBtn" class="btn btn-success px-5">Add</button>
                </form>
            </div>
        @endauth
        <div class="container">
            @foreach ($comments as $comment)
                <div class="d-flex justify-content-between bg-dark text-light py-1 px-4 mb-1 rounded">
                    <p>{{$comment->comment}}</p>
                    <p><small class="text-sm text-light">{{$comment->created_at}}</small></p>
                </div>
            @endforeach
        </div>
    </div> --}}
    {{-- here ends commenting div --}}
</div>

@endsection