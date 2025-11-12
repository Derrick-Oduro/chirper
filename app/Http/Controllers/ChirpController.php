<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;

class ChirpController extends Controller
{

    public function index()
    {
        $chirps = Chirp::with('user')
        ->latest()
        ->take(50)
        ->get();

        return view('home', ['chirps' => $chirps]);
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Chirp::create([
            'message' => $validated['message'],
        ]);


        return redirect('/')->with('success', 'Chirp created successfully.');

    }
}

