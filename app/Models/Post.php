<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use Attachable;
    use AsSource;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function setThumbnailAttribute(?int $id)
    {
        $this->attributes['thumbnail_id'] = $id;
    }

    public function getThumbnailAttribute()
    {
        return Attachment::find($this->thumbnail_id);
    }
}
