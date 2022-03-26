<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

class DashboardController extends Controller
{
    function index()
    {
        $data["quizzes"] = Quiz::where('user_id', auth()->id())->paginate(5);
        return view('dashboard', $data);
    }
}
