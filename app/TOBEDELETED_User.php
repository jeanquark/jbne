<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\MemberResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

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
        return $this->belongsToMany('App\Task', 'task_users');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }
}
