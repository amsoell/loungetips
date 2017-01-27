<?php
  require_once("config.php");
  define('AUTOCLOSE', false);
  
  $sqlx = "SELECT tips.id, tips.tip, IFNULL(SUM(report.report),0) AS score, COUNT(report.report) AS reports FROM tips LEFT JOIN report ON tips.id=report.id WHERE tips.id='".$_REQUEST['id']."' GROUP BY tips.id LIMIT 1";
  $rs = mysql_query($sqlx);
  
  if ($rec = mysql_fetch_array($rs)) {
      $totalscore = ($rec['score'] - (($rec['reports']-$rec['score'])));
?>
<html>
  <head>
    <title>CD101 Lounge Tips</title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="/style.css" type="text/css" media="screen" />    
    <meta name="description" content="Find and share CD101 Lounge Tips! LoungeTips.com lets you share the tips you hear on WWCD, CD101FM in Columbus, OH with fellow listeners who may not have been tuned in to hear them." />
    <meta name="keywords" content="CD101, CD 101, WWCD, 101.1, CD101.1, Columbus, Ohio, Radio, The Alternative Station, Alternative Station, Columbus' Best Radio, Lounge Tips, Lounge, Tips, Lounge Points, Points" />    
  </head>
  <body style="background: url(/images/bginv.png) top repeat-x; background-color: #F9F9F9;">  
    <h1>Report on tip: <i><?php print $rec['tip']; ?></i></h1>
    <p>This tip has been reported as <b><?php print ($totalscore<0?'bad':'good') ?></b> with a <b><?php print ($totalscore<0?'':'+').$totalscore; ?></b> confidence rating. The higher the confidence rating, the more people have reported the tip as good. To add your vote to the confidence score, click one of the buttons below.</p>
    <a href="index.php?action=report&id=<?php print $rec['id']; ?>&value=1" target="_top"><img src="/images/report_good.png" alt="It's Good!" border="0"></a>
    <a href="index.php?action=report&id=<?php print $rec['id']; ?>&value=0" target="_top"><img src="/images/report_bad.png" alt="It's Bad!" border="0"></a>    
  </body>
</html>
<?php
  }
?>
