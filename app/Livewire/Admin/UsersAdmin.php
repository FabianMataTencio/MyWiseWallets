<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UsersAdmin extends Component
{
    public $data_terms;
    public $id;

    protected $listeners = ['deleteUser', 'dataTermsUsers'=>'search'];

    public function search($data_terms, $id){
        $this-> data_terms = $data_terms;
        $this-> id = $id;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }  

    public function render()
    {
        $users = User::query()
            ->when($this->data_terms, function($query){
                $query->where('name', 'LIKE', "%" . $this->data_terms . "%");
            })
            ->when($this->id, function ($query) {
                $query->where('id', '=', $this->id);
            })
            ->orderBy('id', 'desc') 
            ->get();
        
        return view('livewire.admin.users-admin', [
            'users' => $users,
        ]);
    }
}
