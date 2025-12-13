<?php

// The hostname that should trigger a redirect.
$redirectHost = 'consilia.cz';

// The final destination for the redirect.
$redirectTarget = 'https://www.consilia-brno.com';

// Get the host from the request headers.
$currentHost = $_SERVER['HTTP_HOST'];

// --- Decision Logic ---
if ($currentHost === $redirectHost) {
    // If the host matches, issue a temporary redirect (307) and stop.
    header("Location: " . $redirectTarget, true, 307);
    exit();
} else {
    // For any other host, serve the static landing page.
    // Set the content type to HTML.
    header("Content-Type: text/html; charset=utf-8");
    
    // Read and output the contents of your index.html file.
    // The path is relative to this PHP file's location.
    $content = @file_get_contents(__DIR__ . '/../landing.html');
    if ($content === false) {
        http_response_code(500);
        echo 'Internal Server Error';
        exit();
    }
    echo $content;

}
