            @if ($paginator->hasPages())
                <div class="p-4 border-t border-[var(--border)] flex flex-col sm:flex-row justify-between items-center gap-4">

                    {{-- Showing Results --}}
                    <p class="text-sm text-[var(--fg-secondary)]">
                        Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}
                        of {{ number_format($paginator->total()) }} users
                    </p>

                    {{-- Pagination Buttons --}}
                    <div class="flex items-center gap-1">

                        {{-- Previous Button --}}
                        @if ($paginator->onFirstPage())
                            <button class="btn-ghost px-3 py-1 text-sm disabled:opacity-50" disabled>
                                ← Prev
                            </button>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}"
                            class="btn-ghost px-3 py-1 text-sm">
                                ← Prev
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span class="px-2 text-[var(--fg-muted)]">...</span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <span
                                            class="bg-[var(--accent)] text-[var(--bg-primary)] px-3 py-1 rounded-md text-sm font-medium">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                        class="hover:bg-[var(--bg-elevated)] px-3 py-1 rounded-md text-sm">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}"
                            class="btn-ghost px-3 py-1 text-sm">
                                Next →
                            </a>
                        @else
                            <button class="btn-ghost px-3 py-1 text-sm disabled:opacity-50" disabled>
                                Next →
                            </button>
                        @endif

                    </div>
                </div>
            @endif
