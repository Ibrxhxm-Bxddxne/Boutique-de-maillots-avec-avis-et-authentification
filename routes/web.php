<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// 1. PAGE D'ACCUEIL (On utilise ton contrôleur, plus welcome)
Route::get('/', [ProductController::class, 'index'])->name('home');

// 2. PRODUITS
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{product}', [ProductController::class, 'show'])->name('products.show');

// 3. AUTHENTIFICATION (On utilise tes routes manuelles OU celles de Breeze)
// Si tu veux utiliser TON AuthController, garde ces lignes :
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 4. ROUTES PROTÉGÉES (Utilisateurs connectés)
Route::middleware('auth')->group(function () {
    // Panier
    Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
    Route::post('/panier/ajouter', [CartController::class, 'store'])->name('cart.add');
    Route::delete('/panier/supprimer/{cart}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::delete('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

    // Avis
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->name('reviews.destroy')
    ->middleware('auth');
    
    // Profil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 5. ROUTES ADMIN (Protégées par le middleware admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/produits/create', [AdminController::class, 'create'])->name('products.create');
    Route::post('/produits', [AdminController::class, 'store'])->name('products.store');
    Route::delete('/reviews/{review}', [AdminController::class, 'destroyReview'])->name('admin.reviews.destroy');
    Route::get('/produits/{product}/edit', [AdminController::class, 'edit'])->name('products.edit');
    Route::put('/produits/{product}', [AdminController::class, 'update'])->name('products.update');
    Route::delete('/produits/{product}', [AdminController::class, 'destroy'])->name('products.destroy');
});

// Supprime ou commente cette ligne si tu gères l'auth toi-même pour éviter les conflits
// require __DIR__.'/auth.php';