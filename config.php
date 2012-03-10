<?
/*
 * fmengine 0.4a config
 * by Pushkov Alexander
 */

$cfg = Array();

$cfg['mysql'] = Array();
$cfg['mysql']['host'] = 'localhost';
$cfg['mysql']['user'] = 'fmengine';
$cfg['mysql']['base'] = 'fmengine';
$cfg['mysql']['pass'] = 'qwerty123';
$cfg['mysql']['prefix'] = 'fm_';

//cron config
$cfg['cron']['length'] = 4*60+30; //Track length. Recommended is the length of the shortest track.
$cfg['cron']['tracknum'] = (2 * 24*60*60)/$cfg['cron']['length'] + 1 ; //Tracks Per Cron. Recommended: (time between cron launches) / (one track length) + 1