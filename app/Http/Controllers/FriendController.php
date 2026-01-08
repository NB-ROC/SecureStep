<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index(Request $request)
    {
        // altijd string, ook als q ontbreekt
        $search = (string) $request->query('q', '');

        // basis-query: iedereen behalve jezelf
        $users = User::query()
            ->where('id', '!=', $request->user()->id)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('firstname', 'like', "%{$search}%")
                        ->orWhere('middlename', 'like', "%{$search}%")
                        ->orWhere('lastname', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('firstname')
            ->limit(25)
            ->get();

        // ids van alle users die jij volgt
        $followingIds = $request->user()
            ->following()
            ->pluck('users.id')
            ->toArray();

        $outgoingPending = $request->user()
            ->outgoingFollowRequests()
            ->where('status', 'pending')
            ->get()
            ->keyBy('requested_id');

        $incomingPending = $request->user()
            ->incomingFollowRequests()
            ->where('status', 'pending')
            ->get()
            ->keyBy('requester_id');

        // AJAX request: alleen de partial teruggeven
        if ($request->ajax()) {
            return view('friends._results', [
                'users'        => $users,
                'search'       => $search,
                'followingIds' => $followingIds,
                'outgoingPending' => $outgoingPending,
                'incomingPending' => $incomingPending,
            ]);
        }

        // normale page load
        return view('friends.index', [
            'users'        => $users,
            'search'       => $search,
            'followingIds' => $followingIds,
            'outgoingPending' => $outgoingPending,
            'incomingPending' => $incomingPending,
        ]);
    }
}
