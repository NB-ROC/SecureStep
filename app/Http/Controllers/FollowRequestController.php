<?php

namespace App\Http\Controllers;

use App\Models\FollowRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowRequestController extends Controller
{
    public function store(User $user)
    {
        $me = Auth::user();

        if ($me->id === $user->id) {
            return back()->withErrors('Je kan jezelf niet volgen.');
        }

        if ($me->following()->where('users.id', $user->id)->exists()) {
            return back()->withErrors('Je volgt deze gebruiker al.');
        }

        $existing = FollowRequest::where('requester_id', $me->id)
            ->where('requested_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->withErrors('Er staat al een verzoek open.');
        }

        $incoming = FollowRequest::where('requester_id', $user->id)
            ->where('requested_id', $me->id)
            ->where('status', 'pending')
            ->first();

        if ($incoming) {
            return back()->withErrors('Deze gebruiker heeft jou al een verzoek gestuurd. Accepteer/weis dat eerst.');
        }

        FollowRequest::create([
            'requester_id' => $me->id,
            'requested_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Volgverzoek verstuurd.');
    }

    public function accept(FollowRequest $followRequest)
    {
        $me = Auth::user();

        if ($followRequest->requested_id !== $me->id || $followRequest->status !== 'pending') {
            abort(403);
        }

        $followRequest->update(['status' => 'accepted']);


        $requester = User::findOrFail($followRequest->requester_id);

        // Gebruik jouw bestaande follows relatie (zoals je al had)
        $requester->following()->syncWithoutDetaching([$me->id]);

        return back()->with('success', 'Volgverzoek geaccepteerd.');
    }

    public function reject(FollowRequest $followRequest)
    {
        $me = Auth::user();

        if ($followRequest->requested_id !== $me->id || $followRequest->status !== 'pending') {
            abort(403);
        }

        $followRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Volgverzoek geweigerd.');
    }

    public function cancel(FollowRequest $followRequest)
    {
        $me = Auth::user();

        if ($followRequest->requester_id !== $me->id || $followRequest->status !== 'pending') {
            abort(403);
        }

        $followRequest->update(['status' => 'cancelled']);

        return back()->with('success', 'Volgverzoek ingetrokken.');
    }
}
