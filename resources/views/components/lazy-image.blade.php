@props([
    'src',
    'alt',
    'class' => '',
    'placeholder' => '/images/placeholder.svg',
    'width' => null,
    'height' => null
])

<div 
    class="lazy-image-container relative overflow-hidden {{ $class }}"
    {{ $width ? 'style="width: ' . $width . 'px;"' : '' }}
    {{ $height ? 'style="height: ' . $height . 'px;"' : '' }}
>
    <!-- Placeholder/Blur effect -->
    <div class="absolute inset-0 bg-gray-200 dark:bg-gray-700 animate-pulse"></div>
    
    <!-- Actual image with lazy loading -->
    <img 
        src="{{ $placeholder }}" 
        data-src="{{ $src }}"
        alt="{{ $alt }}"
        class="lazy-image w-full h-full object-cover transition-opacity duration-300 opacity-0"
        loading="lazy"
        {{ $width ? 'width="' . $width . '"' : '' }}
        {{ $height ? 'height="' . $height . '"' : '' }}
    />
    
    <!-- Loading indicator -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none loading-spinner hidden">
        <svg class="w-8 h-8 text-gray-400 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</div>