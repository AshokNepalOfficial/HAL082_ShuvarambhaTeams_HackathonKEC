<x-app-layout>
    <!-- USER MANAGEMENT SECTION-->
    <main class="p-4 lg:p-6 view-section active" id="user-management-view">

        <div class="mb-6 animate-in stagger-1">
            <!-- Main Container: items-start helps align H1/P better on desktop -->
            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-y-4 gap-x-4">

                <!-- 1. Header & Description (Always Order 1) -->
                <div class="order-1">
                    <h1 class="font-display text-2xl lg:text-3xl font-bold text-[var(--fg-primary)]">
                        File Manager
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
                    <div class="col-span-7 lg:flex-1 relative relative w-full">
                        <a href="{{ route('file-manager.index') }}" class="hover:underline font-semibold">Root</a>
                        @if($currentFolder)
                        <span class="text-white-400">/</span>
                        <span class="text-sm font-medium">{{ $currentFolder->name }}</span>
                        @endif
                    </div>



                    <div id="selectionBar" class="flex items-center space-x-2 pl-4 border-l border-[var(--border)] hidden">
                        <span class="text-xs font-medium text-[var(--fg-secondary)]">
                            <span id="selectedCount">0</span> items selected
                            <span id="excludedCount" class="text-[var(--warning)]" style="display:none;">(0 excluded)</span>
                        </span>

                        <div class="h-4 w-px bg-[var(--border)] mx-2"></div>

                        <button id="openChatbotModal" class="bg-[var(--accent)] hover:bg-[var(--accent-dim)] text-[var(--fg-primary)] px-4 py-1.5 rounded-full text-xs font-bold shadow-lg shadow-[var(--accent-glow)] flex items-center">
                            <i class="fa-solid fa-robot mr-2"></i> Create Chatbot
                        </button>

                        <button class="bg-[var(--bg-primary)] border border-[var(--border)] hover:border-[var(--accent)] hover:text-[var(--accent)] text-[var(--fg-primary)] px-3 py-1.5 rounded-full text-xs font-bold flex items-center transition">
                            <i class="fa-solid fa-sliders mr-2"></i> Bulk Vector Settings
                        </button>

                        <button id="clearSelection" class="p-2 text-[var(--fg-muted)] hover:text-[var(--danger)]" title="Clear Selection">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                    <div class="relative group">

                        <select id="attachSelect" class="peer appearance-none input-field pr-10 cursor-pointer">
                            <option value="">Attach</option>
                            <option value="file">File</option>
                            <option value="folder">Folder</option>
                        </select>
                        <span
                            class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[var(--fg-muted)] transition-transform duration-300 peer-focus:-rotate-180">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </div>


                    <!-- Export (30% mobile) -->
                    <div class="col-span-3 lg:order-last">
                        @if($parentId)
                        <a href="{{ route('file-manager.index', ['folder_id' => $currentFolder->parent_id]) }}"
                            class="btn-ghost w-full py-3 px-1 text-sm sm:text-xs lg:px-4 lg:w-auto">
                            ← Back
                        </a>
                        @endif
                    </div>

                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[var(--bg-secondary)] text-[var(--fg-secondary)] text-sm border-b border-[var(--border)]">
                        <tr>
                            <th class="p-4 w-12"><input type="checkbox" class="custom-checkbox"></th>
                            <th class="p-4 font-medium">Name</th>
                            <th class="p-4 font-medium">Type</th>
                            <th class="p-4 font-medium">Details</th>
                            <th class="p-4 font-medium">Updated</th>
                            <th class="p-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @forelse($items as $item)

                        <tr data-id="{{ $item->id }}" class="table-row border-b border-[var(--border)] last:border-0">
                            <td class="p-4"><input type="checkbox" class="custom-checkbox"></td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">

                                    @if($item->display_type === 'folder')
                                    <!-- Folder Icon -->
                                    <svg class="w-9 h-9 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium">
                                            <a href="{{ route('file-manager.index', ['folder_id' => $item->id]) }}">
                                                {{ $item->display_name }}
                                            </a>
                                        </p>
                                    </div>


                                    @else
                                    <!-- File Icon -->
                                    <svg class="w-9 h-9 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium">{{ $item->display_name }}</p>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4"><span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-400"> {{ ucfirst($item->display_type) }}</span></td>
                            <td class="p-4">


                                @if($item->display_type === 'folder')
                                <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-400">
                                    {{ $item->items_count }} items
                                </span>
                                @else
                                <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-400">
                                    {{ $item->vectorstore_quality_id ?? 'No Quality Set' }}
                                </span>
                                @endif
                            </td>
                            <td class="p-4">
                                <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-400">
                                    {{ $item->updated_at->diffForHumans() }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-1">
                                <button onclick="openView({{$item->id}})" class="p-2 text-[var(--fg-muted)] hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg></button>
                                <button onclick="openEdit({{$item->id}})" class="p-2 text-[var(--accent)] hover:bg-[var(--accent)]/10 rounded-md transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg></button>
                                <button onclick="openDelete({{$item->id}})" class="p-2 text-red-500 hover:bg-red-500/10 rounded-md transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                This folder is empty.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>



            <!-- Footer / Pagination -->
            {{ $items->links('vendor.pagination.custom') }}

        </div>






<!-- Chatbot Modal (Initially Hidden) -->
<div id="chatbotModal" class="fixed inset-0 flex items-center justify-center bg-black/50 z-50 hidden">
    <div class="bg-[var(--bg-card)] p-6 rounded-lg w-96">
        <h3 class="text-[var(--fg-primary)] font-bold mb-4">Create Chatbot</h3>
        <form id="chatbotForm">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            
            <label class="block text-[var(--fg-secondary)] text-sm mb-1">Chatbot Name</label>
            <input type="text" name="name" required
                class="w-full p-2 rounded-md text-[var(--fg-primary)] bg-[var(--bg-secondary)] border border-[var(--border)] mb-4">

            <div class="flex justify-end space-x-2">
                <button type="button" id="closeChatbotModal" class="px-4 py-2 rounded bg-[var(--border)] text-[var(--fg-primary)] hover:bg-[var(--bg-elevated)]">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-[var(--accent)] text-[var(--fg-primary)] hover:bg-[var(--accent-dim)]">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- 4️⃣ FINAL SCRIPT -->
<script>
    // Track selected items
    const selected = { files: [], folders: [] };

    const selectionBar = document.getElementById('selectionBar');
    const selectedCountEl = document.getElementById('selectedCount');
    const clearBtn = document.getElementById('clearSelection');

    const checkboxes = document.querySelectorAll('#userTableBody .custom-checkbox');
    const topCheckbox = document.querySelector('thead .custom-checkbox');

    function updateSelection() {
        selected.files = [];
        selected.folders = [];

        let folderSelectedCount = 0;
        let totalSelected = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const tr = cb.closest('tr');
                const type = tr.querySelector('td:nth-child(3) span').textContent.trim().toLowerCase();
                const id = tr.dataset.id;

                if (type === 'folder') {
                    selected.folders.push(id);
                    folderSelectedCount++;
                } else {
                    selected.files.push(id);
                }
                totalSelected++;
            }
        });

        // Show action bar only if at least one folder is selected
        selectionBar.classList.toggle('hidden', folderSelectedCount === 0);

        // Update total selected count
        selectedCountEl.textContent = totalSelected;
    }

    // Row checkboxes
    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            updateSelection();
            topCheckbox.checked = [...checkboxes].every(c => c.checked);
        });
    });

    // Top checkbox
    topCheckbox.addEventListener('change', () => {
        const checked = topCheckbox.checked;
        checkboxes.forEach(cb => cb.checked = checked);
        updateSelection();
    });

    // Clear selection
    clearBtn.addEventListener('click', () => {
        checkboxes.forEach(cb => cb.checked = false);
        topCheckbox.checked = false;
        updateSelection();
    });

    // Modal
    const chatbotModal = document.getElementById('chatbotModal');
    const openModalBtn = document.getElementById('openChatbotModal');
    const closeModalBtn = document.getElementById('closeChatbotModal');
    const chatbotForm = document.getElementById('chatbotForm');

    openModalBtn.addEventListener('click', () => chatbotModal.classList.remove('hidden'));
    closeModalBtn.addEventListener('click', () => chatbotModal.classList.add('hidden'));

    // Submit chatbot
    chatbotForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(chatbotForm);

        // Append selected files and folders as arrays
        selected.files.forEach(id => formData.append('files_id[]', id));
        selected.folders.forEach(id => formData.append('folder_id[]', id));

        try {
            const response = await fetch("{{ route('chatbots.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                alert('Chatbot created successfully!');
                chatbotModal.classList.add('hidden');
                chatbotForm.reset();
                checkboxes.forEach(cb => cb.checked = false);
                topCheckbox.checked = false;
                updateSelection();
            } else {
                console.error(data);
                alert('Error creating chatbot!');
            }
        } catch (err) {
            console.error(err);
            alert('Something went wrong!');
        }
    });
</script>
        <!-- Attach Modal -->
        <div id="attachModal" class="modal-overlay">

            <div class="card w-full max-w-md p-6 relative">

                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 id="modalTitle" class="font-display text-xl font-semibold">
                        Attach
                    </h2>

                    <button type="button"
                        onclick="closeModal()"
                        class="text-[var(--fg-muted)] hover:text-[var(--fg-primary)] transition">
                        ✕
                    </button>
                </div>

                <form id="attachForm" class="space-y-5">

                    <!-- FILE SECTION -->
                    <div id="fileSection" class="hidden space-y-4">

                        <!-- File -->
                        <div>
                            <label class="text-sm text-[var(--fg-secondary)] block mb-2">
                                Select File
                            </label>

                            <input type="file"
                                id="fileInput"
                                name="file"
                                class="input-field cursor-pointer" />
                        </div>

                        <!-- File Type -->
                        <div>
                            <label class="text-sm text-[var(--fg-secondary)] block mb-2">
                                File Type
                            </label>

                            <select id="filetype_id" class="input-field">
                                <option value="">Select Type</option>
                                @foreach($fileTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Vectorstore Quality -->
                        <div>
                            <label class="text-sm text-[var(--fg-secondary)] block mb-2">
                                Vectorstore Quality
                            </label>

                            <select id="vectorstore_quality_id" class="input-field">
                                <option value="">Select Quality</option>
                                @foreach($vectorQualities as $quality)
                                <option value="{{ $quality->id }}">
                                    {{ $quality->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Is Vectorized -->
                        <div>
                            <label class="text-sm text-[var(--fg-secondary)] block mb-2">
                                Vectorize File?
                            </label>

                            <select id="is_vectorized" class="input-field">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                    </div>

                    <!-- FOLDER SECTION -->
                    <div id="folderSection" class="hidden">
                        <label class="text-sm text-[var(--fg-secondary)] block mb-2">
                            Folder Name
                        </label>

                        <input type="text"
                            id="folderName"
                            name="name"
                            placeholder="Enter folder name..."
                            class="input-field" />
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button"
                            onclick="closeModal()"
                            class="btn-ghost">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn-primary">
                            Confirm
                        </button>
                    </div>

                </form>
            </div>
        </div>




        <script>
            const attachSelect = document.getElementById("attachSelect");
            const modal = document.getElementById("attachModal");
            const fileSection = document.getElementById("fileSection");
            const folderSection = document.getElementById("folderSection");
            const modalTitle = document.getElementById("modalTitle");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function getCurrentFolderId() {
                const params = new URLSearchParams(window.location.search);
                return params.get('folder_id');
            }

            attachSelect.addEventListener("change", function() {

                if (this.value === "file") {
                    openModal();
                    fileSection.classList.remove("hidden");
                    folderSection.classList.add("hidden");
                    modalTitle.innerText = "Upload File";
                }

                if (this.value === "folder") {
                    openModal();
                    folderSection.classList.remove("hidden");
                    fileSection.classList.add("hidden");
                    modalTitle.innerText = "Create Folder";
                }

                this.value = "";
            });

            function openModal() {
                modal.classList.add("active");
            }

            function closeModal() {
                modal.classList.remove("active");
                document.getElementById("attachForm").reset();
            }

            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener("keydown", function(e) {
                if (e.key === "Escape") {
                    closeModal();
                }
            });

            document.getElementById("attachForm").addEventListener("submit", async function(e) {
                e.preventDefault();

                const folderId = getCurrentFolderId();
                const isFileUpload = !fileSection.classList.contains("hidden");

                try {

                    // ======================
                    // FILE UPLOAD
                    // ======================
                    if (isFileUpload) {

                        if (!folderId) {
                            alert("Open a folder before uploading a file.");
                            return;
                        }

                        const fileInput = document.getElementById("fileInput");
                        const filetypeId = document.getElementById("filetype_id").value;
                        const vectorQualityId = document.getElementById("vectorstore_quality_id").value;
                        const isVectorized = document.getElementById("is_vectorized").value;

                        if (!fileInput.files.length) {
                            alert("Please select a file.");
                            return;
                        }

                        if (!filetypeId || !vectorQualityId) {
                            alert("Please select all required options.");
                            return;
                        }

                        const formData = new FormData();
                        formData.append("file", fileInput.files[0]);
                        formData.append("filetype_id", filetypeId);
                        formData.append("vectorstore_quality_id", vectorQualityId);
                        formData.append("is_vectorized", isVectorized);

                        const response = await fetch(`/folders/${folderId}/files`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: formData
                        });

                        if (!response.ok) throw new Error("Upload failed");
                    }

                    // ======================
                    // CREATE FOLDER
                    // ======================
                    else {

                        const name = document.getElementById("folderName").value.trim();

                        if (!name) {
                            alert("Folder name is required.");
                            return;
                        }

                        const formData = new FormData();
                        formData.append("name", name);

                        if (folderId) {
                            formData.append("parent_id", folderId);
                        }

                        const response = await fetch(`/folders`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: formData
                        });

                        if (!response.ok) throw new Error("Folder creation failed");
                    }

                    closeModal();
                    location.reload();

                } catch (error) {
                    console.error(error);
                    alert("Something went wrong.");
                }
            });
        </script>
    </main>
</x-app-layout>