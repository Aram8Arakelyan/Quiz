<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $casts = ['data' => 'array'];

    public static function saveQuestion($quizId, $data)
    {
        try {
            $info = ['mark' => $data['mark'], "question_type" => $data['type']];
            foreach ($data as $key => $value) {
                if (str_contains($key, "answer"))
                    $info['answers'][$key] = $value;
            }
            $newQuestion = new static();
            $newQuestion->user_id = auth()->id();
            $newQuestion->quiz_id = $quizId;
            $newQuestion->question = $data['question'];
            $newQuestion->data = $info;
            $newQuestion->save();
            return $newQuestion;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
