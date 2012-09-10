<?php
class Poster {
    static function thread($fields) {
        extract($fields);
        echo '<div class="thread">';
        echo "<h2><span class=\"op\">$op</span> - $title " .
          "- <span class=\"time\">$time</span></h2>";
        echo '<div class="message">' . nl2br($message) . '</div>';
        echo "</div>\n";
    }

    static function no_threads() {
        echo '<h2>No threads found for this board.</h2>';
        echo '<p>This would be a great time to create one, I bet.</p>';
    }
}
