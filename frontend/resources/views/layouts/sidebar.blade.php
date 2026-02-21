<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

@auth
<aside class="sidebar bg-[var(--bg-secondary)] border-r border-[var(--border)] flex flex-col" id="sidebar">

    <!-- Logo -->
    <div class="py-2 px-4 h-16 border-b border-[var(--border)]">
        <div class="flex items-center gap-3">

        <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-accent to-purple flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="bot" aria-hidden="true" class="lucide lucide-bot w-6 h-6 text-bg-primary"><path d="M12 8V4H8"></path><rect width="16" height="12" x="4" y="8" rx="2"></rect><path d="M2 14h2"></path><path d="M20 14h2"></path><path d="M15 13v2"></path><path d="M9 13v2"></path></svg>
                    </div>
                    <span class="font-display font-bold text-xl tracking-tight">Shuvarambha</span>
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
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                        <svg class="w-6 h-6" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">

                            <!-- Folder body -->
                            <path d="M3 7h5l2 2h11v9a2 2 0 0 1-2 2H3z"></path>

                            <!-- Folder top -->
                            <path d="M3 7V5a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v2"></path>

                        </svg>
                        <a href="{{ route('file-manager.index') }}"><span class="font-medium">File Manager</span></a>
                        
                    </div>
                @endif

                {{-- Chatbots --}}
                @if(Route::has('chatbots.index'))
                    <div class="nav-item flex items-center gap-3 {{ request()->routeIs('chatbots.*') ? 'active' : '' }}">
                       <svg class="w-6 h-6" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">

                            <!-- Antenna -->
                            <line x1="12" y1="2" x2="12" y2="5"></line>
                            <circle cx="12" cy="2" r="1"></circle>

                            <!-- Head -->
                            <rect x="4" y="6" width="16" height="12" rx="3"></rect>

                            <!-- Eyes -->
                            <circle cx="9" cy="12" r="1"></circle>
                            <circle cx="15" cy="12" r="1"></circle>

                            <!-- Mouth -->
                            <line x1="9" y1="16" x2="15" y2="16"></line>

                        </svg>
                        <a href="{{ route('chatbots.index') }}"><span class="font-medium">Chatbots</span></a>
                        
                    </div>
                @endif


                                {{-- FileTypes --}}
                @if(Route::has('filetypes.index'))
                    <div class="nav-item flex items-center gap-3 {{ request()->routeIs('filetypes.*') ? 'active' : '' }}">
                       <svg class="w-6 h-6" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">

                            <!-- Antenna -->
                            <line x1="12" y1="2" x2="12" y2="5"></line>
                            <circle cx="12" cy="2" r="1"></circle>

                            <!-- Head -->
                            <rect x="4" y="6" width="16" height="12" rx="3"></rect>

                            <!-- Eyes -->
                            <circle cx="9" cy="12" r="1"></circle>
                            <circle cx="15" cy="12" r="1"></circle>

                            <!-- Mouth -->
                            <line x1="9" y1="16" x2="15" y2="16"></line>

                        </svg>
                        <a href="{{ route('filetypes.index') }}"><span class="font-medium">File Type</span></a>
                        
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