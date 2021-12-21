<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MhsController extends Controller
{
    public function mhs() {
        $data = "Data Mahasiswa";
        return response()->json($data, 200);
    }

    public function mhsAuth() {
        $data = "Hai " . Auth::user()->name;
        return response()->json($data, 200);
    }
}
