<?
/*
 * fmengine 0.1p tracklist watcher
 * by Pushkov Alexander
 */

$list = Array(); //our playlist

// The goal is to fill $list with music URLs.

// METHOD ONE: List all files
// Good for hotlinking files from services like PromoDJ
// ! See for crossdomain.xml !

//$list[] = 'mp3/dialup.mp3';
//$list[] = 'mp3/dj_cvetkoff_and_olya_milaksa_-_belaya_noch.mp3';

// METHOD TWO: Use all files from dir
// Good for using files from your server
//
// 1. You should remember that ANYTHING from this dir will be used as an mp3 file
// 2. Subdirectories ARE NOT ALLOWED.
// 3. You can modify it if you want to.

$path='mp3/'; // with trailing /
$scan = scandir($path);
foreach($scan as $file) {
  if ($file != "." && $file != "..") {
    $list[] = $path.$file;
  }
}

// METHOD THREE: Combine methods one and two.

// Remember, it isn't a radio right now.