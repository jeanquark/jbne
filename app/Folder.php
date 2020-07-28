<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';

    protected $fillable = ['parent_folder_id', 'path', 'name'];
}
