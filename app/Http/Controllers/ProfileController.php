<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();

        // tellers
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        // optioneel: lijstjes (bijv. eerste 10)
        $followers = $user->followers()->limit(10)->get();
        $following = $user->following()->limit(10)->get();

        return view('profile.show', [
            'user'            => $user,
            'followersCount'  => $followersCount,
            'followingCount'  => $followingCount,
            'followers'       => $followers,
            'following'       => $following,
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // update()/destroy() laat je zoals ze al waren
}
