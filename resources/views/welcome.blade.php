<!DOCTYPE html>
<html class="light scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Alumni Connect - Bridge Your Future</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#516600",
                        "on-secondary-fixed-variant": "#43474b",
                        "tertiary": "#6d5a5a",
                        "primary-fixed": "#c8f230",
                        "on-primary-fixed-variant": "#3d4d00",
                        "surface-variant": "#e5e2e1",
                        "surface-container-highest": "#e5e2e1",
                        "tertiary-fixed-dim": "#dac1c1",
                        "surface-container": "#f0eded",
                        "error-container": "#ffdad6",
                        "surface-container-high": "#eae7e7",
                        "inverse-primary": "#add500",
                        "secondary-fixed": "#dfe3e7",
                        "on-tertiary-fixed": "#261818",
                        "on-secondary-container": "#5e6367",
                        "on-primary": "#ffffff",
                        "secondary-container": "#dce0e4",
                        "secondary": "#5a5f62",
                        "on-tertiary-fixed-variant": "#544243",
                        "surface": "#fcf9f8",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#313030",
                        "tertiary-fixed": "#f7dcdc",
                        "outline": "#757962",
                        "on-primary-container": "#5d7400",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#7b6767",
                        "on-tertiary": "#ffffff",
                        "background": "#fcf9f8",
                        "surface-bright": "#fcf9f8",
                        "outline-variant": "#c5c9ae",
                        "primary-container": "#d4ff3e",
                        "on-background": "#1c1b1b",
                        "on-primary-fixed": "#171e00",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#c3c7cb",
                        "surface-tint": "#516600",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#f3f0ef",
                        "tertiary-container": "#ffeaea",
                        "surface-dim": "#dcd9d9",
                        "primary-fixed-dim": "#add500",
                        "on-surface": "#1c1b1b",
                        "on-secondary-fixed": "#171c1f",
                        "on-surface-variant": "#444934",
                        "surface-container-low": "#f6f3f2"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "max-width": "1280px",
                        "unit": "8px",
                        "margin-mobile": "20px",
                        "margin-desktop": "80px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "display-xl": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "display-xl": ["72px", {"lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                        "label-sm": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "headline-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}]
                    },
                    "animation": {
                        "fade-in": "fadeIn 0.3s ease-in-out"
                    },
                    "keyframes": {
                        "fadeIn": {
                            "0%": { opacity: "0", transform: "translateY(-10px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" }
                        }
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Smooth Scroll Interactions */
        html { scroll-behavior: smooth; }
        
        .reveal-card {
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.6s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .reveal-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        /* Hero Underline */
        .hero-underline {
            background-image: linear-gradient(transparent 80%, #d4ff3e 80%);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        .dark .hero-underline {
            background-image: linear-gradient(transparent 80%, rgba(212,255,62,0.4) 80%);
        }

        /* Dark Mode Global Glow Effects */
        .dark .glowing-text {
            text-shadow: 0 0 10px rgba(212, 255, 62, 0.3);
        }
        .dark .reveal-card, 
        .dark .group-flip .flip-inner, 
        .dark details.group, 
        .dark .glowing-theme {
            box-shadow: 0 0 15px rgba(212, 255, 62, 0.1);
            border-color: rgba(212, 255, 62, 0.3);
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .dark .reveal-card:hover, 
        .dark .group-flip:hover .flip-inner, 
        .dark details.group:hover {
            box-shadow: 0 0 30px rgba(212, 255, 62, 0.35);
            border-color: rgba(212, 255, 62, 0.6);
        }

        /* Marquee Animations */
        @keyframes slide-right {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0%); }
        }
        @keyframes slide-left {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .marquee-track-right {
            display: flex;
            width: max-content;
            animation: slide-right 40s linear infinite;
        }
        .marquee-track-right:hover {
            animation-play-state: paused;
        }
        .marquee-track-left {
            display: flex;
            width: max-content;
            animation: slide-left 40s linear infinite;
        }
        .marquee-track-left:hover {
            animation-play-state: paused;
        }

        /* Custom Keyframe Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float 6s ease-in-out infinite; animation-delay: 3s; }
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.8; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.03); }
        }
        .animate-pulse-slow { animation: pulse-slow 8s infinite; }
        .bg-gradient-animate {
            background-size: 200% 200%;
            animation: gradientMove 5s ease infinite;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Flip Card CSS */
        .perspective-1000 { perspective: 1000px; }
        .transform-style-3d { transform-style: preserve-3d; }
        .backface-hidden { backface-visibility: hidden; }
        .rotate-y-180 { transform: rotateY(180deg); }
        .group-flip:hover .flip-inner { transform: rotateY(180deg); }
    </style>
</head>
<body class="bg-surface dark:bg-[#0f1115] text-on-surface dark:text-[#e3e3e3] dark:text-gray-100 font-body-md selection:bg-primary-container selection:text-on-primary-container transition-colors duration-500">

<!-- Navigation Bar -->
<header class="fixed top-0 left-0 right-0 z-50 bg-surface/80 dark:bg-[#0f1115]/80 backdrop-blur-md border-b border-outline-variant dark:border-[#444934] dark:border-gray-800 transition-colors duration-500">
    <nav class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop py-4 max-w-max-width mx-auto">
        <div class="flex items-center gap-2">
            <div class="bg-primary-container p-1 rounded-lg">
                <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
            </div>
            <span class="text-headline-md font-bold tracking-tight dark:text-white">Alumni Connect</span>
        </div>
        <div class="hidden lg:flex items-center gap-8">
            <a class="text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 hover:text-primary dark:hover:text-primary-container transition-colors text-label-sm font-bold" href="#home">Home</a>
            <a class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-white transition-colors text-label-sm font-bold" href="#mission">Mission</a>
            <a class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-white transition-colors text-label-sm font-bold" href="#testimonials">Voices</a>
            <a class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-white transition-colors text-label-sm font-bold" href="#team">Team</a>
            <a class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-white transition-colors text-label-sm font-bold" href="#faq">FAQ</a>
        </div>
        <div class="flex items-center gap-4">
            <!-- Theme Toggle -->
            <button id="themeToggle" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container dark:hover:bg-gray-800 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.3)]">
                <span class="material-symbols-outlined dark:text-primary-container" id="themeIcon">dark_mode</span>
            </button>
            
        <a href="{{ route('login') }}" class="bg-primary-container text-on-primary-container px-6 py-2.5 rounded-full font-bold text-label-sm hover:opacity-90 hover:scale-105 active:scale-95 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.4)] hidden sm:block">Log in</a>
            
        <a href="{{ route('register') }}" class="bg-primary-container text-on-primary-container px-6 py-2.5 rounded-full font-bold text-label-sm hover:opacity-90 hover:scale-105 active:scale-95 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.4)]">Join now</a>
        </div>
    </nav>
</header>

<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-center overflow-hidden bg-surface-container-low dark:bg-[#1a1c21] transition-colors duration-500">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <!-- Enhanced Background Image -->
            <img alt="Welcome Illustration" class="w-full h-full object-cover animate-pulse-slow" src="https://lh3.googleusercontent.com/aida/ADBb0ujWOZ8buOF7lIgxr_1ZNVmI-uqrTc2_osnIYH9-gIEpRDNRPVOsYT_SR1s4vPXZhq6CCe_aMxWQDbEL3ephuBpaGMmRrbYblp16ypQl8GXUYbL5_AfdGiPPROcWVrVFP_dbYcn1q66yX_q-rmin2q3umPd9kqC2VWRfvMJXpqcF89J3KpYrUTLav6anBcqubBLsgS4g8x8IUNonuMMFsdR1qTEjJOTkjcs3osa1ctBebIIDyUZr05mLT3xJ"/>
            <div class="absolute inset-0 bg-surface/70 dark:bg-[#0f1115]/80 backdrop-blur-[2px]"></div>
            <!-- Glowing accent in dark mode -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary-container/0 to-primary-container/0 dark:from-primary-container/10 dark:to-transparent transition-colors duration-500"></div>
            <!-- Floating Decorative Orbs -->
            <div class="absolute top-1/4 left-10 w-40 h-40 bg-primary-container/30 rounded-full blur-3xl animate-float pointer-events-none"></div>
            <div class="absolute bottom-1/4 right-20 w-56 h-56 bg-primary/20 dark:bg-primary-container/20 rounded-full blur-3xl animate-float-delayed pointer-events-none"></div>
        </div>
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop py-20 relative z-10 w-full">
            <div class="max-w-3xl space-y-8">
                <h1 class="font-display-xl text-display-xl max-md:text-headline-lg-mobile text-on-surface dark:text-[#e3e3e3] dark:text-white leading-tight dark:glowing-text">
                    Welcome to <br/> <span class="bg-gradient-to-r from-primary to-primary-container dark:from-[#d4ff3e] dark:to-white bg-clip-text text-transparent bg-gradient-animate inline-block pb-2">Alumni Connect.</span>
                </h1>
                <p class="text-body-lg text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 font-semibold max-w-xl">
                    The exclusive digital bridge for the world's most ambitious graduates. Reconnect with your legacy and accelerate your career.
                </p>
                <!-- Community Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 py-4">
                    <div class="space-y-1">
                        <div class="text-headline-lg font-bold text-primary dark:text-primary-container dark:glowing-text">10K+</div>
                        <div class="text-label-sm font-bold text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Active Alumni</div>
                    </div>
                    <div class="space-y-1">
                        <div class="text-headline-lg font-bold text-primary dark:text-primary-container dark:glowing-text">500+</div>
                        <div class="text-label-sm font-bold text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Expert Mentors</div>
                    </div>
                    <div class="space-y-1">
                        <div class="text-headline-lg font-bold text-primary dark:text-primary-container dark:glowing-text">200+</div>
                        <div class="text-label-sm font-bold text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Global Companies</div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('register') }}" class="bg-on-surface dark:bg-white text-surface dark:text-[#0f1115] px-10 py-5 rounded-full font-bold text-body-md hover:shadow-xl hover:-translate-y-1 transition-all active:scale-95 inline-block dark:shadow-[0_0_15px_rgba(255,255,255,0.3)]">Claim Your Profile</a>
                    <a href="#mission" class="border-2 border-on-surface dark:border-white text-on-surface dark:text-[#e3e3e3] dark:text-white px-10 py-5 rounded-full font-bold text-body-md hover:bg-surface-container dark:hover:bg-gray-800 transition-colors inline-block">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Dynamic Company Marquee sliding right -->
    <section class="py-12 bg-surface-container-lowest dark:bg-[#0a0c10] border-y border-outline-variant dark:border-[#444934] dark:border-gray-800 overflow-hidden">
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop mb-8">
            <p class="text-center text-label-sm font-bold text-secondary dark:text-[#a0a5a8] dark:text-gray-500 uppercase tracking-widest">Graduates hired by top global companies</p>
        </div>
        <div class="w-full relative">
            <div class="marquee-track-right flex items-center gap-16 px-8 opacity-60 dark:opacity-40 grayscale transition-all hover:grayscale-0 hover:opacity-100">
                <!-- Group 1 -->
                <h3 class="text-3xl font-black shrink-0">Google</h3>
                <h3 class="text-3xl font-black shrink-0 text-blue-600">Meta</h3>
                <h3 class="text-3xl font-black shrink-0 text-gray-800 dark:text-white">Apple</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#ff9900]">Amazon</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#e50914]">Netflix</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#0070f3]">Vercel</h3>
                <h3 class="text-3xl font-black shrink-0 text-blue-500">Microsoft</h3>
                <h3 class="text-3xl font-black shrink-0 text-indigo-600">Stripe</h3>
                <h3 class="text-3xl font-black shrink-0 text-red-500">Adobe</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#00a1e0]">Salesforce</h3>
                <!-- Group 2 -->
                <h3 class="text-3xl font-black shrink-0">Google</h3>
                <h3 class="text-3xl font-black shrink-0 text-blue-600">Meta</h3>
                <h3 class="text-3xl font-black shrink-0 text-gray-800 dark:text-white">Apple</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#ff9900]">Amazon</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#e50914]">Netflix</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#0070f3]">Vercel</h3>
                <h3 class="text-3xl font-black shrink-0 text-blue-500">Microsoft</h3>
                <h3 class="text-3xl font-black shrink-0 text-indigo-600">Stripe</h3>
                <h3 class="text-3xl font-black shrink-0 text-red-500">Adobe</h3>
                <h3 class="text-3xl font-black shrink-0 text-[#00a1e0]">Salesforce</h3>
            </div>
        </div>
    </section>

    <!-- Legacy Reconnected Section with Form -->
    <section class="py-24 bg-surface dark:bg-[#0f1115] transition-colors duration-500" id="home">
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <h2 class="font-display-xl text-display-xl max-md:text-headline-lg-mobile text-on-surface dark:text-[#e3e3e3] dark:text-white leading-tight">
                    Your legacy, <br/> <span class="bg-gradient-to-r from-primary to-primary-container dark:from-[#d4ff3e] dark:to-white bg-clip-text text-transparent bg-gradient-animate inline-block pb-2">reconnected.</span>
                </h2>
                <p class="text-body-lg text-secondary dark:text-[#a0a5a8] dark:text-gray-400 max-w-lg">
                    Bridge the gap between your graduation and your career. We solve the connection problem by bringing 10k+ alumni into one seamless professional network.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="bg-on-surface dark:bg-white text-surface dark:text-[#0f1115] px-8 py-4 rounded-full font-bold text-body-md hover:shadow-xl hover:-translate-y-1 transition-all active:scale-95">Explore Network</a>
                    <a href="#how-it-works" class="border-2 border-on-surface dark:border-gray-600 text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 px-8 py-4 rounded-full font-bold text-body-md hover:bg-surface-container dark:hover:bg-gray-800 transition-colors">How it works</a>
                </div>
            </div>
            
            <!-- Login/Register Action Cards -->
            <div class="flex flex-col gap-6 max-w-md mx-auto lg:ml-auto w-full">
                <!-- Login Card -->
                <a href="{{ route('login') }}" class="bg-surface-container-low dark:bg-[#1a1c21] p-8 rounded-[2rem] border border-outline-variant dark:border-[#444934] dark:border-gray-800 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.15)] dark:hover:border-primary-container/50 group flex items-center justify-between">
                    <div>
                        <h3 class="text-headline-md font-bold text-on-surface dark:text-white mb-2">Welcome Back</h3>
                        <p class="text-body-md text-secondary dark:text-gray-400">Login to your account</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-surface-container-highest dark:bg-[#2a3014] flex items-center justify-center group-hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-on-surface dark:text-white group-hover:text-on-primary-container">arrow_forward</span>
                    </div>
                </a>

                <!-- Register Card -->
                <a href="{{ route('register') }}" class="bg-primary-container p-8 rounded-[2rem] border border-transparent transition-all duration-300 hover:-translate-y-2 hover:shadow-xl dark:shadow-[0_0_15px_rgba(212,255,62,0.2)] group flex items-center justify-between">
                    <div>
                        <h3 class="text-headline-md font-bold text-on-primary-container mb-2">New Here?</h3>
                        <p class="text-body-md text-on-primary-container/80">Join the Alumni Network</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/40 transition-colors">
                        <span class="material-symbols-outlined text-on-primary-container">person_add</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-24 max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop" id="mission">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative reveal-card">
                <div class="absolute inset-0 bg-primary-container/20 blur-3xl rounded-[2.5rem] dark:bg-primary-container/10 dark:bg-primary-container/20 animate-pulse-slow"></div>
                <img alt="Mission Illustration" class="w-full h-auto rounded-[2.5rem] relative z-10 shadow-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsiYqE7ONyFKfJNxY2EL8D04WnDkrfvCL1x217-cdPPAXhwFrVsvWW1s7C3frLFQVVKYvo9aaRoRcHeE04pgW8GcJovgJ8uEw7dJ4fodiHiPxwxDFDSPndbuaNDJz4QP8P-BhonE5n8UTIHGUid9BsHWj0nCfBfcRlfR_BjPGQ5Tq7bHHf-65_et9F57EI52_VEhmGXwrpdiyRqBPGGi7sNbpO03OdtfsmSMYjyfREgbvBDP3sAifs5ZEH8-3McFF1-eMGV8DZo-v1"/>
                <!-- Floating Decorative Badge -->
                <div class="absolute -bottom-6 -right-6 bg-surface dark:bg-[#1a1c21] p-6 rounded-3xl shadow-2xl border border-outline-variant dark:border-[#444934] dark:border-gray-800 z-20 animate-float hidden md:block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-primary-container">verified</span>
                        </div>
                        <div>
                            <p class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white text-lg">100% Verified</p>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400">Exclusive Network</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-6 order-1 lg:order-2 reveal-card" style="transition-delay: 100ms;">
                <div class="inline-block bg-primary-container/30 px-4 py-1.5 rounded-full text-primary dark:text-primary-container font-bold text-label-sm uppercase tracking-wider">Our Mission</div>
                <h2 class="text-headline-lg font-bold leading-tight dark:text-white">Empowering a lifelong academic heritage.</h2>
                <p class="text-body-lg text-secondary dark:text-[#a0a5a8] dark:text-gray-400">
                    Alumni Connect exists to eliminate the professional isolation that often follows graduation. We believe your university ties are your strongest asset. 
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary dark:text-primary-container" data-icon="check_circle">check_circle</span>
                        <span class="text-body-md font-bold text-on-surface dark:text-[#e3e3e3] dark:text-gray-200">Verified alumni-only directory for secure networking.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary dark:text-primary-container" data-icon="check_circle">check_circle</span>
                        <span class="text-body-md font-bold text-on-surface dark:text-[#e3e3e3] dark:text-gray-200">Curated mentorship programs matching experience with ambition.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary dark:text-primary-container" data-icon="check_circle">check_circle</span>
                        <span class="text-body-md font-bold text-on-surface dark:text-[#e3e3e3] dark:text-gray-200">Direct access to career opportunities within the inner circle.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Features Overview -->
    <section class="py-24 bg-surface-container-low dark:bg-[#1a1c21] transition-colors duration-500">
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="text-center mb-16 space-y-4 reveal-card">
                <h2 class="text-headline-lg font-bold dark:text-white">Everything you need to thrive</h2>
                <p class="text-body-lg text-secondary dark:text-[#a0a5a8] dark:text-gray-400 max-w-2xl mx-auto">A comprehensive ecosystem designed specifically for the modern graduate's journey.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Alumni Connections -->
                <div class="reveal-card bg-[#f4f7ed] dark:bg-[#0f1115] overflow-hidden rounded-[2.5rem] border border-outline-variant dark:border-[#444934] dark:border-gray-800 flex flex-col transition-all">
                    <div class="p-8 pb-0">
                        <h3 class="text-headline-md font-bold mb-3 dark:text-white">Alumni Connections</h3>
                        <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 mb-6">Forge powerful partnerships with verified peers across any industry.</p>
                    </div>
                    <div class="mt-auto px-8 pb-8">
                        <img alt="Alumni Connections" class="w-full h-48 object-contain opacity-90 dark:opacity-80 transition-transform duration-500 hover:scale-110" src="https://lh3.googleusercontent.com/aida/ADBb0uhUygNCTnIpRtab94KC_RnbTbStoGmPA0I3Lt2VqKukK30M0NnXVWGmUoKbYTONRi7VY4TiPjaQBlGGUEkZdcdPx9FLFoU0DZqy8NrQj5xeBoqrWpIITvQBq3szkM3ge57FhBK7PIzn7zgwmaCmbDKWIgSmv2r7mDB_pLQmfB1svALlwVUsuQL-eNTBN8_eWwJE13Xy0iAppXZB16sKBKYQcmvhEDjes3_AIU5qstimt8DYDHKf_Ir_lrY"/>
                    </div>
                </div>
                <!-- Mentorship & Growth -->
                <div class="reveal-card bg-[#fef6f5] dark:bg-[#0f1115] overflow-hidden rounded-[2.5rem] border border-outline-variant dark:border-[#444934] dark:border-gray-800 flex flex-col transition-all" style="transition-delay: 100ms;">
                    <div class="p-8 pb-0">
                        <h3 class="text-headline-md font-bold mb-3 dark:text-white">Mentorship &amp; Growth</h3>
                        <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 mb-6">Learn from those who've walked your path and achieve your career goals.</p>
                    </div>
                    <div class="mt-auto px-8 pb-8">
                        <img alt="Mentorship &amp; Growth" class="w-full h-48 object-contain opacity-90 dark:opacity-80 transition-transform duration-500 hover:scale-110" src="https://lh3.googleusercontent.com/aida/ADBb0ugZJjwufeZ2nRZQ5svxG5FvHI5umHq84x1Ee5UpWCj5caFhNUWqJQc5owAh0o9YSFqRcQ1D-cxyQjC4Pyeec7EOjMgTL2MUY_L6KUFvj4xOoz-dTWE6V9Cy4BMOUeUpJl_aYg1dOwPijX3ylXCkCAd7eFboO2P-5-JFU9QNILL5Q9phzhL-Xi8B4xEH-l1QqG7yG2ZGNxGb5xsc0W-BW-6kVkVmn0t0nrt2JSOf71tCN8sxgNhTXsWZSxYv"/>
                    </div>
                </div>
                <!-- Events & Networking (Updated with Image) -->
                <div class="reveal-card bg-[#edf5f9] dark:bg-[#0f1115] overflow-hidden rounded-[2.5rem] border border-outline-variant dark:border-[#444934] dark:border-gray-800 flex flex-col transition-all" style="transition-delay: 200ms;">
                    <div class="p-8 pb-0">
                        <h3 class="text-headline-md font-bold mb-3 dark:text-white">Events &amp; Networking</h3>
                        <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 mb-6">Exclusive access to global industry summits, regional meetups, and skill-building webinars.</p>
                    </div>
                    <div class="mt-auto px-8 pb-8">
                        <img alt="Events" class="w-full h-48 object-cover rounded-xl opacity-90 dark:opacity-80 transition-transform duration-500 hover:scale-110" src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=500&q=80"/>
                    </div>
                </div>
                <!-- Professional Messaging (Updated with Image) -->
                <div class="reveal-card bg-[#fdf4eb] dark:bg-[#0f1115] overflow-hidden rounded-[2.5rem] border border-outline-variant dark:border-[#444934] dark:border-gray-800 flex flex-col transition-all">
                    <div class="p-8 pb-0">
                        <h3 class="text-headline-md font-bold mb-3 dark:text-white">Professional Messaging</h3>
                        <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 mb-6">Direct, secure communication channels with any alumni member worldwide without intermediate gatekeepers.</p>
                    </div>
                    <div class="mt-auto px-8 pb-8">
                        <img alt="Messaging" class="w-full h-48 object-cover rounded-xl opacity-90 dark:opacity-80 transition-transform duration-500 hover:scale-110" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=500&q=80"/>
                    </div>
                </div>
                <!-- Career Portal -->
                <div class="reveal-card bg-[#f5f0fa] dark:bg-[#0f1115] p-8 rounded-[2.5rem] border border-outline-variant dark:border-[#444934] dark:border-gray-800 md:col-span-2 transition-all" style="transition-delay: 100ms;">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-8 h-full">
                        <div class="w-20 h-20 bg-[#d4ff3e] rounded-3xl flex-shrink-0 flex items-center justify-center dark:shadow-[0_0_20px_rgba(212,255,62,0.3)] transform transition-transform hover:scale-110">
                            <span class="material-symbols-outlined text-on-primary-container text-4xl" data-icon="work">work</span>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-headline-md font-bold dark:text-white">Integrated Career Portal</h3>
                            <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 max-w-xl">Browse job openings shared directly by alumni within top-tier global companies. Get referred, get noticed, and land your next role with the power of your network.</p>
                            <a href="{{ route('login') }}" class="text-primary dark:text-primary-container font-bold inline-flex items-center gap-2 hover:gap-4 transition-all">
                                Explore opportunities <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works (Interactive Hover Steps with Pastels) -->
    <section id="how-it-works" class="py-24 max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop transition-colors duration-500">
        <div class="text-center mb-16 reveal-card">
            <h2 class="text-headline-lg font-bold dark:text-white">How it Works</h2>
            <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 mt-4">Your journey to a stronger network in four simple steps.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-4 reveal-card bg-[#fdf0f4] dark:bg-gray-800 p-6 rounded-3xl transition-colors border border-transparent dark:border-gray-700">
                <div class="text-display-xl font-black text-primary-container/50 dark:text-primary-container/30 leading-none transition-transform hover:scale-110 origin-left">01</div>
                <h4 class="text-headline-md font-bold dark:text-white">Verify Identity</h4>
                <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400">Sync with your university credentials to confirm your alumni status.</p>
            </div>
            <div class="space-y-4 reveal-card bg-[#eef7fc] dark:bg-gray-800 p-6 rounded-3xl transition-colors border border-transparent dark:border-gray-700" style="transition-delay: 100ms;">
                <div class="text-display-xl font-black text-primary-container/50 dark:text-primary-container/30 leading-none transition-transform hover:scale-110 origin-left">02</div>
                <h4 class="text-headline-md font-bold dark:text-white">Build Profile</h4>
                <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400">Highlight your career path, skills, and what you're looking for.</p>
            </div>
            <div class="space-y-4 reveal-card bg-[#f4f7ed] dark:bg-gray-800 p-6 rounded-3xl transition-colors border border-transparent dark:border-gray-700" style="transition-delay: 200ms;">
                <div class="text-display-xl font-black text-primary-container/50 dark:text-primary-container/30 leading-none transition-transform hover:scale-110 origin-left">03</div>
                <h4 class="text-headline-md font-bold dark:text-white">Get Matched</h4>
                <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400">Receive daily peer and mentor suggestions based on your goals.</p>
            </div>
            <div class="space-y-4 reveal-card bg-[#fdf4eb] dark:bg-gray-800 p-6 rounded-3xl transition-colors border border-transparent dark:border-gray-700" style="transition-delay: 300ms;">
                <div class="text-display-xl font-black text-primary-container/50 dark:text-primary-container/30 leading-none transition-transform hover:scale-110 origin-left">04</div>
                <h4 class="text-headline-md font-bold dark:text-white">Grow Together</h4>
                <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400">Attend events, secure roles, and eventually mentor others.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section (Sliding Marquee Left) -->
    <section class="py-24 bg-surface-container-low dark:bg-[#1a1c21] overflow-hidden transition-colors duration-500" id="testimonials">
        <div class="text-center mb-16 reveal-card">
            <h2 class="text-headline-lg font-bold dark:text-white">Voices of the Network</h2>
            <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 mt-4">Hear what our active members have achieved.</p>
        </div>
        
        <!-- Sliding Marquee Container -->
        <div class="w-full relative">
            <div class="marquee-track-left">
                <!-- Group 1 -->
                <div class="flex gap-8 px-4">
                    <div class="w-[350px] bg-[#fcfcfc] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="Sarah Chen" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"Found my current VP role through a direct message here. The level of trust is unmatched compared to LinkedIn."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">Sarah Chen</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2015</p>
                        </div>
                    </div>
                    <div class="w-[350px] bg-[#fdf0f4] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="Elena Rodriguez" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"The mentorship program gave me guidance when I was switching industries. My mentor is now a close advisor."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">Elena Rodriguez</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2018</p>
                        </div>
                    </div>
                    <div class="w-[350px] bg-[#eef7fc] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="David Park" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"Staying connected to my alma mater has never been easier. I've hired three graduates through this portal already."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">David Park</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2010</p>
                        </div>
                    </div>
                    <div class="w-[350px] bg-[#f4f7ed] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="Aisha Patel" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"The events and seminars hosted here completely transformed my approach to networking. A game changer."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">Aisha Patel</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2021</p>
                        </div>
                    </div>
                </div>
                <!-- Group 2 (Duplicate for infinite loop effect) -->
                <div class="flex gap-8 px-4">
                    <div class="w-[350px] bg-[#fcfcfc] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="Sarah Chen" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"Found my current VP role through a direct message here. The level of trust is unmatched compared to LinkedIn."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">Sarah Chen</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2015</p>
                        </div>
                    </div>
                    <div class="w-[350px] bg-[#fdf0f4] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="Elena Rodriguez" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"The mentorship program gave me guidance when I was switching industries. My mentor is now a close advisor."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">Elena Rodriguez</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2018</p>
                        </div>
                    </div>
                    <div class="w-[350px] bg-[#eef7fc] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="David Park" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"Staying connected to my alma mater has never been easier. I've hired three graduates through this portal already."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">David Park</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2010</p>
                        </div>
                    </div>
                    <div class="w-[350px] bg-[#f4f7ed] dark:bg-[#0f1115] p-8 rounded-[2rem] flex flex-col items-center text-center border border-outline-variant dark:border-[#444934] dark:border-gray-800 reveal-card shrink-0">
                        <img alt="Aisha Patel" class="w-24 h-24 rounded-full object-cover mb-6 border-4 border-primary-container" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80"/>
                        <p class="text-body-md italic text-on-surface dark:text-[#e3e3e3] dark:text-gray-300 mb-6">"The events and seminars hosted here completely transformed my approach to networking. A game changer."</p>
                        <div class="mt-auto">
                            <h4 class="font-bold text-on-surface dark:text-[#e3e3e3] dark:text-white">Aisha Patel</h4>
                            <p class="text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400 uppercase tracking-widest">Class of 2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section (3 Flip Cards) -->
    <section class="py-24 relative transition-colors duration-500 overflow-hidden" id="team">
        <div class="absolute inset-0 z-0">
            <img alt="Team Background" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=2000&q=80"/>
            <div class="absolute inset-0 bg-surface/80 dark:bg-[#0f1115]/80 backdrop-blur-md"></div>
        </div>
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop relative z-10">
            <div class="text-center mb-16 reveal-card">
                <h2 class="text-headline-lg font-bold dark:text-white">The Founders behind the connection.</h2>
                <p class="text-body-lg text-secondary dark:text-[#a0a5a8] dark:text-gray-400 max-w-2xl mx-auto mt-4">We are a dedicated team of developers building the bridge between education and professional success.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Flip Card 1: Neeraj Negi -->
                <div class="group-flip h-[380px] w-full perspective-1000 cursor-pointer reveal-card">
                    <div class="relative w-full h-full transition-transform duration-700 transform-style-3d flip-inner shadow-xl rounded-3xl">
                        <!-- Front -->
                        <div class="absolute inset-0 backface-hidden bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl p-8 flex flex-col items-center justify-center border border-outline-variant dark:border-[#444934] dark:border-gray-800">
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=300&q=80" class="w-36 h-36 rounded-full object-cover mb-6 border-4 border-surface shadow-md">
                            <h4 class="font-bold text-2xl dark:text-white mb-2">Neeraj Negi</h4>
                            <p class="text-primary dark:text-primary-container font-bold uppercase tracking-widest text-sm">Full Stack Developer</p>
                        </div>
                        <!-- Back -->
                        <div class="absolute inset-0 backface-hidden rotate-y-180 bg-primary-container dark:bg-[#2a3014] rounded-3xl p-8 flex flex-col items-center justify-center text-center">
                            <h4 class="font-bold text-2xl text-on-primary-container dark:text-white mb-4">Neeraj Negi</h4>
                            <p class="text-on-primary-container/80 dark:text-gray-300 mb-6">Expert in architecting robust database structures and designing beautiful, scalable frontend components using modern tech stacks.</p>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-surface/20 flex items-center justify-center hover:bg-surface/40 transition-colors"><span class="material-symbols-outlined text-on-primary-container dark:text-white">code</span></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface/20 flex items-center justify-center hover:bg-surface/40 transition-colors"><span class="material-symbols-outlined text-on-primary-container dark:text-white">link</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flip Card 2: Rishav Kumar -->
                <div class="group-flip h-[380px] w-full perspective-1000 cursor-pointer reveal-card" style="transition-delay: 100ms;">
                    <div class="relative w-full h-full transition-transform duration-700 transform-style-3d flip-inner shadow-xl rounded-3xl">
                        <!-- Front -->
                        <div class="absolute inset-0 backface-hidden bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl p-8 flex flex-col items-center justify-center border border-outline-variant dark:border-[#444934] dark:border-gray-800">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80" class="w-36 h-36 rounded-full object-cover mb-6 border-4 border-surface shadow-md">
                            <h4 class="font-bold text-2xl dark:text-white mb-2">Rishav Kumar</h4>
                            <p class="text-primary dark:text-primary-container font-bold uppercase tracking-widest text-sm">Backend Developer</p>
                        </div>
                        <!-- Back -->
                        <div class="absolute inset-0 backface-hidden rotate-y-180 bg-primary-container dark:bg-[#2a3014] rounded-3xl p-8 flex flex-col items-center justify-center text-center">
                            <h4 class="font-bold text-2xl text-on-primary-container dark:text-white mb-4">Rishav Kumar</h4>
                            <p class="text-on-primary-container/80 dark:text-gray-300 mb-6">Master of server-side logic, API integrations, and ensuring high performance and responsiveness of requests from the front-end.</p>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-surface/20 flex items-center justify-center hover:bg-surface/40 transition-colors"><span class="material-symbols-outlined text-on-primary-container dark:text-white">terminal</span></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface/20 flex items-center justify-center hover:bg-surface/40 transition-colors"><span class="material-symbols-outlined text-on-primary-container dark:text-white">storage</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flip Card 3: Md Abdul Basit -->
                <div class="group-flip h-[380px] w-full perspective-1000 cursor-pointer reveal-card" style="transition-delay: 200ms;">
                    <div class="relative w-full h-full transition-transform duration-700 transform-style-3d flip-inner shadow-xl rounded-3xl">
                        <!-- Front -->
                        <div class="absolute inset-0 backface-hidden bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl p-8 flex flex-col items-center justify-center border border-outline-variant dark:border-[#444934] dark:border-gray-800">
                            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=300&q=80" class="w-36 h-36 rounded-full object-cover mb-6 border-4 border-surface shadow-md">
                            <h4 class="font-bold text-2xl dark:text-white mb-2">Md Abdul Basit</h4>
                            <p class="text-primary dark:text-primary-container font-bold uppercase tracking-widest text-sm">Frontend Developer</p>
                        </div>
                        <!-- Back -->
                        <div class="absolute inset-0 backface-hidden rotate-y-180 bg-primary-container dark:bg-[#2a3014] rounded-3xl p-8 flex flex-col items-center justify-center text-center">
                            <h4 class="font-bold text-2xl text-on-primary-container dark:text-white mb-4">Md Abdul Basit</h4>
                            <p class="text-on-primary-container/80 dark:text-gray-300 mb-6">Crafting intuitive user interfaces, fluid animations, and ensuring pixel-perfect responsive designs across all devices and browsers.</p>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-surface/20 flex items-center justify-center hover:bg-surface/40 transition-colors"><span class="material-symbols-outlined text-on-primary-container dark:text-white">brush</span></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface/20 flex items-center justify-center hover:bg-surface/40 transition-colors"><span class="material-symbols-outlined text-on-primary-container dark:text-white">devices</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 bg-surface-container-lowest dark:bg-[#1a1c21] transition-colors duration-500" id="faq">
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                <!-- Left Column -->
                <div class="lg:col-span-5 space-y-6 reveal-card">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary dark:bg-primary-container/20 dark:text-primary-container font-label-sm uppercase tracking-wider text-xs">
                        <span class="material-symbols-outlined text-sm">help</span>
                        Got Questions?
                    </div>
                    <h2 class="text-headline-lg font-bold text-on-surface dark:text-white leading-tight">
                        Frequently Asked <br class="hidden lg:inline"/><span class="bg-gradient-to-r from-primary to-primary-container dark:from-[#d4ff3e] dark:to-white bg-clip-text text-transparent bg-gradient-animate inline-block pb-2">Questions.</span>
                    </h2>
                    <p class="text-body-lg text-secondary dark:text-gray-400 max-w-md">
                        Everything you need to know about the Alumni Connect platform, verification, safety, and community guidelines.
                    </p>
                    
                    <!-- Can't find answer card -->
                    <div class="p-8 rounded-[2rem] bg-surface-container-low dark:bg-[#15171c] border border-outline-variant dark:border-gray-800 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center">
                                <span class="material-symbols-outlined text-on-primary-container">support_agent</span>
                            </div>
                            <h4 class="font-bold text-on-surface dark:text-white">Still have questions?</h4>
                        </div>
                        <p class="text-label-sm text-secondary dark:text-gray-400">
                            Can't find the answer you're looking for? Reach out to our support team and we'll get back to you shortly.
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-label-sm font-bold text-primary dark:text-primary-container hover:underline group">
                            Contact Support <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Q1 -->
                    <details class="group bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl border border-outline-variant dark:border-gray-800 [&_summary::-webkit-details-marker]:hidden reveal-card duration-300">
                        <summary class="flex justify-between items-center w-full p-6 cursor-pointer list-none select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#f4f7ed] dark:bg-[#25282c] flex items-center justify-center text-primary dark:text-primary-container group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined">shield</span>
                                </div>
                                <span class="text-headline-md font-bold group-hover:text-primary dark:group-hover:text-primary-container transition-colors dark:text-white text-left">Is my data secure?</span>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-[#f4f7ed] dark:bg-[#25282c] flex items-center justify-center material-symbols-outlined transition-transform duration-300 group-open:rotate-180 dark:text-gray-400 group-hover:bg-primary-container group-hover:text-on-primary-container">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 pl-20 text-secondary dark:text-[#a0a5a8] dark:text-gray-400 text-body-md animate-fade-in">
                            Yes, absolutely. We use bank-grade encryption to protect your personal and professional information. Only verified alumni from your network can view your detailed profile, and you maintain complete control over what information is visible to others.
                        </div>
                    </details>

                    <!-- Q2 -->
                    <details class="group bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl border border-outline-variant dark:border-gray-800 [&_summary::-webkit-details-marker]:hidden reveal-card duration-300" style="transition-delay: 50ms;">
                        <summary class="flex justify-between items-center w-full p-6 cursor-pointer list-none select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#eef7fc] dark:bg-[#25282c] flex items-center justify-center text-primary dark:text-primary-container group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined">verified_user</span>
                                </div>
                                <span class="text-headline-md font-bold group-hover:text-primary dark:group-hover:text-primary-container transition-colors dark:text-white text-left">How do I verify my status?</span>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-[#eef7fc] dark:bg-[#25282c] flex items-center justify-center material-symbols-outlined transition-transform duration-300 group-open:rotate-180 dark:text-gray-400 group-hover:bg-primary-container group-hover:text-on-primary-container">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 pl-20 text-secondary dark:text-[#a0a5a8] dark:text-gray-400 text-body-md animate-fade-in">
                            You can verify your alumni status using your active .edu university email address during registration. If you no longer have access to your university email, you can securely upload a copy of your degree or academic transcript for manual verification by our admissions team within 24 hours.
                        </div>
                    </details>

                    <!-- Q3 -->
                    <details class="group bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl border border-outline-variant dark:border-gray-800 [&_summary::-webkit-details-marker]:hidden reveal-card duration-300" style="transition-delay: 100ms;">
                        <summary class="flex justify-between items-center w-full p-6 cursor-pointer list-none select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#fdf4eb] dark:bg-[#25282c] flex items-center justify-center text-primary dark:text-primary-container group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined">work</span>
                                </div>
                                <span class="text-headline-md font-bold group-hover:text-primary dark:group-hover:text-primary-container transition-colors dark:text-white text-left">Can I use this for hiring?</span>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-[#fdf4eb] dark:bg-[#25282c] flex items-center justify-center material-symbols-outlined transition-transform duration-300 group-open:rotate-180 dark:text-gray-400 group-hover:bg-primary-container group-hover:text-on-primary-container">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 pl-20 text-secondary dark:text-[#a0a5a8] dark:text-gray-400 text-body-md animate-fade-in">
                            Yes! As a verified alumni, you can post job openings from your current company directly to the career portal. This is a highly effective way to recruit top-tier talent from your alma mater, ensuring candidates already share a foundation of excellence.
                        </div>
                    </details>

                    <!-- Q4 -->
                    <details class="group bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl border border-outline-variant dark:border-gray-800 [&_summary::-webkit-details-marker]:hidden reveal-card duration-300" style="transition-delay: 150ms;">
                        <summary class="flex justify-between items-center w-full p-6 cursor-pointer list-none select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#fdf0f4] dark:bg-[#25282c] flex items-center justify-center text-primary dark:text-primary-container group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined">school</span>
                                </div>
                                <span class="text-headline-md font-bold group-hover:text-primary dark:group-hover:text-primary-container transition-colors dark:text-white text-left">How does the mentorship program work?</span>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-[#fdf0f4] dark:bg-[#25282c] flex items-center justify-center material-symbols-outlined transition-transform duration-300 group-open:rotate-180 dark:text-gray-400 group-hover:bg-primary-container group-hover:text-on-primary-container">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 pl-20 text-secondary dark:text-[#a0a5a8] dark:text-gray-400 text-body-md animate-fade-in">
                            Mentorship is a core pillar of Alumni Connect. You can opt-in to be a mentor or mentee (or both). Mentees can search our directory by industry or role and send introductory requests. Once accepted, you gain access to a shared tracking board to set goals and schedule milestone check-ins.
                        </div>
                    </details>

                    <!-- Q5 -->
                    <details class="group bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl border border-outline-variant dark:border-gray-800 [&_summary::-webkit-details-marker]:hidden reveal-card duration-300" style="transition-delay: 200ms;">
                        <summary class="flex justify-between items-center w-full p-6 cursor-pointer list-none select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#f5f0fa] dark:bg-[#25282c] flex items-center justify-center text-primary dark:text-primary-container group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                                <span class="text-headline-md font-bold group-hover:text-primary dark:group-hover:text-primary-container transition-colors dark:text-white text-left">Are there fees to use the platform?</span>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-[#f5f0fa] dark:bg-[#25282c] flex items-center justify-center material-symbols-outlined transition-transform duration-300 group-open:rotate-180 dark:text-gray-400 group-hover:bg-primary-container group-hover:text-on-primary-container">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 pl-20 text-secondary dark:text-[#a0a5a8] dark:text-gray-400 text-body-md animate-fade-in">
                            No. Basic membership, networking, and mentorship features are completely free for all verified alumni. We believe in removing barriers to opportunity. Certain premium features, such as advanced recruiting tools for enterprise companies, are offered on a paid basis.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-surface-container-high dark:bg-[#0f1115] pt-24 pb-12 border-t border-outline-variant dark:border-[#444934] dark:border-gray-800 transition-colors duration-500" id="contact">
    <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-1 space-y-6">
                <div class="flex items-center gap-2">
                    <div class="bg-primary-container p-1 rounded-lg">
                        <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
                    </div>
                    <span class="text-headline-md font-bold dark:text-white">Alumni Connect</span>
                </div>
                <p class="text-secondary dark:text-[#a0a5a8] dark:text-gray-400 text-label-sm">Building the world's most trusted academic professional network.</p>
                <div class="flex gap-4">
                    <a class="w-10 h-10 rounded-full border border-outline dark:border-[#757962] dark:border-gray-700 flex items-center justify-center hover:bg-primary-container dark:hover:bg-gray-800 dark:text-gray-300 transition-colors" href="#"><span class="material-symbols-outlined text-[20px]">public</span></a>
                    <a class="w-10 h-10 rounded-full border border-outline dark:border-[#757962] dark:border-gray-700 flex items-center justify-center hover:bg-primary-container dark:hover:bg-gray-800 dark:text-gray-300 transition-colors" href="#"><span class="material-symbols-outlined text-[20px]">share</span></a>
                </div>
            </div>
            <div>
                <h5 class="font-bold mb-6 dark:text-white">Quick Links</h5>
                <ul class="space-y-4 text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400">
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="#home">Home</a></li>
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="#mission">Our Mission</a></li>
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="#testimonials">Voices</a></li>
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="#team">Founding Team</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold mb-6 dark:text-white">Contact Us</h5>
                <ul class="space-y-4 text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400">
                    <li class="flex gap-3"><span class="material-symbols-outlined text-[18px]">mail</span> negineeraj811@gmail.com</li>
                    <li class="flex gap-3"><span class="material-symbols-outlined text-[18px]">phone</span> 90451XXXXX</li>
                    <li class="flex gap-3"><span class="material-symbols-outlined text-[18px]">location_on</span> Jalandhar, Punjab</li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold mb-6 dark:text-white">Legal</h5>
                <ul class="space-y-4 text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-400">
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="{{ route('terms') }}">Terms of Service</a></li>
                    <li><a class="hover:text-on-surface dark:text-[#e3e3e3] dark:hover:text-primary-container transition-colors" href="{{ route('cookies') }}">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-8 border-t border-outline-variant dark:border-[#444934] dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-label-sm text-secondary dark:text-[#a0a5a8] dark:text-gray-500">
            <p>© 2026 Alumni Connect. All rights reserved.</p>
            <p>Made with passion for the academic community.</p>
        </div>
    </div>
</footer>

<script>
    // Theme Toggle Logic
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    
    // Check initial theme
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        if(themeIcon) themeIcon.textContent = 'light_mode';
    } else {
        document.documentElement.classList.remove('dark');
        if(themeIcon) themeIcon.textContent = 'dark_mode';
    }

    if(themeToggle) {
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            if (document.documentElement.classList.contains('dark')) {
                localStorage.theme = 'dark';
                themeIcon.textContent = 'light_mode';
            } else {
                localStorage.theme = 'light';
                themeIcon.textContent = 'dark_mode';
            }
        });
    }

    // Smooth Scroll Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal-card').forEach(el => {
        el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
        observer.observe(el);
    });
</script>
</body>
</html>
