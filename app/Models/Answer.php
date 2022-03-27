<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $primaryKey = 'answer_id';
    protected $fillable = ['user_id', 'question_id', 'answer'];
    public $timestamps = false;
}
