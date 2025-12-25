<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootShop - Maillots de Foot Officiels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-black italic tracking-tighter">
                FOOT<span class="text-yellow-400">SHOP</span>
            </a>

            <div class="flex items-center space-x-6">
                <a href="{{ route('products.index') }}" class="hover:text-yellow-400 transition font-semibold">Produits</a>

                @auth
                    <a href="{{ route('cart.index') }}" class="relative hover:text-yellow-400 transition font-semibold">
                        Panier
                    </a>

                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="bg-yellow-500 text-blue-900 px-4 py-1 rounded-full text-sm font-bold hover:bg-yellow-400">
                            Admin Panel
                        </a>
                    @endif

                    <div class="border-l border-blue-700 h-6 mx-2"></div>
                    
                    <span class="text-sm text-blue-200">Hello, {{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-red-400 hover:text-red-300">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-semibold hover:text-yellow-400">Connexion</a>
                    <a href="/register" class="bg-white text-blue-900 px-5 py-2 rounded-full font-bold text-sm hover:bg-gray-100 transition">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-10 flex-grow">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content') 
        </main>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto px-6 text-center">
            <p class="mb-4 text-white font-bold tracking-widest uppercase">FootShop &copy; 2025</p>
            <p class="text-sm">Les plus beaux maillots de football, livrés chez vous.</p>
        </div>
    </footer>

</body>
</html>