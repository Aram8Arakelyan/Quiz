<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    protected $casts = ['data' => 'array'];

    public static function saveResult($mark, $email, $quizId)
    {
        $quiz = Quiz::find($quizId);
        $result = static::where(['email' => $email, "quiz_id" => $quizId])->first();
        $result->mark = $mark;
        $result->finished_at = now();
        $result->save();

        return ['mark' => $mark, "total" => $quiz->mark];
    }

    public static function calculateResult($data)
    {
        $quiz = Quiz::with("questions.answers")->find($data["quiz_id"]);
        $mark = 0;
        foreach ($quiz->questions as $question) {
            if (isset($data[$question->id]) && Answers::where(['question_id' => $question->id, 'status' => 1])->first()->answer == $data[$question->id]) {
                $mark += $question->mark;
            }
        }
        return $mark;
    }
}
