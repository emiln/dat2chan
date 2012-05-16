<?php
// Extract the parameters passed in the URL.
$params = explode('/', $_GET['url']);

// Determine whether a specific page was requested. If not, send default page.
switch (count($params)) {
    case 0:
        echo 'You requested nothing at all. What are you doing, bro?';
        break;
    case 1:
        echo empty($params[0]) ? 'You requested an empty board.' :
            'You requested the front page of board "' . $params[0] . '".';
        break;
    case 2:
        echo 'You requested a thread called "' . $params[1] . '" from a board '
            . 'called "' . $params[0] . '".';
        break;
    case 3:
        echo $params[1] == 'page' ? 'You requested page ' . $params[2] .
            ' of the board "' . $params[0] . '"."' :
            'I am not really sure what you requested, bro.';
        break;
}
