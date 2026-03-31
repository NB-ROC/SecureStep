<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    private $database;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('firebase-credentials.json'))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        $this->database = $factory->createDatabase();
    }

    public function updateLocation($userId, $latitude, $longitude)
    {
        $this->database
            ->getReference("locations/{$userId}")
            ->set([
                "latitude" => $latitude,
                "longitude" => $longitude,
            ]);
    }

    public function getLocations()
    {
        return $this->database
            ->getReference('locations')
            ->getValue();
    }
}
