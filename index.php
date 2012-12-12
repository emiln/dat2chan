<?php
// Load various stuff.
include('DB.class.php');
include('Poster.class.php');

// Extract the parameters passed in the URL.
$params = explode('/', $_GET['url']);
$baseurl = 'http://www.dat2chan.org';
// Wrap content in header.
include('header.html');

// Determine whether a specific page was requested. If not, send default page.
switch (count($params)) {
    case 0:
        echo 'You requested nothing at all. What are you doing, bro?';
        break;
    case 1:
        $board_q = 'SELECT id FROM boards WHERE name=?';
        $board_r = DB::query($board_q, array($params[0]));
	$board_name = $params[0];
        $board_r = $board_r[0]['id'];
        $query = 'SELECT * FROM threads WHERE board=? ORDER BY last_activity DESC';
        $res = DB::query($query, array($board_r));
        if (count($res) == 0) {
            Poster::no_threads();
        } else {
            foreach ($res as $r) {
              Poster::thread($r);
              $post_id = $r['id'];
              $post_q = 'SELECT * FROM posts WHERE board=?' .
                ' AND reply_to=? ORDER BY id DESC LIMIT 5';
              $post_r = DB::query($post_q, array($board_r, $post_id));
              $post_r = array_reverse($post_r);
              foreach ($post_r as $reply) {
                  Poster::reply($reply);
                }
            }
        }
        Poster::thread_form($board_r);
        break;
    case 2:
    $thread_q = 'SELECT * FROM threads WHERE clean_title=?';
	$thread_r = DB::query($thread_q,array($params[1]));
    
	if (count($thread_r) == 0) {
        poster::invalid_thread();
        }
    else {
        foreach ($thread_r as $thread) {
            Poster::thread($thread);
            $post_id = $thread['id'];
            $post_q = 'SELECT * FROM posts WHERE reply_to=?';
            $post_r = DB::query($post_q, array($post_id));
            $board_q = 'SELECT id FROM boards WHERE name=?';
            $board_r = DB::query($board_q, array($params[0]));
            $board_name = $params[0];
            $board_r = $board_r[0]['id'];
            foreach ($post_r as $post) {
                Poster::reply($post);
            }

        }
        Poster::reply_form($post_id,$board_r);
    }
        break;
    case 3:
        if ($params[1]=='p') {
            $board_q='SELECT id FROM boards WHERE name=?';
            $board_r=DB::query($board_q,array($params[0]));
            $board_r=$board_r[0]['id'];
            $ant_threads=1;
            $ant_thr=$ant_threads;
            $query='SELECT * FROM threads WHERE board=? ORDER BY last_activity DESC LIMIT ?*?,?';
            $result=DB::query($query,array($board_r,$ant_thr,$params[2],$ant_threads));
            if(count($result)==0){
                Poster::no_threads();
            }
            else {
              foreach ($result as $r) {
                  Poster::thread($r);
                  $post_id = $r['id'];
                  $post_q = 'SELECT * FROM posts WHERE board=?' .
                    ' AND reply_to=? ORDER BY id DESC LIMIT 5';
                  $post_r = DB::query($post_q, array($board_r, $post_id));
                  $post_r = array_reverse($post_r);
                  foreach ($post_r as $reply) {
                      Poster::reply($reply);
                  }
                }
            }
        }
        break;
        
}
// Wrap content in footer.
include('footer.html');
?>