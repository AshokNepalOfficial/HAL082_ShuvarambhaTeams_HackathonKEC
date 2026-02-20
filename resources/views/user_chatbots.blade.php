<x-app-layout>

    <!-- CHATBOT MANAGEMENT SECTION-->
    <main class="p-4 lg:p-6 view-section active" id="chatbot-management-view">

        <div class="mb-6 animate-in stagger-1">
            <!-- Main Container -->
            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-y-4 gap-x-4">
                <!-- 1. Header & Description -->
                <div class="order-1">
                    <h1 class="font-display text-2xl lg:text-3xl font-bold text-[var(--fg-primary)]">
                        Chatbots List
                    </h1>
                    <p class="hidden sm:block text-[var(--fg-secondary)] mt-1">
                        List of chatbot made by you.
                    </p>
                </div>

                <!-- 2. The Button -->
                <button type="button"
                    class="order-2 sm:order-3 btn-primary inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all hover:brightness-110 active:scale-95 whitespace-nowrap">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    <span>Add Chatbot</span>
                </button>

                <!-- 3. Selects Wrapper -->
                <div class="order-3 sm:order-2 w-full sm:w-auto sm:ml-auto flex items-center gap-3">

                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
            <div class="card lg:p-5 p-3 animate-in stagger-1">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Total Chatbots</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1" data-count="128459">128,459</p>
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

        <!-- Card Grid Section -->
        <div class="card overflow-hidden p-4 lg:p-6">
            <!-- Toolbar -->
            <div class="pb-4 mb-4 border-b border-[var(--border)]">
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

            <!-- Cards Grid Container -->
            <div id="userCardGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <!-- Cards will be injected here by JS -->
            </div>

            <!-- Pagination -->
            <div class="p-4 mt-4 border-t border-[var(--border)] flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-[var(--fg-secondary)]">Showing 1-10 of 2,481 users</p>
                <div class="flex items-center gap-1">
                    <button class="btn-ghost px-3 py-1 text-sm disabled:opacity-50" disabled>← Prev</button>
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

        <!-- VIEW MODAL -->
        <div class="modal-overlay" id="modalView">
            <div
                class="bg-[var(--bg-card)] border border-[var(--border)] w-full max-sm:max-w-xs max-w-sm rounded-xl overflow-hidden p-6 relative">
                <button class="absolute top-4 right-4 text-[var(--fg-muted)] hover:text-white text-2xl"
                    onclick="closeAllModals()">&times;</button>
                <div class="text-center mb-6">
                    <img id="viewAvatar" src="" class="w-20 h-20 rounded-full mx-auto bg-[var(--bg-secondary)] mb-4">
                    <h3 id="viewTitle" class="text-xl font-bold font-display"></h3>
                    <p id="viewSubTitle" class="text-[var(--fg-muted)]"></p>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-[var(--border)] text-sm"><span
                            class="text-[var(--fg-muted)]">Status</span><span id="viewStatus"></span></div>
                </div>
                <button class="btn-ghost w-full mt-6 p-2" onclick="closeAllModals()">Close Profile</button>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div class="modal-overlay" id="modalEdit">
            <div class="bg-[var(--bg-card)] border border-[var(--border)] w-full max-w-md rounded-xl p-6">
                <h3 class="text-xl font-bold font-display mb-4">Configure Chatbot</h3>
                <form id="editForm" class="space-y-4">
                    <input type="hidden" id="editUserId">
                    <div><label class="text-xs uppercase text-[var(--fg-muted)] font-bold">Title</label><input type="text"
                            id="editTitle" class="input-field mt-1" required></div>
                    <div><label class="text-xs uppercase text-[var(--fg-muted)] font-bold">Sub Title</label><input type="text"
                            id="editSubTitle" class="input-field mt-1" required></div>
                    <div class="grid grid-cols-1 gap-4">
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
                    <button id="confirmDelBtn" class="btn-danger w-full bg-[var(--danger)] text-white rounded-lg p-2 font-semibold hover:opacity-90">Delete Account</button>
                    <button class="btn-ghost w-full p-2" onclick="closeAllModals()">Cancel</button>
                </div>
            </div>
        </div>

        <script>
            let users = [{
                    id: 1,
                    title: "Chatbot1",
                    sub_title: "For ABC",
                    status: "Active",
                    avatar: "chatbot1"
                },
                {
                    id: 2,
                    title: "Chatbot2",
                    sub_title: "For Efg",
                    status: "Active",
                    avatar: "chatbot2"
                },
                {
                    id: 3,
                    title: "Chatbot3",
                    sub_title: "For ABCD",
                    status: "Pending",
                    avatar: "chatbot3"
                },
                {
                    id: 4,
                    title: "Chatbot4",
                    sub_title: "For Efg2",
                    status: "Inactive",
                    avatar: "chatbot4"
                },
                {
                    id: 5,
                    title: "Support Bot",
                    sub_title: "Customer Service",
                    status: "Active",
                    avatar: "support"
                },
                {
                    id: 6,
                    title: "Sales Bot",
                    sub_title: "Lead Gen",
                    status: "Active",
                    avatar: "sales"
                },
                {
                    id: 7,
                    title: "FAQ Bot",
                    sub_title: "Help Center",
                    status: "Inactive",
                    avatar: "faq"
                },
                {
                    id: 8,
                    title: "Booking Bot",
                    sub_title: "Reservations",
                    status: "Active",
                    avatar: "booking"
                }
            ];

            let deleteId = null;

            function renderCards(data) {
                const container = document.getElementById('userCardGrid');

                container.innerHTML = data.map(u => `
                  <div class="bg-[var(--bg-secondary)] border border-[var(--border)] rounded-xl p-4 flex flex-col gap-4 hover:border-[var(--accent)] transition-all cursor-pointer group">
                      <!-- Top Section: Avatar & Info -->
                      <div class="flex items-center gap-3">
                          <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=${u.avatar}" class="w-12 h-12 rounded-full bg-[var(--bg-card)] border border-[var(--border)]">
                          <div class="flex-1 min-w-0">
                              <p class="font-semibold text-[var(--fg-primary)] truncate">${u.title}</p>
                              <p class="text-xs text-[var(--fg-muted)] truncate">${u.sub_title}</p>
                          </div>
                      </div>
                      
                      <!-- Middle Section: Status -->
                      <div class="flex items-center justify-between">
                          <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md ${
                              u.status === 'Active' ? 'bg-emerald-500/10 text-emerald-400' : 
                              u.status === 'Pending' ? 'bg-yellow-500/10 text-yellow-400' : 
                              'bg-gray-500/10 text-gray-400'
                          }">${u.status}</span>
                          
                          <!-- Quick Actions (Visible on Hover) -->
                          <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                              <button onclick="openView(${u.id})" class="p-1.5 text-[var(--fg-muted)] hover:text-[var(--accent)] hover:bg-[var(--bg-elevated)] rounded-md transition-colors" title="View">
                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                              </button>
                              <button onclick="openEdit(${u.id})" class="p-1.5 text-[var(--fg-muted)] hover:text-[var(--info)] hover:bg-[var(--bg-elevated)] rounded-md transition-colors" title="Edit">
                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                              </button>
                              <button onclick="openDelete(${u.id})" class="p-1.5 text-[var(--fg-muted)] hover:text-[var(--danger)] hover:bg-[var(--bg-elevated)] rounded-md transition-colors" title="Delete">
                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                              </button>
                          </div>
                      </div>
                  </div>
              `).join('');
            }

            function closeAllModals() {
                document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
            }

            function openView(id) {
                const u = users.find(x => x.id === id);
                document.getElementById('viewAvatar').src = `https://api.dicebear.com/7.x/avataaars/svg?seed=${u.avatar}`;
                document.getElementById('viewTitle').innerText = u.title;
                document.getElementById('viewSubTitle').innerText = u.sub_title;
                document.getElementById('viewStatus').innerText = u.status;
                document.getElementById('modalView').classList.add('active');
            }

            function openEdit(id) {
                const u = users.find(x => x.id === id);
                document.getElementById('editUserId').value = u.id;
                document.getElementById('editTitle').value = u.title; // Fixed: was u.name
                document.getElementById('editSubTitle').value = u.sub_title;
                document.getElementById('editStatus').value = u.status;
                document.getElementById('modalEdit').classList.add('active');
            }

            function openDelete(id) {
                const u = users.find(x => x.id === id);
                deleteId = id;
                document.getElementById('delUserName').innerText = u.title; // Fixed: was u.name
                document.getElementById('modalDelete').classList.add('active');
            }

            document.getElementById('editForm').onsubmit = (e) => {
                e.preventDefault();
                const id = parseInt(document.getElementById('editUserId').value);
                users = users.map(u => u.id === id ? {
                    ...u,
                    title: document.getElementById('editTitle').value,
                    sub_title: document.getElementById('editSubTitle').value,
                    status: document.getElementById('editStatus').value
                } : u);
                renderCards(users);
                closeAllModals();
            };

            document.getElementById('confirmDelBtn').onclick = () => {
                users = users.filter(u => u.id !== deleteId);
                renderCards(users);
                closeAllModals();
            };

            const tS = document.getElementById('searchInputTable');
            tS.oninput = (e) => {
                const val = e.target.value.toLowerCase();
                renderCards(users.filter(u => u.title.toLowerCase().includes(val)));
            };

            // Initial Render
            renderCards(users);
        </script>
    </main>
</x-app-layout>