<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'is_published',
    ];

    // Correct relationship
    public function category()
    {
        return $this->belongsTo(\App\Models\KbCategory::class, 'category_id');
    }
}