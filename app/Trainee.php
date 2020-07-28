<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $fillable = ['title', 'content', 'image_path', 'order_of_appearance', 'is_published'];
}
