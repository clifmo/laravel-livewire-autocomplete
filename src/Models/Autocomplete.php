<?php

namespace App\Livewire;

use Livewire\Component;

abstract class Autocomplete extends Component
{
    public $results;
    public string $search;
    public $selected;
    public $showDropdown;

    public string $label = 'some_label';
    public string $identifier = 'id';

    abstract public function query();

    public function mount(): void
    {
        $this->showDropdown = false;
        $this->results = collect();
    }

    public function updatedSelected(): void
    {
        $this->dispatch('valueSelected', $this->selected);
    }

    public function updatedSearch(): void
    {

        if (strlen($this->search) < 2) {
            $this->results = collect();
            $this->showDropdown = false;
            return;
        }

        if ($this->query()) {
            $this->results = $this->query()->get();
        } else {
            $this->results = collect();
        }

        $this->selected = '';
        $this->showDropdown = true;
    }

    public function render()
    {
        return view('livewire.autocomplete');
    }
}
