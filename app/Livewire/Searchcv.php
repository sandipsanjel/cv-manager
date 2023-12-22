<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Url;
use App\Models\UserCV;
use Livewire\Component;

class Searchcv extends Component
{

    #[Url(keep: true)]
    public $search = '';
    public $cvs;

    public function search()
    {

        $this->resetdata();
    }
    // public function resetData()
    // {
    //     $this->search='';
    //     $this->cvs = [];
    // }
    public function render()
    {
        $this->cvs = UserCV::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.searchcv');
    }
}
