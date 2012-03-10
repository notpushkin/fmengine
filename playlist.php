<?
/*
 * fmengine 0.4a playlist
 * by Pushkov Alexander
 */
function fall($err = 'undef') {
  header('fmerror: '.$err);
  include 'randlist.php';
  die();
}

include 'config.php';

$mylink = mysql_connect($cfg['mysql']['host'], $cfg['mysql']['user'], $cfg['mysql']['pass']) //hello, dolly
    or fall('mysql connection');
mysql_select_db($cfg['mysql']['base']) or fall('mysql database');

$query = "SELECT * FROM `".$cfg['mysql']['prefix']."playlist` WHERE `time` > ".time()." ORDER BY `time`"; //select one song
$result = mysql_query($query) or fall('mysql query');
$track = mysql_fetch_array($result, MYSQL_ASSOC);
?>
{"url": "<?=$track['url']?>",
 "debug": "mySql fetched, time is <?=time()?>, track is valid until <?=$track['time']?>"}
<?/*
if (file_exists('list/list.txt')){
  $tracks = unserialize(file_get_contents('list/list.txt'));
  foreach($tracks as $time => $track) {
    if ($time > time()) {
      echo '{"url": "'.$track.'"}';
      die();
    }
  }
} else {
  include 'playlist-cron.php';
  fall('no entries');
}
*/