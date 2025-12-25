<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Enregistrer un nouvel avis.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|min:5|max:1000',
        ]);

        // 2. Création de l'avis
        Review::create([
            'product_id' => $request->product_id,
            'user_id'    => Auth::id(), // L'ID de l'utilisateur connecté
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Votre avis a été publié avec succès !');
    }

    /**
     * Supprimer un avis (Auteur ou Admin uniquement).
     */
    public function destroy(Review $review)
    {
        $user = Auth::user();

        // Vérification de sécurité : 
        // L'utilisateur doit être soit l'admin, soit le propriétaire de l'avis
        if ($user->is_admin || $user->id === $review->user_id) {
            
            $review->delete();
            
            return back()->with('success', 'L’avis a été supprimé.');
        }

        // Si quelqu'un essaie de supprimer sans autorisation
        return back()->with('error', 'Vous n’êtes pas autorisé à supprimer cet avis.');
    }
}