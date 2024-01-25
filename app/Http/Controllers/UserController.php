<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, UpdateUserProfileRequest $request)
    {
        $data = array_filter($request->safe()->all());
        if (isset($data['newPassword'])){
            $data['password'] = Hash::make($data['newPassword']);
            unset($data['current_password'], $data['newPassword']);
        }

        if (isset($data['avatar'])){
            Storage::delete('public/' . substr($user->avatar, 9)); // Delete the old avatar from the storage.
            $data['avatar'] = '/storage/' . $request['avatar']->store('avatars', 'public');
        }

        $data['isPrivate'] = $request->has('isPrivate');

        $user->update($data);
        return redirect()->route('edit.profile', $data['username'])->with('success', 'Profile updated.');
    }

    public function follow(User $user)
    {
        auth()->user()->follow($user);
        return back();
    }

    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }
}
