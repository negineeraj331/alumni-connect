<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Alumni Connect — Bridge Your Future')</title>
    <meta name="description" content="@yield('meta_description', 'The exclusive digital bridge for ambitious graduates. Reconnect, mentor, grow.')">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary':           '#516600',
                        'primary-dark':      '#3d4d00',
                        'primary-container': '#d4ff3e',
                        'on-primary-container': '#5d7400',
                        'inverse-primary':   '#add500',
                        'surface':           '#fcf9f8',
                        'surface-low':       '#f6f3f2',
                        'surface-container': '#f0eded',
                        'surface-high':      '#eae7e7',
                        'surface-highest':   '#e5e2e1',
                        'surface-white':     '#ffffff',
                        'on-surface':        '#1c1b1b',
                        'secondary':         '#5a5f62',
                        'outline':           '#757962',
                        'outline-variant':   '#c5c9ae',
                        'error':             '#ba1a1a',
                        'tertiary':          '#6d5a5a',
                        'tertiary-container':'#ffeaea',
                        'secondary-container':'#dce0e4',
                        'on-secondary-container': '#5e6367',
                        'on-tertiary-container': '#7b6767',
                        'surface-variant':   '#e5e2e1',
                        "on-secondary-fixed-variant": "#43474b",
                        "primary-fixed": "#c8f230",
                        "on-primary-fixed-variant": "#3d4d00",
                        "surface-container-highest": "#e5e2e1",
                        "tertiary-fixed-dim": "#dac1c1",
                        "error-container": "#ffdad6",
                        "surface-container-high": "#eae7e7",
                        "secondary-fixed": "#dfe3e7",
                        "on-tertiary-fixed": "#261818",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#544243",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#313030",
                        "tertiary-fixed": "#f7dcdc",
                        "on-error-container": "#93000a",
                        "on-tertiary": "#ffffff",
                        "background": "#fcf9f8",
                        "surface-bright": "#fcf9f8",
                        "on-background": "#1c1b1b",
                        "on-primary-fixed": "#171e00",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#c3c7cb",
                        "surface-tint": "#516600",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#f3f0ef",
                        "surface-dim": "#dcd9d9",
                        "primary-fixed-dim": "#add500",
                        "on-secondary-fixed": "#171c1f",
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "display-xl": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg": ["Inter"]
                    },
                    borderRadius: {
                        'card': '1.5rem',
                        'card-lg': '2rem',
                        'card-xl': '2.5rem',
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "gutter": "24px",
                        "max-width": "1280px",
                        "unit": "8px",
                        "margin-mobile": "20px",
                        "margin-desktop": "80px"
                    },
                    fontSize: {
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "display-xl": ["72px", {"lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                        "label-sm": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "headline-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}]
                    },
                    animation: {
                        "fade-in": "fadeIn 0.3s ease-in-out"
                    },
                    keyframes: {
                        "fadeIn": {
                            "0%": { opacity: "0", transform: "translateY(-10px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcf9f8;
            color: #1c1b1b;
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        .dark body, body.dark {
            background-color: #0f1115;
            color: #e3e3e3;
        }
        html.dark {
            background-color: #0f1115;
        }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }

        /* ===== NAVIGATION ACTIVE STATE ===== */
        .nav-link {
            font-size: 0.875rem;
            font-weight: 600;
            color: #5a5f62;
            transition: color 0.2s, background-color 0.2s;
        }
        .dark .nav-link { color: #9ca3af; }
        .nav-link:hover { color: #1c1b1b; }
        .dark .nav-link:hover { color: #e3e3e3; }
        .nav-link.active {
            color: #1c1b1b;
            background-color: #d4ff3e !important;
            border-radius: 0.5rem;
            font-weight: 700;
        }
        .dark .nav-link.active {
            color: #0f1115;
            background-color: #d4ff3e !important;
            box-shadow: 0 0 12px rgba(212, 255, 62, 0.5);
        }

        /* ===== DARK THEME — LANDING PAGE STYLE ===== */
        html.dark body { background-color: #0f1115; color: #e3e3e3; }

        /* Dark nav */
        html.dark header.app-nav {
            background-color: rgba(15, 17, 21, 0.85) !important;
            border-color: rgba(212, 255, 62, 0.15) !important;
        }
        html.dark .app-nav .brand-name { color: #ffffff; }
        html.dark .app-nav .theme-btn { box-shadow: 0 0 12px rgba(212, 255, 62, 0.25); }
        html.dark .app-nav .theme-btn .material-symbols-outlined { color: #d4ff3e; }

        /* Dark cards — lime glow like landing page */
        html.dark .card,
        html.dark .reveal-card,
        html.dark .glowing-card {
            border-color: rgba(212, 255, 62, 0.2) !important;
            box-shadow: 0 0 15px rgba(212, 255, 62, 0.08);
        }
        html.dark .glowing-card:hover {
            border-color: rgba(212, 255, 62, 0.5) !important;
            box-shadow: 0 0 30px rgba(212, 255, 62, 0.2);
        }

        /* Surfaces in dark */
        html.dark .dark-surface { background-color: #1a1c21 !important; }
        html.dark .dark-bg { background-color: #0f1115 !important; }
        html.dark .dark-card { background-color: #1a1c21 !important; border-color: rgba(212,255,62,0.15) !important; }

        /* Dark bento/card borders glow */
        html.dark [class*="border-outline-variant"],
        html.dark [class*="border-[#444934]"] {
            border-color: rgba(212, 255, 62, 0.15) !important;
        }
        html.dark .border-glow-hover:hover {
            border-color: rgba(212, 255, 62, 0.4) !important;
            box-shadow: 0 0 20px rgba(212, 255, 62, 0.12);
        }

        /* Text glow for primary lime */
        html.dark .lime-glow-text {
            text-shadow: 0 0 12px rgba(212, 255, 62, 0.35);
        }

        /* Background panels in dark */
        html.dark .bg-surface-container-lowest,
        html.dark .bg-\[\#1a1c21\] { background-color: #1a1c21 !important; }
        html.dark .bg-surface-container-low,
        html.dark .bg-\[\#1a1c16\] { background-color: #161819 !important; }
        html.dark .bg-surface,
        html.dark .bg-\[\#12140e\] { background-color: #0f1115 !important; }
        html.dark .bg-surface-container,
        html.dark .bg-\[\#20241b\] { background-color: #1e2025 !important; }

        /* ===== BACKGROUND ANIMATION — FLOATING ORBS ===== */
        @keyframes orbFloat {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            33% { transform: translateY(-25px) translateX(12px); }
            66% { transform: translateY(10px) translateX(-15px); }
        }
        @keyframes orbPulse {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.08); }
        }
        .orb-1 { animation: orbFloat 12s ease-in-out infinite, orbPulse 8s ease-in-out infinite; }
        .orb-2 { animation: orbFloat 16s ease-in-out infinite reverse, orbPulse 10s ease-in-out infinite; animation-delay: -4s; }
        .orb-3 { animation: orbFloat 20s ease-in-out infinite, orbPulse 12s ease-in-out infinite; animation-delay: -8s; }

        /* ===== USER MENU DROPDOWN ===== */
        .user-menu-dropdown {
            transform: translateY(-8px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s cubic-bezier(0.22,1,0.36,1);
        }
        .user-menu-open .user-menu-dropdown {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
        /* Role avatar glow colors */
        .avatar-student  { background:#cceaf8; color:#0a5c82; box-shadow:0 0 14px rgba(100,180,230,0.55); }
        .avatar-alumni   { background:#d4ff3e; color:#3d4d00; box-shadow:0 0 14px rgba(212,255,62,0.55); }
        .avatar-faculty, .avatar-mentor { background:#fcd8e5; color:#8b1a45; box-shadow:0 0 14px rgba(230,100,150,0.55); }
        .avatar-organizer{ background:#fde4b8; color:#8b4a00; box-shadow:0 0 14px rgba(230,170,80,0.55); }
        .avatar-admin    { background:#e8d8fa; color:#5a2d8c; box-shadow:0 0 14px rgba(180,130,240,0.55); }
        .avatar-member   { background:#e8d8fa; color:#5a2d8c; box-shadow:0 0 14px rgba(180,130,240,0.55); }

        /* ===== CARDS / BUTTONS ===== */
        .reveal-card { transition: transform 0.4s cubic-bezier(0.22,1,0.36,1), box-shadow 0.4s ease; }
        .reveal-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.10); }
        .btn-primary {
            background: #1c1b1b; color: #fcf9f8;
            padding: 0.625rem 1.5rem; border-radius: 9999px;
            font-weight: 700; font-size: 0.875rem;
            transition: all 0.2s;
        }
        .btn-primary:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.2); transform: translateY(-2px); }
        .btn-accent {
            background: #d4ff3e; color: #3d4d00;
            padding: 0.625rem 1.5rem; border-radius: 9999px;
            font-weight: 700; font-size: 0.875rem;
            transition: all 0.2s;
        }
        .btn-accent:hover { opacity: 0.9; transform: scale(1.05); }
        html.dark .btn-accent { box-shadow: 0 0 16px rgba(212, 255, 62, 0.4); }
        .input-field {
            width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem;
            border: 1px solid #c5c9ae; background: #fff; color: #1c1b1b;
            font-size: 0.875rem; transition: all 0.2s;
        }
        html.dark .input-field { background: #1a1c21; border-color: rgba(212,255,62,0.2); color: #e3e3e3; }
        .input-field:focus { outline: none; border-color: #516600; box-shadow: 0 0 0 3px rgba(81,102,0,0.15); }
        html.dark .input-field:focus { border-color: #d4ff3e; box-shadow: 0 0 0 3px rgba(212,255,62,0.15); }
        .card { background: #fff; border-radius: 1.5rem; border: 1px solid #c5c9ae; }
        html.dark .card { background: #1a1c21; border-color: rgba(212,255,62,0.18); box-shadow: 0 0 15px rgba(212,255,62,0.06); }
        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 1rem; border-radius: 0.75rem;
            font-size: 0.875rem; font-weight: 600; color: #5a5f62;
            transition: all 0.2s;
        }
        .sidebar-link:hover { background: #f0eded; color: #1c1b1b; }
        html.dark .sidebar-link:hover { background: #1e2025; color: #e3e3e3; }
        .sidebar-link.active { background: #d4ff3e; color: #3d4d00; }
        html.dark .sidebar-link.active { box-shadow: 0 0 10px rgba(212,255,62,0.3); }
        .flash-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 0.75rem 1rem; border-radius: 0.75rem; font-size: 0.875rem; }
        .flash-error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.75rem 1rem; border-radius: 0.75rem; font-size: 0.875rem; }
    </style>
    @yield('head')
</head>
<body class="min-h-screen bg-surface dark:bg-[#0f1115] text-on-surface dark:text-[#e3e3e3] transition-colors duration-300">

{{-- ===== NAVIGATION ===== --}}
@auth
{{-- App Nav (authenticated) --}}
<header class="app-nav fixed top-0 left-0 right-0 z-50 bg-surface/85 dark:bg-[#0f1115]/85 backdrop-blur-md border-b border-outline-variant dark:border-[rgba(212,255,62,0.15)] transition-colors duration-300">
    <nav class="flex justify-between items-center max-w-screen-xl mx-auto px-6 py-3">
        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
            <div class="bg-primary-container p-1.5 rounded-lg group-hover:shadow-[0_0_12px_rgba(212,255,62,0.5)] transition-shadow">
                <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings:'FILL' 1">school</span>
            </div>
            <span class="brand-name text-lg font-bold tracking-tight text-on-surface dark:text-white">Alumni Connect</span>
        </a>

        {{-- Nav Links --}}
        <div class="hidden lg:flex items-center gap-1">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025] flex items-center gap-1">
                <span class="material-symbols-outlined text-[18px]">dashboard</span> Dashboard
            </a>
            <a href="{{ route('feed.index') }}"
               class="nav-link {{ request()->routeIs('feed.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025]">
               Feed
            </a>
            <a href="{{ route('profiles.index') }}"
               class="nav-link {{ request()->routeIs('profiles.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025]">
               Directory
            </a>
            <a href="{{ route('events.index') }}"
               class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025]">
               Events
            </a>
            <a href="{{ route('jobs.index') }}"
               class="nav-link {{ request()->routeIs('jobs.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025]">
               Jobs
            </a>
            <a href="{{ route('mentorship.index') }}"
               class="nav-link {{ request()->routeIs('mentorship.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025]">
               Mentorship
            </a>
            <a href="{{ route('messages.index') }}"
               class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025] flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">mail</span> Messages
                @php
                    $unreadCount = \App\Models\Message::where('receiver_id', Auth::id())->whereNull('read_at')->count();
                @endphp
                <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ $unreadCount > 0 ? 'bg-red-500 text-white animate-pulse' : 'bg-surface-container text-secondary dark:bg-[#1e2025] dark:text-gray-400' }}">
                    {{ $unreadCount }}
                </span>
            </a>
            @if(Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.index') }}"
               class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }} px-3 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025] text-error dark:text-red-400">
               Admin
            </a>
            @endif
        </div>

        {{-- Right Actions --}}
        <div class="flex items-center gap-2">
            {{-- Theme Toggle --}}
            <button id="theme-toggle"
                class="theme-btn p-2 rounded-full hover:bg-surface-container dark:hover:bg-[#1e2025] text-secondary dark:text-[#d4ff3e] transition-all duration-200 dark:shadow-[0_0_12px_rgba(212,255,62,0.2)] dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.35)]"
                title="Toggle Dark Mode">
                <span class="material-symbols-outlined text-xl" id="theme-icon">dark_mode</span>
            </button>

            {{-- User Menu --}}
            @php $navRole = Auth::user()->roles->first()?->name ?? 'member'; @endphp
            <div class="relative" id="user-menu-wrapper">
                {{-- Trigger: colored avatar circle + hamburger bars --}}
                <button id="user-menu-toggle"
                    class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-surface-container dark:hover:bg-[#1e2025] transition-all group"
                    aria-expanded="false" aria-haspopup="true">
                    {{-- Colored initial circle or custom avatar --}}
                    <div class="w-9 h-9 rounded-full overflow-hidden avatar-{{ $navRole }} flex items-center justify-center font-black text-sm select-none transition-transform group-hover:scale-105">
                        @if(Auth::user()->profile?->avatar_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile->avatar_path) }}" class="w-full h-full object-cover">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                    {{-- Three-bars icon --}}
                    <div class="flex flex-col gap-[4px] pr-1">
                        <span class="block w-4 h-[2px] bg-current text-secondary dark:text-gray-400 rounded-full"></span>
                        <span class="block w-3 h-[2px] bg-current text-secondary dark:text-gray-400 rounded-full"></span>
                        <span class="block w-4 h-[2px] bg-current text-secondary dark:text-gray-400 rounded-full"></span>
                    </div>
                </button>

                {{-- Dropdown Panel --}}
                <div class="user-menu-dropdown absolute right-0 top-full mt-3 w-60 bg-white dark:bg-[#1a1c21] rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.18)] shadow-xl dark:shadow-[0_8px_32px_rgba(212,255,62,0.12)] z-50 overflow-hidden">
                    {{-- User info header --}}
                    <div class="px-5 py-4 border-b border-outline-variant dark:border-[rgba(212,255,62,0.1)] flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden avatar-{{ $navRole }} flex items-center justify-center font-black text-xl flex-shrink-0">
                            @if(Auth::user()->profile?->avatar_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile->avatar_path) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr(Auth::user()->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="font-black text-on-surface dark:text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-secondary dark:text-gray-400 truncate capitalize">{{ $navRole }}</p>
                        </div>
                    </div>
                    {{-- Menu items --}}
                    <div class="p-2">
                        <a href="{{ route('profiles.show', Auth::id()) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-on-surface dark:text-[#e3e3e3] hover:bg-surface-container dark:hover:bg-[#1e2025] hover:text-primary dark:hover:text-[#d4ff3e] rounded-xl transition-all group">
                            <span class="material-symbols-outlined text-[20px] text-secondary dark:text-gray-400 group-hover:text-primary dark:group-hover:text-[#d4ff3e]" style="font-variation-settings:'FILL' 1">person</span>
                            View Profile
                        </a>
                        <a href="{{ route('profiles.edit', Auth::id()) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-on-surface dark:text-[#e3e3e3] hover:bg-surface-container dark:hover:bg-[#1e2025] hover:text-primary dark:hover:text-[#d4ff3e] rounded-xl transition-all group">
                            <span class="material-symbols-outlined text-[20px] text-secondary dark:text-gray-400 group-hover:text-primary dark:group-hover:text-[#d4ff3e]" style="font-variation-settings:'FILL' 1">settings</span>
                            Settings
                        </a>
                        <div class="border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)] my-1"></div>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-red-500 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all">
                                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">logout</span>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="pt-20 min-h-screen bg-surface dark:bg-[#0f1115] transition-colors duration-300">
    {{-- Standard content wrapper (not dashboards) --}}
    @unless(View::hasSection('full_content'))
    <div class="max-w-screen-xl mx-auto px-6 py-8">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="flash-success mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-green-600 text-base">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash-error mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-red-600 text-base">error</span>
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="flash-error mb-6">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
    @endunless

    {{-- Full-width dashboard/page content with animated background --}}
    @hasSection('full_content')
    <div class="relative min-h-[60vh] overflow-hidden">
        {{-- Animated Background Orbs --}}
        <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true">
            <div class="orb-1 absolute top-[8%] left-[5%] w-72 h-72 bg-primary-container/25 dark:bg-[rgba(212,255,62,0.07)] rounded-full blur-3xl"></div>
            <div class="orb-2 absolute top-[40%] right-[8%] w-96 h-96 bg-primary/10 dark:bg-[rgba(212,255,62,0.05)] rounded-full blur-3xl"></div>
            <div class="orb-3 absolute bottom-[5%] left-[30%] w-64 h-64 bg-primary-container/20 dark:bg-[rgba(212,255,62,0.06)] rounded-full blur-3xl"></div>
            <div class="orb-1 absolute bottom-[20%] right-[25%] w-48 h-48 bg-tertiary-container/30 dark:bg-[rgba(109,90,90,0.08)] rounded-full blur-2xl" style="animation-delay:-6s;"></div>
        </div>
        {{-- Actual page content --}}
        <div class="relative z-10">
            @yield('full_content')
        </div>
    </div>
    @endif
</main>

@else
{{-- Public Nav (guest) --}}
<header class="fixed top-0 left-0 right-0 z-50 bg-surface/85 dark:bg-[#0f1115]/85 backdrop-blur-md border-b border-outline-variant dark:border-[rgba(212,255,62,0.15)]">
    <nav class="flex justify-between items-center max-w-screen-xl mx-auto px-6 py-4">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2">
            <div class="bg-primary-container p-1.5 rounded-lg">
                <span class="material-symbols-outlined text-primary text-xl">school</span>
            </div>
            <span class="text-lg font-bold tracking-tight text-on-surface dark:text-white">Alumni Connect</span>
        </a>
        <div class="hidden lg:flex items-center gap-8">
            <a href="#mission" class="nav-link">Mission</a>
            <a href="#features" class="nav-link">Features</a>
            <a href="#testimonials" class="nav-link">Testimonials</a>
            <a href="#contact" class="nav-link">Contact</a>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="nav-link px-4 py-2 rounded-lg hover:bg-surface-container dark:hover:bg-[#1e2025]">Login</a>
            <a href="{{ route('register') }}" class="btn-accent dark:shadow-[0_0_16px_rgba(212,255,62,0.35)]">Join Now</a>
        </div>
    </nav>
</header>

<main class="pt-20">
    @yield('content')
</main>
@endauth

{{-- ===== FOOTER (auth pages) ===== --}}
@auth
<footer class="bg-surface-high dark:bg-[#0a0c10] border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)] mt-0 py-8">
    <div class="max-w-screen-xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-2">
            <div class="bg-primary-container p-1 rounded-lg dark:shadow-[0_0_8px_rgba(212,255,62,0.25)]">
                <span class="material-symbols-outlined text-primary text-base" style="font-variation-settings:'FILL' 1">school</span>
            </div>
            <span class="font-bold text-on-surface dark:text-white">Alumni Connect</span>
        </div>
        <p class="text-xs text-secondary dark:text-gray-500">© {{ date('Y') }} Alumni Connect. All rights reserved.</p>
        <div class="flex flex-wrap gap-4 text-xs text-secondary dark:text-gray-400">
            <a href="{{ route('about') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">About</a>
            <a href="{{ route('privacy') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Privacy</a>
            <a href="{{ route('contact') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Contact</a>
            <a href="{{ route('guidelines') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Guidelines</a>
        </div>
    </div>
</footer>
@endauth

{{-- ===== FOOTER (guest pages) ===== --}}
@guest
<footer class="bg-surface-high dark:bg-[#0f1115] border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)] pt-16 pb-8 mt-0" id="contact">
    <div class="max-w-screen-xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-primary-container p-1.5 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-xl">school</span>
                    </div>
                    <span class="text-xl font-bold text-on-surface dark:text-white">Alumni Connect</span>
                </div>
                <p class="text-secondary dark:text-gray-400 text-sm leading-relaxed max-w-xs">The exclusive digital bridge for the world's most ambitious graduates.</p>
            </div>
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-on-surface dark:text-white mb-4">Platform</h4>
                <ul class="space-y-2 text-sm text-secondary dark:text-gray-400">
                    <li><a href="{{ route('login') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Directory</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Mentorship</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Events</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-on-surface dark:text-white mb-4">Account</h4>
                <ul class="space-y-2 text-sm text-secondary dark:text-gray-400">
                    <li><a href="{{ route('login') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Sign In</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-on-surface dark:hover:text-white transition-colors">Register</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)] pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-secondary dark:text-gray-500 text-xs">© {{ date('Y') }} Alumni Connect. All rights reserved.</p>
            <p class="text-secondary dark:text-gray-500 text-xs">Built with ❤️ for lifelong learners.</p>
        </div>
    </div>
</footer>
@endguest

<script>
    // Scroll-reveal animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(24px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s cubic-bezier(0.22,1,0.36,1)';
        observer.observe(el);
    });
</script>
<script>
    // Dark Mode Toggle Logic — persists across pages
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    function applyTheme(dark) {
        if (dark) {
            document.documentElement.classList.add('dark');
            if (themeIcon) themeIcon.textContent = 'light_mode';
        } else {
            document.documentElement.classList.remove('dark');
            if (themeIcon) themeIcon.textContent = 'dark_mode';
        }
    }

    // Load saved preference
    const saved = localStorage.theme;
    if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        applyTheme(true);
    } else {
        applyTheme(false);
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
            const isDark = document.documentElement.classList.contains('dark');
            applyTheme(!isDark);
            localStorage.theme = isDark ? 'light' : 'dark';
        });
    }
</script>
<script>
    // ===== User Menu Dropdown =====
    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userMenuWrapper = document.getElementById('user-menu-wrapper');

    if (userMenuToggle && userMenuWrapper) {
        userMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = userMenuWrapper.classList.contains('user-menu-open');
            userMenuWrapper.classList.toggle('user-menu-open', !isOpen);
            userMenuToggle.setAttribute('aria-expanded', !isOpen);
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuWrapper.contains(e.target)) {
                userMenuWrapper.classList.remove('user-menu-open');
                userMenuToggle.setAttribute('aria-expanded', 'false');
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                userMenuWrapper.classList.remove('user-menu-open');
                userMenuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
</script>
<script>
    // Auto-dismiss flash messages after 2 seconds
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.flash-success, .flash-error').forEach(el => {
            el.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            setTimeout(() => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    el.remove();
                }, 500);
            }, 2000);
        });
    });
</script>
@if(Auth::check() && Auth::user()->hasRole('student'))
    {{-- Floating Micro-Illustration for Student --}}
    <div class="fixed bottom-6 left-6 z-40 pointer-events-none hidden md:block select-none" id="student-illustration">
        <div class="relative bg-white/80 dark:bg-[#1a1c21]/80 backdrop-blur-md p-3.5 rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.18)] shadow-lg dark:shadow-[0_0_15px_rgba(212,255,62,0.06)] flex items-center gap-3 animate-float duration-1000">
            <div class="relative w-10 h-10 flex items-center justify-center bg-primary-container dark:bg-[rgba(212,255,62,0.15)] text-primary dark:text-[#d4ff3e] rounded-xl overflow-hidden">
                <span class="material-symbols-outlined text-2xl animate-spin-slow">school</span>
                <span class="absolute w-1.5 h-1.5 rounded-full bg-[#d4ff3e] top-1 right-1 animate-ping"></span>
            </div>
            <div>
                <p class="text-[10px] font-black text-secondary dark:text-gray-500 uppercase tracking-widest leading-none mb-1">Student Space</p>
                <p class="text-xs font-extrabold text-on-surface dark:text-white leading-none">Learning &amp; Growing</p>
            </div>
            <div class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-primary/45 dark:bg-[#d4ff3e]/45 animate-bounce"></div>
            <div class="absolute -bottom-1 left-4 w-1.5 h-1.5 rounded-full bg-secondary/35 dark:bg-white/35 animate-ping" style="animation-delay: 1s;"></div>
        </div>
    </div>
    
    <style>
        @keyframes floatAnim {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(2deg); }
        }
        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        #student-illustration {
            animation: floatAnim 4s ease-in-out infinite;
        }
        .animate-spin-slow {
            animation: spinSlow 12s linear infinite;
        }
    </style>
@endif
</body>
</html>
