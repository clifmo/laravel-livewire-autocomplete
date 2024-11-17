<div
    class="space-y-8 divide-y divide-gray-200"
    x-data='{
        someModelSelected(e) {

            let value = e.target.value

            let inputValue = document.getElementById("someModel").value;

            document.getElementById("someModelOptions").querySelectorAll("option").forEach(x => {
                if ( x.value === inputValue ) {
                    $wire.dispatch("updated-someModel", {name: inputValue});
                }
            });
        }
    }'
>
    <input
        type="text"
        list="someModelOptions"
        id="someModel"
        wire:model.live.debounce.200ms="term"
        autocomplete="off"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
        x-on:change.debounce="someModelSelected($event)"
    >

    <datalist id="someModelOptions">
        @foreach($searchResults as $key => $result)
            <option
                wire:key="{{ $key }}"
                data-value="{{ $key }}"
                value="{{ $result }}"
            ></option>
        @endforeach
    </datalist>
</div>


<script>
    let onChange = (e) => {
        // Get the text input value
        // It will be the human-readable label from the
        // datalist's value="foo" attribute
        let value = e.target.value
        console.log('onChange');
        // Get the data-value attribute by selecting the datalist element
        // with a matching value ('foo', 'bar', 'baz' in our case)
        // This might create an invalid css selector,
        // but you could also find the datalist element
        // and do a foreach on its child options

        // let selected = document.body.querySelector("datalist [value=\""+value+"\"]")

        let selected = 'done ';
        let inputValue = document.getElementById('someModel').value;
        document.getElementById('someModelOptions').querySelectorAll('option').forEach(x => {
            if ( x.value === inputValue ) {
                $wire.dispatch('updated-someModel');
            }
        });

        // If we find the selected option, grab the
        // machine-readable ID from the data-value attribute
        if (selected) {
            // let id = selected.dataset.value
            // console.log('selected value is:', id)
        }
    }

</script>
