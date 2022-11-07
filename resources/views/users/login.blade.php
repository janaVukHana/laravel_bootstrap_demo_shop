@extends('layouts.app')

@section('content')
<div class="container py-5 row shadow mx-auto my-3 bg-dark text-light rounded">
    <div class="col-6 mx-auto">
        <h1>Login to your account</h1>
        <form action="/users/login" method="POST">
            @csrf
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
            
            <button type="submit" class="btn btn-success">Login</button>
        </form>

        <p>Don't have account? Make it <a href="/users/register">here</a> and continue where you stoped.</p>
    </div>
</div>
@endsection