<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['blog_title','blog_image','blog_category','blog_description','blog_content','blog_owner','like_number'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
