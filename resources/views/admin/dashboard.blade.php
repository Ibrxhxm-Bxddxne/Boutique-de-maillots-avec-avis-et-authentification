@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter">Panel Administrateur</h1>
            <p class="text-gray-500 font-medium">Gestion de l'inventaire et des produits</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-blue-900 text-white px-8 py-4 rounded-2xl font-bold uppercase tracking-widest shadow-lg hover:bg-black transition-all active:scale-95 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Ajouter un maillot
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Total Produits</span>
            <p class="text-3xl font-black text-blue-900">{{ $products->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Maillots Club</span>
            <p class="text-3xl font-black text-gray-800">{{ $products->where('category', 'club')->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Maillots Pays</span>
            <p class="text-3xl font-black text-gray-800">{{ $products->where('category', 'country')->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="p-6 text-xs font-black uppercase text-gray-400 tracking-widest">Produit</th>
                        <th class="p-6 text-xs font-black uppercase text-gray-400 tracking-widest text-center">Catégorie</th>
                        <th class="p-6 text-xs font-black uppercase text-gray-400 tracking-widest text-center">Prix</th>
                        <th class="p-6 text-xs font-black uppercase text-gray-400 tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-6 flex items-center gap-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-16 object-cover rounded-lg shadow-sm">
                            <div>
                                <p class="font-bold text-gray-900 uppercase italic">{{ $product->player_name }}</p>
                                <p class="text-xs text-gray-400 font-medium">#{{ $product->number }}</p>
                            </div>
                        </td>

                        <td class="p-6 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $product->category == 'club' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                                {{ $product->category }}
                            </span>
                        </td>

                        <td class="p-6 text-center">
                            <span class="font-black text-gray-900">{{ $product->price }}€</span>
                        </td>

                        <td class="p-6">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('products.show', $product->id) }}" class="p-2 bg-gray-100 text-gray-500 rounded-xl hover:bg-blue-900 hover:text-white transition-all" title="Voir le produit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a href="{{ route('products.edit', $product->id) }}" class="p-2 bg-gray-100 text-gray-500 rounded-xl hover:bg-yellow-500 hover:text-white transition-all" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Supprimer ce maillot définitivement ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gray-100 text-gray-500 rounded-xl hover:bg-red-600 hover:text-white transition-all" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection