<?php

namespace App\Livewire;

use Livewire\Component;

class Select2 extends Component
{
    public $opcion = 3;
    public function render()
    {
        return view('livewire.select2');
    }
}
