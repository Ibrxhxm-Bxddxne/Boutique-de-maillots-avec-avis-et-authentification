@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-10">
    
    <aside class="w-full md:w-1/4">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 sticky top-10">
            <h2 class="text-2xl font-black text-gray-900 mb-8 uppercase italic tracking-tighter">Filtres</h2>

            <form action="{{ route('products.index') }}" method="GET" class="space-y-10">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Type de Maillot</h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="category" value="" onchange="this.form.submit()" {{ !request('category') ? 'checked' : '' }} class="text-blue-900 focus:ring-blue-900">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-900">Tous</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="category" value="club" onchange="this.form.submit()" {{ request('category') == 'club' ? 'checked' : '' }} class="text-blue-900 focus:ring-blue-900">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-900">Clubs</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="category" value="country" onchange="this.form.submit()" {{ request('category') == 'country' ? 'checked' : '' }} class="text-blue-900 focus:ring-blue-900">
                            <span class="text-sm font-bold text-gray-600 group-hover:text-blue-900">Sélections</span>
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Gamme de Prix</h3>
                    <select name="price_range" onchange="this.form.submit()" class="w-full border-gray-200 rounded-xl text-sm font-bold">
                        <option value="">Tous les prix</option>
                        <option value="0-50" {{ request('price_range') == '0-50' ? 'selected' : '' }}>0 - 50€</option>
                        <option value="50-100" {{ request('price_range') == '50-100' ? 'selected' : '' }}>50 - 100€</option>
                        <option value="100+" {{ request('price_range') == '100+' ? 'selected' : '' }}>+ 100€</option>
                    </select>
                </div>

                <a href="{{ route('products.index') }}" class="block text-center text-[10px] font-black uppercase text-red-500 hover:underline">Réinitialiser</a>
            </form>
        </div>
    </aside>

    <div class="flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-500">
                    <a href="{{ route('products.show', $product->id) }}" class="block relative overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-80 object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-blue-900 font-black text-xs uppercase">
                            {{ $product->category }}
                        </div>
                    </a>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="font-black text-gray-900 uppercase italic leading-tight">{{ $product->player_name }}</h3>
                            <span class="text-blue-900 font-black">{{ $product->price }}€</span>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex text-yellow-400">
                                @php $avg = round($product->average_rating); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-3 w-3 fill-current {{ $i <= $avg ? '' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <span class="text-[10px] font-bold text-gray-400">({{ $product->reviews->count() }})</span>
                        </div>

                        <a href="{{ route('products.show', $product->id) }}" class="block w-full text-center py-3 bg-gray-900 text-white rounded-xl text-xs font-black uppercase tracking-widest group-hover:bg-blue-900 transition-colors">
                            Voir le maillot
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 font-bold italic">Aucun maillot ne correspond à vos filtres.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection