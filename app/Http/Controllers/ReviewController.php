<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        return view('reviews.index');
    }

    public function create(){
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:200',
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        Review::create([
            'description' => $validated['description'],
            'user_id' => auth()->id(),
            'star_id' => $validated['rating']
        ]);

        return redirect()->route('reviews.index')->with('message', __('Rewiew created successfully!'));
    }
}
