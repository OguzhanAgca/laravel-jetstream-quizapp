<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $primaryKey = 'result_id';
    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'correct',
        'wrong',
        'empty',
        'created_at',
        'updated_at'
    ];
}
