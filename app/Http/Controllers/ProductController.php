<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Correction : Utiliser request()->routeIs('home') est plus fiable que path()
        if ($request->is('/') || $request->routeIs('home')) {
            $latestProducts = Product::latest()->take(4)->get();
            // Utilisation de withAvg pour les performances
            $topRatedProducts = Product::withAvg('reviews', 'rating')
                ->orderByDesc('reviews_avg_rating')
                ->take(4)
                ->get();
            return view('index', compact('latestProducts', 'topRatedProducts'));
        }

        $query = Product::query();

        // Filtres
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('price_range')) {
            if ($request->price_range == '0-50') $query->where('price', '<=', 50);
            elseif ($request->price_range == '50-100') $query->whereBetween('price', [50, 100]);
            elseif ($request->price_range == '100+') $query->where('price', '>', 100);
        }

        // Tri
        $request->sort == 'oldest' ? $query->oldest() : $query->latest();

        // On charge les avis pour éviter les requêtes SQL en boucle dans la vue
        $products = $query->with('reviews')->paginate(9)->withQueryString();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        // On charge les avis ET l'utilisateur de chaque avis en une seule fois
        $product->load(['reviews.user']);
        
        return view('products.show', compact('product'));
    }
}