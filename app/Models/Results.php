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
        $result = static::where(['email' => $email, "quiz_id" => $quizId])->whereNotNull("finished_at")->first();
        if (!$result) {
            $result = new static();
            $result->quiz_id = $quizId;
            $result->user_id = $quiz->user_id;
            $result->email = $email;
            $result->mark = $mark;
            $result->finished_at = now();
            $result->save();
        } else {

        }
        return ['mark' => $mark, "total" => $quiz->mark];
    }

    public static function calculateResult($data)
    {
        $quiz = Quiz::with("questions")->find($data["quiz_id"]);
        $mark = 0;
        foreach ($quiz->questions as $question) {
            $rightAnswer = $question["data"]["answers"]["right_answer"];
            if (isset($data[$question->id]) && $question["data"]["answers"]["answer_" . $rightAnswer] == $data[$question->id]) {
                $mark += $question->data["mark"];
            }
        }
        return $mark;
    }
}
