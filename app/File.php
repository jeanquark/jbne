<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['creator_id', 'parent_folder_id', 'path', 'name', 'clicks'];

    public function member()
    {
        return $this->belongsTo('App\Member', 'creator_id');
    }
}
