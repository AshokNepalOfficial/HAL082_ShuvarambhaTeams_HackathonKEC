<x-app-layout>
    <!-- USER MANAGEMENT SECTION-->
    <main class="p-4 lg:p-6 view-section active" id="user-management-view">

        <div class="mb-6 animate-in stagger-1">
            <!-- Main Container: items-start helps align H1/P better on desktop -->
            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-y-4 gap-x-4">

                <!-- 1. Header & Description (Always Order 1) -->
                <div class="order-1">
                    <h1 class="font-display text-2xl lg:text-3xl font-bold text-[var(--fg-primary)]">
                        User Management
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




        <x-user-management-table :users="$users" />
    </main>
    <script>
        // Data
        const usersData = [{
                name: 'Sarah Chen',
                role: 'Admin',
                status: 'active'
            },
            {
                name: 'Mike Ross',
                role: 'Editor',
                status: 'active'
            },
        ];

        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const menuToggle = document.getElementById('menuToggle');
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const navItems = document.querySelectorAll('.nav-item');
        const toastContainer = document.getElementById('toastContainer');

        // Initialization
        function init() {
            setupEventListeners();
            animateCounters();
        }

        // Event Listeners
        function setupEventListeners() {
            // Mobile sidebar
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                sidebarOverlay.classList.toggle('open');
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
            });

            // Dropdowns
            notificationBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                notificationDropdown.classList.toggle('open');
                profileDropdown.classList.remove('open');
            });

            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('open');
                notificationDropdown.classList.remove('open');
            });

            document.addEventListener('click', () => {
                notificationDropdown.classList.remove('open');
                profileDropdown.classList.remove('open');
            });

            // Navigation & View Switching
            navItems.forEach(item => {
                item.addEventListener('click', () => {
                    const viewId = item.dataset.view;
                    if (!viewId) return;

                    // Update Nav Active State
                    navItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');

                    // Switch Views
                    document.querySelectorAll('.view-section').forEach(section => {
                        section.classList.remove('active');
                    });
                    const targetView = document.getElementById(viewId + '-view');
                    if (targetView) {
                        targetView.classList.add('active');
                        // Re-trigger animations if needed
                        const animElements = targetView.querySelectorAll('.animate-in');
                        animElements.forEach(el => {
                            el.style.animation = 'none';
                            el.offsetHeight; // trigger reflow
                            el.style.animation = null;
                        });
                    }

                    // Close Mobile Sidebar
                    sidebar.classList.remove('open');
                    sidebarOverlay.classList.remove('open');

                    showToast(`Navigated to ${viewId.charAt(0).toUpperCase() + viewId.slice(1)}`, 'info');
                });
            });
        }

        // Animations
        function animateCounters() {
            const counters = document.querySelectorAll('[data-count]');
            counters.forEach(counter => {
                const target = parseInt(counter.dataset.count);
                const duration = 2000;
                const start = performance.now();

                function update(currentTime) {
                    const elapsed = currentTime - start;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 4);
                    counter.textContent = Math.floor(target * eased).toLocaleString();
                    if (progress < 1) requestAnimationFrame(update);
                }
                requestAnimationFrame(update);
            });
        }

        // Toast
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            const colors = {
                success: 'var(--accent)',
                error: 'var(--danger)',
                warning: 'var(--warning)',
                info: 'var(--info)'
            };
            toast.className = 'card-elevated p-4 flex items-center gap-3 min-w-72';
            toast.style.animation = 'fadeSlideUp 0.3s ease-out';
            toast.innerHTML = `
        <div class="w-2 h-2 rounded-full" style="background: ${colors[type]}"></div>
        <p class="text-sm">${message}</p>
      `;
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', init);
    </script>
</x-app-layout>