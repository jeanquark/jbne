<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permanence extends Model
{
    protected $table = 'permanences';

    // protected $fillable = ['lawyer_id', 'week1', 'week2', 'week3', 'week4', 'week5', 'week6', 'week7', 'week8', 'week9', 'week10', 'week11', 'week12', 'week13', 'week14', 'week15', 'week16', 'week17', 'week18', 'week19', 'week20', 'week21', 'week22', 'week23', 'week24', 'week25', 'week26', 'week27', 'week28', 'week29', 'week30', 'week31', 'week32', 'week33', 'week34', 'week35', 'week36', 'week37', 'week38', 'week39', 'week40', 'week41', 'week42', 'week43', 'week44', 'week45', 'week46', 'week47', 'week48', 'week49', 'week50', 'week51', 'week52', 'week53', 'remarks'];
    protected $fillable = ['lawyer_id', 'year', 'quarter', 'month', 'week1_dispo', 'week1_attr', 'week1_nb', 'week2_dispo', 'week2_attr', 'week2_nb', 'week3_dispo', 'week3_attr', 'week3_nb', 'week4_dispo', 'week4_attr', 'week4_nb', 'week5_dispo', 'week5_attr', 'week5_nb'];

    public function lawyer()
    {
        return $this->belongsTo('App\Lawyer');
    }
}
