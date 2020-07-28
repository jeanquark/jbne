<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\LawyerResetPasswordNotification;

class Lawyer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'lawyer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'username', 'email', 'password', 'lastname', 'firstname', 'phone_mobile', 'languages', 'lawyer_office_id', 'is_confirmed', 'confirmation_code', 'is_verified'
    ];*/

    protected $fillable = [
        'username', 'email', 'password', 'lastname', 'firstname', 'phone_mobile', 'languages', 'lawyer_office_id', 'is_verified'
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
        $this->notify(new LawyerResetPasswordNotification($token));
    }

    public function permanence()
    {
        return $this->hasMany('App\Permanence');
    }

    public function permanenceAttribution()
    {
        return $this->hasMany('App\PermanenceAttribution');
    }

    public function lawyerOffice()
    {
        return $this->belongsTo('App\LawyerOffice');
    }

    public function verifyLawyer()
    {
        return $this->hasOne('App\VerifyLawyer');
    }
}
