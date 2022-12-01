<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'categoryId',
        'shortDescription',
        'fullDescription',
        'videoURL',
        'image',
        'newsType',
    ];
    public function category()
    {
        return $this->hasOne(Category::class,'id','categoryId');
    }
}
