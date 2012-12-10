<?php
class titlegenerator {
    static function cleanurl($title) {
	$title = preg_replace('/[^a-z0-9]/i','-',$title);
        $title = str_replace(' ','-',$title);
	while (strpos($title,'--')!==FALSE) {
	    $title=str_replace('--','-',$title);
	}
	$title = trim($title,'-');
	if (empty($title)) {
	    $title = 'op-is-a-lazy-scrub';
	}
    $query = 'SELECT occurences FROM thread_urls WHERE cleanurl=?';
    $result = DB::query($query,array($title));
    if (empty($result)) {
        $q='INSERT INTO thread_urls (cleanurl,occurences) VALUES (?,0)';
        $r=DB::insert($q,array($title));
        print_r($ooc);
    }
    else {
        $occ=$result[0][occurences];
        echo "OCC is currently:".$occ;
        $occ += 1;
        $q='UPDATE thread_urls SET occurences=? WHERE cleanurl=?';
        $r=DB::update($q,array($occ,$title));
        $title = $title.$occ;
    }
    print_r($result);
    return unserialize(strtolower(serialize($title)));
    }
}
?>