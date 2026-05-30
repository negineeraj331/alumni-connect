<?php

$files = [
    __DIR__ . '/resources/views/auth/login.blade.php',
    __DIR__ . '/resources/views/auth/register.blade.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Find Google button and replace with <a>
        $content = preg_replace(
            '/<button class="flex items-center justify-center px-4 py-3 border border-outline dark:border-\[#757962\] rounded-lg hover:bg-surface transition-colors gap-2" type="button">(\s*<svg.*?Google<\/span>\s*)<\/button>/s',
            '<a href="{{ route(\'oauth.redirect\', [\'provider\' => \'google\']) }}" class="flex items-center justify-center px-4 py-3 border border-outline dark:border-[#757962] rounded-lg hover:bg-surface transition-colors gap-2">$1</a>',
            $content
        );

        // Find LinkedIn button and replace with <a>
        $content = preg_replace(
            '/<button class="flex items-center justify-center px-4 py-3 border border-outline dark:border-\[#757962\] rounded-lg hover:bg-surface transition-colors gap-2" type="button">(\s*<svg.*?LinkedIn<\/span>\s*)<\/button>/s',
            '<a href="{{ route(\'oauth.redirect\', [\'provider\' => \'linkedin\']) }}" class="flex items-center justify-center px-4 py-3 border border-outline dark:border-[#757962] rounded-lg hover:bg-surface transition-colors gap-2">$1</a>',
            $content
        );

        file_put_contents($file, $content);
    }
}
echo "OAuth Links replaced.\n";
