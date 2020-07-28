<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	protected $table = 'team';
	
    protected $fillable = ['title', 'firstname', 'lastname', 'status', 'image_path', 'email', 'website', 'linkedIn', 'is_published', 'order_of_appearance'];
}
