<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $this->firebaseService->updateLocation(auth()->id(), $request->latitude, $request->longitude);

        return response()->json(['success' => true]);
    }

    public function getLocations()
    {
        return response()->json($this->firebaseService->getLocations());
    }
}
