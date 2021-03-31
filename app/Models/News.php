<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text', 
        'isPrivate', 
        'image', 
        'category_id', 
        'date',
        'description',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
