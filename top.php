<?php
  require_once("config.php");
  define('AUTOCLOSE', false);
?>
<html>
  <head>
    <title>CD101 Lounge Tips</title>
    <link rel="stylesheet" href="/thickbox.css" type="text/css" media="screen" />        
    <link rel="stylesheet" href="/style.css" type="text/css" media="screen" />
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')>0) { ?>
    <meta name="viewport" content="width=320; initial-scale=0.43; maximum-scale=0.43; user-scalable=0;"/>
    <link rel="stylesheet" href="/iphone.css" type="text/css" media="screen" />    
<?php } ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="/feed.rss" />
    <meta name="description" content="Find and share CD101 Lounge Tips! LoungeTips.com lets you share the tips you hear on WWCD, CD101FM in Columbus, OH with fellow listeners who may not have been tuned in to hear them." />
    <meta name="keywords" content="CD101, CD 101, WWCD, 101.1, CD101.1, Columbus, Ohio, Radio, The Alternative Station, Alternative Station, Columbus' Best Radio, Lounge Tips, Lounge, Tips, Lounge Points, Points" />    
    <script src='/include/jquery.js' type='text/javascript'></script>
    <script src='/include/jquery.thickbox.js' type='text/javascript'></script>    
    <script src='/include/tooltip.js' type='text/javascript'></script>        
  </head>
  <body>  
<?php include("$site_root/include/header.php"); ?>
<?php include("$site_root/talk/include/user/nav.php"); ?>
<!-- div class="blue announcement"></div -->
<p>If you're a frequent CD101 listener and collect lounge points, you've probably noticed that CD101 recycles their lounge tips quite often. We thought it would be fun to show the top tips since we've been reporing them. This doesn't really serve any practical purpose, just something that seemed fun and interesting.</p>
<h3>Past 30 Days</h3>
<?php
  $sqlx = "select distinct lower(tip) as tip, count(lower(tip)) as count from tips where (description like '%am' or description like '%pm' or description='noon') and entered>=DATE_ADD(CURRENT_DATE, INTERVAL -30 DAY) group by lower(tip) order by count desc, tip limit 10";
  $rs = mysql_query($sqlx);

  print "<ol>";
  while ($rec = mysql_fetch_array($rs)) {
    print "<li><b>".ucfirst($rec['tip']).'</b> ('.$rec['count'].'x)</li>';
  }
  print "</ol>";
?>
<h3>All-Time Top Tips</h3>
<?php
  $sqlx = "select distinct lower(tip) as tip, count(lower(tip)) as count from tips where description like '%am' or description like '%pm' or description='noon' group by lower(tip) order by count desc, tip limit 10";
  $rs = mysql_query($sqlx);

  print "<ol>";
  while ($rec = mysql_fetch_array($rs)) {
    print "<li><b>".ucfirst($rec['tip']).'</b> ('.$rec['count'].'x)</li>';
  }
  print "</ol>";
?>
<?php
  include("$site_root/include/footer.php"); 
?>
  </body>
</html>
