<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subject.index', [
            'subjects' => Subject::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $is_created = Subject::create($data);

        if ($is_created) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', [
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $is_updated = $subject->update($data);

        if ($is_updated) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $is_deleted = $subject->delete();

        if ($is_deleted) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }
}
