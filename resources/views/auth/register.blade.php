<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Register | Alumni Connect</title>
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
        input:focus, select:focus {
            outline: none !important;
            border-color: #516600 !important;
            box-shadow: 0 0 0 1px #516600 !important;
        }
    </style>
</head>
<body class="bg-surface dark:bg-[#12140e] text-on-surface dark:text-[#e3e3e3] font-body-md overflow-x-hidden flex flex-col min-h-screen">
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
            <a class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8] hover:text-on-surface transition-colors flex items-center gap-2" href="{{ route('login') }}">
            Already have an account? <span class="text-primary font-bold hover:underline">Login</span>
        </a>
            <!-- Theme Toggle -->
            <button id="themeToggle" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container dark:hover:bg-gray-800 transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.3)]">
                <span class="material-symbols-outlined dark:text-primary-container" id="themeIcon">dark_mode</span>
            </button>
        </div>
    </header>
</div>

<main class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop py-12 md:py-16 flex-grow">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-start">
        
        <!-- Left Branding Column: Asymmetric Layout with Illustrated Background -->
        <div class="hidden md:flex md:col-span-5 flex-col gap-12 sticky top-24 relative p-10 -ml-8 rounded-[2.5rem] overflow-hidden border border-outline-variant dark:border-[#444934]/30 shadow-sm">
            <!-- Background Illustration - Working Unsplash Link -->
            <div class="absolute inset-0 z-0">
                <img alt="Abstract Architecture" class="w-full h-full object-cover opacity-[0.25]" src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1000&q=80"/>
                <div class="absolute inset-0 bg-gradient-to-b from-surface/40 via-surface/70 to-surface"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-surface/10 to-surface"></div>
            </div>
            
            <div class="relative z-10 space-y-6">
                <h1 class="font-display-xl text-display-xl text-on-surface leading-tight">
                    Start your <br/>
                    <span class="text-primary italic">next chapter</span>
                </h1>
                <p class="font-body-lg text-body-lg text-secondary dark:text-[#a0a5a8] max-w-md">
                    Join a global network of over 50,000 graduates. Build professional bridges and rediscover academic heritage.
                </p>
            </div>
            
            <!-- Feature Highlighting Glassmorphism-style card -->
            <div class="bg-surface-container-highest/80 dark:bg-[#20241b]/80 backdrop-blur-md rounded-xl p-10 relative overflow-hidden z-10 border border-outline-variant dark:border-[#444934] shadow-sm hover:shadow-md transition-shadow">
                <div class="relative z-10 space-y-4">
                    <span class="material-symbols-outlined text-primary text-4xl">school</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface dark:text-[#e3e3e3]">Heritage &amp; Growth</h3>
                    <p class="text-body-md text-on-surface-variant dark:text-[#c4c8b9]">Connecting generations of alumni through curated mentorship programs and exclusive career opportunities.</p>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-primary-container rounded-full opacity-50 blur-2xl"></div>
            </div>
            
            <div class="flex items-center gap-4 py-4 relative z-10">
                <div class="flex -space-x-3">
                    <img alt="User" class="w-10 h-10 rounded-full border-2 border-surface object-cover" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=100&q=80"/>
                    <img alt="User" class="w-10 h-10 rounded-full border-2 border-surface object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80"/>
                    <img alt="User" class="w-10 h-10 rounded-full border-2 border-surface object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80"/>
                </div>
                <span class="text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8] font-bold">Join 400+ new members this week</span>
            </div>
        </div>

        <!-- Right Form Column -->
        <div class="col-span-1 md:col-span-7 lg:col-span-6 lg:col-start-7">
            <div class="bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] p-8 md:p-12 rounded-[2.5rem] shadow-sm">
                
                @if($errors->any())
                    <div class="bg-error-container text-on-error-container border border-error rounded-xl px-4 py-3 text-sm mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('register') }}" method="POST" class="space-y-8">
                    @csrf
                    <header class="space-y-2 mb-10">
                        <h2 class="font-headline-md text-headline-md text-on-surface dark:text-[#e3e3e3]">Create your account</h2>
                        <p class="text-body-md text-secondary dark:text-[#a0a5a8]">It only takes two minutes to set up your profile.</p>
                    </header>
                    
                    <!-- Name & Email Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                        <div class="space-y-1">
                            <label class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">Full Name</label>
                            <input id="reg-name" name="name" value="{{ old('name') }}"
                                   class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border @error('name') border-error @else border-outline dark:border-[#757962] @enderror text-on-surface px-4 py-3 rounded-lg font-body-md focus:ring-2 focus:ring-primary-container"
                                   placeholder="John Doe" type="text" required autocomplete="name"/>
                            <p id="name-hint" class="text-xs mt-1 hidden flex items-center gap-1">
                                <span id="name-hint-icon" class="material-symbols-outlined text-[14px]">info</span>
                                <span id="name-hint-text">Letters and spaces only — no numbers or symbols.</span>
                            </p>
                            @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-1">
                            <label class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">Gmail Address</label>
                            <input id="reg-email" name="email" value="{{ old('email') }}"
                                   class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border @error('email') border-error @else border-outline dark:border-[#757962] @enderror text-on-surface px-4 py-3 rounded-lg font-body-md focus:ring-2 focus:ring-primary-container"
                                   placeholder="yourname@gmail.com" type="email" required autocomplete="email"/>
                            <p id="email-hint" class="text-xs mt-1 hidden flex items-center gap-1">
                                <span id="email-hint-icon" class="material-symbols-outlined text-[14px]">info</span>
                                <span id="email-hint-text">Only @gmail.com addresses are accepted.</span>
                            </p>
                            @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    
                    <!-- Dynamic Role Selection Dropdown -->
                    <div class="space-y-2">
                        <label class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">I am a...</label>
                        <select id="role-select" name="roles[]" required class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border border-outline dark:border-[#757962] text-on-surface px-4 py-3 rounded-lg font-body-md appearance-none cursor-pointer focus:ring-2 focus:ring-primary-container">
                            <option value="" disabled {{ old('roles.0') ? '' : 'selected' }}>Select your role</option>
                            <option value="alumni" {{ old('roles.0') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                            <option value="mentor" {{ old('roles.0') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                            <option value="student" {{ old('roles.0') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="faculty" {{ old('roles.0') == 'faculty' ? 'selected' : '' }}>Faculty</option>
                            <option value="organizer" {{ old('roles.0') == 'organizer' ? 'selected' : '' }}>Event Organizer</option>
                        </select>
                    </div>
                    
                    <!-- Dynamic Academic Details Row -->
                    <div id="dynamic-fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-gutter">
                        <div class="space-y-2" id="grad-year-container">
                            <label class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">Graduation Year</label>
                            <select id="graduation_year" name="graduation_year" class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border @error('graduation_year') border-error @else border-outline dark:border-[#757962] @enderror text-on-surface px-4 py-3 rounded-lg font-body-md appearance-none cursor-pointer focus:ring-2 focus:ring-primary-container">
                                <option value="" disabled {{ old('graduation_year') ? '' : 'selected' }}>Select Year</option>
                                @for($year = date('Y') + 4; $year >= 1970; $year--)
                                    <option value="{{ $year }}" {{ old('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="space-y-2" id="study-field-container">
                            <label id="study-field-label" class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">Field of Study <span class="text-secondary dark:text-[#a0a5a8] text-xs font-normal">(Optional)</span></label>
                            <input id="field_of_study" name="field_of_study" value="{{ old('field_of_study') }}" class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border border-outline dark:border-[#757962] text-on-surface px-4 py-3 rounded-lg font-body-md focus:ring-2 focus:ring-primary-container" placeholder="e.g. Computer Science" type="text"/>
                        </div>
                    </div>
                    
                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                        <div class="space-y-1">
                            <label class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">Create Password</label>
                            <input id="reg-password" name="password"
                                   class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border @error('password') border-error @else border-outline dark:border-[#757962] @enderror text-on-surface px-4 py-3 rounded-lg font-body-md focus:ring-2 focus:ring-primary-container"
                                   placeholder="••••••••" type="password" required autocomplete="new-password"/>
                            @error('password')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-1">
                            <label class="font-label-sm text-label-sm text-on-surface-variant dark:text-[#c4c8b9] block">Confirm Password</label>
                            <input id="reg-confirm" name="password_confirmation"
                                   class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border border-outline dark:border-[#757962] text-on-surface px-4 py-3 rounded-lg font-body-md focus:ring-2 focus:ring-primary-container"
                                   placeholder="••••••••" type="password" required autocomplete="new-password"/>
                            <p id="confirm-hint" class="text-xs mt-1 hidden flex items-center gap-1">
                                <span id="confirm-hint-icon" class="material-symbols-outlined text-[14px]">info</span>
                                <span id="confirm-hint-text">Passwords do not match.</span>
                            </p>
                        </div>
                    </div>
                    <!-- Live Password Strength Checklist -->
                    <div id="pw-rules" class="hidden bg-surface-container dark:bg-[#1e2025] rounded-xl p-4 space-y-2">
                        <p class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wider mb-1">Password must have:</p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                            <div id="rule-len" class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400">
                                <span class="material-symbols-outlined text-[16px] rule-icon">radio_button_unchecked</span> 8+ characters
                            </div>
                            <div id="rule-letter" class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400">
                                <span class="material-symbols-outlined text-[16px] rule-icon">radio_button_unchecked</span> A letter (a–z)
                            </div>
                            <div id="rule-number" class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400">
                                <span class="material-symbols-outlined text-[16px] rule-icon">radio_button_unchecked</span> A number (0–9)
                            </div>
                            <div id="rule-symbol" class="flex items-center gap-2 text-xs text-secondary dark:text-gray-400 sm:col-span-3">
                                <span class="material-symbols-outlined text-[16px] rule-icon">radio_button_unchecked</span> A symbol (!@#$%^&amp;* etc.)
                            </div>
                        </div>
                    </div>
                    
                    <!-- Consent -->
                    <div class="flex items-start gap-3 py-2">
                        <input id="terms" name="terms" class="mt-1 rounded border-outline dark:border-[#757962] text-primary focus:ring-primary" type="checkbox" required/>
                        <label for="terms" class="text-label-sm font-label-sm text-on-surface-variant dark:text-[#c4c8b9] leading-relaxed">
                            I agree to the <a class="text-primary underline" href="{{ route('terms') }}">Terms of Service</a> and <a class="text-primary underline" href="{{ route('privacy') }}">Privacy Policy</a>. I also consent to receive community updates.
                        </label>
                    </div>
                    
                    <!-- Submit Action -->
                    <button class="w-full bg-primary-container text-on-primary-container font-bold text-body-lg py-4 rounded-lg transition-transform hover:scale-[1.01] active:scale-[0.98] flex justify-center items-center gap-2 group" type="submit">
                        Complete Registration
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                </form>

                <!-- Social Logins -->
                <div class="relative py-6 mt-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant dark:border-[#444934]"></div>
                    </div>
                    <div class="relative flex justify-center text-label-sm font-label-sm">
                        <span class="bg-surface-container-low dark:bg-[#1a1c16] px-4 text-secondary dark:text-[#a0a5a8]">Or register with</span>
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
                
                <div class="mt-8 text-center text-label-sm font-label-sm text-secondary dark:text-[#a0a5a8]">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Login</a>
                </div>
            </div>
            
            <div class="mt-12 md:hidden">
                <p class="text-label-sm text-center text-secondary dark:text-[#a0a5a8]">© 2026 Alumni Connect. Building a modern heritage.</p>
            </div>
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
    document.addEventListener('DOMContentLoaded', function() {

        // ===== ROLE DYNAMIC FIELDS =====
        const roleSelect       = document.getElementById('role-select');
        const dynamicFields    = document.getElementById('dynamic-fields');
        const gradYearContainer= document.getElementById('grad-year-container');
        const gradYearInput    = document.getElementById('graduation_year');
        const studyFieldLabel  = document.getElementById('study-field-label');
        const studyFieldInput  = document.getElementById('field_of_study');

        function updateFields() {
            const role = roleSelect.value;
            if (!role) { dynamicFields.classList.add('hidden'); return; }
            dynamicFields.classList.remove('hidden');
            if (role === 'alumni' || role === 'student') {
                gradYearContainer.classList.remove('hidden');
                gradYearInput.required = true;
                studyFieldLabel.innerHTML = 'Field of Study <span class="text-secondary dark:text-[#a0a5a8] text-xs font-normal">(Optional)</span>';
                studyFieldInput.placeholder = 'e.g. Computer Science';
            } else if (role === 'mentor') {
                gradYearContainer.classList.remove('hidden'); gradYearInput.required = false;
                studyFieldLabel.innerHTML = 'Area of Expertise <span class="text-secondary dark:text-[#a0a5a8] text-xs font-normal">(Optional)</span>';
                studyFieldInput.placeholder = 'e.g. Software Engineering';
            } else if (role === 'faculty') {
                gradYearContainer.classList.add('hidden'); gradYearInput.required = false;
                studyFieldLabel.innerHTML = 'Department / Subject <span class="text-secondary dark:text-[#a0a5a8] text-xs font-normal">(Optional)</span>';
                studyFieldInput.placeholder = 'e.g. Mathematics';
            } else if (role === 'organizer') {
                gradYearContainer.classList.add('hidden'); gradYearInput.required = false;
                studyFieldLabel.innerHTML = 'Organization / Department <span class="text-secondary dark:text-[#a0a5a8] text-xs font-normal">(Optional)</span>';
                studyFieldInput.placeholder = 'e.g. Alumni Association';
            } else if (role === 'admin') {
                gradYearContainer.classList.add('hidden'); gradYearInput.required = false;
                studyFieldLabel.innerHTML = 'Administrative Department <span class="text-secondary dark:text-[#a0a5a8] text-xs font-normal">(Optional)</span>';
                studyFieldInput.placeholder = 'e.g. System Operations';
            }
        }
        roleSelect.addEventListener('change', updateFields);
        if (roleSelect.value) updateFields();

        // ===== HELPER: set hint state =====
        function setHint(hintEl, iconEl, textEl, isOk, okMsg, failMsg) {
            hintEl.classList.remove('hidden');
            if (isOk) {
                iconEl.textContent = 'check_circle';
                iconEl.classList.replace('text-error', 'text-green-600');
                iconEl.classList.add('text-green-600');
                hintEl.classList.remove('text-error'); hintEl.classList.add('text-green-600');
                textEl.textContent = okMsg;
            } else {
                iconEl.textContent = 'cancel';
                iconEl.classList.replace('text-green-600', 'text-error');
                iconEl.classList.add('text-error');
                hintEl.classList.remove('text-green-600'); hintEl.classList.add('text-error');
                textEl.textContent = failMsg;
            }
        }

        // ===== NAME VALIDATION =====
        const nameInput   = document.getElementById('reg-name');
        const nameHint    = document.getElementById('name-hint');
        const nameHintIcon= document.getElementById('name-hint-icon');
        const nameHintTxt = document.getElementById('name-hint-text');
        nameInput.addEventListener('input', function() {
            const val = this.value.trim();
            if (!val) { nameHint.classList.add('hidden'); return; }
            const ok = /^[a-zA-Z\s]+$/.test(val);
            setHint(nameHint, nameHintIcon, nameHintTxt, ok, 'Looks good!', 'Letters and spaces only — no numbers or symbols.');
        });

        // ===== EMAIL VALIDATION =====
        const emailInput   = document.getElementById('reg-email');
        const emailHint    = document.getElementById('email-hint');
        const emailHintIcon= document.getElementById('email-hint-icon');
        const emailHintTxt = document.getElementById('email-hint-text');
        emailInput.addEventListener('input', function() {
            const val = this.value.trim();
            if (!val) { emailHint.classList.add('hidden'); return; }
            const ok = /^[a-zA-Z0-9._%+\-]+@gmail\.com$/i.test(val);
            setHint(emailHint, emailHintIcon, emailHintTxt, ok, 'Valid Gmail address ✓', 'Only @gmail.com addresses are accepted.');
        });

        // ===== PASSWORD STRENGTH =====
        const pwInput     = document.getElementById('reg-password');
        const confirmInput= document.getElementById('reg-confirm');
        const pwRules     = document.getElementById('pw-rules');
        const confirmHint = document.getElementById('confirm-hint');
        const confirmIcon = document.getElementById('confirm-hint-icon');
        const confirmTxt  = document.getElementById('confirm-hint-text');

        function checkRule(id, passes) {
            const el = document.getElementById(id);
            const icon = el.querySelector('.rule-icon');
            if (passes) {
                icon.textContent = 'check_circle';
                el.classList.remove('text-secondary', 'dark:text-gray-400');
                el.classList.add('text-green-600');
            } else {
                icon.textContent = 'radio_button_unchecked';
                el.classList.remove('text-green-600');
                el.classList.add('text-secondary', 'dark:text-gray-400');
            }
        }

        pwInput.addEventListener('focus',  () => pwRules.classList.remove('hidden'));
        pwInput.addEventListener('input',  function() {
            const v = this.value;
            checkRule('rule-len',    v.length >= 8);
            checkRule('rule-letter', /[a-zA-Z]/.test(v));
            checkRule('rule-number', /[0-9]/.test(v));
            checkRule('rule-symbol', /[^a-zA-Z0-9]/.test(v));
            // also re-check confirm
            if (confirmInput.value) {
                const match = confirmInput.value === v;
                setHint(confirmHint, confirmIcon, confirmTxt, match, 'Passwords match ✓', 'Passwords do not match.');
            }
        });

        confirmInput.addEventListener('input', function() {
            if (!this.value) { confirmHint.classList.add('hidden'); return; }
            const match = this.value === pwInput.value;
            setHint(confirmHint, confirmIcon, confirmTxt, match, 'Passwords match ✓', 'Passwords do not match.');
        });
    });
</script>
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
