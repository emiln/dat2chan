<?php
// Extract the parameters passed in the URL.
$params = explode('/', $_GET['url']);

// Determine whether a specific page was requested. If not, send default page.
if (count($params) == 0 || empty($params[0])) {
    // Default page.
} else {
    // Specific board page.
}
