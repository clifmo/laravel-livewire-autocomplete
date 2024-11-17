<?php

namespace App\Livewire;

use App\Models\SomeModel;
use Livewire\Component;

class AutocompleteSomeModel extends Autocomplete
{

    public function query()
    {
        return SomeModel::where('name', 'like', '%'.$this->search.'%');
    }
}
