<?php
class Poster {
    static function thread($fields) {
        foreach ($fields as $f) {
            $f = utf8_encode($f);
        }
        extract($fields);
        ?>
        <div class="thread">
          <h2>
            <span class="op"><?php echo $op; ?></span>
            <?php echo $title; ?>
            <span class="time"><?php echo $time; ?></span>
          </h2>
          <div class="message"><?php echo nl2br($message); ?></div>
        </div>
        <?php
        echo '<div class="thread">';
        echo "<h2><span class=\"op\">$op</span>$title" .
          "<span class=\"time\">$time</span></h2>";
        echo '<div class="message">' . nl2br($message) . '</div>';
        echo "</div>\n";
    }

    static function no_threads() {
        ?>
        <h2>No threads found for this board.</h2>
        <p>This would be a great time to create one, I bet.</p>
        <?php
    }

    static function reply($reply) {
        foreach ($reply as $f) {
            $f = utf8_decode($f);
        }
        extract($reply);
        ?>
        <div class="reply">
          <h3>
            <span class="poster"><?php echo $poster; ?></span>
            <?php echo $title; ?>
            <span class="time"><?php echo $time; ?></span>
          </h3>
          <div class="reply-message"><?php echo nl2br($message); ?></div>
        </div>
        <?php
    }

    static function reply($reply) {
        extract($reply);
        echo '<div class="reply">';
        echo "<h3><span class=\"poster\">$poster</span>$title" .
          "<span class=\"time\">$time</span></h3>";
        echo '<div class="reply-message">' . nl2br($message) . '</div>';
        echo "</div>\n";
    }
}
