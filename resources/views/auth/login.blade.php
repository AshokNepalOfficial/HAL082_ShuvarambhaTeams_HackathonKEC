<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-[420px] bg-brand-card border border-brand-border rounded-xl p-8 animate-in relative z-10">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-brand-accent mb-4 shadow-[0_0_30px_rgba(0,212,170,0.3)]">
                <a href="/">
                    <x-application-logo class="w-8 h-8 text-brand-primary" />
                </a>
            </div>
            <h1 class="font-display text-2xl font-bold">Welcome Back</h1>
            <p class="text-brand-muted mt-1 text-sm">Sign in to your account</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label 
                    for="email"
                    :value="__('Email Address')" 
                    class="block text-xs font-medium text-slate-400 mb-2 uppercase tracking-wider"
                />

                <x-text-input 
                    id="email"
                    name="email"
                    type="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com"
                    class="w-full bg-brand-secondary border border-brand-border rounded-lg px-4 py-2.5 outline-none focus:border-brand-accent focus:ring-2 focus:ring-brand-accent/20 transition-all"
                />

                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label 
                    for="password"
                    :value="__('Password')" 
                    class="block text-xs font-medium text-slate-400 mb-2 uppercase tracking-wider"
                />

                <x-text-input 
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full bg-brand-secondary border border-brand-border rounded-lg px-4 py-2.5 outline-none focus:border-brand-accent focus:ring-2 focus:ring-brand-accent/20 transition-all"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="flex items-center space-x-2">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-brand-accent shadow-sm focus:ring-brand-accent">
                    <span class="text-slate-400">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-brand-accent hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <x-primary-button 
                class="w-full bg-brand-accent text-brand-primary font-bold py-3 rounded-lg hover:brightness-110 active:scale-[0.98] transition-all justify-center">
                {{ __('Sign In') }}
            </x-primary-button>

        </form>
    </div>
</x-guest-layout>