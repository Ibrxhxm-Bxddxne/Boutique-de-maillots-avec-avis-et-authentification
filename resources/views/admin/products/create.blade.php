@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-blue-900 p-6">
            <h1 class="text-2xl font-bold text-white">Ajouter un Nouveau Maillot</h1>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nom du Joueur</label>
                    <input type="text" name="player_name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900" placeholder="ex: Zinedine Zidane">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Numéro</label>
                    <input type="number" name="number" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900" placeholder="ex: 10">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Catégorie</label>
                    <select name="category" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900">
                        <option value="club">Club</option>
                        <option value="country">Pays</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" step="0.01" name="price" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900" placeholder="ex: 89.99">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-900 focus:ring-blue-900" placeholder="Détails sur le maillot, la saison..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Photo du Maillot</label>
                <input type="file" name="image" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Annuler</a>
                <button type="submit" class="px-6 py-2 bg-blue-900 text-white rounded-lg font-bold hover:bg-blue-800 shadow-lg">
                    Enregistrer le Produit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection