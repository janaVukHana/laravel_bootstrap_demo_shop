<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'image', 'description', 'category'];

    public function scopeFilter($query, array $filters) {
        if(request('category') ?? false) {
            $query->where('category', 'like', '%' . request('category') . '%');
        }

        if(request('search') ?? false) {
            $query->where('category', 'like', '%' . request('search') . '%')
                ->orWhere('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }

    // public function comment() {
    //     return $this->hasMany(Comment::class, 'product_id');
    // }
}
