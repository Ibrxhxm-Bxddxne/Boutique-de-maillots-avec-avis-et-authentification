@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="bg-blue-900 p-6">
            <h1 class="text-2xl font-bold text-white uppercase italic">Modifier le Maillot</h1>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Nom du Joueur</label>
                    <input type="text" name="player_name" value="{{ $product->player_name }}" required class="w-full border-gray-200 rounded-xl focus:ring-blue-900 focus:border-blue-900">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Numéro</label>
                    <input type="number" name="number" value="{{ $product->number }}" required class="w-full border-gray-200 rounded-xl focus:ring-blue-900 focus:border-blue-900">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Catégorie</label>
                    <select name="category" class="w-full border-gray-200 rounded-xl">
                        <option value="club" {{ $product->category == 'club' ? 'selected' : '' }}>Club</option>
                        <option value="country" {{ $product->category == 'country' ? 'selected' : '' }}>Pays</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Prix (€)</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required class="w-full border-gray-200 rounded-xl">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Image actuelle</label>
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-40 object-cover rounded-lg border">
                </div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Changer l'image (optionnel)</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t">
                <a href="{{ route('admin.index') }}" class="px-6 py-2 text-gray-500 font-bold uppercase text-sm hover:underline">Annuler</a>
                <button type="submit" class="bg-blue-900 text-white px-10 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-black transition shadow-lg">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection