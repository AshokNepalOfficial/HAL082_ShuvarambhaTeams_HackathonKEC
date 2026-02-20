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



            <!-- VIEW MODAL -->
            <div class="modal-overlay" id="modalView">
                <div
                    class="bg-[var(--bg-card)] border border-[var(--border)] w-full max-sm:max-w-xs max-w-sm rounded-xl overflow-hidden p-6 relative">
                    <button class="absolute top-4 right-4 text-[var(--fg-muted)] hover:text-white text-2xl"
                        onclick="closeAllModals()">&times;</button>
                    <div class="text-center mb-6">
                        <img id="viewAvatar" src="" class="w-20 h-20 rounded-full mx-auto bg-[var(--bg-secondary)] mb-4">
                        <h3 id="viewName" class="text-xl font-bold font-display"></h3>
                        <p id="viewEmail" class="text-[var(--fg-muted)]"></p>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-[var(--border)] text-sm"><span
                                class="text-[var(--fg-muted)]">Role</span><span id="viewRole"></span></div>
                        <div class="flex justify-between py-2 border-b border-[var(--border)] text-sm"><span
                                class="text-[var(--fg-muted)]">Status</span><span id="viewStatus"></span></div>
                    </div>
                    <button class="btn-ghost w-full mt-6 p-2" onclick="closeAllModals()">Close Profile</button>
                </div>
            </div>

            <!-- EDIT MODAL -->
            <div class="modal-overlay" id="modalEdit">
                <div class="bg-[var(--bg-card)] border border-[var(--border)] w-full max-w-md rounded-xl p-6">
                    <h3 class="text-xl font-bold font-display mb-4">Update User Info</h3>
                    <form id="editForm" class="space-y-4">
                        <input type="hidden" id="editUserId">
                        <div><label class="text-xs uppercase text-[var(--fg-muted)] font-bold">Name</label><input type="text"
                                id="editName" class="input-field mt-1" required></div>
                        <div><label class="text-xs uppercase text-[var(--fg-muted)] font-bold">Email</label><input type="email"
                                id="editEmail" class="input-field mt-1" required></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="text-xs uppercase text-[var(--fg-muted)] font-bold">Role</label>
                                <select id="editRole" class="input-field mt-1">
                                    <option>Admin</option>
                                    <option>Editor</option>
                                    <option>Subscriber</option>
                                </select>
                            </div>
                            <div><label class="text-xs uppercase text-[var(--fg-muted)] font-bold">Status</label>
                                <select id="editStatus" class="input-field mt-1">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                    <option>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="button" class="btn-ghost flex-1 p-2" onclick="closeAllModals()">Cancel</button>
                            <button type="submit" class="btn-primary flex-1">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- DELETE MODAL -->
            <div class="modal-overlay" id="modalDelete">
                <div class="bg-[var(--bg-card)] border border-[var(--border)] w-full max-w-xs rounded-xl p-6 text-center">
                    <div class="w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Delete User?</h3>
                    <p class="text-sm text-[var(--fg-muted)] mb-6">Remove <span id="delUserName" class="text-white font-bold"></span>?
                    </p>
                    <div class="space-y-2">
                        <button id="confirmDelBtn" class="btn-danger w-full">Delete Account</button>
                        <button class="btn-ghost w-full p-2" onclick="closeAllModals()">Cancel</button>
                    </div>
                </div>
            </div>


            <script>
                let users = [{
                        id: 1,
                        name: "Sarah Chen",
                        email: "sarah@example.com",
                        role: "Admin",
                        status: "Active",
                        avatar: "sarah"
                    },
                    {
                        id: 2,
                        name: "Marcus Johnson",
                        email: "marcus@example.com",
                        role: "Editor",
                        status: "Active",
                        avatar: "marcus"
                    },
                    {
                        id: 3,
                        name: "Elena Rodriguez",
                        email: "elena@example.com",
                        role: "Subscriber",
                        status: "Pending",
                        avatar: "elena"
                    },
                    {
                        id: 4,
                        name: "James Wilson",
                        email: "james@example.com",
                        role: "Editor",
                        status: "Inactive",
                        avatar: "james"
                    }
                ];

                let deleteId = null;

                function renderTable(data) {
                    const body = document.getElementById('userTableBody');

                    body.innerHTML = data.map(u => `
                  <tr class="table-row border-b border-[var(--border)] last:border-0">
                      <td class="p-4"><input type="checkbox" class="custom-checkbox"></td>
                      <td class="p-4">
                          <div class="flex items-center gap-3">
                              <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=${u.avatar}" class="w-9 h-9 rounded-full bg-[var(--bg-secondary)]">
                              <div><p class="text-sm font-medium">${u.name}</p><p class="text-xs text-[var(--fg-muted)]">${u.email}</p></div>
                          </div>
                      </td>
                      <td class="p-4 text-sm">${u.role}</td>
                      <td class="p-4"><span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md ${
                          u.status === 'Active' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-gray-500/10 text-gray-400'
                      }">${u.status}</span></td>
                      <td class="p-4 text-right space-x-1">
                          <button onclick="openView(${u.id})" class="p-2 text-[var(--fg-muted)] hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                          <button onclick="openEdit(${u.id})" class="p-2 text-[var(--accent)] hover:bg-[var(--accent)]/10 rounded-md transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                          <button onclick="openDelete(${u.id})" class="p-2 text-red-500 hover:bg-red-500/10 rounded-md transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                      </td>
                  </tr>
              `).join('');
                }

                function closeAllModals() {
                    document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
                }

                function openView(id) {
                    const u = users.find(x => x.id === id);
                    document.getElementById('viewAvatar').src = `https://api.dicebear.com/7.x/avataaars/svg?seed=${u.avatar}`;
                    document.getElementById('viewName').innerText = u.name;
                    document.getElementById('viewEmail').innerText = u.email;
                    document.getElementById('viewRole').innerText = u.role;
                    document.getElementById('viewStatus').innerText = u.status;
                    document.getElementById('modalView').classList.add('active');
                }

                function openEdit(id) {
                    const u = users.find(x => x.id === id);
                    document.getElementById('editUserId').value = u.id;
                    document.getElementById('editName').value = u.name;
                    document.getElementById('editEmail').value = u.email;
                    document.getElementById('editRole').value = u.role;
                    document.getElementById('editStatus').value = u.status;
                    document.getElementById('modalEdit').classList.add('active');
                }

                function openDelete(id) {
                    const u = users.find(x => x.id === id);
                    deleteId = id;
                    document.getElementById('delUserName').innerText = u.name;
                    document.getElementById('modalDelete').classList.add('active');
                }

                document.getElementById('editForm').onsubmit = (e) => {
                    e.preventDefault();
                    const id = parseInt(document.getElementById('editUserId').value);
                    users = users.map(u => u.id === id ? {
                        ...u,
                        name: document.getElementById('editName').value,
                        email: document.getElementById('editEmail').value,
                        role: document.getElementById('editRole').value,
                        status: document.getElementById('editStatus').value
                    } : u);
                    renderTable(users);
                    closeAllModals();
                };

                document.getElementById('confirmDelBtn').onclick = () => {
                    users = users.filter(u => u.id !== deleteId);
                    renderTable(users);
                    closeAllModals();
                };
                const tS = document.getElementById('searchInputTable');
                [tS].forEach(el => el.oninput = (e) => {
                    const val = e.target.value.toLowerCase();
                    tS.value = e.target.value;
                    renderTable(users.filter(u => u.name.toLowerCase().includes(val)));
                });

                renderTable(users);
            </script>


        </div>

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