<x-app-layout>
    <!-- USER MANAGEMENT SECTION-->
    <main class="p-4 lg:p-6 view-section active" id="user-management-view">

        <div class="mb-6 animate-in stagger-1">
            <!-- Main Container: items-start helps align H1/P better on desktop -->
            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-y-4 gap-x-4">

                <!-- 1. Header & Description (Always Order 1) -->
                <div class="order-1">
                    <h1 class="font-display text-2xl lg:text-3xl font-bold text-[var(--fg-primary)]">
                       Dashboard
                    </h1>
                    <!-- Visible only on Desktop -->
                    <p class="hidden sm:block text-[var(--fg-secondary)] mt-1">
                        Used for managing the user.
                    </p>
                </div>

                <!-- 2. The Button 
              Mobile: order-2 (Top Right)
              Desktop: order-3 (Far Right) -->
                <button type="button"
                    class="order-2 sm:order-3 btn-primary inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all hover:brightness-110 active:scale-95 whitespace-nowrap">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    <span>Add User</span>
                </button>

                <!-- 3. Selects Wrapper
              Mobile: order-3 & w-full (Forces it to Row 2)
              Desktop: order-2, w-auto, and sm:ml-auto (Pushes itself and the button to the right) -->
                <div class="order-3 sm:order-2 w-full sm:w-auto sm:ml-auto flex items-center gap-3">

                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
            <div class="card lg:p-5 p-3 animate-in stagger-1">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Total Users</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1" data-count="128459">128,459</p>
                        <div class="flex items-center gap-1 mt-2 text-[var(--accent)]">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 6l-9.5 9.5-5-5L1 18"></path>
                                <path d="M17 6h6v6"></path>
                            </svg>
                            <span class="text-sm font-medium">+12.5%</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[var(--accent)]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[var(--accent)]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 010 7.75"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="card lg:p-5 p-3 animate-in stagger-2">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Active</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1" data-count="892340">892,340</p>
                        <div class="flex items-center gap-1 mt-2 text-[var(--accent)]">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 6l-9.5 9.5-5-5L1 18"></path>
                                <path d="M17 6h6v6"></path>
                            </svg>
                            <span class="text-sm font-medium">+8.2%</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[var(--info)]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[var(--info)]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="card lg:p-5 p-3 animate-in stagger-3">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Pending</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1">32.4%</p>
                        <div class="flex items-center gap-1 mt-2 text-[var(--accent)]">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 18l-9.5-9.5-5 5L1 6"></path>
                                <path d="M17 18h6v-6"></path>
                            </svg>
                            <span class="text-sm font-medium">-4.1%</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[var(--warning)]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[var(--warning)]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="card lg:p-5 p-3 animate-in stagger-4">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Today</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1">4m 32s</p>
                        <div class="flex items-center gap-1 mt-2 text-[var(--accent)]">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 6l-9.5 9.5-5-5L1 18"></path>
                                <path d="M17 6h6v6"></path>
                            </svg>
                            <span class="text-sm font-medium">+18.7%</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section  -->

        <div class="card overflow-hidden">
            <style>
                /* Custom Checkbox */
                .custom-checkbox {
                    appearance: none;
                    width: 18px;
                    height: 18px;
                    border: 1px solid var(--border);
                    border-radius: 4px;
                    background: var(--bg-secondary);
                    cursor: pointer;
                    position: relative;
                    transition: all 0.2s ease;
                }

                .custom-checkbox:checked {
                    background: var(--accent);
                    border-color: var(--accent);
                }

                .custom-checkbox:checked::after {
                    content: '';
                    position: absolute;
                    left: 5px;
                    top: 2px;
                    width: 5px;
                    height: 10px;
                    border: solid var(--bg-primary);
                    border-width: 0 2px 2px 0;
                    transform: rotate(45deg);
                }

                .modal-overlay {
                    backdrop-filter: blur(4px);
                    transition: opacity 0.3s ease;
                    display: none;
                    position: fixed;
                    inset: 0;
                    z-index: 200;
                    align-items: center;
                    justify-content: center;
                    padding: 1rem;
                    background: rgba(0, 0, 0, 0.8);
                }

                .modal-overlay.active {
                    display: flex;
                }
            </style>
            <!-- Toolbar -->
            <div class="p-4 border-b border-[var(--border)]">
                <div class="grid grid-cols-10 lg:flex lg:items-center gap-3">

                    <!-- Search (70% mobile) -->
                    <div class="col-span-7 lg:flex-1 relative">
                        <input type="search" id="searchInputTable" placeholder="Search by name..." class="input-field w-full">
                    </div>

                    <!-- Export (30% mobile) -->
                    <div class="col-span-3 lg:order-last">
                        <button class="btn-ghost w-full py-3 px-1 text-sm sm:text-xs lg:px-4 lg:w-auto">Export CSV</button>
                    </div>

                    <!-- Role Select (50% mobile) -->
                    <div class="col-span-5 lg:w-44">
                        <div class="relative group">
                            <select class="peer appearance-none input-field pr-10 cursor-pointer">
                                <option>All Roles</option>
                                <option>Admin</option>
                                <option>Editor</option>
                                <option>Subscriber</option>
                            </select>
                            <span
                                class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[var(--fg-muted)] transition-transform duration-300 peer-focus:-rotate-180">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Status Select (50% mobile) -->
                    <div class="col-span-5 lg:w-44">
                        <div class="relative group">
                            <select class="peer appearance-none input-field pr-10 cursor-pointer">
                                <option>All Status</option>
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Pending</option>
                            </select>
                            <span
                                class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[var(--fg-muted)] transition-transform duration-300 peer-focus:-rotate-180">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[var(--bg-secondary)] text-[var(--fg-secondary)] text-sm border-b border-[var(--border)]">
                        <tr>
                            <th class="p-4 w-12"><input type="checkbox" class="custom-checkbox"></th>
                            <th class="p-4 font-medium">User Details</th>
                            <th class="p-4 font-medium">Role</th>
                            <th class="p-4 font-medium">Status</th>
                            <th class="p-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-[var(--border)] flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-[var(--fg-secondary)]">Showing 1-10 of 2,481 users</p>
                <div class="flex items-center gap-1">
                    <button class="btn-ghost px-3 py-1 text-sm disabled:opacity-50" disabled="">← Prev</button>
                    <button
                        class="bg-[var(--accent)] text-[var(--bg-primary)] px-3 py-1 rounded-md text-sm font-medium">1</button>
                    <button class="hover:bg-[var(--bg-elevated)] px-3 py-1 rounded-md text-sm">2</button>
                    <button class="hover:bg-[var(--bg-elevated)] px-3 py-1 rounded-md text-sm">3</button>
                    <span class="px-2 text-[var(--fg-muted)]">...</span>
                    <button class="hover:bg-[var(--bg-elevated)] px-3 py-1 rounded-md text-sm">249</button>
                    <button class="btn-ghost px-3 py-1 text-sm">Next →</button>
                </div>
            </div>


        </div>

    </main>
</x-app-layout>