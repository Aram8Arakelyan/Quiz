<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $dates = ['started_at', "finished_at"];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function createNewQuiz($name = "", $mark = 1, $startedAt, $finishedAt)
    {
        $user = auth()->user();
        $quiz = static::where("user_id", $user->id)->where("name", "like", "%" . $name . "%")->first();
        if (!$quiz) {
            $newQuiz = new static();
            $newQuiz->name = $name;
            $newQuiz->user_id = $user->id;
            $newQuiz->mark = $mark;
            $newQuiz->started_at = $startedAt;
            $newQuiz->finished_at = $finishedAt;
            $newQuiz->save();
            return $newQuiz;
        }
        return false;
    }
}
