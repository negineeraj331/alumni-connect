<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Privacy Policy | Alumni Connect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface": "#fcf9f8",
                        "inverse-on-surface": "#f3f0ef",
                        "secondary": "#5a5f62",
                        "on-background": "#1c1b1b",
                        "outline-variant": "#c5c9ae",
                        "surface-container-low": "#f6f3f2",
                        "secondary-fixed-dim": "#c3c7cb",
                        "on-secondary": "#ffffff",
                        "background": "#fcf9f8",
                        "on-surface-variant": "#444934",
                        "tertiary-fixed": "#f7dcdc",
                        "surface-tint": "#516600",
                        "outline": "#757962",
                        "on-tertiary-fixed-variant": "#544243",
                        "inverse-surface": "#313030",
                        "error-container": "#ffdad6",
                        "tertiary": "#6d5a5a",
                        "inverse-primary": "#add500",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#dce0e4",
                        "surface-container": "#f0eded",
                        "on-tertiary-container": "#7b6767",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "surface-container-high": "#eae7e7",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#5e6367",
                        "on-error": "#ffffff",
                        "surface-variant": "#e5e2e1",
                        "secondary-fixed": "#dfe3e7",
                        "surface-bright": "#fcf9f8",
                        "on-primary-fixed": "#171e00",
                        "on-primary-container": "#5d7400",
                        "primary-fixed": "#c8f230",
                        "primary": "#516600",
                        "on-primary-fixed-variant": "#3d4d00",
                        "tertiary-fixed-dim": "#dac1c1",
                        "primary-container": "#d4ff3e",
                        "on-tertiary-fixed": "#261818",
                        "tertiary-container": "#ffeaea",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#171c1f",
                        "on-secondary-fixed-variant": "#43474b",
                        "primary-fixed-dim": "#add500",
                        "on-surface": "#1c1b1b",
                        "surface-container-highest": "#e5e2e1",
                        "surface-dim": "#dcd9d9"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "max-width": "1280px",
                        "margin-desktop": "80px",
                        "unit": "8px",
                        "margin-mobile": "20px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "display-xl": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-md": ["Inter"]
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
        .policy-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .policy-content li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-surface dark:bg-[#12140e] text-on-surface dark:text-[#e3e3e3] font-body-md antialiased">
<!-- TopAppBar -->
<header class="fixed top-0 z-50 w-full bg-surface dark:bg-[#1a1c16] border-b border-outline-variant dark:border-[#444934]">
<nav class="flex justify-between items-center w-full px-8 py-4 max-w-[1280px] mx-auto">
<a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
    <div class="bg-primary-container p-1 rounded-lg">
        <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
    </div>
    <span class="text-headline-md font-bold tracking-tight dark:text-white">Alumni Connect</span>
</a>
<div class="hidden md:flex items-center gap-8">
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Features</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Directory</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Mentorship</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Events</a>
</div>
<div class="flex items-center gap-4">
<a href="{{ route('login') }}" class="hidden md:block text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-transform active:scale-95">Login</a>
<a href="{{ route('register') }}" class="bg-primary-container text-on-primary-container px-6 py-2 rounded-full font-bold text-label-sm hover:opacity-90 transition-all active:scale-95">Get Started</a>
<button id="themeToggle" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container dark:hover:bg-gray-800 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.3)]">
    <span class="material-symbols-outlined dark:text-primary-container" id="themeIcon">dark_mode</span>
</button>
</div>
</nav>
</header>
<main class="pt-24 pb-24 px-4 md:px-0">
<!-- Hero Section -->
<section class="relative pt-16 pb-16 mb-16 overflow-hidden bg-surface-container-low dark:bg-[#1a1c21] rounded-b-[3rem] border-b border-outline-variant dark:border-[#444934]">
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-10 w-40 h-40 bg-primary-container/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-20 w-56 h-56 bg-primary/20 dark:bg-primary-container/20 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-[800px] mx-auto text-center relative z-10">
<div class="mb-10 flex justify-center">
<div class="relative w-48 h-48 md:w-64 md:h-64 rounded-full bg-tertiary-container flex items-center justify-center overflow-hidden dark:shadow-[0_0_20px_rgba(212,255,62,0.15)]">
<img class="w-3/4 h-3/4 object-contain" src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1100&q=80"/>
</div>
</div>
<h1 class="font-headline-lg text-headline-lg mb-6 text-on-surface dark:text-[#e3e3e3]">Privacy Policy</h1>
<p class="font-body-lg text-body-lg text-secondary dark:text-[#a0a5a8] max-w-2xl mx-auto">
                At Alumni Connect, we believe transparency is the foundation of community. This policy outlines how we protect your data while fostering professional growth.
            </p>
<div class="mt-8 flex justify-center gap-2 items-center text-label-sm text-secondary dark:text-[#a0a5a8]">
<span class="material-symbols-outlined text-[18px]" data-icon="history">history</span>
<span>Last Updated: October 24, 2024</span>
</div>
    </div>
</section>
<!-- Content Sections -->
<article class="max-w-[800px] mx-auto policy-content bg-surface-container-lowest dark:bg-[#12140e] md:p-12 p-6 rounded-[2.5rem] shadow-xl border border-outline-variant dark:border-[#444934] dark:shadow-[0_0_20px_rgba(212,255,62,0.05)] relative z-20 -mt-10">
<section class="mb-16 border-l-2 border-primary-container pl-8">
<h2 class="font-headline-md text-headline-md mb-6 text-on-surface dark:text-[#e3e3e3] flex items-center gap-3">
<span class="material-symbols-outlined text-primary" data-icon="database">database</span>
                    Data Collection
                </h2>
<p class="text-body-md mb-4 dark:text-[#a0a5a8]">
                    To provide a tailored networking experience, we collect specific information when you interact with our platform. This includes:
                </p>
<ul class="text-body-md text-secondary dark:text-[#a0a5a8]">
<li><strong>Account Information:</strong> Name, email address, graduation year, and professional credentials provided during registration.</li>
<li><strong>Profile Data:</strong> Career history, skills, mentorship interests, and community forum contributions.</li>
<li><strong>Usage Metadata:</strong> IP addresses, browser types, and platform interaction patterns gathered via secure logging.</li>
<li><strong>Communication:</strong> Records of messages sent through our mentorship portal to ensure platform safety.</li>
</ul>
</section>
<section class="mb-16 border-l-2 border-outline-variant dark:border-[#444934] pl-8">
<h2 class="font-headline-md text-headline-md mb-6 text-on-surface dark:text-[#e3e3e3] flex items-center gap-3">
<span class="material-symbols-outlined text-primary" data-icon="insight_glow">insight_spark</span>
                    Use of Information
                </h2>
<p class="text-body-md mb-4 dark:text-[#a0a5a8]">
                    Your information is used strictly to enhance the Alumni Connect experience:
                </p>
<ul class="text-body-md text-secondary dark:text-[#a0a5a8]">
<li>Facilitating mentorship matching based on shared academic backgrounds and career goals.</li>
<li>Notifying you of relevant alumni events, career opportunities, and community milestones.</li>
<li>Improving platform functionality through anonymized aggregate data analysis.</li>
<li>Maintaining a secure environment by preventing unauthorized access or fraudulent activity.</li>
</ul>
</section>
<!-- Interactive Callout Card -->
<div class="bg-surface-container-low dark:bg-[#1a1c16] p-10 rounded-xl mb-16 border border-outline-variant dark:border-[#444934] dark:shadow-[0_0_20px_rgba(212,255,62,0.15)]">
<h3 class="font-headline-md text-headline-md mb-4 text-on-surface dark:text-[#e3e3e3]">A Note on Your Privacy</h3>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] mb-6">
                    We never sell your personal data to third-party advertisers. Your professional journey belongs to you; we are simply the stewards of the connection.
                </p>
<div class="flex items-center gap-4">
<div class="h-10 w-10 rounded-full bg-primary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary-fixed" data-icon="lock" data-weight="fill">lock</span>
</div>
<span class="text-label-sm font-bold text-on-surface-variant dark:text-[#c4c8b9]">Encrypted &amp; Secure</span>
</div>
</div>
<section class="mb-16 border-l-2 border-outline-variant dark:border-[#444934] pl-8">
<h2 class="font-headline-md text-headline-md mb-6 text-on-surface dark:text-[#e3e3e3] flex items-center gap-3">
<span class="material-symbols-outlined text-primary" data-icon="person_check">person_check</span>
                    User Choice &amp; Rights
                </h2>
<p class="text-body-md mb-4 dark:text-[#a0a5a8]">
                    You maintain full control over your digital footprint within our ecosystem:
                </p>
<ul class="text-body-md text-secondary dark:text-[#a0a5a8]">
<li><strong>Profile Visibility:</strong> You can toggle your profile between Public, Alumni-Only, or Private at any time.</li>
<li><strong>Data Access:</strong> Request a complete export of your personal data stored on our servers.</li>
<li><strong>Right to Rectification:</strong> Update or correct your information directly through your account settings.</li>
<li><strong>Account Deletion:</strong> You may request permanent deletion of your account and associated data at any time.</li>
</ul>
</section>
<section class="mb-16 border-l-2 border-primary-container pl-8">
<h2 class="font-headline-md text-headline-md mb-6 text-on-surface dark:text-[#e3e3e3] flex items-center gap-3">
<span class="material-symbols-outlined text-primary" data-icon="shield_lock">shield_lock</span>
                    Data Security
                </h2>
<p class="text-body-md mb-6 text-secondary dark:text-[#a0a5a8]">
                    We employ industry-standard administrative, technical, and physical security measures to protect your information. This includes end-to-end encryption for private messaging, regular security audits, and strict access controls for our internal data processing systems.
                </p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="p-4 bg-surface dark:bg-[#12140e] rounded-lg border border-outline dark:border-[#757962]">
<span class="text-label-sm block mb-1 font-bold text-primary">Protocol</span>
<span class="text-body-md dark:text-[#e3e3e3]">TLS 1.3 Encryption</span>
</div>
<div class="p-4 bg-surface dark:bg-[#12140e] rounded-lg border border-outline dark:border-[#757962]">
<span class="text-label-sm block mb-1 font-bold text-primary">Storage</span>
<span class="text-body-md dark:text-[#e3e3e3]">SOC2 Compliant Servers</span>
</div>
</div>
</section>
<!-- Contact CTA -->
<section class="text-center py-12 border-t border-outline-variant dark:border-[#444934] mt-24">
<h2 class="font-headline-md text-headline-md mb-4 dark:text-[#e3e3e3]">Questions about your data?</h2>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] mb-8">Our privacy team is here to help you understand your rights and our responsibilities.</p>
<a class="inline-flex items-center gap-2 border-2 border-on-background dark:border-[#e3e3e3] px-8 py-3 rounded-full font-bold hover:bg-on-background hover:text-surface dark:hover:bg-[#e3e3e3] dark:hover:text-[#12140e] transition-all active:scale-95" href="{{ route('contact') }}">
                    Contact Privacy Office
                    <span class="material-symbols-outlined" data-icon="mail">mail</span>
</a>
</section>
</article>
</main>
<footer class="bg-surface-container-low dark:bg-[#20241b] border-t border-outline-variant dark:border-[#444934]">
<div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full px-margin-desktop py-12 max-w-max-width mx-auto gap-8">
<div class="flex flex-col gap-4">
<div class="text-headline-md font-headline-md font-bold text-on-surface dark:text-white flex items-center gap-2">
    <div class="bg-primary-container p-1 rounded-lg flex items-center justify-center">
    <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
</div>
    Alumni Connect
</div>
<p class="text-secondary dark:text-[#a0a5a8] text-body-md max-w-xs">© 2026 Alumni Connect. Building a modern heritage.</p>
</div>
<div class="flex flex-wrap gap-x-12 gap-y-4">
<a class="{{ request()->routeIs('about') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('about') }}">About Us</a>
<a class="{{ request()->routeIs('privacy') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('privacy') }}">Privacy Policy</a>
<a class="{{ request()->routeIs('terms') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('terms') }}">Terms of Service</a>
<a class="{{ request()->routeIs('cookies') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('cookies') }}">Cookie Policy</a>
<a class="{{ request()->routeIs('contact') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('contact') }}">Contact</a>
<a class="{{ request()->routeIs('guidelines') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('guidelines') }}">Community Guidelines</a>
</div>
</div>
</footer>
<script>
        // Simple scroll observer for subtle header shadow
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('shadow-sm');
                if(!document.documentElement.classList.contains('dark')) {
                    header.classList.replace('bg-surface', 'bg-surface/90');
                }
                header.style.backdropFilter = 'blur(8px)';
            } else {
                header.classList.remove('shadow-sm');
                if(!document.documentElement.classList.contains('dark')) {
                    header.classList.replace('bg-surface/90', 'bg-surface');
                }
                header.style.backdropFilter = 'none';
            }
        });
    </script>
<script>
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const html = document.documentElement;

    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
        if(themeIcon) themeIcon.textContent = 'light_mode';
    } else {
        html.classList.remove('dark');
        if(themeIcon) themeIcon.textContent = 'dark_mode';
    }

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