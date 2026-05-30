<?php

$directories = [
    __DIR__ . '/resources/views/dashboards',
    __DIR__ . '/resources/views/profiles',
    __DIR__ . '/resources/views/events',
    __DIR__ . '/resources/views/messages',
    __DIR__ . '/resources/views/feed',
    __DIR__ . '/resources/views/admin',
];

$replacements = [
    // Backgrounds
    'bg-surface ' => 'bg-surface dark:bg-[#12140e] ',
    'bg-surface"' => 'bg-surface dark:bg-[#12140e]"',
    'bg-white' => 'bg-surface-container-lowest dark:bg-[#1a1c21]',
    'bg-surface-container-low ' => 'bg-surface-container-low dark:bg-[#1a1c16] ',
    'bg-surface-container-low"' => 'bg-surface-container-low dark:bg-[#1a1c16]"',
    'bg-surface-container-highest ' => 'bg-surface-container-highest dark:bg-[#20241b] ',
    'bg-surface-container-highest"' => 'bg-surface-container-highest dark:bg-[#20241b]"',
    'bg-surface-container ' => 'bg-surface-container dark:bg-[#20241b] ',
    'bg-surface-container"' => 'bg-surface-container dark:bg-[#20241b]"',
    
    // Text colors
    'text-on-surface"' => 'text-on-surface dark:text-white"',
    'text-on-surface ' => 'text-on-surface dark:text-white ',
    'text-secondary ' => 'text-secondary dark:text-gray-400 ',
    'text-secondary"' => 'text-secondary dark:text-gray-400"',
    'text-gray-600' => 'text-gray-600 dark:text-gray-400',
    'text-gray-800' => 'text-gray-800 dark:text-white',
    
    // Borders
    'border-outline-variant' => 'border-outline-variant dark:border-[#444934]',
    'border-outline ' => 'border-outline dark:border-[#757962] ',
    'border-outline"' => 'border-outline dark:border-[#757962]"',
    'border-gray-200' => 'border-gray-200 dark:border-[#444934]',
    'border-gray-300' => 'border-gray-300 dark:border-[#757962]',
    
    // Shadows
    'shadow-sm ' => 'shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] ',
    'shadow-sm"' => 'shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]"',
    'shadow-md ' => 'shadow-md dark:shadow-[0_0_20px_rgba(212,255,62,0.1)] ',
    'shadow-md"' => 'shadow-md dark:shadow-[0_0_20px_rgba(212,255,62,0.1)]"',
    'shadow-lg ' => 'shadow-lg dark:shadow-[0_0_25px_rgba(212,255,62,0.15)] ',
    'shadow-lg"' => 'shadow-lg dark:shadow-[0_0_25px_rgba(212,255,62,0.15)]"',
];

$filesProcessed = 0;

foreach ($directories as $dir) {
    if (!is_dir($dir)) continue;

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
            $path = $file->getPathname();
            $content = file_get_contents($path);
            $originalContent = $content;

            foreach ($replacements as $search => $replace) {
                // To avoid double-replacing (e.g. if dark:bg-[#12140e] is already there)
                // we only replace if the target dark class isn't already directly following the search text.
                // The simplest way is to check if the replace string already exists, 
                // but since these files might have mixed states, we use a regex or check.
                if (!str_contains($content, $replace)) {
                    $content = str_replace($search, $replace, $content);
                }
            }

            if ($content !== $originalContent) {
                file_put_contents($path, $content);
                $filesProcessed++;
                echo "Updated: " . $path . "\n";
            }
        }
    }
}

echo "Successfully updated {$filesProcessed} files with premium dark mode styling.\n";
