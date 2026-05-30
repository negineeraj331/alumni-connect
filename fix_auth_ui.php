<?php

$files = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);

        // 1. Re-arrange Header items to put the toggle button on the far right
        // In login and register, the header currently looks like:
        // <header ...>
        //     <a href... Logo ... </a>
        //     <button ...>dark_mode</button>
        //     <a ...>Don't have an account? ...</a>
        // </header>
        
        // Remove existing toggle button
        $toggleButton = '<button type="button" class="material-symbols-outlined text-secondary dark:text-[#a0a5a8] hover:text-primary transition-colors p-2 ml-4" onclick="document.documentElement.classList.toggle(\'dark\'); this.innerText = document.documentElement.classList.contains(\'dark\') ? \'light_mode\' : \'dark_mode\';">dark_mode</button>';
        $content = str_replace($toggleButton . "\n        ", "", $content);
        $content = str_replace($toggleButton, "", $content);
        
        // Now find the Login/Join Now link and append the button AFTER it, wrapping them in a flex container if needed, or just placing it after.
        if (basename($file) === 'login.blade.php') {
            $linkPattern = '/(<a class="text-label-sm font-label-sm text-secondary dark:text-\[#a0a5a8\] hover:text-on-surface transition-colors flex items-center gap-2" href="[^"]*register[^"]*">\s*Don\'t have an account\? <span class="text-primary font-bold hover:underline">Join Now<\/span>\s*<\/a>)/s';
            
            $replacement = '<div class="flex items-center gap-6">' . "\n            $1\n            " . $toggleButton . "\n        </div>";
            $content = preg_replace($linkPattern, $replacement, $content);
        } else if (basename($file) === 'register.blade.php') {
            $linkPattern = '/(<a class="text-label-sm font-label-sm text-secondary dark:text-\[#a0a5a8\] hover:text-on-surface transition-colors flex items-center gap-2" href="[^"]*login[^"]*">\s*Already have an account\? <span class="text-primary font-bold hover:underline">Login<\/span>\s*<\/a>)/s';
            
            $replacement = '<div class="flex items-center gap-6">' . "\n            $1\n            " . $toggleButton . "\n        </div>";
            $content = preg_replace($linkPattern, $replacement, $content);
        }

        // 2. Add glow effect to the main form container
        // login.blade.php: <div class="w-full bg-surface-container-low dark:bg-[#1a1c16] p-8 md:p-12 rounded-xl border border-outline-variant dark:border-[#444934] dark:shadow-[0_0_25px_rgba(212,255,62,0.1)]">
        // wait, I might have added dark:shadow-[0_0_25px_rgba(212,255,62,0.1)] earlier.
        
        // Let's strip any existing glow first to avoid duplicates
        $content = str_replace(' dark:shadow-[0_0_25px_rgba(212,255,62,0.1)]', '', $content);
        $content = str_replace(' dark:shadow-[0_0_20px_rgba(212,255,62,0.3)]', '', $content);
        
        $content = str_replace(
            'class="w-full bg-surface-container-low dark:bg-[#1a1c16] p-8 md:p-12 rounded-xl border border-outline-variant dark:border-[#444934]"',
            'class="w-full bg-surface-container-low dark:bg-[#1a1c16] p-8 md:p-12 rounded-xl border border-outline-variant dark:border-[#444934] dark:shadow-[0_0_20px_rgba(212,255,62,0.3)]"',
            $content
        );

        file_put_contents($file, $content);
    }
}
echo "Auth UI updated.";
