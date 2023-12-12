<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use App\Models\UserCV;
use Livewire\Component;

class Searchcv extends Component
{

    #[Url(keep: true)]
    public $search = '';
    public $cvs;

    public function search(){

        $this->resetdata();
    }
    // public function resetData()
    // {
    //     $this->search='';
    //     $this->cvs = [];
    // }
    public function render()
    {
        if (!empty('search')) {
            $this->cvs = UserCV::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->cvs = null;
        }

        return view('livewire.searchcv');
    }
    
}
