<?php

use Illuminate\Support\Facades\Route;
use MongoDB\Client;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', function () {
    try {
        $client = new Client(env('DB_HOST'));
        $client->listDatabases(); // Forces a connection
        return response()->json(['msg' => 'MongoDB is accessible!']);
    } catch (\Exception $e) {
        return response()->json(['msg' => 'Could not connect to MongoDB: ' . $e->getMessage()]);
    }
});
