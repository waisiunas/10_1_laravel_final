<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function select_subject()
    {
        return view('pages.select-subject', [
            'subjects' => Subject::all(),
        ]);
    }

    public function select_topic(Subject $subject)
    {
        // dd($subject->topics);
        return view('pages.select-topic', [
            'topics' => $subject->topics,
        ]);
    }
}
