<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

@auth
<aside class="sidebar bg-[var(--bg-secondary)] border-r border-[var(--border)] flex flex-col" id="sidebar">

    <!-- Logo -->
    <div class="py-2 px-4 h-16 border-b border-[var(--border)]">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-[var(--accent)] flex items-center justify-center glow-accent">
                <svg class="w-6 h-6 text-[var(--bg-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                </svg>
            </div>
            <div>
                <h1 class="font-display font-bold text-lg">Command</h1>
                <p class="text-xs text-[var(--fg-muted)]">Admin Panel</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 p-4 overflow-y-auto">

        <!-- Main -->
        <div class="mb-6">
            <p class="text-xs font-medium text-[var(--fg-muted)] uppercase tracking-wider mb-3 px-2">Main</p>
            <div class="space-y-1">

                {{-- Dashboard --}}
                @if(Route::has('dashboard'))
                    <div class="nav-item flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        <a href="{{ route('dashboard') }}"><span class="font-medium">Dashboard</span></a>
                        
                    </div>


                @endif
                {{-- Analytics --}}
                @if(Route::has('analytics.index'))
                <a href="{{ route('analytics.index') }}"
                   class="nav-item flex items-center gap-3 {{ request()->routeIs('analytics.*') ? 'active' : '' }}">
                    <span class="font-medium">Analytics</span>
                </a>
                @endif

                {{-- Content --}}
                @if(Route::has('content.index'))
                <a href="{{ route('content.index') }}"
                   class="nav-item flex items-center gap-3 {{ request()->routeIs('content.*') ? 'active' : '' }}">
                    <span class="font-medium">Content</span>
                </a>
                @endif

                {{-- Users --}}
                @if(Route::has('users.index'))
                    <div class="nav-item flex items-center gap-3 {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <svg class="w-6 h-6 text-[var(--accent)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 010 7.75"></path>
                        </svg>
                        <a href="{{ route('users.index') }}"><span class="font-medium">Users</span></a>
                        
                    </div>
                @endif


                {{-- File Manager --}}
                @if(Route::has('file-manager.index'))
                    <div class="nav-item flex items-center gap-3 {{ request()->routeIs('file-manager.*') ? 'active' : '' }}">
                        <svg class="w-9 h-9 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                        </svg>
                        <a href="{{ route('file-manager.index') }}"><span class="font-medium">File Manager</span></a>
                        
                    </div>
                @endif

                {{-- Chatbots --}}
                @if(Route::has('chatbots.index'))
                    <div class="nav-item flex items-center gap-3 {{ request()->routeIs('chatbots.*') ? 'active' : '' }}">
                        <svg class="w-9 h-9 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                        </svg>
                        <a href="{{ route('chatbots.index') }}"><span class="font-medium">File Manager</span></a>
                        
                    </div>
                @endif
            </div>
        </div>

        <!-- Management -->
        <div class="mb-6">
            <p class="text-xs font-medium text-[var(--fg-muted)] uppercase tracking-wider mb-3 px-2">Management</p>
            <div class="space-y-1">

                {{-- Media --}}
                @if(Route::has('media.index'))
                <a href="{{ route('media.index') }}"
                   class="nav-item flex items-center gap-3 {{ request()->routeIs('media.*') ? 'active' : '' }}">
                    <span class="font-medium">Media Library</span>
                </a>
                @endif

                {{-- Settings --}}
                @if(Route::has('settings.index'))
                <a href="{{ route('settings.index') }}"
                   class="nav-item flex items-center gap-3 {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <span class="font-medium">Settings</span>
                </a>
                @endif

            </div>
        </div>

    </nav>

    <!-- User Card -->
    <div class="p-4 border-t border-[var(--border)]">
        <div class="card-elevated p-3 flex items-center gap-3">
            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=admin"
                 class="w-10 h-10 rounded-full bg-[var(--bg-secondary)]">
            <div class="flex-1 min-w-0">
                <p class="font-medium text-sm truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-[var(--fg-muted)] truncate">Super Admin</p>
            </div>
        </div>
    </div>

</aside>
@endauth