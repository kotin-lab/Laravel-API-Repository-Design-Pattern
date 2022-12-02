<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'cat_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
