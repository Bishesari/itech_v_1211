<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Volt\Component;

new class extends Component
{
    public string $user_name = '';
    public string $password = '';
    public bool $remember = false;

    public string $context = 'modal'; // modal | page

    public function mount(string $context = 'modal'): void
    {
        $this->context = $context;
    }

    public function login(): void
    {
        $key = Str::lower($this->user_name) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('user_name', 'تلاش‌های ناموفق زیاد! یک دقیقه دیگر تلاش کنید.');
            return;
        }

        if (Auth::attempt(
            ['user_name' => $this->user_name, 'password' => $this->password],
            $this->remember
        )) {

            session()->regenerate();
            RateLimiter::clear($key);

            $roles = Auth::user()->getAllRolesWithInstitutes();

            if ($roles->count() === 1) {
                $role = $roles->first();
                session([
                    'active_role_id' => $role->role_id,
                    'active_institute_id' => $role->institute_id,
                ]);
            }

            if ($this->context === 'modal') {
                $this->dispatch('reloadPage');
            } else {
                $this->redirectRoute('dashboard', navigate: true);
            }
            return;
        }

        RateLimiter::hit($key);
        $this->addError('password', 'نام کاربری یا رمز عبور اشتباه است.');
    }

    public function reset_all(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }
};
