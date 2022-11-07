@props(['categorys'])

@php
$categorys = explode(',', $categorys);
@endphp
@foreach ($categorys as $category)
<a href="/?category={{$category}}"><span class="badge bg-secondary mx-1">{{$category}}</span></a>
@endforeach