<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.question.index', [
            'questions' => Question::with('choices')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.question.create', [
            'subjects' => Subject::all(),
            'topics' => Topic::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => ['required'],
            'topic_id' => ['required'],
            'text' => ['required'],
            'choice_1' => ['required'],
            'choice_2' => ['required'],
            'choice_3' => ['required'],
            'choice_4' => ['required'],
            'correct_choice' => ['required'],
        ]);

        $data = [
            'topic_id' => $request->topic_id,
            'text' => $request->text,
        ];

        $is_created = Question::create($data);

        if ($is_created) {
            $question_id = $is_created->id;
            $is_correct = 0;
            for ($i = 1; $i <= 4; $i++) {

                if ($i == $request->correct_choice) {
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }

                $data = [
                    'question_id' => $question_id,
                    'text' => request('choice_' . $i),
                    'is_correct' => $is_correct,
                ];

                Choice::create($data);
            }

            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('admin.question.edit', [
            'subjects' => Subject::all(),
            'topics' => Topic::all(),
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'subject_id' => ['required'],
            'topic_id' => ['required'],
            'text' => ['required'],
            'choice_1' => ['required'],
            'choice_2' => ['required'],
            'choice_3' => ['required'],
            'choice_4' => ['required'],
            'correct_choice' => ['required'],
        ]);

        $data = [
            'topic_id' => $request->topic_id,
            'text' => $request->text,
        ];

        $is_updated = $question->update($data);

        if ($is_updated) {
            $is_correct = 0;
            $i = 1;
            foreach ($question->choices as $choice) {
                if ($i == $request->correct_choice) {
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }

                $data = [
                    'text' => request('choice_' . $i),
                    'is_correct' => $is_correct,
                ];
                $i++;

                $choice->update($data);
            }

            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $is_deleted = $question->delete();

        if ($is_deleted) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }
}
