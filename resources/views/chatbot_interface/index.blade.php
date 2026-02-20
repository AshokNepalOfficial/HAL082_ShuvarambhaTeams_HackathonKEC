<x-app-layout>
    <!-- CSS Variables for consistent theming (Assumed to be in your main CSS or layout) -->
    <style>
        :root {
            --accent: #00d4aa;
            --bg-secondary: #111827;
            --bg-primary: #0a0f1a;
            --bg-elevated: #1f2937;
            --border: #374151;
            --fg-primary: #f9fafb;
            --fg-secondary: #d1d5db;
            --fg-muted: #9ca3af;
        }
    </style>

    <main class="flex flex-col h-[calc(100vh-64px)] overflow-hidden bg-[var(--bg-primary)]">
        <!-- Main Chat Layout -->
        <div class="flex flex-1 overflow-hidden relative">
            
            <!-- LEFT SIDEBAR: CONVERSATION HISTORY -->
            <aside id="chatSidebar" class="absolute inset-y-0 left-0 z-40 w-80 lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-300 ease-in-out bg-[var(--bg-secondary)] border-r border-[var(--border)] flex flex-col">
                
                <!-- Sidebar Header -->
                <div class="p-4 border-b border-[var(--border)] flex items-center justify-between">
                    <h2 class="font-display font-bold text-lg text-[var(--fg-primary)]">Chat History</h2>
                    <button onclick="createNewChat()" class="p-2 rounded-lg bg-[var(--bg-elevated)] text-[var(--accent)] hover:bg-[var(--accent)] hover:text-[var(--bg-primary)] transition-all" title="New Chat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

                <!-- List of Previous Conversations -->
                <div class="flex-1 overflow-y-auto p-2 space-y-1" id="conversationList">
                    <!-- Loaded via JavaScript -->
                    <div class="p-4 text-center text-[var(--fg-muted)] text-sm italic">Loading history...</div>
                </div>

                <!-- Sidebar Footer: Bot Info -->
                <div class="p-4 border-t border-[var(--border)]">
                    <div class="flex items-center gap-3 p-2 bg-[var(--bg-primary)] rounded-lg border border-[var(--border)]">
                        <div class="w-10 h-10 rounded-full bg-[var(--accent)] flex items-center justify-center text-[var(--bg-primary)] font-bold text-sm">
                            {{ strtoupper(substr($chatbot->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-[var(--fg-primary)] truncate">{{ $chatbot->name }}</p>
                            <p class="text-[10px] text-[var(--accent)] flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                                System Online
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- RIGHT SIDE: ACTIVE CHAT -->
            <section class="flex-1 flex flex-col bg-[var(--bg-primary)] relative min-w-0">
                
                <!-- Chat Header -->
                <header class="h-16 border-b border-[var(--border)] bg-[var(--bg-secondary)]/50 flex items-center justify-between px-4 lg:px-6">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleChatSidebar()" class="lg:hidden p-2 -ml-2 text-[var(--fg-secondary)] hover:text-[var(--accent)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div>
                            <h3 id="activeChatTitle" class="font-bold text-[var(--fg-primary)] text-sm lg:text-base">Select a conversation</h3>
                            <p class="text-[10px] text-[var(--fg-muted)]">Chatting with {{ $chatbot->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[var(--fg-muted)] hover:text-red-400 transition-colors" title="Delete Conversation">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </header>

                <!-- Messages Area -->
                <div id="chatMessages" class="flex-1 overflow-y-auto p-4 lg:p-6 space-y-6 scroll-smooth">
                    <!-- Default Welcome when no chat is selected -->
                    <div id="noChatSelected" class="h-full flex flex-col items-center justify-center text-center p-6">
                        <div class="w-16 h-16 bg-[var(--bg-elevated)] rounded-full flex items-center justify-center mb-4 text-[var(--accent)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <h4 class="text-[var(--fg-primary)] font-bold">Your Assistant is Ready</h4>
                        <p class="text-[var(--fg-muted)] text-sm max-w-xs mt-2">Select a conversation from the sidebar or start a new one to begin.</p>
                    </div>
                </div>

                <!-- Chat Input Area -->
                <div id="inputArea" class="hidden p-4 lg:p-6 border-t border-[var(--border)] bg-[var(--bg-secondary)]/30 backdrop-blur-sm">
                    <div class="max-w-4xl mx-auto relative flex items-end gap-2">
                        <div class="flex-1 relative">
                            <textarea 
                                id="messageInput"
                                rows="1" 
                                placeholder="Message {{ $chatbot->name }}..." 
                                class="w-full bg-[var(--bg-secondary)] border border-[var(--border)] text-[var(--fg-primary)] rounded-2xl py-3 pl-4 pr-12 focus:outline-none focus:border-[var(--accent)] focus:ring-1 focus:ring-[var(--accent)] transition-all resize-none overflow-hidden"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"
                            ></textarea>
                            <button id="sendBtn" onclick="sendMessage()" class="absolute right-2 bottom-2 p-2 bg-[var(--accent)] text-[var(--bg-primary)] rounded-xl hover:scale-105 active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Overlay for Mobile -->
            <div id="sidebarMobileOverlay" onclick="toggleChatSidebar()" class="fixed inset-0 bg-black/60 z-30 hidden lg:hidden transition-opacity"></div>
        </div>
    </main>

    <script>
        // --- GLOBAL CONFIG ---
        const CHATBOT_ID = {{ $chatbot->id }};
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let activeConversationId = null;

        // URL Helper
        const botUrl = (path) => `/chatbots/${CHATBOT_ID}${path}`;

        // Initial Load
        document.addEventListener('DOMContentLoaded', () => {
            loadConversations();
        });

        // 1. Load Conversation History
        async function loadConversations() {
            try {
                const response = await fetch(botUrl('/conversations'));
                const conversations = await response.json();
                const list = document.getElementById('conversationList');
                
                if (conversations.length === 0) {
                    list.innerHTML = `<p class="p-4 text-center text-[var(--fg-muted)] text-xs">No conversations found.</p>`;
                    return;
                }

                list.innerHTML = '';
                conversations.forEach(conv => {
                    const lastMsg = conv.messages[0]?.message || 'New Chat';
                    const time = new Date(conv.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    
                    const item = `
                        <div onclick="selectConversation(${conv.id})" 
                             class="conv-item p-3 rounded-xl cursor-pointer transition-all hover:bg-[var(--bg-elevated)] ${activeConversationId == conv.id ? 'bg-[var(--bg-elevated)] border-l-4 border-[var(--accent)]' : ''}" 
                             data-id="${conv.id}">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-sm font-semibold text-[var(--fg-primary)] truncate">Conversation #${conv.id}</h3>
                                <span class="text-[10px] text-[var(--fg-muted)] shrink-0">${time}</span>
                            </div>
                            <p class="text-xs text-[var(--fg-muted)] truncate">${lastMsg}</p>
                        </div>
                    `;
                    list.insertAdjacentHTML('beforeend', item);
                });
            } catch (err) {
                console.error("History load error:", err);
            }
        }

        // 2. Select and Load Messages
        async function selectConversation(id) {
            activeConversationId = id;
            
            // UI State
            document.querySelectorAll('.conv-item').forEach(el => el.classList.remove('bg-[var(--bg-elevated)]', 'border-l-4', 'border-[var(--accent)]'));
            const activeEl = document.querySelector(`[data-id="${id}"]`);
            if (activeEl) activeEl.classList.add('bg-[var(--bg-elevated)]', 'border-l-4', 'border-[var(--accent)]');

            document.getElementById('activeChatTitle').innerText = `Conversation #${id}`;
            document.getElementById('inputArea').classList.remove('hidden');
            document.getElementById('noChatSelected')?.classList.add('hidden');

            const container = document.getElementById('chatMessages');
            container.innerHTML = `<div class="flex justify-center py-10"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[var(--accent)]"></div></div>`;

            try {
                const response = await fetch(botUrl(`/conversations/${id}/messages`));
                const messages = await response.json();
                
                container.innerHTML = '';
                if (messages.length === 0) {
                    appendMessageUI('assistant', "Hello! How can I help you in this new chat?");
                } else {
                    messages.forEach(msg => appendMessageUI(msg.sender, msg.message, msg.created_at));
                }
                container.scrollTop = container.scrollHeight;
                
                if (window.innerWidth < 1024) toggleChatSidebar(); // Close sidebar on mobile
            } catch (err) {
                container.innerHTML = `<p class="text-center text-red-400 p-4">Error loading messages.</p>`;
            }
        }

        // 3. Create New Conversation
        async function createNewChat() {
            try {
                const response = await fetch(botUrl('/conversations'), {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
                });
                const newConv = await response.json();
                await loadConversations();
                selectConversation(newConv.id);
            } catch (err) {
                console.error("Create chat error:", err);
            }
        }

        // 4. Send Message
        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const btn = document.getElementById('sendBtn');
            const text = input.value.trim();
            
            if (!text || !activeConversationId) return;

            // UI feedback
            appendMessageUI('user', text, new Date());
            input.value = '';
            input.style.height = '';
            showTypingIndicator();

            try {
                const response = await fetch(botUrl(`/conversations/${activeConversationId}/messages`), {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                    body: JSON.stringify({ message: text })
                });
                
                const data = await response.json();
                removeTypingIndicator();
                appendMessageUI('assistant', data.ai_message.message, data.ai_message.created_at);
                loadConversations(); // Update preview in sidebar
            } catch (err) {
                removeTypingIndicator();
                console.error("Send error:", err);
            }
        }

        // --- UI HELPERS ---

        function appendMessageUI(sender, text, timestamp) {
            const container = document.getElementById('chatMessages');
            const time = timestamp ? new Date(timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : 'Just now';
            const isUser = sender === 'user';

            const html = `
                <div class="flex ${isUser ? 'flex-row-reverse' : ''} items-start gap-3 max-w-[85%] lg:max-w-[75%] ${isUser ? 'ml-auto' : ''}">
                    <div class="w-8 h-8 rounded-full ${isUser ? 'bg-[var(--accent)] text-[var(--bg-primary)]' : 'bg-[var(--bg-elevated)] text-[var(--accent)]'} border border-[var(--border)] flex items-center justify-center shrink-0 text-xs font-bold">
                        ${isUser ? 'ME' : 'AI'}
                    </div>
                    <div class="${isUser ? 'bg-[var(--accent)] text-[var(--bg-primary)] rounded-tr-none' : 'bg-[var(--bg-elevated)] text-[var(--fg-primary)] rounded-tl-none'} p-4 rounded-2xl border border-[var(--border)] shadow-sm text-sm">
                        ${text.replace(/</g, "&lt;").replace(/>/g, "&gt;")}
                        <div class="mt-2 text-[10px] opacity-70 ${isUser ? 'text-right' : ''}">${time}</div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            container.scrollTop = container.scrollHeight;
        }

        function showTypingIndicator() {
            const html = `
                <div id="typingIndicator" class="flex items-start gap-3 max-w-[85%] lg:max-w-[75%]">
                    <div class="w-8 h-8 rounded-full bg-[var(--bg-elevated)] text-[var(--accent)] border border-[var(--border)] flex items-center justify-center shrink-0 text-xs font-bold">AI</div>
                    <div class="bg-[var(--bg-elevated)] p-4 rounded-2xl rounded-tl-none border border-[var(--border)]">
                        <div class="flex gap-1">
                            <div class="w-1.5 h-1.5 bg-[var(--accent)] rounded-full animate-bounce"></div>
                            <div class="w-1.5 h-1.5 bg-[var(--accent)] rounded-full animate-bounce [animation-delay:0.2s]"></div>
                            <div class="w-1.5 h-1.5 bg-[var(--accent)] rounded-full animate-bounce [animation-delay:0.4s]"></div>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('chatMessages').insertAdjacentHTML('beforeend', html);
            document.getElementById('chatMessages').scrollTop = document.getElementById('chatMessages').scrollHeight;
        }

        function removeTypingIndicator() {
            document.getElementById('typingIndicator')?.remove();
        }

        function toggleChatSidebar() {
            const sidebar = document.getElementById('chatSidebar');
            const overlay = document.getElementById('sidebarMobileOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        document.getElementById('messageInput')?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>
</x-app-layout>