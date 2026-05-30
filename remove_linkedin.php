<?php

$files = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Remove the LinkedIn anchor tag
        $content = preg_replace(
            '/<a href="\{\{\s*route\(\'oauth\.redirect\', \[\'provider\' => \'linkedin\'\]\)\s*\}\}"[^>]*>.*?<\/a>/s',
            '',
            $content
        );

        // Change the grid-cols-2 to grid-cols-1 for the button container
        // To be safe, we'll look for `<div class="grid grid-cols-2 gap-4">` that's immediately before the Google button.
        $content = preg_replace(
            '/<div class="grid grid-cols-2 gap-4">\s*(<a href="\{\{\s*route\(\'oauth\.redirect\', \[\'provider\' => \'google\'\]\))/s',
            '<div class="grid grid-cols-1 gap-4">' . "\n" . '                    $1',
            $content
        );

        file_put_contents($file, $content);
    }
}
echo "LinkedIn buttons removed.\n";
