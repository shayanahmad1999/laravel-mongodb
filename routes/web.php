<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', function () {
    try {
        DB::connection('mongodb')->getPdo();
        return response()->json(['msg' => 'MongoDB is accessible!']);
    } catch (\Exception $e) {
        return response()->json(['msg' => 'Could not connect to MongoDB: ' . $e->getMessage()]);
    }
});
