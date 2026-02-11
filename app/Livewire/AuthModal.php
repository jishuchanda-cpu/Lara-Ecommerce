<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AuthModal extends Component
{
    public bool $show = false;
    public string $mode = 'login'; // 'login' or 'register'

    // Login fields
    public string $loginEmail = '';
    public string $loginPassword = '';

    // Registration fields
    public string $registerName = '';
    public string $registerEmail = '';
    public string $registerPassword = '';
    public string $registerPassword_confirmation = '';

    protected $listeners = ['show-auth-modal' => 'showModal'];

    public function showModal(): void
    {
        $this->show = true;
        $this->reset(['loginEmail', 'loginPassword', 'registerName', 'registerEmail', 'registerPassword', 'registerPassword_confirmation']);
        $this->resetValidation();
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->mode = 'login';
        $this->reset(['loginEmail', 'loginPassword', 'registerName', 'registerEmail', 'registerPassword', 'registerPassword_confirmation']);
        $this->resetValidation();
    }

    public function switchMode(string $mode): void
    {
        $this->mode = $mode;
        $this->resetValidation();
    }

    public function login(): void
    {
        $this->validate([
            'loginEmail' => ['required', 'email'],
            'loginPassword' => ['required'],
        ]);

        if (!Auth::attempt(['email' => $this->loginEmail, 'password' => $this->loginPassword])) {
            throw ValidationException::withMessages([
                'loginEmail' => 'These credentials do not match our records.',
            ]);
        }

        $this->dispatch('auth-success');
        $this->closeModal();

        $this->dispatch('notify', [
            'message' => 'Welcome back!',
            'type' => 'success'
        ]);
    }

    public function register(): void
    {
        $validated = $this->validate([
            'registerName' => ['required', 'string', 'max:255'],
            'registerEmail' => ['required', 'email', 'max:255', 'unique:users,email'],
            'registerPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'registerPassword.confirmed' => 'The password confirmation does not match.',
        ], [
            'registerName' => 'name',
            'registerEmail' => 'email',
            'registerPassword' => 'password',
        ]);

        $user = User::create([
            'name' => $validated['registerName'],
            'email' => $validated['registerEmail'],
            'password' => Hash::make($validated['registerPassword']),
        ]);

        Auth::login($user);

        $this->dispatch('auth-success');
        $this->closeModal();

        $this->dispatch('notify', [
            'message' => 'Account created successfully! Welcome!',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.auth-modal');
    }
}
