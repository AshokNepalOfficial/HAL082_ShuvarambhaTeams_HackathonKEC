<x-app-layout>
    <!-- Enhanced CSS with Syntax Highlighting & Mobile Optimizations -->
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
            --code-bg: #1e1e2e;
            --code-header: #181825;
        }

        /* Custom Scrollbar */
        #chatMessages::-webkit-scrollbar, #conversationList::-webkit-scrollbar { width: 6px; }
        #chatMessages::-webkit-scrollbar-track, #conversationList::-webkit-scrollbar-track { background: transparent; }
        #chatMessages::-webkit-scrollbar-thumb, #conversationList::-webkit-scrollbar-thumb { 
            background: var(--border); 
            border-radius: 10px; 
        }
        #chatMessages::-webkit-scrollbar-thumb:hover, #conversationList::-webkit-scrollbar-thumb:hover { 
            background: var(--fg-muted); 
        }

        /* Markdown Content Styling */
        .markdown-content { line-height: 1.6; }
        .markdown-content p { margin-bottom: 0.75rem; }
        .markdown-content p:last-child { margin-bottom: 0; }
        
        /* Code Blocks with Copy */
        .code-block-wrapper {
            position: relative;
            margin: 0.75rem 0;
            border-radius: 0.75rem;
            overflow: hidden;
            background: var(--code-bg);
            border: 1px solid var(--border);
        }
        .code-block-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            background: var(--code-header);
            border-bottom: 1px solid var(--border);
        }
        .code-language {
            font-size: 0.75rem;
            color: var(--accent);
            text-transform: uppercase;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
        }
        .copy-btn {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            color: var(--fg-secondary);
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .copy-btn:hover { 
            background: var(--accent); 
            color: var(--bg-primary);
            border-color: var(--accent);
        }
        .copy-btn.copied { 
            background: var(--accent); 
            color: var(--bg-primary);
            border-color: var(--accent);
        }
        
        .markdown-content pre {
            margin: 0;
            padding: 1rem;
            overflow-x: auto;
            background: var(--code-bg);
        }
        .markdown-content code {
            font-family: 'Fira Code', 'Consolas', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .markdown-content :not(pre) > code {
            background: rgba(0, 212, 170, 0.1);
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            color: var(--accent);
            font-size: 0.85em;
            border: 1px solid rgba(0, 212, 170, 0.2);
        }

        /* Tables with Copy */
        .table-wrapper {
            position: relative;
            margin: 0.75rem 0;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            overflow: hidden;
            background: var(--bg-secondary);
        }
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            background: var(--bg-elevated);
            border-bottom: 1px solid var(--border);
        }
        .table-copy-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            color: var(--fg-secondary);
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            opacity: 0;
        }
        .table-wrapper:hover .table-copy-btn { opacity: 1; }
        .table-copy-btn:hover { 
            background: var(--accent); 
            color: var(--bg-primary);
        }
        .table-copy-btn.copied { 
            background: var(--accent); 
            color: var(--bg-primary);
            border-color: var(--accent);
        }
        
        .markdown-content table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }
        .markdown-content th,
        .markdown-content td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
            color: var(--fg-secondary);
        }
        .markdown-content th {
            background: var(--bg-elevated);
            font-weight: 600;
            color: var(--fg-primary);
        }
        .markdown-content tr:last-child td { border-bottom: none; }

        /* Lists with Copy */
        .list-wrapper {
            position: relative;
            margin: 0.75rem 0;
        }
        .list-copy-btn {
            position: absolute;
            top: -0.5rem;
            right: 0;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            color: var(--fg-secondary);
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            opacity: 0;
        }
        .list-wrapper:hover .list-copy-btn { opacity: 1; }
        .list-copy-btn:hover { 
            background: var(--accent); 
            color: var(--bg-primary);
        }
        .list-copy-btn.copied { 
            background: var(--accent); 
            color: var(--bg-primary);
        }

        .markdown-content ul,
        .markdown-content ol {
            padding-left: 1.5rem;
            margin: 0.75rem 0;
        }
        .markdown-content li { 
            margin: 0.375rem 0; 
            color: var(--fg-secondary);
        }
        .markdown-content a { 
            color: var(--accent); 
            text-decoration: underline;
            text-underline-offset: 2px;
        }
        .markdown-content blockquote {
            border-left: 3px solid var(--accent);
            padding-left: 1rem;
            margin: 0.75rem 0;
            color: var(--fg-muted);
            font-style: italic;
        }
        .markdown-content hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1rem 0;
        }

        /* Mobile Optimizations */
        @media (max-width: 1024px) {
            #chatSidebar {
                position: fixed;
                top: 64px; /* Account for header */
                height: calc(100vh - 64px);
            }
        }

        @media (max-width: 640px) {
            .markdown-content pre {
                font-size: 0.75rem;
            }
            .message-bubble {
                max-width: 95% !important;
            }
            .code-block-header {
                padding: 0.375rem 0.75rem;
            }
        }

        /* Animations */
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .message-animate { animation: slideIn 0.3s ease-out forwards; }

        /* Typing Indicator */
        .typing-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: typing 1.4s infinite ease-in-out both;
        }
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        @keyframes typing {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        /* Selection styling */
        ::selection {
            background: rgba(0, 212, 170, 0.3);
            color: var(--fg-primary);
        }
    </style>

    <main class="flex flex-col h-[calc(100vh-64px)] overflow-hidden bg-[var(--bg-primary)]">
        <div class="flex flex-1 overflow-hidden relative">
            
            <!-- Sidebar -->
            <aside id="chatSidebar" class="absolute inset-y-0 left-0 z-40 w-80 lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-300 ease-in-out bg-[var(--bg-secondary)] border-r border-[var(--border)] flex flex-col">
                <div class="p-4 border-b border-[var(--border)] flex items-center justify-between">
                    <h2 class="font-bold text-lg text-[var(--fg-primary)]">Chat History</h2>
                    <button onclick="createNewChat()" class="p-2 rounded-lg bg-[var(--bg-elevated)] text-[var(--accent)] hover:bg-[var(--accent)] hover:text-[var(--bg-primary)] transition-all" title="New Chat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-2 space-y-1" id="conversationList">
                    <div class="p-4 text-center text-[var(--fg-muted)] text-sm italic">Loading history...</div>
                </div>

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

            <!-- Main Chat Area -->
            <section class="flex-1 flex flex-col bg-[var(--bg-primary)] relative min-w-0">
                
                <!-- Header -->
                <header class="h-16 border-b border-[var(--border)] bg-[var(--bg-secondary)]/50 flex items-center justify-between px-4 lg:px-6 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleChatSidebar()" class="lg:hidden p-2 -ml-2 text-[var(--fg-secondary)] hover:text-[var(--accent)] transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div class="min-w-0">
                            <h3 id="activeChatTitle" class="font-bold text-[var(--fg-primary)] text-sm lg:text-base truncate">Select a conversation</h3>
                            <p class="text-[10px] text-[var(--fg-muted)]">Chatting with {{ $chatbot->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button onclick="deleteActiveConversation()" class="p-2 text-[var(--fg-muted)] hover:text-red-400 transition-colors" title="Delete Conversation">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </header>

                <!-- Messages -->
                <div id="chatMessages" class="flex-1 overflow-y-auto p-4 lg:p-6 space-y-6 scroll-smooth">
                    <div id="noChatSelected" class="h-full flex flex-col items-center justify-center text-center p-6">
                        <div class="w-16 h-16 bg-[var(--bg-elevated)] rounded-full flex items-center justify-center mb-4 text-[var(--accent)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <h4 class="text-[var(--fg-primary)] font-bold">Your Assistant is Ready</h4>
                        <p class="text-[var(--fg-muted)] text-sm max-w-xs mt-2">Select a conversation from the sidebar or start a new one to begin.</p>
                    </div>
                </div>

                <!-- Input -->
                <div id="inputArea" class="hidden p-4 lg:p-6 border-t border-[var(--border)] bg-[var(--bg-secondary)]/30 backdrop-blur-sm">
                    <div class="max-w-4xl mx-auto relative flex items-end gap-2">
                        <div class="flex-1 relative">
                            <textarea 
                                id="messageInput"
                                rows="1" 
                                placeholder="Message {{ $chatbot->name }}..." 
                                class="w-full bg-[var(--bg-secondary)] border border-[var(--border)] text-[var(--fg-primary)] rounded-2xl py-3 pl-4 pr-12 focus:outline-none focus:border-[var(--accent)] focus:ring-1 focus:ring-[var(--accent)] transition-all resize-none overflow-hidden placeholder:text-[var(--fg-muted)]"
                                oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, 200) + 'px'"
                            ></textarea>
                            <button id="sendBtn" onclick="sendMessage()" class="absolute right-2 bottom-2 p-2 bg-[var(--accent)] text-[var(--bg-primary)] rounded-xl hover:scale-105 active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mobile Overlay -->
            <div id="sidebarMobileOverlay" onclick="toggleChatSidebar()" class="fixed inset-0 bg-black/60 z-30 hidden lg:hidden transition-opacity backdrop-blur-sm"></div>
        </div>
    </main>

    <!-- Markdown & Syntax Highlighting Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/13.0.1/markdown-it.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/json.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/html.min.js"></script>

    <script>
        // --- CONFIGURATION ---
        const CHATBOT_ID = {{ $chatbot->id }};
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let activeConversationId = null;

        // Initialize Markdown-it
        const md = window.markdownit({
            html: false,
            linkify: true,
            typographer: true,
            breaks: true,
            highlight: function (str, lang) {
                if (lang && hljs.getLanguage(lang)) {
                    try {
                        return hljs.highlight(str, { language: lang, ignoreIllegals: true }).value;
                    } catch (__) {}
                }
                return md.utils.escapeHtml(str);
            }
        });

        const botUrl = (path) => `/chatbots/${CHATBOT_ID}${path}`;

        // --- INITIALIZATION ---
        document.addEventListener('DOMContentLoaded', () => {
            loadConversations();
            
            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                // Escape to close sidebar on mobile
                if (e.key === 'Escape' && window.innerWidth < 1024) {
                    const sidebar = document.getElementById('chatSidebar');
                    if (!sidebar.classList.contains('-translate-x-full')) {
                        toggleChatSidebar();
                    }
                }
            });
        });

        // --- COPY UTILITIES ---
        async function copyToClipboard(text, btn) {
            try {
                await navigator.clipboard.writeText(text);
                const originalHTML = btn.innerHTML;
                btn.classList.add('copied');
                btn.innerHTML = `<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Copied`;
                
                setTimeout(() => {
                    btn.classList.remove('copied');
                    btn.innerHTML = originalHTML;
                }, 2000);
            } catch (err) {
                // Fallback
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
            }
        }

        window.copyCode = function(btn) {
            const pre = btn.closest('.code-block-wrapper').querySelector('pre');
            const code = pre.querySelector('code');
            copyToClipboard(code.textContent, btn);
        };

        // --- CONTENT PROCESSING ---
        function processMarkdown(html) {
            const temp = document.createElement('div');
            temp.innerHTML = html;

            // Wrap code blocks
            temp.querySelectorAll('pre').forEach((pre) => {
                const code = pre.querySelector('code');
                if (!code) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'code-block-wrapper';
                
                const lang = code.className.match(/language-(\w+)/)?.[1] || 'text';
                const header = document.createElement('div');
                header.className = 'code-block-header';
                header.innerHTML = `
                    <span class="code-language">${lang}</span>
                    <button class="copy-btn" onclick="window.copyCode(this)" aria-label="Copy code">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        Copy
                    </button>
                `;

                wrapper.appendChild(header);
                pre.parentNode.insertBefore(wrapper, pre);
                wrapper.appendChild(pre);
            });

            // Wrap tables
            temp.querySelectorAll('table').forEach(table => {
                const wrapper = document.createElement('div');
                wrapper.className = 'table-wrapper';
                
                const copyBtn = document.createElement('button');
                copyBtn.className = 'table-copy-btn';
                copyBtn.innerHTML = 'Copy CSV';
                copyBtn.onclick = function() {
                    const rows = Array.from(table.querySelectorAll('tr')).map(row => 
                        Array.from(row.querySelectorAll('td, th')).map(cell => cell.textContent).join('\t')
                    ).join('\n');
                    copyToClipboard(rows, this);
                };

                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(copyBtn);
                wrapper.appendChild(table);
            });

            // Wrap lists
            temp.querySelectorAll('ul, ol').forEach(list => {
                const wrapper = document.createElement('div');
                wrapper.className = 'list-wrapper';
                
                const copyBtn = document.createElement('button');
                copyBtn.className = 'list-copy-btn';
                copyBtn.innerHTML = 'Copy List';
                copyBtn.onclick = function() {
                    const items = Array.from(list.querySelectorAll('li')).map(li => `• ${li.textContent}`).join('\n');
                    copyToClipboard(items, this);
                };

                list.parentNode.insertBefore(wrapper, list);
                wrapper.appendChild(copyBtn);
                wrapper.appendChild(list);
            });

            return temp.innerHTML;
        }

        // --- API FUNCTIONS ---
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
                    
                    const item = document.createElement('div');
                    item.className = `conv-item p-3 rounded-xl cursor-pointer transition-all hover:bg-[var(--bg-elevated)] ${activeConversationId == conv.id ? 'bg-[var(--bg-elevated)] border-l-4 border-[var(--accent)]' : ''}`;
                    item.dataset.id = conv.id;
                    item.onclick = () => selectConversation(conv.id);
                    item.innerHTML = `
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="text-sm font-semibold text-[var(--fg-primary)] truncate">Conversation #${conv.id}</h3>
                            <span class="text-[10px] text-[var(--fg-muted)] shrink-0">${time}</span>
                        </div>
                        <p class="text-xs text-[var(--fg-muted)] truncate">${lastMsg.substring(0, 50)}${lastMsg.length > 50 ? '...' : ''}</p>
                    `;
                    list.appendChild(item);
                });
            } catch (err) {
                console.error("History load error:", err);
                document.getElementById('conversationList').innerHTML = `<p class="p-4 text-center text-red-400 text-xs">Failed to load history</p>`;
            }
        }

        async function selectConversation(id) {
            activeConversationId = id;
            
            // Update UI
            document.querySelectorAll('.conv-item').forEach(el => {
                el.classList.remove('bg-[var(--bg-elevated)]', 'border-l-4', 'border-[var(--accent)]');
            });
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
                
                if (window.innerWidth < 1024) toggleChatSidebar();
            } catch (err) {
                container.innerHTML = `<p class="text-center text-red-400 p-4">Error loading messages.</p>`;
            }
        }

        async function createNewChat() {
            try {
                const response = await fetch(botUrl('/conversations'), {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': CSRF_TOKEN 
                    }
                });
                const newConv = await response.json();
                await loadConversations();
                selectConversation(newConv.id);
            } catch (err) {
                console.error("Create chat error:", err);
            }
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const btn = document.getElementById('sendBtn');
            const text = input.value.trim();
            
            if (!text || !activeConversationId || btn.disabled) return;

            appendMessageUI('user', text, new Date());
            input.value = '';
            input.style.height = '';
            showTypingIndicator();
            btn.disabled = true;

            try {
                const response = await fetch(botUrl(`/conversations/${activeConversationId}/messages`), {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': CSRF_TOKEN 
                    },
                    body: JSON.stringify({ message: text })
                });
                
                const data = await response.json();
                removeTypingIndicator();
                
                if (data.ai_message) {
                    appendMessageUI('assistant', data.ai_message.message, data.ai_message.created_at);
                } else {
                    appendMessageUI('assistant', "I apologize, but I couldn't process that request.");
                }
                
                loadConversations();
            } catch (err) {
                removeTypingIndicator();
                appendMessageUI('assistant', "⚠️ Connection error. Please try again.");
                console.error("Send error:", err);
            } finally {
                btn.disabled = false;
                input.focus();
            }
        }

        async function deleteActiveConversation() {
            if (!activeConversationId) {
                alert("Please select a conversation to delete.");
                return;
            }

            if (!confirm("Are you sure you want to delete this conversation? This cannot be undone.")) {
                return;
            }

            try {
                const response = await fetch(botUrl(`/conversations/${activeConversationId}`), {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    activeConversationId = null;
                    
                    document.getElementById('chatMessages').innerHTML = `
                        <div id="noChatSelected" class="h-full flex flex-col items-center justify-center text-center p-6 message-animate">
                            <div class="w-16 h-16 bg-[var(--bg-elevated)] rounded-full flex items-center justify-center mb-4 text-[var(--accent)]">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            </div>
                            <h4 class="text-[var(--fg-primary)] font-bold">Conversation Deleted</h4>
                            <p class="text-[var(--fg-muted)] text-sm max-w-xs mt-2">Select another chat or start a new one.</p>
                        </div>
                    `;
                    
                    document.getElementById('inputArea').classList.add('hidden');
                    document.getElementById('activeChatTitle').innerText = "Select a conversation";
                    
                    loadConversations();
                } else {
                    const data = await response.json();
                    alert(data.error || "Failed to delete conversation.");
                }
            } catch (err) {
                console.error("Delete error:", err);
                alert("An error occurred while trying to delete the conversation.");
            }
        }

        // --- UI HELPERS ---
        function appendMessageUI(sender, text, timestamp) {
            const container = document.getElementById('chatMessages');
            const time = timestamp ? new Date(timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : 'Just now';
            const isUser = sender === 'user';

            // Process markdown for assistant messages
            const content = isUser ? escapeHtml(text) : processMarkdown(md.render(text));
            
            const wrapper = document.createElement('div');
            wrapper.className = `flex ${isUser ? 'flex-row-reverse' : ''} items-start gap-3 max-w-[90%] lg:max-w-[80%] ${isUser ? 'ml-auto' : ''} message-animate`;
            
            wrapper.innerHTML = `
                <div class="w-8 h-8 rounded-full ${isUser ? 'bg-[var(--accent)] text-[var(--bg-primary)]' : 'bg-[var(--bg-elevated)] text-[var(--accent)]'} border border-[var(--border)] flex items-center justify-center shrink-0 text-xs font-bold">
                    ${isUser ? 'ME' : 'AI'}
                </div>
                <div class="message-bubble ${isUser ? 'bg-[var(--accent)] text-[var(--bg-primary)] rounded-tr-none' : 'bg-[var(--bg-elevated)] text-[var(--fg-primary)] rounded-tl-none border border-[var(--border)]'} p-4 rounded-2xl shadow-sm text-sm markdown-content overflow-hidden">
                    ${content}
                    <div class="mt-2 text-[10px] opacity-70 ${isUser ? 'text-right' : ''} font-medium">${time}</div>
                </div>
            `;
            
            container.appendChild(wrapper);
            
            // Highlight code blocks
            wrapper.querySelectorAll('pre code').forEach(block => {
                hljs.highlightElement(block);
            });
            
            container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function showTypingIndicator() {
            const container = document.getElementById('chatMessages');
            const html = `
                <div id="typingIndicator" class="flex items-start gap-3 max-w-[90%] lg:max-w-[80%] message-animate">
                    <div class="w-8 h-8 rounded-full bg-[var(--bg-elevated)] text-[var(--accent)] border border-[var(--border)] flex items-center justify-center shrink-0 text-xs font-bold">AI</div>
                    <div class="bg-[var(--bg-elevated)] p-4 rounded-2xl rounded-tl-none border border-[var(--border)]">
                        <div class="flex gap-1">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
        }

        function removeTypingIndicator() {
            document.getElementById('typingIndicator')?.remove();
        }

        function toggleChatSidebar() {
            const sidebar = document.getElementById('chatSidebar');
            const overlay = document.getElementById('sidebarMobileOverlay');
            const isClosed = sidebar.classList.contains('-translate-x-full');
            
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // Input handling
        document.getElementById('messageInput')?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Auto-focus input when chat selected
        function focusInput() {
            document.getElementById('messageInput')?.focus();
        }
    </script>
</x-app-layout>