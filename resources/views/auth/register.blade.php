@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4">
    <div class="max-w-md w-full bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter">Créer un compte</h2>
            <p class="text-gray-500 text-sm mt-2">Rejoignez la communauté des supporters</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 rounded-xl text-red-600 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Nom Complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-900 focus:border-blue-900 shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Adresse Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-900 focus:border-blue-900 shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Mot de passe</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-900 focus:border-blue-900 shadow-sm">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-900 focus:border-blue-900 shadow-sm">
            </div>

            <button type="submit" class="w-full bg-blue-900 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg active:scale-95">
                S'inscrire
            </button>
        </form>

        <div class="mt-8 text-center border-t pt-6">
            <p class="text-sm text-gray-500">Déjà inscrit ? <a href="{{ route('login') }}" class="font-bold text-blue-900 hover:underline">Se connecter</a></p>
        </div>
    </div>
</div>
@endsection
