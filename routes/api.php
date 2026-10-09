<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/pengeluaran', function () {
    $data = DB::table('expenses')->get(); 
    return response()->json($data);
});

// tes cache
// tes cache
// tes     cache