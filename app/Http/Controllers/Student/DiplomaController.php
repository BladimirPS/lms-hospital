<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiplomaController extends Controller
{
    public function index()
    {
        $diplomas = Auth::user()->enrollments()
            ->with(['diploma', 'course'])
            ->whereHas('diploma')
            ->get();

        return view('student.diplomas', compact('diplomas'));
    }
}
