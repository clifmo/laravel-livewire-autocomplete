<div>
    <div
        x-data="{
          open: @entangle('showDropdown'),
          search: @entangle('search'),
          selected: @entangle('selected'),
          highlightedIndex: 0,
          highlightPrevious() {
            if (this.highlightedIndex > 0) {
              this.highlightedIndex = this.highlightedIndex - 1;
              this.scrollIntoView();
            }
          },
          highlightNext() {
            if (this.highlightedIndex < this.$refs.results.children.length - 1) {
              this.highlightedIndex = this.highlightedIndex + 1;
              this.scrollIntoView();
            }
          },
          scrollIntoView() {
            this.$refs.results.children[this.highlightedIndex].scrollIntoView({
              block: 'nearest',
              behavior: 'smooth'
            });
          },
          updateSelected(id, name) {
            this.selected = id;
            this.search = name;
            this.open = false;
            this.highlightedIndex = 0;
          },
      }">
        <div x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
            <span>
              <div>
                <input
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-bluishCyan-500 dark:focus:border-bluishCyan-600 focus:ring-bluishCyan-500 dark:focus:ring-bluishCyan-600 rounded-md shadow-sm mt-1 block w-full"
                    wire:model.live.debounce.300ms="search"
                    x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                    x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                    x-on:keydown.enter.stop.prevent="$dispatch('value-selected', {
                    id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
                    name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                  })">
              </div>
            </span>
            <div
                x-show="open"
                x-on:click.away="open = false"
                class="bg-gray-300 dark:bg-black dark:text-gray-300"
            >
                <ul x-ref="results">
                    @forelse($results as $index => $result)
                        <li
                            wire:key="{{ $index }}"
                            x-on:click.stop="$dispatch('value-selected', {
                id: {{ $result->id }},
                name: '{{ $result->{$this->label} }}'
              })"
                            :class="{
                'bg-bluishCyan-400': {{ $index }} === highlightedIndex,
                'text-gray-700 dark:text-gray-700': {{ $index }} === highlightedIndex
              }"
                            data-result-id="{{ $result->id }}"
                            data-result-name="{{ $result->{$this->label} }}">
                <span>
                  {{ $result->{$this->label} }}
                </span>
                        </li>
                    @empty
                        <li>No results found</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
