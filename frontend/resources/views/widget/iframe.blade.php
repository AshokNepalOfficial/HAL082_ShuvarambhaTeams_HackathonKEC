<!-- widgets/iframe.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Chat Widget</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Markdown & Syntax Highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/13.0.1/markdown-it.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <!-- Load common languages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/json.min.js"></script>

    <style>
        * { -webkit-tap-highlight-color: transparent; }
        body { font-family: 'Inter', sans-serif; overscroll-behavior: none; }
        
        /* Mobile Fullscreen Support */
        @media (max-width: 640px) {
            .chat-container {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100vw;
                height: 100vh;
                height: 100dvh; /* Dynamic viewport height for mobile */
                border-radius: 0;
                max-width: none;
            }
        }

        /* Custom Scrollbar */
        #chat-box::-webkit-scrollbar { width: 6px; }
        #chat-box::-webkit-scrollbar-track { background: transparent; }
        #chat-box::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        #chat-box::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Markdown Content Styling */
        .markdown-content { line-height: 1.6; }
        .markdown-content p { margin-bottom: 0.75rem; }
        .markdown-content p:last-child { margin-bottom: 0; }
        
        /* Code Blocks with Copy Button */
        .code-block-wrapper {
            position: relative;
            margin: 0.75rem 0;
            border-radius: 0.5rem;
            overflow: hidden;
            background: #282c34;
        }
        .code-block-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            background: #21252b;
            border-bottom: 1px solid #181a1f;
        }
        .code-language {
            font-size: 0.75rem;
            color: #abb2bf;
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
            color: #abb2bf;
            background: #3e4451;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .copy-btn:hover { background: #4b5363; color: #fff; }
        .copy-btn.copied { background: #22c55e; color: white; }
        
        .markdown-content pre {
            margin: 0;
            padding: 1rem;
            overflow-x: auto;
            background: #282c34;
        }
        .markdown-content code {
            font-family: 'Fira Code', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .markdown-content :not(pre) > code {
            background: #f1f5f9;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            color: #ef4444;
            font-size: 0.85em;
        }

        /* Tables with Copy */
        .table-wrapper {
            position: relative;
            margin: 0.75rem 0;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .table-copy-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            color: #64748b;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            opacity: 0;
        }
        .table-wrapper:hover .table-copy-btn { opacity: 1; }
        .table-copy-btn:hover { background: #f1f5f9; color: #334155; }
        .table-copy-btn.copied { background: #22c55e; color: white; border-color: #22c55e; }
        
        .markdown-content table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }
        .markdown-content th,
        .markdown-content td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .markdown-content th {
            background: #f8fafc;
            font-weight: 600;
            color: #475569;
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
            color: #64748b;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            opacity: 0;
        }
        .list-wrapper:hover .list-copy-btn { opacity: 1; }
        .list-copy-btn:hover { background: #f1f5f9; }
        .list-copy-btn.copied { background: #22c55e; color: white; border-color: #22c55e; }

        .markdown-content ul,
        .markdown-content ol {
            padding-left: 1.5rem;
            margin: 0.75rem 0;
        }
        .markdown-content li { margin: 0.375rem 0; }

        /* Animations */
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .message-animate { animation: slideIn 0.3s ease-out forwards; }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse-slow { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }

        .typing-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #94a3b8;
            animation: typing 1.4s infinite ease-in-out both;
        }
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        @keyframes typing {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        /* Mobile optimizations */
        @media (max-width: 640px) {
            .chat-container { border-radius: 0; }
            .message-bubble { max-width: 90% !important; }
        }
    </style>
</head>
<body class="bg-transparent overflow-hidden">
    <div class="chat-container flex flex-col h-screen bg-white shadow-2xl overflow-hidden ring-1 ring-black/5 sm:rounded-2xl sm:h-[550px] sm:max-w-[400px]">
        
        <!-- Header -->
        <div class="bg-white border-b border-gray-100 px-4 py-3 flex justify-between items-center shrink-0 z-10">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        {{ substr($chatbot->name, 0, 1) }}
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full animate-pulse-slow"></div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 leading-tight">{{ $chatbot->name }}</h3>
                    <span class="text-[11px] text-gray-500 font-medium flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                        Online now
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <!-- Mobile fullscreen toggle -->
                <button id="fullscreen-btn" class="sm:hidden p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-full transition-colors" title="Toggle Fullscreen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
                    </svg>
                </button>
                <button onclick="window.parent.postMessage('closeChat', '*')" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-full transition-colors" title="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Messages Area -->
        <div id="chat-box" class="flex-1 p-4 overflow-y-auto space-y-4 bg-slate-50/50 scroll-smooth">
            <!-- Welcome Message -->
            <div class="flex justify-start message-animate">
                <div class="message-bubble bg-white border border-gray-200 text-gray-800 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm max-w-[85%] text-[13.5px] leading-relaxed">
                    <p class="font-medium mb-1">👋 Hello there!</p>
                    <p>I'm {{ $chatbot->name }}. How can I assist you today?</p>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div id="typing-indicator" class="hidden px-4 py-2 shrink-0">
            <div class="flex justify-start">
                <div class="bg-white border border-gray-100 px-4 py-3 rounded-2xl rounded-tl-none flex gap-1.5 items-center shadow-sm">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-gray-100 shrink-0">
            <form id="chat-form" class="relative flex items-center gap-2">
                <input type="hidden" name="chatbot_id" value="{{ $chatbot->id }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="relative flex-1">
                    <input type="text" id="message-input" name="message" required 
                        placeholder="Type your message..." 
                        autocomplete="off"
                        class="w-full bg-gray-100 border-0 rounded-2xl px-5 py-3 pr-12 text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all placeholder:text-gray-400 resize-none"
                        style="min-height: 44px;">
                    
                    <button type="submit" id="send-btn" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>
            </form>
            <p class="text-[10px] text-center text-gray-400 mt-2 font-medium tracking-wide">Powered by {{ config('app.name') }}</p>
        </div>
    </div>

<script>
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

    // DOM Elements
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');
    const chatBox = document.getElementById('chat-box');
    const typingIndicator = document.getElementById('typing-indicator');
    const sendBtn = document.getElementById('send-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const storageKey = `chat_conv_${{ $chatbot->id }}`;
    const fullscreenBtn = document.getElementById('fullscreen-btn');

    // Mobile fullscreen toggle
    let isFullscreen = false;
    if (fullscreenBtn) {
        fullscreenBtn.addEventListener('click', () => {
            isFullscreen = !isFullscreen;
            if (isFullscreen) {
                document.documentElement.requestFullscreen?.() || 
                document.documentElement.webkitRequestFullscreen?.();
            } else {
                document.exitFullscreen?.() || 
                document.webkitExitFullscreen?.();
            }
        });
    }

    // Copy to clipboard utility
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

    // Process markdown content with enhanced features
    function processContent(html) {
        const temp = document.createElement('div');
        temp.innerHTML = html;

        // Wrap code blocks with copy functionality
        temp.querySelectorAll('pre').forEach((pre, index) => {
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

        // Wrap tables with copy functionality
        temp.querySelectorAll('table').forEach(table => {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-wrapper';
            
            const header = document.createElement('div');
            header.className = 'table-header';
            header.innerHTML = `<span class="text-xs font-semibold text-gray-600">Table</span>`;
            
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

        // Wrap lists with copy functionality
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

    // Global copy function for code blocks
    window.copyCode = function(btn) {
        const pre = btn.closest('.code-block-wrapper').querySelector('pre');
        const code = pre.querySelector('code');
        copyToClipboard(code.textContent, btn);
    };

    function appendMessage(sender, text) {
        const isBot = sender === 'bot';
        const wrapper = document.createElement('div');
        wrapper.className = `flex ${isBot ? 'justify-start' : 'justify-end'} message-animate`;
        
        const content = isBot ? processContent(md.render(text)) : escapeHtml(text);
        
        wrapper.innerHTML = `
            <div class="message-bubble ${isBot ? 'bg-white border border-gray-200 text-gray-800 rounded-tl-none' : 'bg-indigo-600 text-white rounded-tr-none'} 
                        px-4 py-3 rounded-2xl shadow-sm max-w-[85%] text-[13.5px] markdown-content">
                ${content}
            </div>
        `;
        
        chatBox.appendChild(wrapper);
        
        // Highlight any new code blocks
        wrapper.querySelectorAll('pre code').forEach(block => {
            hljs.highlightElement(block);
        });
        
        scrollToBottom();
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function scrollToBottom() {
        chatBox.scrollTo({ top: chatBox.scrollHeight, behavior: 'smooth' });
    }

    // Handle form submission
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = messageInput.value.trim();
        if (!message || sendBtn.disabled) return;

        const formData = new FormData(chatForm);
        const existingConvId = localStorage.getItem(storageKey);
        if (existingConvId) formData.append('conversation_id', existingConvId);

        appendMessage('user', message);
        messageInput.value = '';
        typingIndicator.classList.remove('hidden');
        sendBtn.disabled = true;
        scrollToBottom();

        try {
            const response = await fetch("{{ route('chat.send') }}", {
                method: 'POST',
                body: formData,
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            const data = await response.json();

            if (response.ok && data.status === 'success') {
                localStorage.setItem(storageKey, data.conversation_id);
                appendMessage('bot', data.bot_message);
            } else {
                appendMessage('bot', '⚠️ **Error:** ' + (data.message || 'Something went wrong. Please try again.'));
            }
        } catch (error) {
            appendMessage('bot', '🔌 _Connection lost. Please check your internet and try again._');
        } finally {
            typingIndicator.classList.add('hidden');
            sendBtn.disabled = false;
            messageInput.focus();
        }
    });

    // Auto-resize input (optional enhancement)
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Handle enter key (send on Enter, new line on Shift+Enter)
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });

    // Load history if exists
    window.addEventListener('DOMContentLoaded', () => {
        messageInput.focus();
        
        // Check for existing conversation
        const existingId = localStorage.getItem(storageKey);
        if (existingId) {
            // Optionally load previous messages here via API
            console.log('Resuming conversation:', existingId);
        }
    });

    // Handle visibility change (pause/resume)
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            messageInput.focus();
        }
    });
</script>
</body>
</html>