<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition shadow-duration-300">
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->player_name }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <span class="text-xs font-bold uppercase text-gray-400">{{ $product->category }}</span>
        <h3 class="text-lg font-bold text-gray-900">{{ $product->player_name }}</h3>
        <p class="text-gray-600 text-sm mb-2">Numéro {{ $product->number }}</p>
        
        <div class="flex items-center mb-2">
            <span class="text-yellow-500">
                ★ {{ number_format($product->reviews_avg_rating ?? 0, 1) }}
            </span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-xl font-bold text-blue-900">{{ $product->price }} €</span>
            <a href="{{ route('products.show', $product->id) }}" class="bg-blue-900 text-white p-2 rounded-full hover:bg-blue-700 transition">
                👁️
            </a>
        </div>
    </div>
</div>