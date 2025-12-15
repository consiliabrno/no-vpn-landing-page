<?php

// The hostname pattern that should NOT trigger a redirect (serve landing page).
// Matches: consilia.cz, *.consilia.cz, *.*.consilia.cz, etc.
$allowedHostPattern = '/^(.+\.)?consilia\.cz$/i';

// The final destination for the redirect.
$redirectTarget = 'https://www.consilia-brno.com';

/**
 * Redirect to the target URL and exit.
 */
function redirect(string $target): never
{
    header("Location: " . $target, true, 307);
    exit();
}

// Get the host from the request headers.
$currentHost = $_SERVER['HTTP_HOST'];

// --- Decision Logic ---
if (!preg_match($allowedHostPattern, $currentHost)) {
    redirect($redirectTarget);
}

// Serve the static landing page.
header("Content-Type: text/html; charset=utf-8");

$content = @file_get_contents(__DIR__ . '/../public/landing.html');
if ($content === false) {
    redirect($redirectTarget);
}
echo $content;
