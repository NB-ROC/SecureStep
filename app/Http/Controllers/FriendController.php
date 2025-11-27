<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FriendController extends Controller
{
    /**
     * Toon de zoekpagina voor gebruikers.
     */
    public function index(Request $request): View
    {
        $search = $request->input('q');

        // Standaard lege collectie als er nog niet gezocht is
        $users = collect();

        if ($search) {
            $users = User::query()
                ->where('id', '!=', $request->user()->id) // jezelf eruit filteren
                ->where(function ($query) use ($search) {
                    $query->where('firstname', 'like', "%{$search}%")
                        ->orWhere('middlename', 'like', "%{$search}%")
                        ->orWhere('lastname', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('firstname')
                ->limit(25)
                ->get();
        }

        return view('friends.index', [
            'users'  => $users,
            'search' => $search,
        ]);
    }
}
