<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KbCategory extends Model
{ 
    protected $table = 'kb_categories';
     protected $fillable = ['name', 'description']; 

    public function articles() {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function faqs() {
        return $this->hasMany(FAQ::class, 'category_id');
    }
}