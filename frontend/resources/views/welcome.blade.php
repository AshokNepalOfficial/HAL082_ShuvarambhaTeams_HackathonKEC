<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuvarambha - Build RAG Chatbots in Minutes</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        'bg-primary': '#0a0f1a',
                        'bg-secondary': '#111827',
                        'bg-card': '#1a2234',
                        'bg-elevated': '#222d42',
                        'fg-primary': '#f1f5f9',
                        'fg-secondary': '#94a3b8',
                        'fg-muted': '#64748b',
                        'accent': '#00d4aa',
                        'accent-dim': '#00a88a',
                        'accent-glow': 'rgba(0, 212, 170, 0.3)',
                        'danger': '#f43f5e',
                        'warning': '#f59e0b',
                        'info': '#3b82f6',
                        'purple': '#a855f7',
                        'border': '#2a3548',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(0, 212, 170, 0.3)' },
                            '100%': { boxShadow: '0 0 40px rgba(0, 212, 170, 0.6), 0 0 60px rgba(0, 212, 170, 0.3)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --bg-primary: #0a0f1a;
            --bg-secondary: #111827;
            --bg-card: #1a2234;
            --bg-elevated: #222d42;
            --fg-primary: #f1f5f9;
            --fg-secondary: #94a3b8;
            --fg-muted: #64748b;
            --accent: #00d4aa;
            --accent-dim: #00a88a;
            --accent-glow: rgba(0, 212, 170, 0.3);
            --danger: #f43f5e;
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #a855f7;
            --border: #2a3548;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--bg-primary);
            color: var(--fg-primary);
            overflow-x: hidden;
        }

        .bg-pattern {
            background-image:
                linear-gradient(135deg, var(--bg-primary) 0%, #0d1424 50%, var(--bg-primary) 100%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232a3548' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .glow-accent {
            box-shadow: 0 0 30px var(--accent-glow), 0 0 60px rgba(0, 212, 170, 0.1);
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: var(--accent);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 212, 170, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #00d4aa 0%, #a855f7 50%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass {
            background: rgba(26, 34, 52, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(42, 53, 72, 0.5);
        }

        .nav-glass {
            background: rgba(10, 15, 26, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(42, 53, 72, 0.5);
        }

        .particle-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .code-block {
            background: #0d1117;
            border: 1px solid #30363d;
            border-radius: 12px;
            font-family: 'JetBrains Mono', monospace;
        }

        .feature-icon {
            background: linear-gradient(135deg, rgba(0, 212, 170, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
            border: 1px solid rgba(0, 212, 170, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #00d4aa 0%, #00a88a 100%);
            color: #0a0f1a;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 170, 0.4);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
            opacity: 0;
        }

        .btn-primary:hover::after {
            opacity: 1;
            transform: rotate(45deg) translate(50%, 50%);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--fg-primary);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            background: rgba(0, 212, 170, 0.1);
        }

        .folder-visual {
            position: relative;
            overflow: hidden;
        }

        .folder-visual::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 212, 170, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .folder-visual:hover::before {
            opacity: 1;
        }

        .chat-bubble {
            animation: slideIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
        }

        .infographic-line {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: drawLine 2s ease-out forwards;
        }

        @keyframes drawLine {
            to {
                stroke-dashoffset: 0;
            }
        }

        .typing-cursor::after {
            content: '|';
            animation: blink 1s infinite;
            color: var(--accent);
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }

        .grid-bg {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(42, 53, 72, 0.3) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(42, 53, 72, 0.3) 1px, transparent 1px);
        }
    </style>
<base target="_blank">
</head>
<body class="bg-bg-primary text-fg-primary font-sans antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 nav-glass transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-accent to-purple flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="bot" class="w-6 h-6 text-bg-primary"></i>
                    </div>
                    <span class="font-display font-bold text-xl tracking-tight">Shuvarambha</span>
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-fg-secondary hover:text-accent transition-colors text-sm font-medium">Features</a>
                    <a href="#how-it-works" class="text-fg-secondary hover:text-accent transition-colors text-sm font-medium">How It Works</a>
                    <a href="#pricing" class="text-fg-secondary hover:text-accent transition-colors text-sm font-medium">Pricing</a>
                    <a href="#docs" class="text-fg-secondary hover:text-accent transition-colors text-sm font-medium">Docs</a>
                </div>

                <div class="flex items-center gap-4">



                    @if (Route::has('login'))
                        <nav class="flex items-center justify-end gap-4">
                            @auth
                                <!-- Dashboard button for authenticated users -->
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="btn-primary px-6 py-2.5 rounded-lg text-sm font-semibold flex items-center gap-2"
                                >
                                    Dashboard
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            @else
                                <!-- Sign In button -->
                                <a
                                    href="{{ route('login') }}"
                                    class="hidden md:inline-block text-fg-secondary hover:text-accent transition-colors text-sm font-medium"
                                >
                                    Sign In
                                </a>

                                <!-- Register button -->
                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="btn-primary px-6 py-2.5 rounded-lg text-sm font-semibold flex items-center gap-2"
                                    >
                                        Register
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-pattern pt-20">
        <div id="particles-js" class="particle-container"></div>
        
        <div class="hero-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-bg-card border border-border text-accent text-sm font-medium mb-4 hover:border-accent transition-colors cursor-pointer">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    No GraphQL. No Complexity. Just Files.
                </div>
                
                <h1 class="font-display text-5xl md:text-7xl font-bold leading-tight">
                    Build <span class="gradient-text">RAG Chatbots</span><br>
                    in Minutes, Not Days
                </h1>
                
                <p class="text-fg-secondary text-lg md:text-xl max-w-lg leading-relaxed">
                    Drop your files into folders. We handle the vectorization, embeddings, and GraphQL. 
                    Your intelligent chatbot is ready instantly.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <button class="btn-primary px-8 py-4 rounded-xl text-base font-semibold flex items-center gap-3 glow-accent">
                        Start Building Free
                        <i data-lucide="zap" class="w-5 h-5"></i>
                    </button>
                    <button class="btn-secondary px-8 py-4 rounded-xl text-base font-semibold flex items-center gap-3">
                        <i data-lucide="play-circle" class="w-5 h-5"></i>
                        Watch Demo
                    </button>
                </div>

                <div class="flex items-center gap-6 text-fg-muted text-sm pt-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4 text-accent"></i>
                        <span>No credit card</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4 text-accent"></i>
                        <span>Free tier forever</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4 text-accent"></i>
                        <span>Enterprise ready</span>
                    </div>
                </div>
            </div>

            <!-- Interactive Demo Visualization -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-accent/20 to-purple/20 rounded-3xl blur-3xl animate-pulse-slow"></div>
                
                <div class="relative card p-6 md:p-8 glow-accent animate-float">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-border">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-danger"></div>
                            <div class="w-3 h-3 rounded-full bg-warning"></div>
                            <div class="w-3 h-3 rounded-full bg-accent"></div>
                        </div>
                        <span class="text-fg-muted text-xs font-mono">shuvarambha-project</span>
                    </div>

                    <!-- File Tree Visualization -->
                    <div class="space-y-3 font-mono text-sm">
                        <div class="flex items-center gap-3 text-fg-secondary hover:text-accent transition-colors cursor-pointer group">
                            <i data-lucide="folder" class="w-5 h-5 text-warning group-hover:scale-110 transition-transform"></i>
                            <span>documents/</span>
                            <span class="text-fg-muted text-xs ml-auto">12 files</span>
                        </div>
                        <div class="pl-8 space-y-2 border-l border-border">
                            <div class="flex items-center gap-3 text-fg-muted hover:text-accent transition-colors cursor-pointer">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                <span>handbook.pdf</span>
                                <span class="text-accent text-xs ml-auto">✓ processed</span>
                            </div>
                            <div class="flex items-center gap-3 text-fg-muted hover:text-accent transition-colors cursor-pointer">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                <span>api-docs.md</span>
                                <span class="text-accent text-xs ml-auto">✓ processed</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-fg-secondary hover:text-accent transition-colors cursor-pointer group mt-4">
                            <i data-lucide="folder" class="w-5 h-5 text-warning group-hover:scale-110 transition-transform"></i>
                            <span>knowledge-base/</span>
                            <span class="text-fg-muted text-xs ml-auto">8 files</span>
                        </div>

                        <div class="mt-6 p-4 bg-bg-primary rounded-lg border border-border">
                            <div class="flex items-center gap-2 mb-3 text-accent">
                                <i data-lucide="bot" class="w-4 h-4"></i>
                                <span class="text-xs font-semibold uppercase tracking-wider">AI Assistant Active</span>
                            </div>
                            <div class="space-y-3">
                                <div class="chat-bubble bg-bg-elevated p-3 rounded-lg rounded-tl-none text-xs" style="animation-delay: 0.2s">
                                    <span class="text-fg-muted">User:</span> <span class="text-fg-primary">What's our refund policy?</span>
                                </div>
                                <div class="chat-bubble bg-accent/10 border border-accent/20 p-3 rounded-lg rounded-tr-none text-xs" style="animation-delay: 0.8s">
                                    <span class="text-accent">Bot:</span> <span class="text-fg-primary typing-cursor">Based on handbook.pdf section 4.2, we offer 30-day full refunds...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Stats -->
                <div class="absolute -bottom-6 -left-6 glass p-4 rounded-xl animate-float" style="animation-delay: 1s">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center">
                            <i data-lucide="database" class="w-5 h-5 text-accent"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-display">2.4M+</div>
                            <div class="text-xs text-fg-muted">Vectors Processed</div>
                        </div>
                    </div>
                </div>

                <div class="absolute -top-6 -right-6 glass p-4 rounded-xl animate-float" style="animation-delay: 2s">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple/20 flex items-center justify-center">
                            <i data-lucide="message-square" class="w-5 h-5 text-purple"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-display">99.9%</div>
                            <div class="text-xs text-fg-muted">Uptime</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo Cloud -->
    <section class="py-12 border-y border-border bg-bg-secondary/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-fg-muted text-sm mb-8 uppercase tracking-wider font-medium">Trusted by innovative teams</p>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-50">
                <div class="flex items-center gap-2 text-fg-secondary font-display font-bold text-xl">
                    <i data-lucide="hexagon" class="w-6 h-6"></i> TechCorp
                </div>
                <div class="flex items-center gap-2 text-fg-secondary font-display font-bold text-xl">
                    <i data-lucide="triangle" class="w-6 h-6"></i> StartupX
                </div>
                <div class="flex items-center gap-2 text-fg-secondary font-display font-bold text-xl">
                    <i data-lucide="diamond" class="w-6 h-6"></i> InnovateLabs
                </div>
                <div class="flex items-center gap-2 text-fg-secondary font-display font-bold text-xl">
                    <i data-lucide="octagon" class="w-6 h-6"></i> FutureScale
                </div>
                <div class="flex items-center gap-2 text-fg-secondary font-display font-bold text-xl">
                    <i data-lucide="pentagon" class="w-6 h-6"></i> DataFlow
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works - Infographic -->
    <section id="how-it-works" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 grid-bg opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-4">From Files to <span class="gradient-text">Intelligence</span></h2>
                <p class="text-fg-secondary text-lg max-w-2xl mx-auto">No complex setup. No GraphQL queries to write. Just three simple steps.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Connection Lines (SVG) -->
                <svg class="hidden md:block absolute top-1/2 left-0 w-full h-2 -translate-y-1/2 z-0" style="padding: 0 15%;">
                    <line x1="0" y1="1" x2="100%" y2="1" stroke="#2a3548" stroke-width="2" stroke-dasharray="8 4" />
                    <line x1="0" y1="1" x2="100%" y2="1" stroke="#00d4aa" stroke-width="2" class="infographic-line" style="animation-delay: 0.5s" />
                </svg>

                <!-- Step 1 -->
                <div class="scroll-reveal relative z-10">
                    <div class="card p-8 h-full text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-warning/10 border border-warning/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="folder-plus" class="w-8 h-8 text-warning"></i>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-bg-elevated border border-border flex items-center justify-center mx-auto mb-4 font-bold text-accent">1</div>
                        <h3 class="font-display text-xl font-bold mb-3">Create Folder</h3>
                        <p class="text-fg-secondary text-sm leading-relaxed">Create a project folder. Drag and drop your PDFs, DOCs, TXT files, or entire directories.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="scroll-reveal relative z-10" style="animation-delay: 0.2s">
                    <div class="card p-8 h-full text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-accent/10 border border-accent/20 flex items-center justify-center group-hover:scale-110 transition-transform relative">
                            <i data-lucide="cpu" class="w-8 h-8 text-accent"></i>
                            <div class="absolute inset-0 rounded-2xl bg-accent/20 animate-ping opacity-20"></div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-bg-elevated border border-border flex items-center justify-center mx-auto mb-4 font-bold text-accent">2</div>
                        <h3 class="font-display text-xl font-bold mb-3">Auto-Process</h3>
                        <p class="text-fg-secondary text-sm leading-relaxed">We automatically extract text, chunk documents, generate embeddings, and build your vector store.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="scroll-reveal relative z-10" style="animation-delay: 0.4s">
                    <div class="card p-8 h-full text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-purple/10 border border-purple/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="message-circle" class="w-8 h-8 text-purple"></i>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-bg-elevated border border-border flex items-center justify-center mx-auto mb-4 font-bold text-accent">3</div>
                        <h3 class="font-display text-xl font-bold mb-3">Chat Instantly</h3>
                        <p class="text-fg-secondary text-sm leading-relaxed">Embed the widget or use our API. Your chatbot answers questions based on your documents immediately.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-24 bg-bg-secondary/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-4">Everything You Need, <br><span class="gradient-text">Nothing You Don't</span></h2>
                <p class="text-fg-secondary text-lg max-w-2xl mx-auto">Complex RAG infrastructure simplified into an intuitive file-based interface.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="card p-6 scroll-reveal group">
                    <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6 text-accent"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2">Multi-Format Support</h3>
                    <p class="text-fg-secondary text-sm">PDF, DOCX, TXT, Markdown, HTML, and more. We handle the extraction so you don't have to.</p>
                </div>

                <!-- Feature 2 -->
                <div class="card p-6 scroll-reveal group" style="animation-delay: 0.1s">
                    <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="brain" class="w-6 h-6 text-purple"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2">Smart Chunking</h3>
                    <p class="text-fg-secondary text-sm">Intelligent text splitting with semantic preservation. No context loss, maximum relevance.</p>
                </div>

                <!-- Feature 3 -->
                <div class="card p-6 scroll-reveal group" style="animation-delay: 0.2s">
                    <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="zap" class="w-6 h-6 text-warning"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2">Real-time Sync</h3>
                    <p class="text-fg-secondary text-sm">Add or update files anytime. Your chatbot knowledge updates instantly without downtime.</p>
                </div>

                <!-- Feature 4 -->
                <div class="card p-6 scroll-reveal group" style="animation-delay: 0.3s">
                    <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="shield" class="w-6 h-6 text-info"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2">Enterprise Security</h3>
                    <p class="text-fg-secondary text-sm">SOC 2 compliant, end-to-end encryption, private vector stores. Your data never trains our models.</p>
                </div>

                <!-- Feature 5 -->
                <div class="card p-6 scroll-reveal group" style="animation-delay: 0.4s">
                    <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="code-2" class="w-6 h-6 text-danger"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2">Zero GraphQL</h3>
                    <p class="text-fg-secondary text-sm">We abstract all complexity. Simple REST API or drop-in widget. No query writing needed.</p>
                </div>

                <!-- Feature 6 -->
                <div class="card p-6 scroll-reveal group" style="animation-delay: 0.5s">
                    <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="bar-chart-3" class="w-6 h-6 text-accent"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2">Analytics Dashboard</h3>
                    <p class="text-fg-secondary text-sm">Track queries, sources, user satisfaction. See exactly which documents answer which questions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Widget Demo -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-bg-primary via-bg-secondary to-bg-primary"></div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="scroll-reveal">
                    <h2 class="font-display text-4xl md:text-5xl font-bold mb-6">Drop-in Widget.<br><span class="gradient-text">One Line of Code.</span></h2>
                    <p class="text-fg-secondary text-lg mb-8 leading-relaxed">
                        No complex integration. Just copy our script tag and your chatbot appears on your site, 
                        fully styled and contextually aware of your documentation.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-accent/20 flex items-center justify-center mt-1">
                                <i data-lucide="check" class="w-4 h-4 text-accent"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Auto-styled to match your brand</h4>
                                <p class="text-fg-muted text-sm">Inherits your CSS or customize with our theme builder</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-accent/20 flex items-center justify-center mt-1">
                                <i data-lucide="check" class="w-4 h-4 text-accent"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Source citations included</h4>
                                <p class="text-fg-muted text-sm">Every answer links back to the source document and page</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-accent/20 flex items-center justify-center mt-1">
                                <i data-lucide="check" class="w-4 h-4 text-accent"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Mobile-optimized</h4>
                                <p class="text-fg-muted text-sm">Responsive design that works perfectly on all devices</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="scroll-reveal relative">
                    <div class="code-block p-6 font-mono text-sm overflow-x-auto">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-border/50">
                            <span class="text-fg-muted">index.html</span>
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-danger/50"></div>
                                <div class="w-3 h-3 rounded-full bg-warning/50"></div>
                                <div class="w-3 h-3 rounded-full bg-accent/50"></div>
                            </div>
                        </div>
                        <pre class="text-fg-secondary leading-relaxed"><span class="text-purple">&lt;!-- Add this to your HTML --&gt;</span>
<span class="text-danger">&lt;script</span> 
  <span class="text-accent">src</span>=<span class="text-warning">"https://cdn.shuvarambha.ai/widget.js"</span>
  <span class="text-accent">data-project</span>=<span class="text-warning">"proj_123456"</span>
  <span class="text-accent">data-theme</span>=<span class="text-warning">"dark"</span>
<span class="text-danger">&gt;&lt;/script&gt;</span>

<span class="text-purple">&lt;!-- That's it. Chatbot appears automatically --&gt;</span></pre>
                    </div>
                    
                    <!-- Floating Widget Preview -->
                    <div class="absolute -bottom-8 -right-8 w-72 glass rounded-2xl p-4 shadow-2xl border border-accent/20 animate-float">
                        <div class="flex items-center gap-3 mb-3 pb-3 border-b border-border">
                            <div class="w-8 h-8 rounded-lg bg-accent flex items-center justify-center">
                                <i data-lucide="bot" class="w-5 h-5 text-bg-primary"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">Assistant</div>
                                <div class="text-xs text-accent flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse"></span>
                                    Online
                                </div>
                            </div>
                            <button class="ml-auto text-fg-muted hover:text-fg-primary">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="space-y-3">
                            <div class="bg-bg-elevated p-3 rounded-lg rounded-tl-none text-xs text-fg-secondary">
                                How do I reset my password?
                            </div>
                            <div class="bg-accent/10 border border-accent/20 p-3 rounded-lg rounded-tr-none text-xs">
                                <span class="text-fg-primary">You can reset your password by clicking "Forgot Password" on the login page. Check our <span class="text-accent underline">Getting Started Guide</span> for detailed steps.</span>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2 bg-bg-primary rounded-lg p-2 border border-border">
                            <input type="text" placeholder="Ask anything..." class="bg-transparent text-xs flex-1 outline-none text-fg-secondary w-full" disabled>
                            <button class="w-6 h-6 rounded bg-accent flex items-center justify-center">
                                <i data-lucide="send" class="w-3 h-3 text-bg-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-bg-secondary/50 border-y border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="scroll-reveal">
                    <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2 counter" data-target="500">0</div>
                    <div class="text-fg-secondary text-sm">Projects Created</div>
                </div>
                <div class="scroll-reveal" style="animation-delay: 0.1s">
                    <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2 counter" data-target="12">0</div>
                    <div class="text-fg-secondary text-sm">Million Documents</div>
                </div>
                <div class="scroll-reveal" style="animation-delay: 0.2s">
                    <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2 counter" data-target="99">0</div>
                    <div class="text-fg-secondary text-sm">% Uptime SLA</div>
                </div>
                <div class="scroll-reveal" style="animation-delay: 0.3s">
                    <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2 counter" data-target="50">0</div>
                    <div class="text-fg-secondary text-sm">ms Response Time</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-4">Loved by <span class="gradient-text">Developers</span></h2>
                <p class="text-fg-secondary text-lg">See what teams are saying about Shuvarambha</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="card p-6 scroll-reveal">
                    <div class="flex items-center gap-1 mb-4">
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                    </div>
                    <p class="text-fg-secondary text-sm mb-6 leading-relaxed">"We built a customer support bot for our 500+ page documentation in literally 10 minutes. The file-based approach is genius."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-accent to-purple flex items-center justify-center font-bold text-bg-primary">JD</div>
                        <div>
                            <div class="font-semibold text-sm">James Davidson</div>
                            <div class="text-fg-muted text-xs">CTO at TechFlow</div>
                        </div>
                    </div>
                </div>

                <div class="card p-6 scroll-reveal" style="animation-delay: 0.1s">
                    <div class="flex items-center gap-1 mb-4">
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                    </div>
                    <p class="text-fg-secondary text-sm mb-6 leading-relaxed">"Finally, a RAG solution that doesn't require a PhD to set up. The widget integration took 30 seconds. Our users love it."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple to-info flex items-center justify-center font-bold text-bg-primary">SK</div>
                        <div>
                            <div class="font-semibold text-sm">Sarah Kim</div>
                            <div class="text-fg-muted text-xs">Product Lead at StartupX</div>
                        </div>
                    </div>
                </div>

                <div class="card p-6 scroll-reveal" style="animation-delay: 0.2s">
                    <div class="flex items-center gap-1 mb-4">
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                        <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
                    </div>
                    <p class="text-fg-secondary text-sm mb-6 leading-relaxed">"We migrated from a complex self-hosted RAG pipeline. Shuvarambha handles everything and the results are actually better."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-info to-accent flex items-center justify-center font-bold text-bg-primary">MR</div>
                        <div>
                            <div class="font-semibold text-sm">Mike Ross</div>
                            <div class="text-fg-muted text-xs">Engineering Manager</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-accent/5 via-purple/5 to-accent/5"></div>
        <div class="absolute inset-0 grid-bg opacity-20"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 scroll-reveal">
            <h2 class="font-display text-4xl md:text-6xl font-bold mb-6">Ready to Build Your<br><span class="gradient-text">AI Assistant?</span></h2>
            <p class="text-fg-secondary text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                Join thousands of teams who've simplified their RAG workflow. 
                Start free, scale as you grow.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="btn-primary px-10 py-5 rounded-xl text-lg font-semibold flex items-center gap-3 glow-accent w-full sm:w-auto justify-center">
                    Get Started Free
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
                <button class="btn-secondary px-10 py-5 rounded-xl text-lg font-semibold flex items-center gap-3 w-full sm:w-auto justify-center">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    Book Demo
                </button>
            </div>
            
            <p class="text-fg-muted text-sm mt-6">No credit card required • Free tier includes 3 projects • Cancel anytime</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-bg-secondary border-t border-border pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent to-purple flex items-center justify-center">
                            <i data-lucide="bot" class="w-5 h-5 text-bg-primary"></i>
                        </div>
                        <span class="font-display font-bold text-xl">Shuvarambha</span>
                    </div>
                    <p class="text-fg-muted text-sm max-w-sm mb-6">
                        Making RAG-based chatbot development accessible to everyone. 
                        Built by developers, for developers.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-lg bg-bg-elevated border border-border flex items-center justify-center text-fg-muted hover:text-accent hover:border-accent transition-all">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-bg-elevated border border-border flex items-center justify-center text-fg-muted hover:text-accent hover:border-accent transition-all">
                            <i data-lucide="github" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-bg-elevated border border-border flex items-center justify-center text-fg-muted hover:text-accent hover:border-accent transition-all">
                            <i data-lucide="linkedin" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-bg-elevated border border-border flex items-center justify-center text-fg-muted hover:text-accent hover:border-accent transition-all">
                            <i data-lucide="youtube" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-fg-primary">Product</h4>
                    <ul class="space-y-3 text-sm text-fg-muted">
                        <li><a href="#" class="hover:text-accent transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">API Reference</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Changelog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-fg-primary">Company</h4>
                    <ul class="space-y-3 text-sm text-fg-muted">
                        <li><a href="#" class="hover:text-accent transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-accent transition-colors">Status</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-border pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-fg-muted text-sm">© 2024 Team Shuvarambha. All rights reserved.</p>
                <div class="flex gap-6 text-sm text-fg-muted">
                    <a href="#" class="hover:text-accent transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-accent transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-accent transition-colors">Cookie Settings</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#00d4aa' },
                shape: { type: 'circle' },
                opacity: { value: 0.1, random: true, anim: { enable: true, speed: 1, opacity_min: 0.05, sync: false } },
                size: { value: 3, random: true, anim: { enable: true, speed: 2, size_min: 0.1, sync: false } },
                line_linked: { enable: true, distance: 150, color: '#00d4aa', opacity: 0.05, width: 1 },
                move: { enable: true, speed: 1, direction: 'none', random: true, straight: false, out_mode: 'out', bounce: false }
            },
            interactivity: {
                detect_on: 'canvas',
                events: { onhover: { enable: true, mode: 'grab' }, onclick: { enable: true, mode: 'push' }, resize: true },
                modes: { grab: { distance: 140, line_linked: { opacity: 0.2 } }, push: { particles_nb: 4 } }
            },
            retina_detect: true
        });

        // GSAP ScrollTrigger Setup
        gsap.registerPlugin(ScrollTrigger);

        // Scroll Reveal Animations
        gsap.utils.toArray('.scroll-reveal').forEach((element, i) => {
            gsap.fromTo(element, 
                { opacity: 0, y: 30 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    delay: element.style.animationDelay ? parseFloat(element.style.animationDelay) : 0,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: element,
                        start: "top 85%",
                        toggleActions: "play none none reverse"
                    }
                }
            );
        });

        // Counter Animation
        gsap.utils.toArray('.counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            gsap.to(counter, {
                innerHTML: target,
                duration: 2,
                snap: { innerHTML: 1 },
                ease: "power2.out",
                scrollTrigger: {
                    trigger: counter,
                    start: "top 85%",
                    once: true
                }
            });
        });

        // Navbar Scroll Effect
        let lastScroll = 0;
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.classList.add('shadow-lg');
                navbar.style.background = 'rgba(10, 15, 26, 0.95)';
            } else {
                navbar.classList.remove('shadow-lg');
                navbar.style.background = 'rgba(10, 15, 26, 0.9)';
            }
            
            lastScroll = currentScroll;
        });

        // Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Typing Effect for Chat Demo
        const typingElements = document.querySelectorAll('.typing-cursor');
        typingElements.forEach(el => {
            const text = el.textContent;
            el.textContent = '';
            let i = 0;
            const typeInterval = setInterval(() => {
                if (i < text.length) {
                    el.textContent += text.charAt(i);
                    i++;
                } else {
                    clearInterval(typeInterval);
                }
            }, 50);
        });
    </script>
    <script src="http://127.0.0.1:8000/chat-widget.js?chatbot_id=1&token=52fbcb8bfed12d864f0bda93e099a5aa7ddb808e18ba035b0f0cf18c525327a4"></script>
</body>
</html>