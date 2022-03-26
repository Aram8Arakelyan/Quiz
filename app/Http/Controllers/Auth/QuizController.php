<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Results;
use App\Notifications\SendToStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class QuizController extends Controller
{
    public function createNewQuiz(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'time' => 'required',
        ]);
        $times = explode(" - ", $request->time);
        if ($times[0] == $times[1]) return back()->withErrors(['Please select right date!']);
        $startedAt = Carbon::parse($times[0]);
        $finishedAt = Carbon::parse($times[1]);
        $response = Quiz::createNewQuiz($request->name, $request->mark, $startedAt, $finishedAt);
        if ($response) return back()->with('success', 'Successfully created!');
        return back()->withErrors(['Something gets wrong!']);
    }

    public function deleteQuiz($id)
    {
        Quiz::find($id)->delete();
        return back()->with("success", "Successfully deleted");
    }

    public function deleteResult($id)
    {
        Results::find($id)->delete();
        return back()->with("success", "Successfully deleted");
    }

    public function sendToStudents(Request $request)
    {
        $emails = explode(',', $request->emails);
        if (!count($emails)) {
            return back()->withErrors(['Something gets wrong!']);
        }

        foreach ($emails as $email) {
            try {
                Notification::route('mail', $email)
                    ->notify(new SendToStudents($request->quiz_id, $email));
            } catch (\Exception $exception) {

            }
        }

        return back()->with(['success' => "Success"]);
    }

    public function startQuiz($email, $id)
    {
        $quiz = Quiz::with("questions")->find($id);
        if ($quiz->finished_at < now()) return view("welcome");
        $result = Results::where(['email' => $email, "quiz_id" => $id])->first();
        if ($result && $result->finished_at) return view("welcome");
        if (!$result) {
            $result = new Results();
            $result->email = $email;
            $result->started_at = now();
            $result->user_id = $quiz->user_id;
            $result->quiz_id = $quiz->id;
            $result->save();
        }
        $data["quiz"] = $quiz;
        $data["email"] = $email;
        return view('pages.quiz', $data);
    }

    public function sendResult(Request $request)
    {
        $this->validate($request, [
            'quiz_id' => 'required',
            'email' => 'required',
        ]);
        $data = $request->all();
        $mark = Results::calculateResult($data);
        $response = Results::saveResult($mark, $request->email, $request->quiz_id);
        $data = ["mark" => $response['mark'], 'total' => $response["total"]];
        return view("pages.result", $data);
    }

    public function showResults($id)
    {
        $data["results"] = Results::where('quiz_id', $id)->where('user_id', auth()->id())->paginate(5);
        return view('pages.results', $data);
    }
}

