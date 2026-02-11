<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DropdownTag extends Component
{
    public array $tags = [];
    public string $newTag = '';
    public bool $isOpen = false;

    public function mount(array $initialTags = [])
    {
        $this->tags = $initialTags;
    }

    public function addTag(): void
    {
        $this->newTag = trim($this->newTag);
        
        if ($this->newTag && !in_array($this->newTag, $this->tags)) {
            $this->tags[] = $this->newTag;
            $this->newTag = '';
        }
    }

    public function removeTag(int $index): void
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }

    public function toggleDropdown(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.components.dropdown-tag');
    }
}
