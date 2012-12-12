<?php
include ('titlegenerator.php');
class Poster {
    static function thread($fields) {
        foreach ($fields as $f) {
            $f = utf8_encode($f);
        }
        extract($fields);
        ?>
        <div class="thread" id="<?php echo $id ?>p">
        <span class="anchor" id="<?php echo $id; ?>"></span>
        
          <h2>
            <span class="poster"><?php echo $poster; ?> - Post id: <a href="#"><?php echo $id ?></a></span>
            <a href="<?php echo $baseurl.$_GET['url'].'/'.$url; ?>"><?php echo $title; ?></a>
            <span class="time"><?php echo $time; ?></span>
          </h2>
         <?php if (file_exists($file)) {
            ?>
          <a href="<?php echo $imgurl ?>" target="_blank"><img src="<?php echo $imgurl_thumb ?>" alt="No image here, bro"></a>
            <?php } ?>
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
        <div class="reply" id="<?php echo $id; ?>p">
        <span class="anchor" id="<?php echo $id; ?>"></span>
          <h3>
            <span class="poster"><?php echo $poster; ?> - Post id: <a href="#"><?php echo $id ?></a></span>
            <?php if (is_null($title)) {
                echo "&nbsp;";
                }
            else {
                echo $title; 
            }?>
            <span class="time"><?php echo $time; ?></span>
          </h3>
         <?php if (file_exists($file)) {
            ?>
          <a href="<?php echo $imgurl ?>" target="_blank"><img src="<?php echo $imgurl_thumb ?>" alt="No image here, bro"></a>
            <?php } ?>
          <div class="reply-message"><?php echo nl2br($message); ?></div>
        </div>
        <?php
    }
    static function reply_form($id,$board) {
	?>
	<div id="reply_form">
	<div id="reply_hide">
	<a href="#" class = "reply_hide">Reply</a>
	</div>
	<div id="reply_input">
      <form action="/submit_reply.php" method="post" enctype="multipart/form-data">
      <input type = "text" name="title" placeholder="The title of your post"><br />
      <input type = "text" name="name" placeholder="This is the name you post under"><br />
      <textarea rows="8" cols="50" name="message" placeholder ="Your message goes here."></textarea>
      <input type = "file" accept="image" name="file">
      <br />
      <input type="hidden" name="reply_to" value="<?php echo $id; ?>"></input>
      <input type="hidden" name="board" value="<?php echo $board; ?>"></input>
      <input type="hidden" name="refer" value="<?php echo $_GET['url']?>"></input>
      <input type = "submit" value="post" name="post">
      </div><?php
      }
    static function thread_form($board) {
    ?>
           <div id="action">
        <a href="#">Create new thread</a>
        <a href="http://www.dat2chan.org/rules.html">Rules - please read before posting</a>
        <!--Creates a new post in the current thread. If no thread is specified, the user will need to define which thread to post in or create a new thread-->
      </div>
      <div id="postform">
      <form action="/submission.php" method="post" enctype="multipart/form-data">
      <input type = "text" name="title" placeholder="The title of your thread"><br />
      <input type = "text" name="name" placeholder="This is the name you post under"><br />
      <textarea rows="8" cols="50" name="message" placeholder ="Your message goes here."></textarea>
      <input type = "file" accept="image" name="file">
      <input type="hidden" name ="board" value="<?php echo $board; ?>"> </input>
      <input type="hidden" name="refer" value="<?php echo $_GET['url']?>"></input>
      <br />
      <input type = "submit" value="post" name="post">
      </form>
      </div>
      <?php
    }
  }

