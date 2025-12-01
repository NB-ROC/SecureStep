<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(Request $request, User $user)
    {
        if ($request->user()->is($user)) {
            return response()->json(['message' => 'Je kunt jezelf niet volgen'], 422);
        }

        $request->user()
            ->following()
            ->syncWithoutDetaching($user->id);

        if ($request->wantsJson()) {
            return response()->json(['status' => 'followed']);
        }

        return back();
    }

    public function destroy(Request $request, User $user)
    {
        $request->user()
            ->following()
            ->detach($user->id);

        if ($request->wantsJson()) {
            return response()->json(['status' => 'unfollowed']);
        }

        return back();
    }
}
