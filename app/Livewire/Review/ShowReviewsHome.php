<?php

namespace App\Livewire\Review;

use App\Models\Review;
use Livewire\Component;

class ShowReviewsHome extends Component
{
    public function render()
    {
        $reviews = Review::query()
            ->whereIn('star_id', [4, 5]) 
            ->orderBy('created_at', 'desc') 
            ->limit(10)   
            ->get();
        
        return view('livewire.review.show-reviews-home', [
            'reviews' => $reviews,
        ]);
    }
}
