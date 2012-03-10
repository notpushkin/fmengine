<?
/*
 * fmengine 0.4a random playlist
 *
 * Used as (!) fallback (!) if any errors when using default cron playlist
 * To use as default playlist modify JS config in index.php
 *
 * by Pushkov Alexander
 */

$list = Array(); //our playlist

$path='mp3/'; // with trailing /
$scan = scandir($path);
foreach($scan as $file) {
  if ($file != "." && $file != "..") {
    $list[] = $path.$file;
  }
}

// METHOD THREE: Combine methods one and two.

// Remember, it isn't a radio right now.
 
$desid = mt_rand(0, count($list)-1);
$destrack = $list[$desid];

 
//print_r($list);
 
?>{"url": "<?=$destrack?>", "debug": "desid=<?=$desid?> <?=$err?>"}