@extends('layouts.app')

@section('content')
<div class="container py-5 row shadow mx-auto my-3 bg-dark text-light rounded">
    <div class="col-6 mx-auto">
        <h1 class="">Make registration</h1>
        <form action="/users/register" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    value="{{old('name')}}"
                />
                @error('name')
                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    value="{{old('email')}}"
                />
                @error('email')
                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            
            {{-- <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" />
            </div> --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password"
                    value="{{old('password')}}"
                />
                @error('password')
                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            
            <button type="submit" class="btn btn-success">Register</button>
        </form>

        <p>You have account? Log in <a href="/users/login">here</a> and continue where you stoped.</p>
    </div>
</div>
@endsection