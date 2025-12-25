<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Affiche le tableau de bord ou la liste des produits pour l'admin
    public function index()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('admin.products.create');
    }

    // Enregistre le nouveau maillot dans la base de données
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'category'    => 'required|in:club,country',
            'player_name' => 'required|string|max:255',
            'number'      => 'required|integer',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validation image
        ]);

        $data = $request->all();

        // Gestion de l'image (si on en télécharge une)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('admin.index')->with('success', 'La tenue a été ajoutée avec succès !');
    }
    public function destroyReview(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Le commentaire a été supprimé avec succès.');
    }


// Affiche le formulaire avec les données actuelles
public function edit(Product $product)
{
    return view('admin.products.edit', compact('product'));
}

// Enregistre les modifications
public function update(Request $request, Product $product)
{
    $request->validate([
        'player_name' => 'required|string|max:255',
        'number' => 'required|integer',
        'price' => 'required|numeric',
        'category' => 'required|in:club,country',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $data = $request->all();

    // Gestion de la nouvelle image si elle est téléchargée
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image pour ne pas encombrer le serveur
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('admin.index')->with('success', 'Le maillot a été mis à jour avec succès !');
}
public function destroy(Product $product)
{
    // 1. Supprimer l'image du dossier storage pour gagner de la place
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // 2. Supprimer le produit de la base de données
    $product->delete();

    return redirect()->route('admin.index')->with('success', 'Le maillot a été supprimé définitivement.');
}
}