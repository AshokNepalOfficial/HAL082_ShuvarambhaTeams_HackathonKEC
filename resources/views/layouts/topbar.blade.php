    <header class="sticky top-0 z-50 bg-[var(--bg-primary)]/80 backdrop-blur-lg border-b border-[var(--border)]">
        <div class="flex items-center justify-between px-4 lg:px-6 h-16">
            <button class="lg:hidden p-2 rounded-lg hover:bg-[var(--bg-card)] transition-colors focus-ring" id="menuToggle"
                aria-label="Toggle menu">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg>
            </button>
            <!-- Search -->
            <div class="hidden md:flex flex-1 max-w-md">
                <div class="relative w-full">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[var(--fg-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="search" placeholder="Search anything..." class="input-field pl-10 focus-ring" id="searchInput">
                    <kbd class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-[var(--fg-muted)] bg-[var(--bg-elevated)] px-2 py-1 rounded border border-[var(--border)]">/</kbd>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <button class="p-2 rounded-lg hover:bg-[var(--bg-card)] transition-colors focus-ring" id="notificationBtn">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 01-3.46 0" />
                        </svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-[var(--danger)] rounded-full"></span>
                    </button>
                    <div class="dropdown-menu w-80" id="notificationDropdown">
                        <div class="p-3 border-b border-[var(--border)]">
                            <p class="font-display font-semibold">Notifications</p>
                        </div>
                        <div class="p-2">
                            <div class="dropdown-item">New user registered</div>
                            <div class="dropdown-item">Server load warning</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button
                        class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-[var(--bg-card)] transition-colors focus-ring"
                        id="profileBtn">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=admin" alt="Admin"
                            class="w-8 h-8 rounded-full bg-[var(--bg-card)]">
                    </button>
                    <div class="dropdown-menu" id="profileDropdown">
                        <div class="dropdown-item">Profile</div>
                        <div class="dropdown-item">Settings</div>


                        <div class="dropdown-item text-[var(--danger)]">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>