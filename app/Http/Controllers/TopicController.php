<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.topic.index', [
            'topics' => Topic::with('subject')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.topic.create', [
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => ['required'],
            'name' => ['required'],
        ]);

        $data = [
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $is_created = Topic::create($data);

        if ($is_created) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('admin.topic.edit', [
            'subjects' => Subject::all(),
            'topic' => $topic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'subject_id' => ['required'],
            'name' => ['required'],
        ]);

        $data = [
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        $is_updated = $topic->update($data);

        if ($is_updated) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $is_deleted = $topic->delete();

        if ($is_deleted) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }
}
