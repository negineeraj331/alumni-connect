<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
            },
            "fontSize": {
                    "display-xl": ["72px", {"lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                    "label-sm": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                    "headline-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .nav-active { border-bottom: 2px solid #516600; color: #516600; font-weight: 700; padding-bottom: 4px; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-surface dark:bg-[#12140e] text-on-surface dark:text-[#e3e3e3] font-body-md selection:bg-primary-container selection:text-on-primary-container">
<!-- TopAppBar -->
<header class="bg-surface dark:bg-[#1a1c16] sticky top-0 z-50 border-b border-outline-variant dark:border-[#444934]">
<div class="flex justify-between items-center w-full px-margin-desktop py-4 max-w-max-width mx-auto">
<a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
    <div class="bg-primary-container p-1 rounded-lg">
        <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
    </div>
    <span class="text-headline-md font-bold tracking-tight dark:text-white">Alumni Connect</span>
</a>
<nav class="hidden md:flex items-center gap-8">
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md hover:text-primary transition-colors duration-200" href="{{ route('register') }}">Features</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md hover:text-primary transition-colors duration-200" href="{{ route('register') }}">Directory</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md hover:text-primary transition-colors duration-200" href="{{ route('register') }}">Mentorship</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md hover:text-primary transition-colors duration-200" href="{{ route('register') }}">Events</a>
</nav>
<div class="flex items-center gap-4">
<a href="{{ route('login') }}" class="hidden md:block text-secondary dark:text-[#a0a5a8] font-body-md px-4 py-2 hover:text-on-surface transition-soft">Login</a>
<a href="{{ route('register') }}" class="bg-primary-container text-on-primary-container px-6 py-2 rounded-lg font-bold hover:scale-95 transition-transform duration-150">Get Started</a>
<button id="themeToggle" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container dark:hover:bg-gray-800 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.3)]">
    <span class="material-symbols-outlined dark:text-primary-container" id="themeIcon">dark_mode</span>
</button>
</div>
</div>
</header>
<main>
<!-- Hero Section -->
<section class="py-20 md:py-32 px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto flex flex-col md:flex-row items-center gap-16">
<div class="flex-1 space-y-6">
<div class="inline-flex items-center gap-2 bg-primary-container/30 px-4 py-1.5 rounded-full text-on-primary-container font-label-sm uppercase tracking-wider">
<span class="material-symbols-outlined text-sm" data-icon="shield">shield</span>
                    Community Standards
                </div>
<h1 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-on-surface dark:text-[#e3e3e3] leading-tight">
                    Building a space for <span class="text-primary italic">meaningful</span> growth.
                </h1>
<p class="text-body-lg text-secondary dark:text-[#a0a5a8] max-w-xl">
                    Our guidelines ensure that every member of the Alumni Connect network can learn, share, and grow in a professional environment built on mutual respect and excellence.
                </p>
</div>
<div class="flex-1 w-full max-w-[500px]">
<img alt="Mentorship Guidance Illustration" class="w-full h-auto rounded-xl shadow-lg border border-outline-variant/30" src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1100&q=80"/>
</div>
</section>
<!-- Core Guidelines Grid -->
<section class="py-24 bg-surface-container-low dark:bg-[#1a1c16]">
<div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop">
<div class="text-center mb-20">
<h2 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-4">The Pillars of our Network</h2>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] max-w-2xl mx-auto">These four principles form the foundation of every interaction within our alumni community.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Professionalism -->
<div class="bg-surface dark:bg-[#12140e] p-10 rounded-xl border-2 border-outline-variant dark:border-[#444934] hover:border-primary-fixed dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.2)] transition-soft group">
<div class="w-16 h-16 bg-primary-container flex items-center justify-center rounded-xl mb-6 group-hover:rotate-6 transition-transform">
<span class="material-symbols-outlined text-primary text-3xl" data-icon="work">work</span>
</div>
<h3 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-4">Professionalism</h3>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] mb-6 leading-relaxed">
                            Maintain a high standard of professional etiquette. Whether you're networking or mentoring, focus on providing value and constructive feedback.
                        </p>
<ul class="space-y-3">
<li class="flex items-center gap-3 text-on-surface-variant dark:text-[#c4c8b9] font-label-sm">
<span class="material-symbols-outlined text-primary text-sm" data-icon="check_circle">check_circle</span>
                                Use clear, business-appropriate language
                            </li>
<li class="flex items-center gap-3 text-on-surface-variant dark:text-[#c4c8b9] font-label-sm">
<span class="material-symbols-outlined text-primary text-sm" data-icon="check_circle">check_circle</span>
                                Honor your meeting commitments
                            </li>
</ul>
</div>
<!-- Respect -->
<div class="bg-surface dark:bg-[#12140e] p-10 rounded-xl border-2 border-outline-variant dark:border-[#444934] hover:border-primary-fixed dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.2)] transition-soft group">
<div class="w-16 h-16 bg-tertiary-container dark:bg-[#544243] flex items-center justify-center rounded-xl mb-6 group-hover:rotate-6 transition-transform">
<span class="material-symbols-outlined text-tertiary dark:text-[#ffdad6] text-3xl" data-icon="favorite">favorite</span>
</div>
<h3 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-4">Respect</h3>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] mb-6 leading-relaxed">
                            Diverse backgrounds and opinions are our strength. Treat every member with dignity, regardless of their career stage or identity.
                        </p>
<ul class="space-y-3">
<li class="flex items-center gap-3 text-on-surface-variant dark:text-[#c4c8b9] font-label-sm">
<span class="material-symbols-outlined text-tertiary dark:text-[#ffdad6] text-sm" data-icon="check_circle">check_circle</span>
                                Practice active listening
                            </li>
<li class="flex items-center gap-3 text-on-surface-variant dark:text-[#c4c8b9] font-label-sm">
<span class="material-symbols-outlined text-tertiary dark:text-[#ffdad6] text-sm" data-icon="check_circle">check_circle</span>
                                Value time and boundaries of others
                            </li>
</ul>
</div>
<!-- Safety -->
<div class="bg-surface dark:bg-[#12140e] p-10 rounded-xl border-2 border-outline-variant dark:border-[#444934] hover:border-primary-fixed dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.2)] transition-soft group">
<div class="w-16 h-16 bg-secondary-container dark:bg-[#43474b] flex items-center justify-center rounded-xl mb-6 group-hover:rotate-6 transition-transform">
<span class="material-symbols-outlined text-secondary dark:text-[#dfe3e7] text-3xl" data-icon="verified_user">verified_user</span>
</div>
<h3 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-4">Safety</h3>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] mb-6 leading-relaxed">
                            Protect the privacy of fellow alumni. Sharing sensitive information, harassment, or unsolicited solicitation is strictly prohibited.
                        </p>
<ul class="space-y-3">
<li class="flex items-center gap-3 text-on-surface-variant dark:text-[#c4c8b9] font-label-sm">
<span class="material-symbols-outlined text-secondary dark:text-[#dfe3e7] text-sm" data-icon="check_circle">check_circle</span>
                                Keep contact details confidential
                            </li>
<li class="flex items-center gap-3 text-on-surface-variant dark:text-[#c4c8b9] font-label-sm">
<span class="material-symbols-outlined text-secondary dark:text-[#dfe3e7] text-sm" data-icon="check_circle">check_circle</span>
                                Report suspicious behavior immediately
                            </li>
</ul>
</div>
<!-- Growth & Reporting -->
<div class="bg-surface dark:bg-[#12140e] p-10 rounded-xl border-2 border-outline-variant dark:border-[#444934] hover:border-primary-fixed dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.2)] transition-soft group">
<div class="w-16 h-16 bg-primary-fixed flex items-center justify-center rounded-xl mb-6 group-hover:rotate-6 transition-transform">
<span class="material-symbols-outlined text-on-primary-fixed text-3xl" data-icon="flag">flag</span>
</div>
<h3 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-4">Accountability</h3>
<p class="text-body-md text-secondary dark:text-[#a0a5a8] mb-6 leading-relaxed">
                            We take our community health seriously. Guidelines are enforced consistently to ensure a safe space for all members to thrive.
                        </p>
<button class="flex items-center gap-2 text-primary font-bold hover:underline">
                            Learn about reporting
                            <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- High Priority Rules (The Firm Tone) -->
<section class="py-24 px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto">
<div class="bg-primary-fixed/10 p-8 md:p-16 rounded-3xl border border-primary-fixed/20 relative overflow-hidden">
<div class="absolute top-0 right-0 p-8 opacity-10">
<span class="material-symbols-outlined text-8xl" data-icon="policy">policy</span>
</div>
<div class="relative z-10 max-w-3xl">
<h2 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-8">Zero-Tolerance Policies</h2>
<div class="space-y-8">
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-on-primary-fixed">1</div>
<div>
<h4 class="text-body-md font-bold mb-2">No Harassment or Bullying</h4>
<p class="text-body-md text-secondary dark:text-[#a0a5a8]">Any form of discrimination, hate speech, or targeted harassment will result in immediate and permanent account suspension without warning.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-on-primary-fixed">2</div>
<div>
<h4 class="text-body-md font-bold mb-2">No Spam or Commercial Solicitations</h4>
<p class="text-body-md text-secondary dark:text-[#a0a5a8]">This network is for peer connection and mentorship. Do not use the directory for cold sales or unrelated business promotions.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-on-primary-fixed">3</div>
<div>
<h4 class="text-body-md font-bold mb-2">Respect Confidentiality</h4>
<p class="text-body-md text-secondary dark:text-[#a0a5a8]">Discussions within the Mentorship program are private. Do not share proprietary information or personal stories outside the platform.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Reporting Section -->
<section class="py-24 bg-surface dark:bg-[#12140e]">
<div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
<div>
<h2 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-6">Something doesn't feel right?</h2>
<p class="text-body-lg text-secondary dark:text-[#a0a5a8] mb-8 leading-relaxed">
                        If you experience or witness behavior that violates these guidelines, please let us know. We handle every report with confidentiality and care.
                    </p>
<div class="space-y-4">
<div class="flex items-center gap-4 p-4 bg-surface-container-low dark:bg-[#1a1c16] rounded-xl border border-outline-variant dark:border-[#444934]">
<span class="material-symbols-outlined text-primary" data-icon="mail">mail</span>
<div>
<p class="font-bold dark:text-[#e3e3e3]">Email our Trust &amp; Safety team</p>
<p class="text-label-sm text-secondary dark:text-[#a0a5a8]">safety@alumniconnect.edu</p>
</div>
</div>
<div class="flex items-center gap-4 p-4 bg-surface-container-low dark:bg-[#1a1c16] rounded-xl border border-outline-variant dark:border-[#444934]">
<span class="material-symbols-outlined text-primary" data-icon="report">report</span>
<div>
<p class="font-bold dark:text-[#e3e3e3]">In-App Reporting</p>
<p class="text-label-sm text-secondary dark:text-[#a0a5a8]">Use the 'Report' button on any profile or post.</p>
</div>
</div>
</div>
</div>
<div class="bg-white dark:bg-[#1a1c16] p-8 md:p-12 rounded-2xl shadow-xl border border-outline-variant/30 dark:border-[#444934]">
<h3 class="text-headline-md font-headline-md mb-6 dark:text-[#e3e3e3]">Quick Report Form</h3>
<form class="space-y-6">
<div>
<label class="block text-label-sm text-secondary dark:text-[#a0a5a8] mb-2">Subject of Concern</label>
<input class="w-full px-4 py-3 rounded-lg border border-outline dark:border-[#757962] bg-transparent focus:ring-2 focus:ring-primary-fixed focus:border-primary-fixed transition-soft outline-none dark:text-[#e3e3e3]" placeholder="e.g. Inappropriate comment" type="text"/>
</div>
<div>
<label class="block text-label-sm text-secondary dark:text-[#a0a5a8] mb-2">Detailed Description</label>
<textarea class="w-full px-4 py-3 rounded-lg border border-outline dark:border-[#757962] bg-transparent focus:ring-2 focus:ring-primary-fixed focus:border-primary-fixed transition-soft outline-none dark:text-[#e3e3e3]" placeholder="Please describe the incident..." rows="4"></textarea>
</div>
<button class="w-full bg-on-background dark:bg-[#c8f230] text-surface dark:text-[#171e00] py-4 rounded-xl font-bold hover:bg-primary transition-soft" type="button">
                            Submit Secure Report
                        </button>
</form>
</div>
</div>
</section>
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
        // Simple dark mode toggle simulation
        const darkModeBtn = document.querySelector('[data-icon="dark_mode"]');
        darkModeBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            darkModeBtn.innerText = document.documentElement.classList.contains('dark') ? 'light_mode' : 'dark_mode';
        });

        // Add subtle hover effect for cards
        const cards = document.querySelectorAll('.bg-surface.p-10');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
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