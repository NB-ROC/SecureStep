<?php

namespace App\Http\Controllers;

use App\Models\FollowRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowRequestController extends Controller
{
    public function store(User $user)
    {
        $me = auth()->user();

        if ($me->id === $user->id) {
            return back()->withErrors('Je kan jezelf niet volgen.');
        }

        // Als je al volgt: stop
        if ($me->following()->where('users.id', $user->id)->exists()) {
            return back()->withErrors('Je volgt deze gebruiker al.');
        }

        // Bestaat er al een request record (welke status dan ook)?
        $req = FollowRequest::where('requester_id', $me->id)
            ->where('requested_id', $user->id)
            ->first();

        if ($req) {
            if ($req->status === 'pending') {
                return back()->with('success', 'Volgverzoek is al ingediend.');
            }

            if (in_array($req->status, ['rejected', 'cancelled'])) {
                $req->update(['status' => 'pending']);
                return back()->with('success', 'Volgverzoek opnieuw verstuurd.');
            }

            return back()->withErrors('Dit verzoek is al geaccepteerd.');
        }

        // Als zij al pending naar jou hebben gestuurd
        $incoming = FollowRequest::where('requester_id', $user->id)
            ->where('requested_id', $me->id)
            ->where('status', 'pending')
            ->first();

        if ($incoming) {
            return back()->withErrors('Deze gebruiker heeft jou al een verzoek gestuurd. Accepteer/weiger dat eerst.');
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
        $me = auth()->user();

        if ($followRequest->requested_id !== $me->id || $followRequest->status !== 'pending') {
            abort(403);
        }

        $requester = User::findOrFail($followRequest->requester_id);

        // Markeer request als accepted
        $followRequest->update(['status' => 'accepted']);

        // Mutual follow
        $requester->following()->syncWithoutDetaching([$me->id]);        // requester -> me
        $me->following()->syncWithoutDetaching([$requester->id]);        // me -> requester

        // Alleen pending reverse request (indien die bestaat) ook accepted maken
        $reverse = FollowRequest::where('requester_id', $me->id)
            ->where('requested_id', $requester->id)
            ->where('status', 'pending')
            ->first();

        if ($reverse) {
            $reverse->update(['status' => 'accepted']);
        }

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
