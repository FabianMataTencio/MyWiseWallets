<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\On;

class ReviewsAdmin extends Component
{
    public $data_terms;
    public $stars;

    protected $listeners = ['deleteReview', 'dataTermsReviews'=>'search'];

    public function search($data_terms, $stars){
        $this-> data_terms = $data_terms;
        $this-> stars = $stars;
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
    }  

    public function render()
    {
        $reviews = Review::query()
            ->when($this->data_terms, function($query) {
                $query->where(function($query) {
                    $query->whereHas('user', function($query) {
                        $query->where('name', 'like', '%' . $this->data_terms . '%');
                    })
                    ->orWhere('description', 'like', '%' . $this->data_terms . '%');
                });
            })
            ->when($this->stars, function($query){
                $query->where('star_id', $this->stars);
            })
            ->orderBy('id', 'desc') 
            ->get();
        
        return view('livewire.admin.reviews-admin', [
            'reviews' => $reviews,
        ]);
    }
}
