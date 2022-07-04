<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category');
    }
}
