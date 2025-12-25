@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">Mon Panier</h1>
        
        @if(!$cartItems->isEmpty())
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Vider tout le panier ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm uppercase flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Vider le panier
                </button>
            </form>
        @endif
    </div>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
            <div class="mb-6 flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Votre panier est vide</h2>
            <a href="{{ route('products.index') }}" class="inline-block bg-blue-900 text-white px-8 py-3 rounded-xl font-bold uppercase transition hover:bg-black">
                Retour à la boutique
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-6">
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php $total += $item->product->price * $item->quantity; @endphp
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center gap-6 relative group">
                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-24 h-32 object-cover rounded-2xl">
                        
                        <div class="flex-1 text-center sm:text-left">
                            <h3 class="text-xl font-extrabold text-gray-900 uppercase italic">{{ $item->product->player_name }}</h3>
                            <p class="text-gray-500 text-sm font-medium mb-2">Maillot n°{{ $item->product->number }} - {{ ucfirst($item->product->category) }}</p>
                            <div class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-full text-xs font-bold text-gray-600">
                                Prix unité: {{ $item->product->price }}€
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div class="text-center">
                                <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Quantité</span>
                                <span class="font-black text-lg">x{{ $item->quantity }}</span>
                            </div>
                            <div class="text-right min-w-[80px]">
                                <span class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Total</span>
                                <span class="font-black text-xl text-blue-900">{{ $item->product->price * $item->quantity }}€</span>
                            </div>
                        </div>

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="absolute top-4 right-4 sm:static">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 sticky top-10">
                    <h2 class="text-2xl font-black text-gray-900 mb-6 uppercase italic">Récapitulatif</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-600 font-semibold">
                            <span>Sous-total</span>
                            <span>{{ $total }}€</span>
                        </div>
                        <div class="flex justify-between text-gray-600 font-semibold">
                            <span>Frais de port</span>
                            <span class="text-green-500 uppercase text-xs font-black">Offerts</span>
                        </div>
                        <div class="border-t-2 border-dashed border-gray-100 pt-4 flex justify-between items-end">
                            <span class="text-gray-900 font-bold uppercase text-sm">Total TTC</span>
                            <span class="text-3xl font-black text-blue-900">{{ $total }}€</span>
                        </div>
                    </div>

                    <a href="#" class="block w-full bg-blue-900 text-white text-center py-5 rounded-2xl font-black uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-black transition-all active:scale-95">
                        Passer à la caisse
                    </a>
                    
                    <div class="mt-6 flex justify-center gap-4 grayscale opacity-50">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-4">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection