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

        @php
        // Prepare counts
        $totalChatbots = $chatbots->count();
        $activeChatbots = $chatbots->where('status', 'active')->count();
        $pendingChatbots = $chatbots->where('status', 'pending')->count();
        $draftChatbots = $chatbots->where('status', 'draft')->count(); // optional if needed
        @endphp

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
            <!-- Total Chatbots -->
            <div class="card lg:p-5 p-3 animate-in stagger-1">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Total Chatbots</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1">{{ number_format($totalChatbots) }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[var(--accent)]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[var(--accent)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 010 7.75"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Chatbots -->
            <div class="card lg:p-5 p-3 animate-in stagger-2">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Active</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1">{{ $activeChatbots }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[var(--info)]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[var(--info)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Chatbots -->
            <div class="card lg:p-5 p-3 animate-in stagger-3">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Pending</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1">{{ $pendingChatbots }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[var(--warning)]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[var(--warning)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Draft Chatbots (Optional) -->
            <div class="card lg:p-5 p-3 animate-in stagger-4">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[var(--fg-secondary)] text-sm font-medium">Draft</p>
                        <p class="font-display text-2xl lg:text-3xl font-bold mt-1">{{ $draftChatbots }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                </div>
            </div>

            <!-- Cards Grid Container -->
            <div id="userCardGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <!-- Cards will be injected here by JS -->
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

            @php
            // Prepare frontend-ready array
            $chatbotsForJs = $chatbots->map(function($bot) {
            return [
            'id' => $bot->id,
            'title' => $bot->name,
            'sub_title' => $bot->description ?? 'No description',
            'status' => ucfirst($bot->status),
            'avatar' => $bot->name // or any unique seed
            ];
            });
            @endphp

            <script>
                let chatbots = @json($chatbotsForJs);

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
                          <div class="flex gap-1 transition-opacity">

                            <a href="/chatbots/${u.id}/interface" class="p-1.5 text-[var(--fg-muted)] hover:text-[var(--accent)] hover:bg-[var(--bg-elevated)] rounded-md transition-colors" title="View">                        
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 21H17M3 13H21M10 17L9 21M14 17L15 21M6.2 17H17.8C18.9201 17 19.4802 17 19.908 16.782C20.2843 16.5903 20.5903 16.2843 20.782 15.908C21 15.4802 21 14.9201 21 13.8V6.2C21 5.0799 21 4.51984 20.782 4.09202C20.5903 3.71569 20.2843 3.40973 19.908 3.21799C19.4802 3 18.9201 3 17.8 3H6.2C5.0799 3 4.51984 3 4.09202 3.21799C3.71569 3.40973 3.40973 3.71569 3.21799 4.09202C3 4.51984 3 5.07989 3 6.2V13.8C3 14.9201 3 15.4802 3.21799 15.908C3.40973 16.2843 3.71569 16.5903 4.09202 16.782C4.51984 17 5.07989 17 6.2 17Z"  fill="none" 
                                stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </a>

                            <a href="/chatbots/${u.id}/edit" class="p-1.5 text-[var(--fg-muted)] hover:text-[var(--accent)] hover:bg-[var(--bg-elevated)] rounded-md transition-colors" title="Setting">
                                  
                            <svg class="w-6 h-6" 
                                viewBox="0 0 24 24" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="2" 
                                stroke-linecap="round" 
                                stroke-linejoin="round">

                                <!-- Gear -->
                                <circle cx="12" cy="12" r="3"></circle>

                                <path d="M19.4 15
                                        a1.65 1.65 0 0 0 .33 1.82
                                        l.06.06
                                        a2 2 0 1 1-2.83 2.83
                                        l-.06-.06
                                        a1.65 1.65 0 0 0-1.82-.33
                                        1.65 1.65 0 0 0-1 1.51V21
                                        a2 2 0 1 1-4 0v-.09
                                        a1.65 1.65 0 0 0-1-1.51
                                        1.65 1.65 0 0 0-1.82.33
                                        l-.06.06
                                        a2 2 0 1 1-2.83-2.83
                                        l.06-.06
                                        a1.65 1.65 0 0 0 .33-1.82
                                        1.65 1.65 0 0 0-1.51-1H3
                                        a2 2 0 1 1 0-4h.09
                                        a1.65 1.65 0 0 0 1.51-1
                                        1.65 1.65 0 0 0-.33-1.82
                                        l-.06-.06
                                        a2 2 0 1 1 2.83-2.83
                                        l.06.06
                                        a1.65 1.65 0 0 0 1.82.33h0
                                        a1.65 1.65 0 0 0 1-1.51V3
                                        a2 2 0 1 1 4 0v.09
                                        a1.65 1.65 0 0 0 1 1.51
                                        1.65 1.65 0 0 0 1.82-.33
                                        l.06-.06
                                        a2 2 0 1 1 2.83 2.83
                                        l-.06.06
                                        a1.65 1.65 0 0 0-.33 1.82v0
                                        a1.65 1.65 0 0 0 1.51 1H21
                                        a2 2 0 1 1 0 4h-.09
                                        a1.65 1.65 0 0 0-1.51 1z">
                                </path>

                            </svg>
                              </a>


                          </div>
                      </div>
                  </div>
              `).join('');
                }

                function closeAllModals() {
                    document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
                }

                function openView(id) {
                    const u = chatbots.find(x => x.id === id);
                    document.getElementById('viewAvatar').src = `https://api.dicebear.com/7.x/avataaars/svg?seed=${u.avatar}`;
                    document.getElementById('viewTitle').innerText = u.title;
                    document.getElementById('viewSubTitle').innerText = u.sub_title;
                    document.getElementById('viewStatus').innerText = u.status;
                    document.getElementById('modalView').classList.add('active');
                }

                function openEdit(id) {
                    const u = chatbots.find(x => x.id === id);
                    document.getElementById('editUserId').value = u.id;
                    document.getElementById('editTitle').value = u.title; // Fixed: was u.name
                    document.getElementById('editSubTitle').value = u.sub_title;
                    document.getElementById('editStatus').value = u.status;
                    document.getElementById('modalEdit').classList.add('active');
                }

                function openDelete(id) {
                    const u = chatbots.find(x => x.id === id);
                    deleteId = id;
                    document.getElementById('delUserName').innerText = u.title; // Fixed: was u.name
                    document.getElementById('modalDelete').classList.add('active');
                }

                document.getElementById('editForm').onsubmit = (e) => {
                    e.preventDefault();
                    const id = parseInt(document.getElementById('editUserId').value);
                    chatbots = chatbots.map(u => u.id === id ? {
                        ...u,
                        title: document.getElementById('editTitle').value,
                        sub_title: document.getElementById('editSubTitle').value,
                        status: document.getElementById('editStatus').value
                    } : u);
                    renderCards(chatbots);
                    closeAllModals();
                };

                document.getElementById('confirmDelBtn').onclick = () => {
                    chatbots = chatbots.filter(u => u.id !== deleteId);
                    renderCards(chatbots);
                    closeAllModals();
                };

                const tS = document.getElementById('searchInputTable');
                tS.oninput = (e) => {
                    const val = e.target.value.toLowerCase();
                    renderCards(chatbots.filter(u => u.title.toLowerCase().includes(val)));
                };

                // Initial Render
                renderCards(chatbots);
            </script>
    </main>

</x-app-layout>