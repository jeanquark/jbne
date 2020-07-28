<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	protected $table = 'agenda';

    protected $fillable = ['title', 'content', 'image_path', 'is_published'];
}
