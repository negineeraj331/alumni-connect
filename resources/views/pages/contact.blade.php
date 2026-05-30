<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Contact Us | Alumni Connect</title>
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
        body { font-family: 'Inter', sans-serif; }
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
<main class="pt-32 pb-24 px-4 md:px-8">
<!-- Hero Section -->
<section class="max-w-[1280px] mx-auto py-16 md:py-24 grid md:grid-cols-2 gap-12 items-center">
<div class="space-y-6">
<h1 class="text-headline-lg font-headline-lg text-on-surface dark:text-[#e3e3e3]">We're here to help you grow your network.</h1>
<p class="text-body-lg font-body-lg text-secondary dark:text-[#a0a5a8] max-w-lg">Whether you have a question about membership, need assistance with your profile, or want to suggest a new feature, our team is ready to connect.</p>
<div class="flex items-center gap-4 pt-4">
<div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary-container">support_agent</span>
</div>
<div>
<p class="font-bold text-on-surface dark:text-white">Human Support</p>
<p class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8]">Average response time: &lt; 4 hours</p>
</div>
</div>
</div>
<div class="relative dark:shadow-[0_0_20px_rgba(212,255,62,0.15)] rounded-3xl">
<div class="absolute inset-0 bg-primary-container/20 rounded-3xl -rotate-2 -z-10"></div>
<img alt="Professional connection" class="w-full h-auto rounded-3xl object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida/ADBb0uhUygNCTnIpRtab94KC_RnbTbStoGmPA0I3Lt2VqKukK30M0NnXVWGmUoKbYTONRi7VY4TiPjaQBlGGUEkZdcdPx9FLFoU0DZqy8NrQj5xeBoqrWpIITvQBq3szkM3ge57FhBK7PIzn7zgwmaCmbDKWIgSmv2r7mDB_pLQmfB1svALlwVUsuQL-eNTBN8_eWwJE13Xy0iAppXZB16sKBKYQcmvhEDjes3_AIU5qstimt8DYDHKf_Ir_lrY">
</div>
</section>
<!-- Contact Content Section -->
<section class="max-w-[1280px] mx-auto grid md:grid-cols-12 gap-12">
<!-- Contact Details -->
<div class="md:col-span-5 space-y-12">
<div class="p-10 bg-surface-container-low dark:bg-[#1a1c16] rounded-3xl border border-outline-variant/30 dark:border-[#444934] dark:shadow-[0_0_20px_rgba(212,255,62,0.15)] space-y-8">
<div>
<h2 class="text-headline-md font-headline-md text-on-surface dark:text-[#e3e3e3] mb-6">Contact Information</h2>
<div class="space-y-6">
<div class="flex items-start gap-4">
<span class="material-symbols-outlined text-primary mt-1">mail</span>
<div>
<p class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8]">Email us at</p>
<p class="text-body-md font-bold dark:text-white">negineeraj811@gmail.com</p>
</div>
</div>
<div class="flex items-start gap-4">
<span class="material-symbols-outlined text-primary mt-1">call</span>
<div>
<p class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8]">Call our support</p>
<p class="text-body-md font-bold dark:text-white">90451XXXXX</p>
</div>
</div>
<div class="flex items-start gap-4">
<span class="material-symbols-outlined text-primary mt-1">location_on</span>
<div>
<p class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8]">Visit our office</p>
<p class="text-body-md font-bold dark:text-white">144411, GT Road , Jalandhar,<br>Punjab, India</p>
</div>
</div>
</div>
</div>
<div class="pt-8 border-t border-outline-variant/20 dark:border-[#444934]">
<p class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8] mb-4 uppercase tracking-wider">Follow our community</p>
<div class="flex gap-4">
<a class="w-10 h-10 rounded-full border border-outline dark:border-[#757962] flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" href="#">
<span class="material-symbols-outlined text-sm">share</span>
</a>
<a class="w-10 h-10 rounded-full border border-outline dark:border-[#757962] flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" href="#">
<span class="material-symbols-outlined text-sm">groups</span>
</a>
</div>
</div>
</div>
<!-- Map Placeholder -->
<a href="https://maps.google.com/?q=Lovely+Professional+University" target="_blank" rel="noopener noreferrer" class="block rounded-3xl overflow-hidden h-64 relative group dark:shadow-[0_0_20px_rgba(212,255,62,0.15)] cursor-pointer">
<img class="w-full h-full object-cover grayscale brightness-110 group-hover:grayscale-0 transition-all duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0WEJ7vOVXRPtmtLn1bckF_IG_xgrm2_WUmjfre239lX47Jgxh7k6ljpW6EY0mdBbaTRVVHVbezeVnxHucT0r80zH52wjf8CiBKhPzchlxU-p4ybmt1MczblvDB_RLY4I-bOWCpm1luBK_kljxj5weFqGAoGVcMzRsGzlWAb9Rx2wH-GQC2DWm3MlT_CdgfYpvSB24YkCMof-LIG-KKYGus5jvkjRS70PrDpe_RP3gNP27KT1lE08GcWin_Jui--t2W2yhWh6o7lDR">
<div class="absolute inset-0 flex items-center justify-center">
<div class="bg-primary text-on-primary px-4 py-2 rounded-full font-bold shadow-lg group-hover:scale-105 transition-transform">Our HQ</div>
</div>
</a>
</div>
<!-- Contact Form -->
<div class="md:col-span-7 bg-white dark:bg-[#1a1c16] p-8 md:p-12 rounded-3xl border border-outline-variant/20 dark:border-[#444934] shadow-sm dark:shadow-[0_0_20px_rgba(212,255,62,0.2)]">

@if(session('success'))
<div class="bg-primary-container/20 border border-primary-container text-on-primary-container rounded-xl px-5 py-4 mb-6 flex items-center gap-3">
    <span class="material-symbols-outlined text-primary">check_circle</span>
    <span class="text-body-md font-bold">{{ session('success') }}</span>
</div>
@endif

@if($errors->any())
<div class="bg-error-container border border-error text-on-error-container rounded-xl px-5 py-4 mb-6">
    <ul class="list-disc list-inside space-y-1 text-sm">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form class="space-y-6" action="{{ route('contact.send') }}" method="POST">
@csrf
<div class="grid md:grid-cols-2 gap-6">
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface dark:text-[#e3e3e3]" for="name">Full Name</label>
<input class="w-full bg-surface-container-lowest dark:bg-[#12140e] border-outline dark:border-[#757962] border focus:border-primary-fixed focus:ring-2 focus:ring-primary-fixed/20 rounded-lg px-4 py-3 outline-none transition-all dark:text-white" id="name" name="name" value="{{ old('name') }}" placeholder="Jane Doe" required="" type="text">
</div>
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface dark:text-[#e3e3e3]" for="email">Email Address</label>
<input class="w-full bg-surface-container-lowest dark:bg-[#12140e] border-outline dark:border-[#757962] border focus:border-primary-fixed focus:ring-2 focus:ring-primary-fixed/20 rounded-lg px-4 py-3 outline-none transition-all dark:text-white" id="email" name="email" value="{{ old('email') }}" placeholder="jane@university.edu" required="" type="email">
</div>
</div>
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface dark:text-[#e3e3e3]" for="subject">Subject</label>
<select class="w-full bg-surface-container-lowest dark:bg-[#12140e] border-outline dark:border-[#757962] border focus:border-primary-fixed focus:ring-2 focus:ring-primary-fixed/20 rounded-lg px-4 py-3 outline-none transition-all dark:text-white" id="subject" name="subject">
<option {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
<option {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
<option {{ old('subject') == 'Partnership Proposal' ? 'selected' : '' }}>Partnership Proposal</option>
<option {{ old('subject') == 'Membership Questions' ? 'selected' : '' }}>Membership Questions</option>
</select>
</div>
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface dark:text-[#e3e3e3]" for="message">Message</label>
<textarea class="w-full bg-surface-container-lowest dark:bg-[#12140e] border-outline dark:border-[#757962] border focus:border-primary-fixed focus:ring-2 focus:ring-primary-fixed/20 rounded-lg px-4 py-3 outline-none transition-all dark:text-white" id="message" name="message" placeholder="Tell us how we can help..." required="" rows="5">{{ old('message') }}</textarea>
</div>
<button class="w-full bg-primary-fixed text-on-primary-fixed py-4 rounded-xl font-bold text-headline-md hover:brightness-105 active:scale-95 transition-all duration-150 flex items-center justify-center gap-2" type="submit">
                        Send Message
                        <span class="material-symbols-outlined">send</span>
</button>
<p class="text-center text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8]">
                        By submitting, you agree to our <a class="{{ request()->routeIs('privacy') ? 'text-primary font-bold underline' : 'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline' }} transition-all duration-200 text-body-md font-body-md" href="{{ route('privacy') }}">Privacy Policy</a>.
                    </p>
</form>
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