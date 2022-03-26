<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'quizzes';
    protected $primaryKey = 'quiz_id';
    protected $fillable = [
        'quiz_title',
        'quiz_description',
        'quiz_status',
        'quiz_slug',
        'finished_at',
        'created_at',
        'updated_at'
    ];
    public $dates = ['finished_at'];

    public function sluggable(): array
    {
        return [
            'quiz_slug' => [
                'source' => 'quiz_title',
                'onUpdate' => true,
                'unique' => true
            ]
        ];
    }

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date) : null;
    }

    public function getQuestions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'quiz_id');
    }
}
