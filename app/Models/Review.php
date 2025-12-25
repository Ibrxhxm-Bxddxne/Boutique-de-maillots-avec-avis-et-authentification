<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    // Un avis appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un avis appartient à un produit  
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
