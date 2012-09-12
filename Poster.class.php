<?php
class Poster {
    static function thread($fields) {
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
    }

    static function no_threads() {
        ?>
        <h2>No threads found for this board.</h2>
        <p>This would be a great time to create one, I bet.</p>
        <?php
    }

    static function reply($reply) {
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
}
