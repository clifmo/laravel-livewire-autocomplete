<?php

namespace App\Livewire;

use App\Models\County;
use Livewire\Component;

class AutocompleteCounty extends Autocomplete
{

    public function query()
    {
        return County::where('name', 'like', '%'.$this->search.'%');
    }
}
