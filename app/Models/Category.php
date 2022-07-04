<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts() {
        return $this->belongsToMany(Post::class, 'post_category');
    }
}
