@extends('layouts.app')







@section('content')
    <p class="mx-3">კატეგორიები</p>
    @foreach ($categories as $category)
        <div class="my-3 mx-3">
            <a href="{{ route('categories.show', $category->id) }}">{{ $category['title'] }}</a>
        </div>
    @endforeach
@endsection
