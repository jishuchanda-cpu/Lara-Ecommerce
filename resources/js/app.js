import './bootstrap';

// Lazy Loading Images Implementation
class LazyImageLoader {
    constructor() {
        this.imageObserver = null;
        this.init();
    }

    init() {
        // Check if Intersection Observer is supported
        if ('IntersectionObserver' in window) {
            this.setupIntersectionObserver();
            this.observeImages();
        } else {
            // Fallback for older browsers
            this.loadAllImages();
        }
    }

    setupIntersectionObserver() {
        const options = {
            root: null, // relative to viewport
            rootMargin: '50px 0px', // start loading 50px before image comes into view
            threshold: 0.01 // load when 1% of image is visible
        };

        this.imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadImage(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, options);
    }

    observeImages() {
        const lazyImages = document.querySelectorAll('img.lazy-image');
        
        lazyImages.forEach(img => {
            // Set initial placeholder
            if (!img.src || img.src.includes('placeholder')) {
                img.classList.add('opacity-0');
            }
            
            this.imageObserver.observe(img);
        });
    }

    loadImage(img) {
        const container = img.closest('.lazy-image-container');
        const loadingSpinner = container?.querySelector('.loading-spinner');
        const placeholderBg = container?.querySelector('.absolute.inset-0.bg-gray-200');
        
        // Show loading state
        if (loadingSpinner) {
            loadingSpinner.classList.remove('hidden');
        }

        // Create new image to preload
        const newImg = new Image();
        
        newImg.onload = () => {
            // Replace placeholder with actual image
            img.src = img.dataset.src;
            img.classList.remove('opacity-0');
            img.classList.add('opacity-100');
            
            // Hide loading spinner and placeholder
            if (loadingSpinner) {
                loadingSpinner.classList.add('hidden');
            }
            if (placeholderBg) {
                placeholderBg.classList.add('hidden');
            }
            
            // Add loaded class for animations
            img.classList.add('lazy-loaded');
        };

        newImg.onerror = () => {
            // Handle error - show error state
            console.error('Failed to load image:', img.dataset.src);
            if (loadingSpinner) {
                loadingSpinner.classList.add('hidden');
            }
            if (placeholderBg) {
                placeholderBg.classList.remove('bg-gray-200', 'dark:bg-gray-700');
                placeholderBg.classList.add('bg-red-100', 'dark:bg-red-900');
            }
        };

        // Start loading the image
        newImg.src = img.dataset.src;
    }

    loadAllImages() {
        // Fallback for browsers without Intersection Observer
        const lazyImages = document.querySelectorAll('img.lazy-image');
        lazyImages.forEach(img => this.loadImage(img));
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new LazyImageLoader();
});

// Reinitialize if new content is loaded dynamically
if (typeof window !== 'undefined') {
    window.lazyImageLoader = {
        reinitialize: () => {
            new LazyImageLoader();
        }
    };
}
