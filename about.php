<?php
  require("config.php");
  define('AUTOCLOSE', false);
?>
<html>
  <head>
    <title>CD101@102.5 Lounge Tips</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')>0) { ?>
    <meta name="viewport" content="width=320; initial-scale=0.43; maximum-scale=0.43; user-scalable=0;"/>
    <link rel="stylesheet" href="iphone.css" type="text/css" media="screen" />    
<?php } ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="feed.rss" />
    <meta name="description" content="Find and share CD101 Lounge Tips! LoungeTips.com lets you share the tips you hear on WWCD, CD101FM @ 102.5 in Columbus, OH with fellow listeners who may not have been tuned in to hear them." />
    <meta name="keywords" content="CD101, CD 101, WWCD, 101.1, 102.5, CD101.1, CD101@102.5, Columbus, Ohio, Radio, The Alternative Station, Alternative Station, Columbus' Best Radio, Lounge Tips, Lounge, Tips, Lounge Points, Points" />    
  </head>
  <body>  
<?php include("include/header.php"); ?>
<?php include("$site_root/talk/include/user/nav.php"); ?>
  <div style="text-align:left">
  <h1>Welcome to Lounge Tips!</h1>
  <p>LoungeTips.com is the best place on the Internet to share CD102.5 lounge tips and talk about CD102.5 related music and events with fellow listeners. If you missed an on-air tip, check out the <a href="/">main page</a> and see if someone else caught it. If you heard a tip on-air, be the first to share it and get fame and glory, at least for the rest of the day.</p>
  <p>LoungeTips.com is a fan run site that isn't directly affiliated with CD102.5. Lest you be concerned, however, we have a very good relationship with the fine people at CD102.5 and they are excited that they have so many dedicated listeners who help each other out sharing tips. They have, however, very reasonably requested that we only share the hourly tips on this site; Special contest tips and sounding board tips are not to be shared, as they rely on the feedback they get in exchange for those tips in order to better learn what music to play and to keep advertisers happy. So please, only share hourly lounge tips.</p>



  <p>Thanks, and keep sharing those lounge tips!</p>
  <p>The LoungeTips Team</p>
  </div>
<?php include("include/footer.php"); ?>
  </body>
</html>
