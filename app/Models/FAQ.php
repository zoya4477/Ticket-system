<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faqs'; 
    protected $fillable = [
        'question',
        'answer',
        'category_id',
        'is_published'
    ];

    public function category() {
        return $this->belongsTo(KbCategory::class, 'category_id');
    }
}