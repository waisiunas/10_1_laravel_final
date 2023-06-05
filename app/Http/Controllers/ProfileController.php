<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update_details(Request $request)
    {
        return 'Here';
    }

    public function update_picture(Request $request)
    {
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ]);

        if (!empty(Auth::user()->profile_picture)) {
            unlink(public_path('images/' . Auth::user()->profile_picture));
        }

        $user = User::where('id', Auth::id());

        $image_name = time() . "." . $request->picture->extension();

        if ($request->picture->move(public_path('images'), $image_name)) {
            $data = [
                'profile_picture' => $image_name,
            ];

            $is_updated = $user->update($data);

            if ($is_updated) {
                return back()->with(['success' => 'Magic has been spelled!']);
            } else {
                return back()->with(['failure' => 'Magic has failed to spell!']);
            }
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }
}
