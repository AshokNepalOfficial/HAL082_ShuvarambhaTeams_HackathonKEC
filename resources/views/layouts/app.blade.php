<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Space Grotesk', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
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
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-primary);
            color: var(--fg-primary);
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
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
        }

        .card-elevated {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--fg-muted);
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes drawLine {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-in {
            animation: fadeSlideUp 0.5s ease-out forwards;
        }

        .stagger-1 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .stagger-2 {
            animation-delay: 0.2s;
            opacity: 0;
        }

        .stagger-3 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        .stagger-4 {
            animation-delay: 0.4s;
            opacity: 0;
        }

        @media (prefers-reduced-motion: reduce) {
            .animate-in {
                animation: none;
                opacity: 1;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 256px;
            z-index: 150;
            transition: transform 0.3s ease;
        }

        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(10, 15, 26, 0.7);
            z-index: 140;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        @media (min-width: 1024px) {
            .sidebar-overlay {
                display: none;
            }
        }

        .main-content {
            margin-left: 0;
            min-height: 100vh;
        }

        @media (min-width: 1024px) {
            .main-content {
                margin-left: 256px;
            }
        }

        /* Components */
        .nav-item {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--fg-secondary);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .nav-item:hover {
            color: var(--fg-primary);
            background: var(--bg-elevated);
        }

        .nav-item.active {
            color: var(--accent);
            background: rgba(0, 212, 170, 0.1);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--accent);
            border-radius: 0 4px 4px 0;
        }

        .input-field {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--fg-primary);
            transition: all 0.2s ease;
            width: 100%;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .btn-primary {
            background: var(--accent);
            color: var(--bg-primary);
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: var(--accent-dim);
            transform: translateY(-1px);
            box-shadow: 0 4px 20px var(--accent-glow);
        }

        .btn-ghost {
            background: transparent;
            color: var(--fg-secondary);
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .btn-ghost:hover {
            background: var(--bg-elevated);
            color: var(--fg-primary);
            border-color: var(--fg-muted);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 200px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 100;
        }

        .dropdown-menu.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--fg-secondary);
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--bg-elevated);
            color: var(--fg-primary);
        }

        .toggle-switch {
            width: 48px;
            height: 26px;
            background: var(--bg-elevated);
            border-radius: 13px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-switch.active {
            background: var(--accent);
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: var(--fg-primary);
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: transform 0.3s ease;
        }

        .toggle-switch.active::after {
            transform: translateX(22px);
        }

        .chart-line {
            fill: none;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: drawLine 2s ease-out forwards;
        }

        .chart-area {
            stroke: none;
            opacity: 0;
            animation: fadeIn 1s ease-out 0.5s forwards;
        }

        .view-section {
            display: none;
        }

        .view-section.active {
            display: block;
        }

        .focus-ring:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px var(--accent-glow);
        }










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
</head>

<body class="bg-pattern min-h-screen">
    @include('layouts.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        @include('layouts.topbar')

        {{ $slot }}
    </div>

    <!-- Toast Container -->
    <div class="fixed bottom-4 right-4 z-300 flex flex-col gap-2" id="toastContainer"></div>
</body>

</html>