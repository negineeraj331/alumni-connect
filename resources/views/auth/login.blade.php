<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login | Alumni Connect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface-variant": "#444934",
                        "tertiary-fixed": "#f7dcdc",
                        "outline": "#757962",
                        "secondary-fixed-dim": "#c3c7cb",
                        "secondary-container": "#dce0e4",
                        "outline-variant": "#c5c9ae",
                        "on-secondary-fixed": "#171c1f",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e5e2e1",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#add500",
                        "surface-container-high": "#eae7e7",
                        "on-primary-fixed": "#171e00",
                        "tertiary-container": "#ffeaea",
                        "on-error": "#ffffff",
                        "inverse-surface": "#313030",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#f3f0ef",
                        "on-background": "#1c1b1b",
                        "surface-tint": "#516600",
                        "surface-container-highest": "#e5e2e1",
                        "primary-container": "#d4ff3e",
                        "surface-bright": "#fcf9f8",
                        "on-primary-fixed-variant": "#3d4d00",
                        "on-primary": "#ffffff",
                        "surface": "#fcf9f8",
                        "inverse-primary": "#add500",
                        "surface-container": "#f0eded",
                        "on-primary-container": "#5d7400",
                        "background": "#fcf9f8",
                        "tertiary": "#6d5a5a",
                        "on-secondary-container": "#5e6367",
                        "secondary": "#5a5f62",
                        "on-surface": "#1c1b1b",
                        "primary-fixed": "#c8f230",
                        "on-tertiary-container": "#7b6767",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-container-low": "#f6f3f2",
                        "secondary-fixed": "#dfe3e7",
                        "primary": "#516600",
                        "on-secondary-fixed-variant": "#43474b",
                        "tertiary-fixed-dim": "#dac1c1",
                        "on-tertiary-fixed": "#261818",
                        "surface-dim": "#dcd9d9",
                        "on-tertiary-fixed-variant": "#544243"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "margin-desktop": "80px",
                        "unit": "8px",
                        "gutter": "24px",
                        "max-width": "1280px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "headline-lg": ["Inter"],
                        "display-xl": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "display-xl": ["72px", {"lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "label-sm": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-surface dark:bg-[#12140e] text-on-surface dark:text-[#e3e3e3] min-h-screen flex flex-col items-center">
<!-- Distinct Header Background -->
<div class="w-full bg-surface-container-high dark:bg-[#20241b] border-b border-outline-variant dark:border-[#444934] shadow-sm">
    <header class="px-margin-mobile md:px-margin-desktop py-5 max-w-max-width mx-auto flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
            <div class="bg-primary-container p-1 rounded-lg">
                <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
            </div>
            <span class="text-headline-md font-bold tracking-tight dark:text-white">Alumni Connect</span>
        </a>
        
        <div class="flex items-center gap-6">
            <a class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8] hover:text-on-surface transition-colors flex items-center gap-2" href="{{ route('register') }}">
            Don't have an account? <span class="text-primary font-bold hover:underline">Join Now</span>
        </a>
            <!-- Theme Toggle -->
            <button id="themeToggle" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container dark:hover:bg-gray-800 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.3)]">
                <span class="material-symbols-outlined dark:text-primary-container" id="themeIcon">dark_mode</span>
            </button>
        </div>
    </header>
</div>

<main class="flex-grow flex items-center justify-center w-full px-margin-mobile md:px-margin-desktop py-12 max-w-max-width mx-auto">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter w-full items-center">
<div class="hidden md:flex md:col-span-6 flex-col space-y-8 pr-12">
<h1 class="text-display-xl font-display-xl text-primary leading-tight">
                    Welcome <br/>Back.
                </h1>
<p class="text-body-lg font-body-lg text-secondary dark:text-[#a0a5a8] max-w-md">
                    Reconnect with your heritage, access exclusive mentorship, and grow your professional network within the Alumni Connect community.
                </p>
<div class="relative w-full aspect-square rounded-xl overflow-hidden bg-surface-container-low">
<img alt="Graduates collaborating" class="object-cover w-full h-full opacity-90" data-alt="A candid, warm-toned photograph of three diverse young professionals laughing and collaborating around a wooden table in a sun-drenched, modern university library." src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1100&q=80"/>
</div>
</div>
<div class="col-span-1 md:col-span-6 flex justify-center lg:justify-end">
<div class="w-full max-w-md flex flex-col">
<div class="w-full bg-surface-container-low dark:bg-[#1a1c16] p-8 md:p-12 rounded-3xl border border-outline-variant/30 dark:border-[#444934] dark:shadow-[0_0_20px_rgba(212,255,62,0.15)] relative">
<div class="mb-10 text-center md:text-left">
<a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
<span class="material-symbols-outlined text-primary text-3xl" data-icon="school">school</span>
<span class="text-headline-md font-headline-md font-bold text-on-surface dark:text-[#e3e3e3]">Alumni Connect</span>
</a>
<h2 class="text-headline-md font-headline-md text-on-surface mb-2">Secure Login</h2>
<p class="text-body-md font-body-md text-secondary dark:text-[#a0a5a8]">Please enter your credentials to continue.</p>
</div>

@if(session('error'))
<div class="bg-error-container text-on-error-container border border-error rounded-xl px-4 py-3 text-sm mb-6 flex items-center gap-2">
    <span class="material-symbols-outlined text-base">error</span>
    {{ session('error') }}
</div>
@endif

<form action="{{ route('login') }}" method="POST" class="space-y-6">
@csrf
<div>
<label class="block text-label-sm font-label-sm text-on-surface-variant dark:text-[#c4c8b9] mb-2" for="email">Email Address</label>
<input class="w-full px-4 py-3 bg-surface border @error('email') border-error @else border-outline dark:border-[#757962] @enderror rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all placeholder:text-secondary dark:text-[#a0a5a8]-fixed-dim" id="email" name="email" value="{{ old('email') }}" placeholder="alumni@university.edu" type="email" required autocomplete="email"/>
@error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
</div>
<div>
<div class="flex justify-between items-center mb-2">
<label class="block text-label-sm font-label-sm text-on-surface-variant dark:text-[#c4c8b9]" for="password">Password</label>
<a class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8] hover:text-primary transition-colors hover:underline" href="#">Forgot Password?</a>
</div>
<div class="relative">
<input class="w-full px-4 py-3 bg-surface border @error('password') border-error @else border-outline dark:border-[#757962] @enderror rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all placeholder:text-secondary dark:text-[#a0a5a8]-fixed-dim" id="password" name="password" placeholder="••••••••" type="password" required autocomplete="current-password"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary dark:text-[#a0a5a8] hover:text-on-surface dark:text-[#e3e3e3]" type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';">
<span class="material-symbols-outlined" data-icon="visibility">visibility</span>
</button>
</div>
@error('password')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
</div>
<div class="flex items-center space-x-2">
<input class="w-4 h-4 rounded border-outline dark:border-[#757962] text-primary focus:ring-primary" id="remember" name="remember" type="checkbox"/>
<label class="text-body-md font-body-md text-secondary dark:text-[#a0a5a8]" for="remember">Keep me logged in</label>
</div>
<button class="w-full py-4 bg-primary-container text-on-primary-container font-bold rounded-lg hover:brightness-95 transition-all flex items-center justify-center gap-2 group" type="submit">
<span>Sign In</span>
<span class="material-symbols-outlined transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
</button>
</form>

<div class="relative py-6">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-outline-variant dark:border-[#444934]"></div>
</div>
<div class="relative flex justify-center text-label-sm font-label-sm">
<span class="bg-surface-container-low dark:bg-[#1a1c16] px-4 text-secondary dark:text-[#a0a5a8]">Or login with</span>
</div>
</div>
<div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('oauth.redirect', ['provider' => 'google']) }}" class="flex items-center justify-center px-4 py-3 border border-outline dark:border-[#757962] rounded-lg hover:bg-surface transition-colors gap-2">
<svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
</svg>
<span class="text-label-sm font-label-sm text-on-surface dark:text-[#e3e3e3]">Google</span>
</a>

</div>
<div class="mt-8 text-center">
<p class="text-body-md font-body-md text-secondary dark:text-[#a0a5a8]">
                            Don't have an account? 
                            
        <a class="text-primary font-bold hover:underline transition-all" href="{{ route('register') }}">Join the Network</a>
</p>
</div>
</div> <!-- Close card -->

{{-- Demo Credentials (Now Outside the Card) --}}
<div class="mt-6 bg-primary-container/10 dark:bg-primary-container/20 rounded-xl border border-primary-container/30 p-5 text-sm w-full">
    <p class="font-bold text-on-primary-container mb-3 flex items-center gap-1.5">
        <span class="material-symbols-outlined text-base">info</span>
        Demo Accounts (pwd: <code class="bg-primary-container px-1 rounded text-primary">password</code>)
    </p>
    <div class="grid grid-cols-2 gap-2 text-xs text-on-primary-container">
        <div><strong>Admin:</strong> admin@alumni.test</div>
        <div><strong>Alumni:</strong> alumni@alumni.test</div>
        <div><strong>Student:</strong> student@alumni.test</div>
        <div><strong>Mentor:</strong> mentor@alumni.test</div>
        <div><strong>Organizer:</strong> organizer@alumni.test</div>
        <div><strong>Faculty:</strong> faculty@alumni.test</div>
    </div>
</div>

</div> <!-- Close max-w-md flex-col wrapper -->
</div>
</div>
</main>
<!-- Distinct Footer Background -->
<div class="w-full bg-surface-container-high dark:bg-[#20241b] border-t border-outline-variant dark:border-[#444934] mt-auto">
    <footer class="flex flex-col md:flex-row justify-between items-center w-full px-margin-desktop py-10 max-w-max-width mx-auto">
        <div class="mb-6 md:mb-0">
            <span class="text-headline-md font-headline-md font-bold text-on-surface dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-xl" data-icon="school">school</span>
                Alumni Connect
            </span>
            <p class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8] mt-2">© 2026 Alumni Connect. Building a modern heritage.</p>
        </div>
        <nav class="flex flex-wrap justify-center gap-8">
            <a class="{{ request()->routeIs('about') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('about') }}">About Us</a>
            <a class="{{ request()->routeIs('privacy') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('privacy') }}">Privacy Policy</a>
            <a class="{{ request()->routeIs('terms') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('terms') }}">Terms of Service</a>
            <a class="{{ request()->routeIs('cookies') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('cookies') }}">Cookie Policy</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('contact') }}">Contact</a>
            <a class="{{ request()->routeIs('guidelines') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('guidelines') }}">Community Guidelines</a>
        </nav>
    </footer>
</div>
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        // Check for saved theme preference or system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            if(themeIcon) themeIcon.textContent = 'light_mode';
        } else {
            html.classList.remove('dark');
            if(themeIcon) themeIcon.textContent = 'dark_mode';
        }

        // Toggle theme manually
        if(themeToggle) {
            themeToggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                if (html.classList.contains('dark')) {
                    localStorage.theme = 'dark';
                    themeIcon.textContent = 'light_mode';
                } else {
                    localStorage.theme = 'light';
                    themeIcon.textContent = 'dark_mode';
                }
            });
        }
    </script>
</body>
</html>
