<?php

$files = [
    __DIR__ . '/resources/views/pages/about.blade.php',
    __DIR__ . '/resources/views/pages/privacy.blade.php',
    __DIR__ . '/resources/views/pages/contact.blade.php',
    __DIR__ . '/resources/views/pages/guidelines.blade.php',
];

$landingSymbol = '<div class="bg-primary-container p-1 rounded-lg flex items-center justify-center">
    <span class="material-symbols-outlined text-on-primary-container" data-icon="school">school</span>
</div>';

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // 1. Change year
        $content = str_replace('© 2024 Alumni Connect', '© 2026 Alumni Connect', $content);
        
        // 2. Header and Footer Symbol Replacement
        // The old symbol looks like:
        // <span class="material-symbols-outlined text-primary text-xl" data-icon="school">school</span>
        $oldSymbolPattern = '/<span[^>]*data-icon="school"[^>]*>school<\/span>/';
        
        $content = preg_replace($oldSymbolPattern, $landingSymbol, $content);
        
        file_put_contents($file, $content);
    }
}

// Also update the year in login and register and welcome just in case
$otherFiles = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
    __DIR__ . '/resources/views/welcome.blade.php',
];

foreach ($otherFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $content = str_replace('© 2024 Alumni Connect', '© 2026 Alumni Connect', $content);
        file_put_contents($file, $content);
    }
}

echo "Symbols and copyright year updated.\n";
