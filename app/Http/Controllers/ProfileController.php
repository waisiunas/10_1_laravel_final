<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update_details(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $user->id . ',id'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $is_updated = $user->update($data);

        if ($is_updated) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
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

    public function update_password(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $data = [
                'password' => Hash::make($request->password),
            ];

            $is_updated = $user->update($data);

            if ($is_updated) {
                return back()->with(['success' => 'Magic has been spelled!']);
            } else {
                return back()->with(['failure' => 'Magic has failed to spell!']);
            }
        } else {
            return back()->withErrors(['current_password' => 'The current password does not match']);
        }
    }
}
