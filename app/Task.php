<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
    	'status_id', 'description', 'progress'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    // public function users()
    // {
    //     return $this->belongsToMany('App\User', 'task_users');
    // }

    public function members()
    {
        return $this->belongsToMany('App\Member', 'task_member');
    }
}
