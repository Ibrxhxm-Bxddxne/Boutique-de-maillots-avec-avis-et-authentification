<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',    // 'club' ou 'country'
        'player_name',
        'number',
        'description',
        'price',
        'image'        // pour stocker le chemin de la photo
    ];

    public function reviews() {
    return $this->hasMany(Review::class);
}
    
public function getAverageRatingAttribute()
{
    return $this->reviews()->avg('rating') ?: 0;
}
}
