<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class LazyImage extends Component
{
    public string $src;
    public string $alt;
    public string $class;
    public string $placeholder;
    public ?string $width;
    public ?string $height;

    public function __construct(
        string $src,
        string $alt,
        string $class = '',
        string $placeholder = '/images/placeholder.jpg',
        ?string $width = null,
        ?string $height = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->width = $width;
        $this->height = $height;
    }

    public function render(): View
    {
        return view('components.lazy-image');
    }
}