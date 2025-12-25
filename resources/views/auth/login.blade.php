@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-12 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
    <h2 class="text-3xl font-extrabold text-center text-blue-900 mb-8">Connexion</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-900 outline-none" placeholder="votre@email.com" required>
        </div>
        <div class="mb-8">
            <label class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-900 outline-none" placeholder="••••••••" required>
        </div>
        <button type="submit" class="w-full bg-blue-900 text-white font-bold py-4 rounded-xl hover:bg-blue-800 transition shadow-lg">
            Se connecter
        </button>
    </form>
</div>
@endsection