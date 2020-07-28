<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'content', 'image_path', 'file_path', 'is_published'];
}
