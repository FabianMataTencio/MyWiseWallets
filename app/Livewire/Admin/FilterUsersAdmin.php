<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FilterUsersAdmin extends Component
{
    public $data_terms;
    public $id;
    
    public function reedFormDataUsers(){
        $this->dispatch('dataTermsUsers', $this->data_terms, $this->id);
    }

    public function resetFilters()
    {
        $this->data_terms = null;
        $this->id = null;
        $this->dispatch('dataTermsUsers', $this->data_terms, $this->id);
    }

    public function render()
    {
        return view('livewire.admin.filter-users-admin');
    }
}
