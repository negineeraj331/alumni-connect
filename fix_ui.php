<?php

$files = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
    __DIR__ . '/resources/views/pages/about.blade.php',
    __DIR__ . '/resources/views/pages/privacy.blade.php',
    __DIR__ . '/resources/views/pages/contact.blade.php',
    __DIR__ . '/resources/views/welcome.blade.php'
];

$toggleHtml = '<button type="button" class="material-symbols-outlined text-secondary dark:text-[#a0a5a8] hover:text-primary transition-colors p-2 ml-4" onclick="document.documentElement.classList.toggle(\'dark\'); this.innerText = document.documentElement.classList.contains(\'dark\') ? \'light_mode\' : \'dark_mode\';">dark_mode</button>';

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // 1. Remove all existing toggle buttons from the script's previous run
        $content = str_replace($toggleHtml . "\n        ", '', $content);
        $content = str_replace($toggleHtml . "\n", '', $content);
        $content = str_replace($toggleHtml, '', $content);
        
        // 2. Inject exactly ONE toggle button in the header.
        // For welcome.blade.php
        if (basename($file) === 'welcome.blade.php') {
            // Find the <nav> block ending and inject before the Login link
            $content = preg_replace('/(<a[^>]*href="[^"]*login[^"]*"[^>]*class="[^"]*text-secondary[^"]*"[^>]*>Login<\/a>)/s', $toggleHtml . "\n        $1", $content, 1);
        } else {
            // For other pages, inject before the "Already have an account?" or "Don't have an account?" link in the <header> block
            $content = preg_replace('/(<a[^>]*class="[^"]*text-label-sm[^"]*"[^>]*href="[^"]*(login|register)[^"]*"[^>]*>)/s', $toggleHtml . "\n        $1", $content, 1);
        }

        // 3. Fix the footer text color so "Alumni Connect" is visible in dark mode
        $content = str_replace(
            '<span class="text-headline-md font-headline-md font-bold text-on-surface flex items-center gap-2">',
            '<span class="text-headline-md font-headline-md font-bold text-on-surface dark:text-white flex items-center gap-2">',
            $content
        );
        
        // 4. Add glow effect to the main form cards on auth pages and static pages
        $content = str_replace(
            'class="bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] p-8 md:p-12 rounded-[2.5rem] shadow-sm"',
            'class="bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] p-8 md:p-12 rounded-[2.5rem] shadow-sm dark:shadow-[0_0_25px_rgba(212,255,62,0.1)]"',
            $content
        );
        $content = str_replace(
            'class="w-full bg-surface-container-low dark:bg-[#1a1c16] p-8 md:p-12 rounded-xl border border-outline-variant dark:border-[#444934]"',
            'class="w-full bg-surface-container-low dark:bg-[#1a1c16] p-8 md:p-12 rounded-xl border border-outline-variant dark:border-[#444934] dark:shadow-[0_0_25px_rgba(212,255,62,0.1)]"',
            $content
        );
        $content = str_replace(
            'class="bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] rounded-[2.5rem] overflow-hidden shadow-sm w-full"',
            'class="bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] rounded-[2.5rem] overflow-hidden shadow-sm w-full dark:shadow-[0_0_25px_rgba(212,255,62,0.1)]"',
            $content
        );

        file_put_contents($file, $content);
    }
}

echo "UI fixes applied.\n";
