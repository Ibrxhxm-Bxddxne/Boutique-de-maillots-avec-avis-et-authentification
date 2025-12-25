@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="flex flex-col lg:flex-row gap-12 mb-20">
        <div class="w-full lg:w-1/2">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->player_name }}" class="w-full h-auto object-cover">
                @else
                    <div class="w-full h-96 bg-gray-100 flex items-center justify-center text-gray-400 font-bold uppercase tracking-widest italic">Aucune image</div>
                @endif
            </div>
        </div>

        <div class="w-full lg:w-1/2">
            <div class="mb-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-900 text-[10px] font-black uppercase rounded-full tracking-widest">Collection {{ $product->category }}</span>
            </div>
            
            <h1 class="text-4xl font-black text-gray-900 uppercase italic mb-2 tracking-tighter">{{ $product->player_name }}</h1>
            <p class="text-sm text-gray-400 font-bold mb-6">Maillot Officiel • Numéro {{ $product->number }}</p>

            <div class="flex items-center gap-4 mb-8">
                <div class="flex text-yellow-400">
                    @php $avg = round($product->average_rating); @endphp
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="h-5 w-5 fill-current {{ $i <= $avg ? '' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <span class="text-lg font-black text-gray-900">{{ number_format($product->average_rating, 1) }} <span class="text-gray-400 text-sm">/ 5</span></span>
                <span class="text-gray-400 text-sm font-medium">({{ $product->reviews->count() }} avis)</span>
            </div>

            <p class="text-4xl font-black text-blue-900 mb-8 tracking-tight">{{ $product->price }} €</p>

            <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 mb-10">
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Description</h4>
                <p class="text-gray-600 leading-relaxed italic">"{{ $product->description ?? 'Ce maillot premium est conçu pour les fans exigeants.' }}"</p>
            </div>

            <form action="{{ route('cart.add') }}" method="POST" class="flex gap-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" class="w-20 border-gray-200 rounded-xl font-bold">
                <button type="submit" class="flex-1 bg-blue-900 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-black transition shadow-lg active:scale-95">Ajouter au panier</button>
            </form>
        </div>
    </div>

    <hr class="border-gray-100 mb-16">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        
        <div class="lg:col-span-2 space-y-6">
            <h2 class="text-2xl font-black text-gray-900 uppercase italic tracking-tighter mb-8">Avis des supporters</h2>
            
            @forelse($product->reviews as $review)
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white font-black text-sm uppercase">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">{{ $review->user->name }}</p>
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-3 w-3 fill-current {{ $i <= $review->rating ? '' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        @auth
                            @if(auth()->user()->is_admin || auth()->id() === $review->user_id)
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cet avis ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-600 transition p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                    <p class="text-gray-600 italic leading-relaxed text-sm">"{{ $review->comment }}"</p>
                    <p class="text-[10px] text-gray-400 mt-4 uppercase font-bold tracking-widest">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <div class="bg-gray-50 rounded-3xl p-10 text-center border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 italic">Soyez le premier à donner votre avis sur ce maillot !</p>
                </div>
            @endforelse
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-10">
                @auth
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                        <h3 class="text-lg font-black text-blue-900 uppercase italic mb-6">Laisser une note</h3>
                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div>
                                <label class="text-[10px] font-black text-gray-400 uppercase mb-2 block">Votre Note</label>
                                <select name="rating" class="w-full border-gray-200 rounded-xl font-bold text-yellow-500">
                                    <option value="5">★★★★★ Excellent</option>
                                    <option value="4">★★★★☆ Très bon</option>
                                    <option value="3">★★★☆☆ Moyen</option>
                                    <option value="2">★★☆☆☆ Décevant</option>
                                    <option value="1">★☆☆☆☆ Mauvais</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-gray-400 uppercase mb-2 block">Commentaire</label>
                                <textarea name="comment" rows="4" required class="w-full border-gray-200 rounded-xl text-sm italic" placeholder="Qu'avez-vous pensé de la qualité..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-black uppercase tracking-widest text-xs hover:bg-blue-900 transition shadow-lg">Publier mon avis</button>
                        </form>
                    </div>
                @else
                    <div class="bg-gray-900 p-8 rounded-3xl text-center">
                        <p class="text-white font-bold mb-4 italic">Vous voulez donner votre avis ?</p>
                        <a href="{{ route('login') }}" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-xl font-black uppercase text-xs tracking-widest hover:bg-blue-100 transition">Se connecter</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection