<?php

namespace App\Livewire\Review;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\On;

class ShowReviews extends Component
{
    protected $liseners = ['deleteReview'];

    #[On('deleteReview')]

    public function deleteReview(Review $review){
        $review->delete();
        $this->dispatch('reviewDeleted');
    } 

    public function render()
    {
        $userId = auth()->check() ? auth()->id() : null;
        
        $reviews = Review::query()
            ->orderByRaw("CASE WHEN user_id = ? THEN 0 ELSE 1 END", [$userId])
            ->orderBy('id', 'desc') 
            ->get();
        
        return view('livewire.review.show-reviews', [
            'reviews' => $reviews,
        ]);
    }
}
