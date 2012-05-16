<?php
// Extract the parameters passed in the URL.
$params = explode('/', $_GET['url']);

// Determine whether a specific page was requested. If not, send default page.
if (count($params) > 1) {
    echo 'You requested a board called "' . $params[0] . '" and an ID=' .
        $params[1];
} elseif (count($params) == 1 && !empty($params[0])) {
    echo 'You requested the front page of the board called "' . $params[0] .
        '".';
} else {
    echo 'You did not request a board at all. What are you doing, bro?';
}
