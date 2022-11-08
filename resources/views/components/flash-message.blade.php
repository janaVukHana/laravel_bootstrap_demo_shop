@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="position-fixed top-0 start-50 w-50 translate-middle-x bg-danger text-light text-center py-2">
        {{session('message')}}
    </div>
@endif
