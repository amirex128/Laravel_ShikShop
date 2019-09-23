<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAndAnswer extends Model
{
    protected $fillable = [ 'photo', 'question', 'answer' ];
}
