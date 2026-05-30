<?php

$servicesFile = __DIR__ . '/config/services.php';
$content = file_get_contents($servicesFile);

if (!str_contains($content, "'google' =>")) {
    $addition = "
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', '/auth/google/callback'),
    ],
    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_REDIRECT_URI', '/auth/linkedin/callback'),
    ],
";

    // Insert right before the last bracket
    $content = preg_replace('/\];\s*$/', $addition . "];", $content);
    file_put_contents($servicesFile, $content);
    echo "Services updated.\n";
} else {
    echo "Services already updated.\n";
}
