<?php

$files = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
    __DIR__ . '/resources/views/pages/about.blade.php',
    __DIR__ . '/resources/views/pages/privacy.blade.php',
    __DIR__ . '/resources/views/pages/contact.blade.php',
    __DIR__ . '/resources/views/pages/guidelines.blade.php',
];

$links = [
    'about' => 'About Us',
    'privacy' => 'Privacy Policy',
    'contact' => 'Contact',
    'guidelines' => 'Community Guidelines'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        foreach ($links as $route => $text) {
            // Target the <a> tags dynamically
            $pattern = '/<a[^>]*href="\{\{\s*route\(\'' . $route . '\'\)\s*\}\}"[^>]*>\s*' . preg_quote($text, '/') . '\s*<\/a>/s';
            
            $replacement = '<a class="{{ request()->routeIs(\'' . $route . '\') ? \'text-primary font-bold underline\' : \'text-secondary dark:text-[#a0a5a8] hover:text-on-surface hover:underline\' }} transition-all duration-200 text-body-md font-body-md" href="{{ route(\'' . $route . '\') }}">' . $text . '</a>';
            
            $content = preg_replace($pattern, $replacement, $content);
        }
        
        file_put_contents($file, $content);
    }
}
echo "Footers dynamically updated.\n";
