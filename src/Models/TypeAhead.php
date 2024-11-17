<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

abstract class TypeAhead extends Component
{
    abstract public function query(): Collection;
    public array $searchResults = [];

    abstract public function getModelName(): string;


    public function updated(): void
    {
        if($this->{$this->getModelName()} != '') {
            $this->searchResults = $this->query()->pluck($this->value, $this->key)->toArray();
        } else {
            $this->searchResults = [];
        }
    }

    public function render()
    {
        return view('livewire.type-ahead');
    }
}
