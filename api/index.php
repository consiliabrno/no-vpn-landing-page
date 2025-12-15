<?php

// The hostname pattern that should NOT trigger a redirect (serve landing page).
// Matches: consilia.cz, *.consilia.cz, *.*.consilia.cz, etc.
$allowedHostPattern = '/^(.+\.)?consilia\.cz$/i';

// The final destination for the redirect.
$redirectTarget = 'https://www.consilia-brno.com';

// Get the host from the request headers.
$currentHost = $_SERVER['HTTP_HOST'];

// --- Decision Logic ---
if (preg_match($allowedHostPattern, $currentHost)) {
    // If the host matches consilia.cz or any subdomain, serve the static landing page.
    header("Content-Type: text/html; charset=utf-8");
    
    $content = @file_get_contents(__DIR__ . '/../public/landing.html');
    if ($content === false) {
        http_response_code(500);
        echo 'Internal Server Error';
        exit();
    }
    echo $content;
} else {
    // For any other host, issue a temporary redirect (307) and stop.
    header("Location: " . $redirectTarget, true, 307);
    exit();
}
