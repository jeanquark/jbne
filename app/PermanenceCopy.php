<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermanenceCopy extends Model
{
    protected $table = 'permanences_copy';

    protected $fillable = ['lawyer_id', 'year', 'quarter', 'month', 'week1', 'week1_nb', 'week2', 'week2_nb', 'week3', 'week3_nb', 'week4', 'week4_nb', 'week5', 'week5_nb'];
}
