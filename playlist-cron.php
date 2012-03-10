<?
/*
 * fmengine 0.4a playlist cronjob
 * by Pushkov Alexander
 */
 
include 'config.php';

$mylink = mysql_connect($cfg['mysql']['host'], $cfg['mysql']['user'], $cfg['mysql']['pass']) //hello, dolly
    or die(':( mysql connection');
mysql_select_db($cfg['mysql']['base']) or die(':( mysql database');
 
$list = Array();
$tracks = Array();
$trstart = Array();
// The goal is to fill $list with music URLs.

$path='mp3/'; // with trailing /
$scan = scandir($path);
foreach($scan as $file) {
  if ($file != "." && $file != "..") {
    $list[] = $path.$file;
  }
}

// // // // // // // //
// Part 0. Preparing //
/// /// /// /// /// ///
$i = 0;
$query = "DELETE FROM `". $cfg['mysql']['prefix'] ."playlist` WHERE `time` < ".time();
$result = mysql_query($query) or die(':( mysql query #0.' . $i);
$i++;

// Checking for the latest track time
$query = "SELECT `time` FROM `". $cfg['mysql']['prefix'] ."playlist` ORDER BY `time` DESC";
$result = mysql_query($query) or die(':( mysql query #0.' . $i);

$track = mysql_fetch_array($result, MYSQL_ASSOC);

$now = time();
if ($track['time'] > $now) {
  $now = $track['time'];
}

$trackids = Array();
$trackids[-1] = -1;
for ($i = 0; $i <= $cfg['cron']['tracknum']-1; $i++) {
  $desid = mt_rand(0, count($list)-1);
  if ($desid == $trackids[$i-1]) {
    if ($desid == count($list)-1) {
      $desid = $desid + 1;
    } else {
      $desid = $desid - 1;
    }
  }
  $trackids[$i] = $desid;    
  $track = $list[$desid];
  $time = $now+($cfg['cron']['length']*$i);
  $query = "INSERT INTO `".$cfg['mysql']['prefix']."playlist` (time, url) VALUES (" . $time . ", '" . $track . "')";
  $result = mysql_query($query) or die(':( mysql query #' . $i);
} //TODO: Учитывать длину предыдущих треков