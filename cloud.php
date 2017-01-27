<?php
  require_once("config.php");
  define('AUTOCLOSE', false);
?>
<html>
  <head>
    <title>CD101@102.5 Lounge Tips</title>
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
    <script type="text/javascript">
      $(document).ready(function() {
        
      });
    </script>    
  </head>
  <body>  
<?php include("$site_root/include/header.php"); ?>
<?php include("$site_root/talk/include/user/nav.php"); ?>
<!-- div class="blue announcement"></div -->
<p>If you're a frequent CD101 listener and collect lounge points, you've probably noticed that CD101 recycles their lounge tips quite often. We thought it would be fun to show the top tips since we've been reporting them. This doesn't really serve any practical purpose, just something that seemed fun and interesting.</p>
<?php
  $sqlx = "select distinct lower(tip) as tip, count(lower(tip)) as count from tips where (description like '%am' or description like '%pm' or description='noon') group by lower(tip) order by rand()";
  $rs = mysql_query($sqlx);

  print '<ul class="cloud">';
  while ($rec = mysql_fetch_array($rs)) {
    print '<li style="font-size:'.(9*$rec['count']).'px;left:'.(rand(0, 650)).'px;top:'.(rand(0,400)).'px;">'.$rec['tip'].'</li>';
  }
  print "</ul>";
?>
<?php
  include("$site_root/include/footer.php"); 
?>
  </body>
</html>
