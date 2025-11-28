<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = ['name', 'proteins', 'fats', 'carbs', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}