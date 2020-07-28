<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MemberResetPasswordNotification;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $guard = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'rue', 'localite', 'email', 'password', 'is_active', 'emails_sent', 'type', 'statut', 'date_inscription_barreau', 'date_debut_stage', 'date_fin_stage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'task_member');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_member');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }
}
