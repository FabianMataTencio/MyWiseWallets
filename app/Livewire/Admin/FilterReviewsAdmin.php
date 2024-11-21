<?php

namespace App\Livewire\Admin;

use App\Models\Star;
use Livewire\Component;

class FilterReviewsAdmin extends Component
{
    public $data_terms;
    public $stars;
    
    public function reedFormDataReviews(){
        $this->dispatch('dataTermsReviews', $this->data_terms, $this->stars);
    }

    public function resetFilters()
    {
        $this->data_terms = null;
        $this->stars = null;
        $this->dispatch('dataTermsReviews', $this->data_terms, $this->stars);
    }

    public function render()
    {
        return view('livewire.admin.filter-reviews-admin');
    }
}
