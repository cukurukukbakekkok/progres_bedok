<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $calonSiswa = \App\Models\CalonSiswa::where('user_id', $user->id)->first();

    return view('siswa.dashboard', compact('user', 'calonSiswa'));
}
}
