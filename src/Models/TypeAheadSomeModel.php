<?php

namespace App\Livewire;

use App\Models\SomeModel;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class TypeAheadSomeModel extends TypeAhead
{
    public ?SomeModel $someModel;

    public string $modelName = 'term';

    public string $value = 'some_html_label';
    public string $key = 'id';

    public string $term;

    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.type-ahead-someModel');
    }

    public function query(): Collection
    {
        return SomeModel::search($this->term)
            ->orderBy('name')
            ->get();
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }


    #[On('updated-someModel')]
    public function listenSomeModelSelected($name): void
    {

        if ( ! strlen($name) ) return;

        $this->someModel = SomeModel::whereName(SomeModel::removeStateAbbreviation($name))->first();
        $this->term = $this->someModel->with_state_abbreviation;
        $this->dispatch('someModel-selected', ['someModel' => $this->someModel]);
    }

}
