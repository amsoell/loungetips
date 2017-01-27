<?php
  require("config.php");
  define('AUTOCLOSE', false);
?>
<html>
  <head>
    <title>CD101 Lounge Tips</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')>0) { ?>
    <meta name="viewport" content="width=320; initial-scale=0.43; maximum-scale=0.43; user-scalable=0;"/>
    <link rel="stylesheet" href="iphone.css" type="text/css" media="screen" />    
<?php } ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="feed.rss" />
    <meta name="description" content="Find and share CD101 Lounge Tips! LoungeTips.com lets you share the tips you hear on WWCD, CD101FM in Columbus, OH with fellow listeners who may not have been tuned in to hear them." />
    <meta name="keywords" content="CD101, CD 101, WWCD, 101.1, CD101.1, Columbus, Ohio, Radio, The Alternative Station, Alternative Station, Columbus' Best Radio, Lounge Tips, Lounge, Tips, Lounge Points, Points" />    
  </head>
  <body>  
<?php include("include/header.php"); ?>
<?php include("$site_root/talk/include/user/nav.php"); ?>
  <h1>...woah, hold up a second!</h1>
  <p>If you're anything like us here at Lounge Tips, you love CD101. We listen at home, in our cars, streaming over the internet... really any time we can. We love collecting lounge points so we can get into the big room, get concert tickets, and other cool stuff that CD101 gives to their listeners. Unfortunately, we can't listen all day every day; There are meetings, lunch breaks, and other things that come up. That's why we encourage people to share the lounge tips they hear on-air -- so that if we happen to be away from the radio at the wrong time, we don't lose out.</p>
  <p>However, there are some lounge tips that we would prefer you not share:</p>
  <ul>
    <li><b>Sounding Board Tips</b>: Every week, CD101 sends out a survey to listeners asking what they think about certain songs. Andyman personally combs through these surveys in order to adjust the playlist so that we get the best combination of music possible. It's your way of having a say in what gets played. Listeners who complete the survey are rewarded with a lounge tip worth 101 points. By sharing that tip, it results in people not completing the survey, which means less input for CD101. So please, don't share sounding board tips. The survey is quick, and helps make CD101 better. To sign up for the CD101 Sounding Board, visit <a href="http://www.cd101.com/sections/onAir/SoundingBoard.aspx">http://www.cd101.com/sections/onAir/SoundingBoard.aspx</a></li>
    <li><b>Text Club Tips</b>: The CD101 Text Club is a great way to keep updated on events around Columbus. As a bonus, Text Club members get a whopping 1,011 point bonus.  It's easy to sign up, and easy to manage what information you opt-in for. To sign up, visit <a href="http://www.cd101.com/sections/events/TextClub.aspx">http://www.cd101.com/sections/events/TextClub.aspx</a></li>
    <li><b>Trivia Tips</b>: Occasionally, CD101 sponsors will include trivia questions in the Lounge. When the answers to these trivia questions are shared, CD101 sponsors lose out on clicks to their site, and ultimate CD101 loses out on advertising income.  These trivia questions are incredibly easy, so if you want the points, please spend the 3 minutes to help support CD101</li>
  </ul>
  <p>In short, the LoungeTips.com entry form has a drop menu with only hourly slots for a reason. Please, keep sharing the hourly tips, but let's make sure that our sharing doesn't hurt the station we love!</p>
  <p>Thanks, and keep sharing those lounge tips!</p>
  <p>The LoungeTips Team</p>
<?php include("include/footer.php"); ?>
  </body>
</html>