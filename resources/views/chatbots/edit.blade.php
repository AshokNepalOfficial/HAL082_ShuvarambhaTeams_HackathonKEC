<x-app-layout>
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: var(--bg-primary); }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        
        /* Tab Logic */
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .tab-btn.active { 
            color: var(--accent); 
            border-bottom: 2px solid var(--accent);
            background: rgba(0, 212, 170, 0.05);
        }

        .input-compact {
            width: 100%;
            border-radius: 0.5rem;
            border: 1px solid var(--border);
            background: var(--bg-elevated);
            color: var(--fg-primary);
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .input-compact:focus {
            outline: none;
            border-color: var(--accent);
            ring: 1px var(--accent);
        }

        .glass-panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
        }
    </style>

    <main class="p-4 lg:p-4 h-[calc(100vh-2rem)] flex flex-col">
        
        <!-- COMPACT HEADER -->
        <header class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-4">
                <a href="{{ $go_back_url }}" class="p-2 hover:bg-[var(--bg-elevated)] rounded-full text-[var(--fg-muted)] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <div>
                    <h1 class="font-display text-xl font-bold text-[var(--fg-primary)] leading-none">Edit Chatbot</h1>
                    <p class="text-xs text-[var(--fg-muted)] mt-1">{{ $chatbot['name'] }}</p>
                </div>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-mono text-[var(--fg-muted)] hidden sm:block">ID: {{ $chatbot['id'] }}</span>
                <button form="edit-form" type="submit" class="px-5 py-2 bg-[var(--accent)] text-[var(--bg-primary)] rounded-lg text-sm font-bold hover:brightness-105 transition-all shadow-lg shadow-[var(--accent-glow)]">
                    Save Changes
                </button>
            </div>
        </header>

        <form id="edit-form" action="{{ route('chatbot.update', $chatbot['id']) }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            
            <div class="flex flex-1 gap-6 overflow-hidden">
                
                <!-- LEFT NAVIGATION (Vertical Tabs) -->
                <aside class="w-48 flex flex-col gap-1 hidden md:flex">
                    <button type="button" onclick="switchTab(event, 'general')" class="tab-btn active flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg text-[var(--fg-secondary)] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-width="2"/></svg>
                        General
                    </button>
                    <button type="button" onclick="switchTab(event, 'persona')" class="tab-btn flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg text-[var(--fg-secondary)] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2"/></svg>
                        AI Persona
                    </button>
                    <button type="button" onclick="switchTab(event, 'knowledge')" class="tab-btn flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg text-[var(--fg-secondary)] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2"/></svg>
                        Knowledge
                    </button>
                </aside>

                <!-- MAIN EDITOR AREA -->
                <div class="flex-1 glass-panel overflow-y-auto p-6 scrollbar-hide">
                    
                    <!-- TAB: GENERAL -->
                    <div id="general" class="tab-content active animate-in fade-in slide-in-from-right-2">
                        <h3 class="text-lg font-bold text-[var(--fg-primary)] mb-6">General Configuration</h3>
                        <div class="space-y-4 max-w-2xl">
                            <div>
                                <label class="block text-xs font-bold text-[var(--fg-muted)] uppercase tracking-wider mb-1.5">Chatbot Name</label>
                                <input type="text" name="name" value="{{ $chatbot['name'] }}" class="input-compact">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[var(--fg-muted)] uppercase tracking-wider mb-1.5">Description</label>
                                <textarea name="description" rows="3" class="input-compact">{{ $chatbot['description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: PERSONA -->
                    <div id="persona" class="tab-content animate-in fade-in slide-in-from-right-2">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-[var(--fg-primary)]">AI Persona & Behavior</h3>
                            <p class="text-xs text-[var(--fg-muted)]">Define how your AI interacts with users.</p>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-[var(--fg-muted)] uppercase tracking-wider mb-1.5">System Instruction (Prompt)</label>
                                <textarea name="system_prompts" rows="8" class="input-compact font-mono text-xs leading-relaxed" placeholder="e.g. You are a helpful technical support agent...">{{ $chatbot['configurations']['system_prompts'] ?? '' }}</textarea>
                            </div>

                            <div class="pt-4 border-t border-[var(--border)]">
                                <div class="flex items-center justify-between mb-4">
                                    <label class="text-xs font-bold text-[var(--fg-muted)] uppercase tracking-wider">Few-Shot Examples</label>
                                    <button type="button" id="add-fewshot" class="text-[10px] px-2 py-1 bg-[var(--bg-elevated)] border border-[var(--border)] rounded hover:text-[var(--accent)] transition-colors">+ ADD EXAMPLE</button>
                                </div>
                                <div id="fewshots-list" class="space-y-3">
                                    @foreach($chatbot['configurations']['few_shots'] ?? [] as $index => $example)
                                        <div class="flex gap-3 items-start group">
                                            <div class="flex-1 grid grid-cols-2 gap-2">
                                                <input type="text" name="few_shots[{{ $index }}][input]" value="{{ $example['input'] }}" placeholder="User query..." class="input-compact py-1.5 text-xs">
                                                <input type="text" name="few_shots[{{ $index }}][output]" value="{{ $example['output'] }}" placeholder="AI response..." class="input-compact py-1.5 text-xs">
                                            </div>
                                            <button type="button" onclick="this.parentElement.remove()" class="p-2 text-[var(--fg-muted)] hover:text-[var(--danger)]">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: KNOWLEDGE -->
                    <div id="knowledge" class="tab-content animate-in fade-in slide-in-from-right-2">
                        <h3 class="text-lg font-bold text-[var(--fg-primary)] mb-6">Connected Knowledge Base</h3>
                        
                        <div class="overflow-hidden border border-[var(--border)] rounded-lg">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-[var(--bg-elevated)] text-[var(--fg-muted)] font-bold uppercase tracking-widest">
                                    <tr>
                                        <th class="px-4 py-3">File Name</th>
                                        <th class="px-4 py-3">Size</th>
                                        <th class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[var(--border)]">
                                    @forelse($chatbot['selected_files'] as $file)
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-[var(--fg-primary)]">{{ $file['name'] }}</td>
                                            <td class="px-4 py-3 text-[var(--fg-muted)]">{{ $file['file_sizes'] }}</td>
                                            <td class="px-4 py-3">
                                                <span class="inline-flex items-center gap-1.5 {{ $file['is_vectorized'] ? 'text-[var(--accent)]' : 'text-yellow-500' }}">
                                                    <span class="w-1.5 h-1.5 rounded-full currentColor bg-current"></span>
                                                    {{ $file['is_vectorized'] ? 'Indexed' : 'Processing' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="px-4 py-8 text-center text-[var(--fg-muted)]">No data sources attached.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <script>
            function switchTab(evt, tabName) {
                const contents = document.getElementsByClassName("tab-content");
                for (let content of contents) content.classList.remove("active");
                
                const buttons = document.getElementsByClassName("tab-btn");
                for (let btn of buttons) btn.classList.remove("active");
                
                document.getElementById(tabName).classList.add("active");
                evt.currentTarget.classList.add("active");
            }

            document.getElementById('add-fewshot').addEventListener('click', function () {
                const container = document.getElementById('fewshots-list');
                const index = container.children.length;
                const html = `
                    <div class="flex gap-3 items-start animate-in slide-in-from-top-1">
                        <div class="flex-1 grid grid-cols-2 gap-2">
                            <input type="text" name="few_shots[${index}][input]" placeholder="User query..." class="input-compact py-1.5 text-xs">
                            <input type="text" name="few_shots[${index}][output]" placeholder="AI response..." class="input-compact py-1.5 text-xs">
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="p-2 text-[var(--fg-muted)] hover:text-[var(--danger)]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>`;
                container.insertAdjacentHTML('beforeend', html);
            });
        </script>
    </main>
</x-app-layout>

