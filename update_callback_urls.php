<?php

$servicesFile = __DIR__ . '/config/services.php';
$content = file_get_contents($servicesFile);

// Update relative paths to absolute paths
$content = str_replace(
    "'redirect' => env('GOOGLE_REDIRECT_URI', '/auth/google/callback')",
    "'redirect' => env('GOOGLE_REDIRECT_URI', 'http://127.0.0.1:8000/auth/google/callback')",
    $content
);

$content = str_replace(
    "'redirect' => env('LINKEDIN_REDIRECT_URI', '/auth/linkedin/callback')",
    "'redirect' => env('LINKEDIN_REDIRECT_URI', 'http://127.0.0.1:8000/auth/linkedin/callback')",
    $content
);

file_put_contents($servicesFile, $content);

// Also append to .env
$envFile = __DIR__ . '/.env';
$envContent = file_get_contents($envFile);

$envAdditions = "\n# Socialite Configuration\nGOOGLE_CLIENT_ID=\nGOOGLE_CLIENT_SECRET=\nGOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback\nLINKEDIN_CLIENT_ID=\nLINKEDIN_CLIENT_SECRET=\nLINKEDIN_REDIRECT_URI=http://127.0.0.1:8000/auth/linkedin/callback\n";

if (!str_contains($envContent, "GOOGLE_REDIRECT_URI")) {
    file_put_contents($envFile, $envAdditions, FILE_APPEND);
}

echo "Callback URLs updated to absolute paths.";
