<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // On ajoute is_admin ici
    ];

    /**
     * Les attributs cachés pour la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Le cast des types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean', // On force le type en boolean
    ];

    // --- RELATIONS ---

    /**
     * Un utilisateur peut avoir plusieurs articles dans son panier.
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Un utilisateur peut laisser plusieurs avis sur les tenues.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}