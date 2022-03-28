<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    protected $fillable = [
        'quiz_id',
        'question_image',
        'question',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'correct_answer',
        'created_at',
        'updated_at'
    ];

    public function getUserAnswers()
    {
        return $this->belongsTo(Answer::class, 'question_id', 'question_id')->where('user_id', auth()->user()->id);
    }
}
