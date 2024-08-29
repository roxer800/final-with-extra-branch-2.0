@extends('layouts.app')



<div class="d-flex justify-content-between align-items-center test">
    <h2>პროდუქტების სია</h2>

    @if ($user->is_admin)
        <a class="btn btn-primary" href="{{ route('products.create') }}">პროდუქტის დამატება</a>
        <a class="btn btn-primary" href="{{ route('admin.index') }}">admin panel</a>
    @endif

    <a class="btn btn-secondary" href="{{ route('categories.index') }}">კატეგორიები</a>



    @if (!$user->is_admin)
        <div class="d-flex align-items-center">
            <a href="{{ route('basket.index') }}" class="btn btn-info">კალათა</a>
            <p class="mb-0 ms-2"> {{ $basketLength }} პროდუქტი</p>
        </div>
    @endif
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div>პროფილი</div>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    <a class=" mx-4 btn " href="{{ route('profile.index') }}">{{ $user['name'] }}</a>
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>


@section('content')
    <div class="container mt-4">
        <h3 class="my-4">featured products</h3>
        <div class="row">
            @foreach ($featuredProducts as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="image card-img-top" src="{{ asset('storage/' . $product->main_photo) }}"
                            alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['title'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                            <p>{{ $product['price'] }} ლარი</p>
                            <div>
                                <h6>კატეგორია:</h6>
                                <p>{{ $product['category'] }}</p>
                            </div>
                            <a href="{{ route('product.show', ['product' => $product]) }}"
                                class="btn btn-primary">პროდუქტის ნახვა</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-4">
        <h3 class="my-4">პროდუქტები</h3>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="image card-img-top" src="{{ asset('storage/' . $product->main_photo) }}"
                            alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['title'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                            <p>{{ $product['price'] }} ლარი</p>
                            <div>
                                <h6>კატეგორია:</h6>
                                <p>{{ $product['category'] }}</p>
                            </div>
                            <a href="{{ route('product.show', ['product' => $product]) }}"
                                class="btn btn-primary">პროდუქტის ნახვა</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $productsPaginate->onEachSide(2)->links() }}
@endsection
