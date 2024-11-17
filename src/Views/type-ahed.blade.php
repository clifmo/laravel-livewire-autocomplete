<div
    class="mt-1 block w-full"
>
    <input
        type="text"
        list="{{$this->getModelName()}}Options"
        wire:model.live.debounce.300ms="{{$this->getModelName()}}"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
    >

    <datalist id="{{$this->getModelName()}}Options">
        @foreach($searchResults as $key => $result)
            <option
                wire:key="{{ $key }}"
                data-value="{{ $key }}"
                value="{{ $result }}"
            ></option>
        @endforeach
    </datalist>
</div>
