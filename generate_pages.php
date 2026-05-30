<?php

$pages = [
    'about' => [
        'title' => 'About Us',
        'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80',
        'content' => '
            <h2 class="text-headline-lg font-headline-lg text-primary">Our Mission</h2>
            <p class="text-body-lg text-secondary">Alumni Connect was founded with a singular purpose: to bridge the gap between generations of graduates and create a lifelong community of mentorship, networking, and growth.</p>
            
            <h3 class="text-headline-md font-headline-md text-on-surface mt-10">Our History</h3>
            <p class="text-body-lg text-secondary">Since our founding, we have connected over 50,000 alumni across 120 countries, fostering innovation and supporting career development across every major industry.</p>
        '
    ],
    'privacy' => [
        'title' => 'Privacy Policy',
        'image' => 'https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&w=1200&q=80',
        'content' => '
            <h2 class="text-headline-lg font-headline-lg text-primary">Data Protection</h2>
            <p class="text-body-lg text-secondary">We take your privacy seriously. All personal data shared on Alumni Connect is encrypted and securely stored. We never sell your information to third-party data brokers.</p>
            
            <h3 class="text-headline-md font-headline-md text-on-surface mt-10">How We Use Your Data</h3>
            <p class="text-body-lg text-secondary">Your data is used exclusively to match you with potential mentors, notify you of relevant events, and facilitate professional connections within our trusted network.</p>
        '
    ],
    'contact' => [
        'title' => 'Contact Us',
        'image' => 'https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&w=1200&q=80',
        'content' => '
            <h2 class="text-headline-lg font-headline-lg text-primary">Get in Touch</h2>
            <p class="text-body-lg text-secondary">Have a question or need support? Our team is here to help.</p>
            
            <div class="bg-surface p-6 rounded-xl border border-outline-variant mt-8 space-y-4">
                <p class="text-body-lg text-on-surface"><strong>Email:</strong> support@alumni.test</p>
                <p class="text-body-lg text-on-surface"><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p class="text-body-lg text-on-surface"><strong>Office:</strong> 100 University Ave, Tech District</p>
            </div>
        '
    ],
    'guidelines' => [
        'title' => 'Community Guidelines',
        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80',
        'content' => '
            <h2 class="text-headline-lg font-headline-lg text-primary">A Culture of Respect</h2>
            <p class="text-body-lg text-secondary">Alumni Connect thrives on mutual respect, professional integrity, and the shared goal of uplifting one another. We strictly prohibit harassment, spam, and unprofessional conduct.</p>
            
            <h3 class="text-headline-md font-headline-md text-on-surface mt-10">Mentorship Etiquette</h3>
            <p class="text-body-lg text-secondary">When engaging in mentorship, please respect the time and boundaries of others. Be punctual, come prepared to meetings, and provide constructive feedback.</p>
        '
    ]
];

$template = file_get_contents(__DIR__ . '/resources/views/auth/login.blade.php');
// Extract the <head> and the header/footer from login.blade.php to ensure 100% exact match
preg_match('/<head>.*?<\/head>/s', $template, $headMatch);
$head = $headMatch[0];

preg_match('/<div class="w-full bg-surface-container-high border-b border-outline-variant shadow-sm">.*?<\/div>/s', $template, $headerMatch);
$header = $headerMatch[0];

preg_match('/<div class="w-full bg-surface-container-high border-t border-outline-variant mt-auto">.*?<\/html>/s', $template, $footerMatch);
$footer = $footerMatch[0];

if (!is_dir(__DIR__ . '/resources/views/pages')) {
    mkdir(__DIR__ . '/resources/views/pages', 0777, true);
}

foreach ($pages as $name => $data) {
    $html = '<!DOCTYPE html>
<html class="light" lang="en">
' . str_replace('<title>Login | Alumni Connect</title>', '<title>' . $data['title'] . ' | Alumni Connect</title>', $head) . '
<body class="bg-surface text-on-surface min-h-screen flex flex-col items-center">
' . $header . '
<main class="flex-grow w-full px-margin-mobile md:px-margin-desktop py-12 max-w-max-width mx-auto">
    <div class="bg-surface-container-low border border-outline-variant rounded-[2.5rem] overflow-hidden shadow-sm w-full">
        <div class="relative h-64 md:h-80 w-full">
            <img src="' . $data['image'] . '" class="w-full h-full object-cover" alt="Banner">
            <div class="absolute inset-0 bg-surface/80 backdrop-blur-md"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="text-display-xl font-display-xl text-on-surface text-center px-4 relative z-10">' . $data['title'] . '</h1>
            </div>
        </div>
        <div class="p-8 md:p-16 max-w-4xl mx-auto space-y-6">
            ' . $data['content'] . '
        </div>
    </div>
</main>
' . $footer;

    file_put_contents(__DIR__ . '/resources/views/pages/' . $name . '.blade.php', $html);
}

echo "Pages created successfully.\n";

