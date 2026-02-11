<div class="relative">
    <!-- Selected Tags Display -->
    <div class="flex flex-wrap items-center gap-2 p-3 border border-gray-300 rounded-lg bg-white min-h-[48px] cursor-pointer" wire:click="toggleDropdown">
        @if(count($tags) > 0)
            @foreach($tags as $index => $tag)
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    {{ $tag }}
                    <button 
                        wire:click="removeTag({{ $index }})"
                        class="ml-1 text-blue-600 hover:text-blue-800 focus:outline-none"
                        type="button"
                    >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </span>
            @endforeach
        @else
            <span class="text-gray-500">Select tags...</span>
        @endif
        
        <!-- Dropdown Arrow -->
        <svg class="w-4 h-4 ml-auto text-gray-400 {{ $isOpen ? 'rotate-180' : '' }} transition-transform duration-200" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>

    <!-- Dropdown Input and Options -->
    @if($isOpen)
        <div class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg">
            <!-- Add New Tag Input -->
            <div class="p-3 border-b border-gray-200">
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        wire:model.live="newTag"
                        wire:keydown.enter="addTag"
                        placeholder="Add new tag..."
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button 
                        wire:click="addTag"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="button"
                    >
                        Add
                    </button>
                </div>
            </div>
            
            <!-- Available Tags (if you want to show predefined options) -->
            @if(isset($availableTags) && count($availableTags) > 0)
                <div class="max-h-48 overflow-y-auto">
                    @foreach($availableTags as $tag)
                        @if(!in_array($tag, $tags))
                            <button 
                                wire:click="addTag('{{ $tag }}')"
                                class="w-full px-3 py-2 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                type="button"
                            >
                                {{ $tag }}
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
