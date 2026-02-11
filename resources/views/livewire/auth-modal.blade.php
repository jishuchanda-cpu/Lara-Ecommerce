<div>
    @if($show)
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 transition-opacity" wire:click="closeModal"></div>
        
        <!-- Modal -->
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full" @click.stop>
                <!-- Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $mode === 'login' ? 'Welcome Back' : 'Create Account' }}
                    </h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Tabs -->
                <div class="flex border-b border-gray-200 dark:border-gray-700">
                    <button 
                        wire:click="switchMode('login')"
                        class="flex-1 py-3 text-center font-medium transition-colors {{ $mode === 'login' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        Login
                    </button>
                    <button 
                        wire:click="switchMode('register')"
                        class="flex-1 py-3 text-center font-medium transition-colors {{ $mode === 'register' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        Register
                    </button>
                </div>

                <!-- Content -->
                <div class="p-6">
                    @if($mode === 'login')
                        <!-- Login Form -->
                        <form wire:submit.prevent="login" class="space-y-4">
                            <div>
                                <label for="loginEmail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    id="loginEmail"
                                    wire:model="loginEmail"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('loginEmail') border-red-500 @enderror"
                                    placeholder="you@example.com"
                                    required
                                />
                                @error('loginEmail')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="loginPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Password
                                </label>
                                <input 
                                    type="password" 
                                    id="loginPassword"
                                    wire:model="loginPassword"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('loginPassword') border-red-500 @enderror"
                                    placeholder="••••••••"
                                    required
                                />
                                @error('loginPassword')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <button 
                                type="submit"
                                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Sign In
                            </button>
                        </form>
                    @else
                        <!-- Registration Form -->
                        <form wire:submit.prevent="register" class="space-y-4">
                            <div>
                                <label for="registerName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Full Name
                                </label>
                                <input 
                                    type="text" 
                                    id="registerName"
                                    wire:model="registerName"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('registerName') border-red-500 @enderror"
                                    placeholder="John Doe"
                                    required
                                />
                                @error('registerName')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="registerEmail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    id="registerEmail"
                                    wire:model="registerEmail"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('registerEmail') border-red-500 @enderror"
                                    placeholder="you@example.com"
                                    required
                                />
                                @error('registerEmail')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="registerPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Password
                                </label>
                                <input 
                                    type="password" 
                                    id="registerPassword"
                                    wire:model="registerPassword"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('registerPassword') border-red-500 @enderror"
                                    placeholder="••••••••"
                                    required
                                />
                                @error('registerPassword')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="registerPasswordConfirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Confirm Password
                                </label>
                                <input 
                                    type="password" 
                                    id="registerPasswordConfirmation"
                                    wire:model="registerPassword_confirmation"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    placeholder="••••••••"
                                    required
                                />
                            </div>

                            <button 
                                type="submit"
                                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Create Account
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
