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
            // Als het al pending is: niks doen
            if ($req->status === 'pending') {
                return back()->with('success', 'Volgverzoek is al ingediend.');
            }

            // Als het eerder rejected/cancelled was: zet terug naar pending
            if (in_array($req->status, ['rejected', 'cancelled'])) {
                $req->update(['status' => 'pending']);
                return back()->with('success', 'Volgverzoek opnieuw verstuurd.');
            }

            // accepted (zou normaal niet voorkomen omdat following-check hierboven)
            return back()->withErrors('Dit verzoek is al geaccepteerd.');
        }

        // (Slim) als zij al pending naar jou hebben gestuurd
        $incoming =FollowRequest::where('requester_id', $user->id)
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
        $me = auth()->user();

        if ($followRequest->requested_id !== $me->id || $followRequest->status !== 'pending') {
            abort(403);
        }

        // requester = Alice, requested = Bob(me)
        $requester = User::findOrFail($followRequest->requester_id);

        // Markeer deze request als accepted
        $followRequest->update(['status' => 'accepted']);

        // 1) Alice volgt Bob
        $requester->following()->syncWithoutDetaching([$me->id]);

        // 2) Bob volgt Alice (wederzijds)
        $me->following()->syncWithoutDetaching([$requester->id]);

        // 3) Als er al een "tegen-request" bestaat (Bob -> Alice), markeer die ook accepted
        $reverse = FollowRequest::where('requester_id', $me->id)
            ->where('requested_id', $requester->id)
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
