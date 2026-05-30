<?php

$envFile = __DIR__ . '/.env';
$content = file_get_contents($envFile);

$content = preg_replace(
    '/GOOGLE_CLIENT_ID=.*/',
    'GOOGLE_CLIENT_ID=217343775269-eu660529r47hjupeg5c5he0p7q25k72d.apps.googleusercontent.com',
    $content
);

$content = preg_replace(
    '/GOOGLE_CLIENT_SECRET=.*/',
    'GOOGLE_CLIENT_SECRET=YOUR_GOOGLE_CLIENT_SECRET',
    $content
);

file_put_contents($envFile, $content);
echo "Google OAuth credentials added to .env file.\n";
