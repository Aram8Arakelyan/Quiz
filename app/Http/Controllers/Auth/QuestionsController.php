<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    function index($id)
    {
        $data["quiz_id"] = $id;
        $data["quiz"] = Quiz::find($id);
        $data["questions"] = Question::where('quiz_id', $id)->where("user_id", auth()->id())->paginate(2);
        return view('pages.questions', $data);
    }

    public function addQuestion($quiz_id, Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'mark' => 'required',
            "right_answer" => "required",
        ]);
        if (count($request->all()) <= 4) {
            return back()->withErrors(['Please provide answers!']);
        }
        $sum = Question::where('quiz_id', $quiz_id)->sum('mark');
        if ($sum + $request->mark > Quiz::find($quiz_id)->mark) {
            return back()->withErrors(['Question mark is wrong!']);
        }
        $response = Question::saveQuestion($quiz_id, $request->all());
        if ($response) return back()->with('success', 'Successfully created!');
        return back()->withErrors(['Something gets wrong!']);
    }

    public function deleteQuestion($id)
    {
        Question::find($id)->delete();
        return back()->with("success", "Successfully deleted");
    }
}
