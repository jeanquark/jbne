<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyLawyer extends Model
{
    protected $guarded = [];

    public function lawyer()
    {
        return $this->belongsTo('App\Lawyer', 'lawyer_id');
    }
}
