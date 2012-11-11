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
        return unserialize(strtolower(serialize($title)));
    }
}
?>