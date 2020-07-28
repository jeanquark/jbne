<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FormulaireContact extends Model
{
    protected $table = 'formulaire_contacts';

    protected $fillable = ['prenom', 'nom', 'email', 'message', 'is_read'];
}
