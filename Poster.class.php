<?php
include ('titlegenerator.php');
class Poster {
    static function thread($fields) {
        foreach ($fields as $f) {
            $f = utf8_encode($f);
        }
        extract($fields);
        ?>
        <div class="thread">
          <h2>
            <span class="poster"><?php echo $poster; ?></span>
            <a href="<?php echo $baseurl.'/'.'awsm' . '/' . titlegenerator::cleanurl($title); ?>"><?php echo $title; ?></a>
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
    static function invalid_thread() {
        ?>
        <h2>CATASTROPHICAL THREAD-EXISTENCE FAILURE</h2>
        <p>The thread you are looking for does not exist.</p>
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
            <?php if (is_null($title)) {
                echo "&nbsp;";
                }
            else {
                echo $title; 
            }?>
            <span class="time"><?php echo $time; ?></span>
          </h3>
          <div class="reply-message"><?php echo nl2br($message); ?></div>
        </div>
        <?php
    }
    static function reply_form($id) {
	?>
	<div id="reply_form">
	<div id="reply_hide">
	<a href = "#"class = "reply_hide">Reply</a>
	</div>
	<div id="reply_input">
      <form action="/submit_reply.php" method="post">
      <input type = "text" name="title" placeholder="The title of your post"><br />
      <input type = "text" name="name" placeholder="This is the name you post under"><br />
      <textarea rows="8" cols="50" name="message" placeholder ="Your message goes here."></textarea>
      <input type = "file" accept="image" name="file">
      <br />
      <input type="hidden" name="reply_to" value="<?php echo $id; ?>"></input>
      <input type = "submit" value="post" name="post"><?php
      }
}
