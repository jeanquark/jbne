<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteParameter extends Model
{
    protected $table = 'site_parameters';

    protected $fillable = ['name', 'value', 'boolean_value'];
}
