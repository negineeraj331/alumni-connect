<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>About Us | Alumni Connect</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                }
            }
        }
    </script>
<style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .text-balance { text-wrap: balance; }
        
        /* Custom scroll behavior */
        html { scroll-behavior: smooth; }

        /* Animation for team cards */
        .team-card:hover .team-overlay {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden bg-surface dark:bg-[#12140e] text-on-surface dark:text-[#e3e3e3]">
<!-- TopAppBar -->
<header class="bg-surface dark:bg-[#1a1c16] fixed top-0 left-0 right-0 z-50 border-b border-outline-variant dark:border-[#444934]">
<nav class="flex justify-between items-center w-full px-margin-desktop py-4 max-w-max-width mx-auto">
<a class="flex items-center gap-2 text-headline-md font-headline-md font-bold text-on-surface dark:text-white" href="{{ route('welcome') }}">
    <div class="bg-primary-container p-1 rounded-lg flex items-center justify-center">
    <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
</div>
    Alumni Connect
</a>
<!-- Desktop Nav -->
<div class="hidden md:flex items-center gap-8">
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Features</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Directory</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Mentorship</a>
<a class="text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md transition-colors duration-200" href="{{ route('register') }}">Events</a>
</div>
<div class="flex items-center gap-4">
<a href="{{ route('login') }}" class="hidden md:block text-secondary dark:text-[#a0a5a8] hover:text-on-surface font-body-md">Login</a>
<a href="{{ route('register') }}" class="bg-primary-container text-on-primary-container px-6 py-2 rounded-full font-bold hover:scale-95 transition-transform duration-150">Get Started</a>
<button id="themeToggle" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container dark:hover:bg-gray-800 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.3)]">
    <span class="material-symbols-outlined dark:text-primary-container" id="themeIcon">dark_mode</span>
</button>
</div>
</nav>
</header>
<!-- Hero Section -->
<main class="pt-24">
<section class="relative w-full overflow-hidden bg-surface-container-low dark:bg-[#1a1c16]">
<div class="max-w-max-width mx-auto px-margin-desktop py-20 md:py-32 grid md:grid-cols-2 gap-12 items-center">
<div class="z-10">
<span class="inline-block px-4 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm mb-6 uppercase tracking-wider">Our Story</span>
<h1 class="font-display-xl text-display-xl text-on-surface dark:text-[#e3e3e3] mb-8 leading-tight">Bridging the gap from <span class="text-primary italic">Campus</span> to <span class="text-primary italic">Career</span>.</h1>
<p class="font-body-lg text-body-lg text-secondary dark:text-[#a0a5a8] mb-10 max-w-lg">Alumni Connect was born from a simple realization: the journey doesn't end at graduation, but for many, the path forward is unclear. We built a bridge for heritage to meet future ambition.</p>
<div class="flex gap-4">
<a class="bg-primary text-on-primary px-8 py-4 rounded-lg font-bold hover:opacity-90 transition-all flex items-center gap-2" href="#vision">
                            Explore our Vision <span class="material-symbols-outlined">arrow_downward</span>
</a>
</div>
</div>
<div class="relative group">
<div class="absolute -inset-4 bg-primary-container rounded-[2rem] rotate-3 opacity-20 group-hover:rotate-1 transition-transform"></div>
<img alt="" class="relative rounded-2xl shadow-2xl w-full h-auto object-cover transform transition-transform duration-500 group-hover:scale-[1.02] dark:shadow-[0_0_20px_rgba(212,255,62,0.15)]" src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1100&q=80"/>
</div>
</div>
</section>
<!-- Founding Story Section (Bento Style) -->
<section class="py-24 bg-surface dark:bg-[#12140e]">
<div class="max-w-max-width mx-auto px-margin-desktop">
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="md:col-span-2 bg-surface-container-lowest dark:bg-[#1a1c16] p-12 rounded-3xl border border-outline-variant dark:border-[#444934] flex flex-col justify-center dark:hover:shadow-[0_0_15px_rgba(212,255,62,0.15)] transition-shadow">
<h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-[#e3e3e3] mb-6">Why we started.</h2>
<p class="font-body-md text-body-md text-secondary dark:text-[#a0a5a8] mb-4 leading-relaxed">In 2021, we noticed a recurring pattern. Brilliant graduates were struggling to navigate the corporate landscape despite having the technical skills. Meanwhile, seasoned alumni were eager to give back but lacked an accessible platform to share their wisdom.</p>
<p class="font-body-md text-body-md text-secondary dark:text-[#a0a5a8] leading-relaxed">We created Alumni Connect to turn "who you know" into a democratic resource for every student, regardless of their background or major. It’s about building a modern heritage that values mentorship as much as the diploma itself.</p>
</div>
<div class="bg-primary-container p-12 rounded-3xl flex flex-col items-center justify-center text-center dark:hover:shadow-[0_0_15px_rgba(212,255,62,0.15)] transition-shadow">
<span class="material-symbols-outlined text-6xl text-on-primary-container mb-6">diversity_3</span>
<div class="text-4xl font-extrabold text-on-primary-container mb-2">50k+</div>
<div class="text-on-primary-container font-label-sm opacity-80 uppercase tracking-widest">Active Mentors</div>
</div>
<div class="bg-tertiary-container dark:bg-[#544243] p-12 rounded-3xl flex flex-col items-center justify-center text-center dark:hover:shadow-[0_0_15px_rgba(212,255,62,0.15)] transition-shadow">
<span class="material-symbols-outlined text-6xl text-tertiary dark:text-[#ffdad6] mb-6">rocket_launch</span>
<div class="text-4xl font-extrabold text-tertiary dark:text-[#ffdad6] mb-2">85%</div>
<div class="text-tertiary dark:text-[#ffdad6] font-label-sm opacity-80 uppercase tracking-widest">Career Placement</div>
</div>
<div class="md:col-span-2 bg-secondary-container dark:bg-[#43474b] p-12 rounded-3xl border border-outline-variant dark:border-[#444934] flex items-center justify-between dark:hover:shadow-[0_0_15px_rgba(212,255,62,0.15)] transition-shadow">
<div class="max-w-md">
<h3 class="font-headline-md text-headline-md text-on-secondary-container dark:text-white mb-2">Join the Movement</h3>
<p class="text-on-secondary-container dark:text-[#e3e3e3] opacity-80">Be part of the fastest-growing professional network for high-value alumni connections.</p>
</div>
<span class="material-symbols-outlined text-4xl text-on-secondary-container dark:text-[#e3e3e3]">trending_up</span>
</div>
</div>
</div>
</section>
<!-- Vision & Mission -->
<section class="py-24 bg-surface-container-low dark:bg-[#1a1c16]" id="vision">
<div class="max-w-max-width mx-auto px-margin-desktop grid md:grid-cols-2 gap-16">
<div class="relative p-10 bg-surface-container-lowest dark:bg-[#12140e] rounded-3xl border-2 border-primary overflow-hidden dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.2)] transition-shadow">
<div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container rounded-full opacity-30"></div>
<div class="relative z-10">
<div class="w-16 h-16 bg-primary-container rounded-xl flex items-center justify-center mb-8">
<span class="material-symbols-outlined text-on-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">visibility</span>
</div>
<h3 class="font-headline-lg text-headline-lg dark:text-[#e3e3e3] mb-6">Our Vision</h3>
<p class="font-body-lg text-body-lg text-secondary dark:text-[#a0a5a8] leading-relaxed">To create a world where professional success is defined by collective wisdom, where the transition from education to career is a seamless journey of discovery and growth for everyone.</p>
</div>
</div>
<div class="relative p-10 bg-surface-container-lowest dark:bg-[#12140e] rounded-3xl border-2 border-outline-variant dark:border-[#444934] overflow-hidden dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.2)] transition-shadow">
<div class="absolute -bottom-10 -left-10 w-40 h-40 bg-secondary-fixed rounded-full opacity-20"></div>
<div class="relative z-10">
<div class="w-16 h-16 bg-secondary-container dark:bg-[#43474b] rounded-xl flex items-center justify-center mb-8">
<span class="material-symbols-outlined text-on-secondary-container dark:text-[#e3e3e3] text-3xl" style="font-variation-settings: 'FILL' 1;">track_changes</span>
</div>
<h3 class="font-headline-lg text-headline-lg dark:text-[#e3e3e3] mb-6">Our Mission</h3>
<p class="font-body-lg text-body-lg text-secondary dark:text-[#a0a5a8] leading-relaxed">Our mission is to empower the next generation of leaders by providing an intelligent, human-centric platform that facilitates high-value mentorship and professional networking.</p>
</div>
</div>
</div>
</section>
<!-- Meet the Team -->
<section class="py-32 bg-surface dark:bg-[#12140e]">
<div class="max-w-max-width mx-auto px-margin-desktop">
<div class="text-center mb-20">
<h2 class="font-headline-lg text-headline-lg dark:text-[#e3e3e3] mb-4">Meet the Visionaries</h2>
<p class="font-body-md text-body-md text-secondary dark:text-[#a0a5a8] max-w-2xl mx-auto">A team of dedicated educators, engineers, and community builders working together to redefine professional networking.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
<!-- Team Member 1 -->
<div class="group">
<div class="relative overflow-hidden rounded-2xl aspect-square mb-6">
<img alt="" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1100&q=80"/>
<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
</div>
<h4 class="font-headline-md text-headline-md dark:text-[#e3e3e3] mb-1">Dr. Sarah Chen</h4>
<p class="text-primary font-bold text-label-sm uppercase mb-3">Founder &amp; CEO</p>
<p class="text-secondary dark:text-[#a0a5a8] text-body-md">Sarah spent 10 years in higher education research, focusing on career outcomes for first-gen students.</p>
</div>
<!-- Team Member 2 -->
<div class="group">
<div class="relative overflow-hidden rounded-2xl aspect-square mb-6">
<img alt="" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1100&q=80"/>
<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
</div>
<h4 class="font-headline-md text-headline-md dark:text-[#e3e3e3] mb-1">Marcus Thorne</h4>
<p class="text-primary font-bold text-label-sm uppercase mb-3">Head of Community</p>
<p class="text-secondary dark:text-[#a0a5a8] text-body-md">A former HR director at a Fortune 500 company, Marcus knows exactly what employers are looking for.</p>
</div>
<!-- Team Member 3 (Placeholder for variety) -->
<div class="group">
<div class="relative overflow-hidden rounded-2xl aspect-square mb-6 bg-surface-container-high dark:bg-[#1a1c16] flex items-center justify-center">
<img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" data-alt="Professional headshot of an Asian woman in her late 20s, wearing a modern blazer, smiling warmly in a bright, airy office environment. The lighting is natural and flattering, emphasizing a professional and approachable mood. The aesthetic is clean and minimalist, aligning with a high-end corporate networking platform." src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1100&q=80"/>
</div>
<h4 class="font-headline-md text-headline-md dark:text-[#e3e3e3] mb-1">Elena Ruiz</h4>
<p class="text-primary font-bold text-label-sm uppercase mb-3">CTO</p>
<p class="text-secondary dark:text-[#a0a5a8] text-body-md">Elena is the architect behind our matching algorithm, ensuring every connection is meaningful.</p>
</div>
<!-- Team Member 4 (Placeholder for variety) -->
<div class="group">
<div class="relative overflow-hidden rounded-2xl aspect-square mb-6 bg-surface-container-high dark:bg-[#1a1c16] flex items-center justify-center">
<img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" data-alt="Professional headshot of a middle-aged Black man with a confident expression, wearing a high-quality navy suit against a soft-focus architectural background. The image has a sophisticated, premium look with warm lighting and a sharp focus on his features, evoking a sense of leadership and trust." src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1100&q=80"/>
</div>
<h4 class="font-headline-md text-headline-md dark:text-[#e3e3e3] mb-1">David Okafor</h4>
<p class="text-primary font-bold text-label-sm uppercase mb-3">Product Lead</p>
<p class="text-secondary dark:text-[#a0a5a8] text-body-md">David focuses on user experience, making sure the platform is as intuitive as it is powerful.</p>
</div>
</div>
</div>
</section>
<!-- CTA Section -->
<section class="py-24">
<div class="max-w-max-width mx-auto px-margin-desktop">
<div class="bg-primary-container rounded-[3rem] p-16 text-center relative overflow-hidden dark:shadow-[0_0_20px_rgba(212,255,62,0.2)]">
<!-- Background accent shapes -->
<div class="absolute top-0 left-0 w-64 h-64 bg-primary opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
<div class="absolute bottom-0 right-0 w-96 h-96 bg-on-primary-container opacity-5 rounded-full translate-x-1/4 translate-y-1/4"></div>
<div class="relative z-10 max-w-2xl mx-auto">
<h2 class="font-headline-lg text-headline-lg text-on-primary-container mb-6">Ready to write your next chapter?</h2>
<p class="font-body-lg text-body-lg text-on-primary-container opacity-80 mb-10">Whether you're looking for guidance or looking to give it, there's a place for you in our community.</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<button class="bg-primary text-on-primary px-10 py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-105 transition-transform">Create Your Profile</button>
<button class="bg-transparent border-2 border-primary text-primary px-10 py-4 rounded-xl font-bold text-lg hover:bg-primary/5 transition-colors">Become a Mentor</button>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
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


        // Sticky header background shift on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 20) {
                header.classList.add('shadow-sm', 'bg-opacity-95', 'backdrop-blur-md');
            } else {
                header.classList.remove('shadow-sm', 'bg-opacity-95', 'backdrop-blur-md');
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