<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $casts = ['data' => 'array'];

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

    public static function saveQuestion($quizId, $data)
    {
        try {
            $answers = [];
            foreach ($data as $key => $value) {
                if (str_contains($key, "answer"))
                    $answers[$key] = $value;
            }
            $newQuestion = new static();
            $newQuestion->user_id = auth()->id();
            $newQuestion->quiz_id = $quizId;
            $newQuestion->question = $data['question'];
            $newQuestion->mark = $data['mark'];
            $newQuestion->question_type = $data['type'];
            $newQuestion->save();
            foreach ($answers as $key => $value) {
                if ($key !== "right_answer") {
                    $answer = new Answers();
                    $answer->answer = $value;
                    $answer->question_id = $newQuestion->id;
                    $answer->status = explode('_', $key)[1] == $answers['right_answer'] ? 1 : 0;
                    $answer->save();
                }
            }
            return $newQuestion;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
