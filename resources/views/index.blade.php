@extends('layouts.app')

@section('content')

<div class="bg-gradient-to-r from-blue-900 to-black rounded-3xl p-10 mb-12 text-center shadow-2xl">
    <h1 class="text-5xl font-black text-white italic mb-4">FOOT SHOP</h1>
    <p class="text-blue-200 text-lg mb-6 uppercase tracking-widest">Les meilleures tenues de la saison</p>
    <a href="{{ route('products.index') }}" class="inline-block bg-yellow-400 text-blue-900 font-bold px-10 py-3 rounded-full hover:bg-yellow-300 transition">
        TOUT VOIR
    </a>
</div>

<section class="mb-16">
    <div class="flex justify-between items-center mb-8 border-b-2 border-gray-100 pb-4">
        <h2 class="text-3xl font-black text-gray-800 italic uppercase">Derniers Uploads</h2>
        <a href="{{ route('products.index') }}" class="text-blue-600 font-bold hover:underline">Voir plus →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        @foreach($latestProducts as $product)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->player_name }}" class="w-full h-64 object-cover transform group-hover:scale-105 transition duration-500">
                <div class="absolute top-4 right-4 bg-blue-900 text-white text-xs font-bold px-3 py-1 rounded-full">
                    NEW
                </div>
            </div>
            <div class="p-5">
                <span class="text-xs font-bold text-blue-500 uppercase">{{ $product->category }}</span>
                <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $product->player_name }}</h3>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-2xl font-black text-gray-900">{{ $product->price }}€</span>
                    <a href="{{ route('products.show', $product->id) }}" class="bg-gray-900 text-white p-2 rounded-lg hover:bg-blue-900 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section>
    <div class="flex justify-between items-center mb-8 border-b-2 border-gray-100 pb-4">
        <h2 class="text-3xl font-black text-gray-800 italic uppercase">Les mieux notés</h2>
        <a href="{{ route('products.index') }}" class="text-blue-600 font-bold hover:underline">Voir plus →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        @foreach($topRatedProducts as $product)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="relative">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->player_name }}" class="w-full h-64 object-cover">
                <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow-sm flex items-center">
                    <span class="text-yellow-500 mr-1">★</span>
                    <span class="font-bold text-gray-800 text-sm">
                        {{ number_format($product->reviews_avg_rating, 1) ?? 'N/A' }}
                    </span>
                </div>
            </div>
            <div class="p-5">
                <span class="text-xs font-bold text-yellow-600 uppercase">{{ $product->category }}</span>
                <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $product->player_name }}</h3>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-2xl font-black text-gray-900">{{ $product->price }}€</span>
                    <a href="{{ route('products.show', $product->id) }}" class="bg-yellow-400 text-blue-900 font-bold px-4 py-2 rounded-lg hover:bg-yellow-300 transition text-sm">
                        COMMANDER
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection