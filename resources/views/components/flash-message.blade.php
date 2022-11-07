@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="position-fixed top-0 w-100 bg-danger text-light text-center py-2">
        {{session('message')}}
    </div>
@endif
