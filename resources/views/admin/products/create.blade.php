@extends('layouts.app')

@section('content')
@php
    // if(old('category')) {
    //     dd(in_array('yersea', old('category')));
    // }
    // dd(old('category')[0]);
@endphp
<h1 class="text-center mt-3">Create New Product</h1>
        <div class="container py-5 row shadow mx-auto mb-3 bg-dark text-light rounded">
            <div class="col-6 mx-auto">
                <form action="/admin/products/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- title input --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input 
                            type="name"     
                            class="form-control" 
                            id="title" 
                            name="title" 
                            value="{{old('title')}}"
                        />
                        @error('title')
                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- price input --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input 
                            type="number" 
                            step=0.01
                            min="10"
                            max="1000"
                            class="form-control" 
                            id="price" 
                            name="price" 
                            value="{{old('price')}}"
                            />
                            @error('price')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                    </div>
                    <!-- category checkboxes -->
                    <div class="mb-3">
                        <label for="">Choose category</label>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                value="ball" id="ball" 
                                name="category[]"
                                {{-- save input checked if error in form --}}
                                {{old('category') && in_array('ball', old('category')) ? 'checked' : '';}}
                            />
                            <label class="form-check-label" for="ball">
                                Ball
                            </label>
                        </div>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                value="yersea" 
                                id="yersea" 
                                name="category[]"
                                {{-- save input checked if error in form --}}
                                {{old('category') && in_array('yersea', old('category')) ? 'checked' : '';}}
                            />
                            <label class="form-check-label" for="yersea">
                                Yersea
                            </label>
                        </div>
                    </div>
                    @error('category')
                        <p class="text-danger text-sm mt-1">{{$message}}</p>
                    @enderror
                    {{-- file input --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="image" 
                            name="image" 
                        />
                    </div>
                    @error('image')
                        <p class="text-danger text-sm mt-1">{{$message}}</p> 
                    @enderror
                    {{-- description textarea --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea 
                            type="text" 
                            class="form-control" 
                            id="description" 
                            name="description">{{old('description')}}</textarea>
                        @error('description')
                            <p class="text-danger text-sm mt-1">{{$message}}</p> 
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>

@endsection