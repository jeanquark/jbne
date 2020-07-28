<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerOffice extends Model
{
    protected $table = 'lawyers_office';

    protected $fillable = ['updated_by', 'name', 'street', 'city', 'phone_office', 'fax_office'];

    public function lawyers()
    {
        return $this->hasMany('App\Lawyer');
    }
}
