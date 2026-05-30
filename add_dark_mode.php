<?php

$files = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
    __DIR__ . '/resources/views/pages/about.blade.php',
    __DIR__ . '/resources/views/pages/privacy.blade.php',
    __DIR__ . '/resources/views/pages/contact.blade.php',
    __DIR__ . '/resources/views/welcome.blade.php'
];

$replacements = [
    // Backgrounds
    'class="bg-surface text-on-surface' => 'class="bg-surface dark:bg-[#12140e] text-on-surface dark:text-[#e3e3e3]',
    'class="w-full bg-surface-container-high' => 'class="w-full bg-surface-container-high dark:bg-[#20241b]',
    'class="bg-surface-container-low' => 'class="bg-surface-container-low dark:bg-[#1a1c16]',
    'class="w-full bg-surface border' => 'class="w-full bg-surface dark:bg-[#12140e] dark:text-[#e3e3e3] border',
    'class="bg-surface p-6' => 'class="bg-surface dark:bg-[#12140e] p-6',
    'bg-surface-container-highest/80' => 'bg-surface-container-highest/80 dark:bg-[#20241b]/80',
    'bg-primary-container/10' => 'bg-primary-container/10 dark:bg-primary-container/20',
    
    // Text colors
    'text-on-surface"' => 'text-on-surface dark:text-[#e3e3e3]"',
    'text-on-surface ' => 'text-on-surface dark:text-[#e3e3e3] ',
    'text-secondary' => 'text-secondary dark:text-[#a0a5a8]',
    'text-on-surface-variant' => 'text-on-surface-variant dark:text-[#c4c8b9]',
    
    // Borders
    'border-outline-variant' => 'border-outline-variant dark:border-[#444934]',
    'border-outline ' => 'border-outline dark:border-[#757962] ',
    'border-outline"' => 'border-outline dark:border-[#757962]"',
];

$toggleHtml = '
        <button type="button" class="material-symbols-outlined text-secondary dark:text-[#a0a5a8] hover:text-primary transition-colors p-2 ml-4" onclick="document.documentElement.classList.toggle(\'dark\'); this.innerText = document.documentElement.classList.contains(\'dark\') ? \'light_mode\' : \'dark_mode\';">dark_mode</button>';

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Skip if already processed for toggle (to avoid duplicates)
        if (!str_contains($content, "dark_mode</button>")) {
            
            // Apply class replacements safely
            foreach ($replacements as $search => $replace) {
                // simple string replacement. Some may be applied multiple times if run repeatedly, but we only run this once for these pages
                if (!str_contains($content, $replace)) {
                    $content = str_replace($search, $replace, $content);
                }
            }
            
            // Insert toggle button into header.
            // Find Login or Join Now link in header and insert before it
            if (str_contains($content, 'Alumni Connect</span>')) {
                // For login/register/static pages:
                $content = preg_replace('/(<a[^>]*href="[^"]*(login|register)[^"]*"[^>]*>)/s', $toggleHtml . "\n        $1", $content);
            }
            
            file_put_contents($file, $content);
        }
    }
}

// Ensure welcome.blade.php gets the toggle if it doesn't have it
$welcome = file_get_contents(__DIR__ . '/resources/views/welcome.blade.php');
if (!str_contains($welcome, "dark_mode</button>")) {
    $welcome = preg_replace('/(<a[^>]*href="[^"]*login[^"]*"[^>]*>)/s', $toggleHtml . "\n        $1", $welcome);
    file_put_contents(__DIR__ . '/resources/views/welcome.blade.php', $welcome);
}

echo "Dark mode classes applied.\n";
