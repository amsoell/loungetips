<?php
  require_once("config.php");
  define('AUTOCLOSE', false);
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>CD101@102.5 Lounge Tips</title>
    <link rel="stylesheet" href="/thickbox.css" type="text/css" media="screen" />        
    <link rel="stylesheet" href="/style.css?new" type="text/css" media="screen" />
    <link rel="Stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/black-tie/jquery-ui.css" type="text/css" />
    <link rel="Stylesheet" href="http://jquery-ui.googlecode.com/svn/branches/labs/selectmenu/ui.selectmenu.css" type="text/css" />
    <link rel="stylesheet" media="only screen and (max-device-width: 480px)" href="/iphone.css?new" type="text/css" media="screen" />    
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="/feed.rss" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="description" content="Find and share CD101 Lounge Tips! LoungeTips.com lets you share the tips you hear on WWCD, CD101FM in Columbus, OH with fellow listeners who may not have been tuned in to hear them." />
    <meta name="keywords" content="CD101, CD 101, WWCD, 101.1, 102.5, CD101.1, CD102.5, CD1025, CD101 at 102.5, Columbus, Ohio, Radio, The Alternative Station, Alternative Station, Columbus' Best Radio, Lounge Tips, Lounge, Tips, Lounge Points, Points" />    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
    <script type="text/javascript" src="http://jquery-ui.googlecode.com/svn/branches/labs/selectmenu/ui.selectmenu.js"></script>    
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')===false) : ?>    
    <script src='/include/jquery.thickbox.js' type='text/javascript'></script>    
<?php endif; ?>    
    <script src='/include/tooltip.js' type='text/javascript'></script> 
    <script type="text/javascript" language="javascript">
    <!--    
      $(document).ready(function() {
        $('img.hover').hover(function() {
          rel = $(this).attr('rel');
          src = $(this).attr('src');
          $(this).attr('src', rel).attr('rel', src);
        }, function() {
          rel = $(this).attr('rel');
          src = $(this).attr('src');
          $(this).attr('src', rel).attr('rel', src);
        });
        
        $('img.thumbs').click(function() {
          $isGood = ($(this).attr('class').indexOf('down')==-1);
          $thumb = $(this);
          $.ajax({
            url: '/ajax/report.php',
            dataType: 'json',
            data: 'tip='+$(this).parents('.tip').attr('rel')+'&value='+($isGood?1:0),
            success: function(o) {
              if (o.success) {
                $value = parseInt($thumb.parents('.tip').find('.detail .totalscore').attr('rel'));
                $value += ($isGood?1:-1);
                $thumb.parents('.tip').find('.detail .totalscore').attr('rel', $value).html(($value>=0?'+':'-')+$value);
              } else {
                $thumb.parents('.tip').find('.detail').addClass('error').html(o.errmsg);
              }
              $thumb.parents('.tip').find('.thumbs').fadeOut();              
            }
            
          });
        });
        
        
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')===false) : ?>    
        $('select').selectmenu({style:'dropdown', maxHeight: 250});
        
        var $sequence = $('#thetalk ul li').hide(), div=0;
        (function() {
          if (div >= $sequence.length) div = 0;
          c = arguments.callee
          $($sequence[div]).css('opacity',0).css('display','inline').fadeIn(1000, function() {
            $($sequence[div]).animate({opacity: 1.0}, 10000, function () {
              $($sequence[div++]).fadeOut(1000, c);
            })
          });
        })();
        
<?php endif; ?>
      });
    //-->
    </script>
  </head>
  <body>  
    <script type="text/javascript">
      var blocking = true;    
    </script>
    <script src="/advertisement.js"></script>    
<?php include("$site_root/include/header.php"); ?>
<?php include("$site_root/talk/include/user/nav.php"); ?>
<!-- div class="blue announcement" style="text-align:left;"></div -->
<?php include("$site_root/quickentry.php"); ?>
<?php
  $adblock =<<<EOT
<script type="text/javascript"><!--
google_ad_client = "ca-pub-1427098284712384";
/* LoungeTips Tip Block */
google_ad_slot = "0951641320";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>    
EOT;

  $sqlx = "SELECT tips.id, tips.tip, tips.description, tips.user, talk_users.username, UNIX_TIMESTAMP(tips.entered) AS entered, tips.sticky, IFNULL(SUM(report.report),0) AS score, COUNT(report.report) AS reports, GROUP_CONCAT(report.remoteaddr SEPARATOR ',') AS reporters FROM tips LEFT JOIN talk_users ON tips.user=talk_users.id LEFT JOIN report ON tips.id=report.id WHERE (entered>='".date('Y-m-d 00:00:00')."' OR sticky=1) GROUP BY tips.id ORDER BY case 
WHEN tips.description='11pm' THEN 1
WHEN tips.description='10pm' THEN 2
WHEN tips.description='9pm' THEN 3
WHEN tips.description='8pm' THEN 4
WHEN tips.description='7pm' THEN 5
WHEN tips.description='6pm' THEN 6
WHEN tips.description='5pm' THEN 7
WHEN tips.description='4pm' THEN 8
WHEN tips.description='3pm' THEN 9
WHEN tips.description='2pm' THEN 10
WHEN tips.description='1pm' THEN 11
WHEN tips.description='noon' THEN 12
WHEN tips.description='11am' THEN 13
WHEN tips.description='10am' THEN 14
WHEN tips.description='9am' THEN 15
WHEN tips.description='8am' THEN 16
WHEN tips.description='7am' THEN 17
WHEN tips.description='6am' THEN 18
WHEN tips.description='5am' THEN 19
WHEN tips.description='4am' THEN 20
WHEN tips.description='3am' THEN 21
WHEN tips.description='2am' THEN 22
WHEN tips.description='1am' THEN 23
ELSE 24
END";
  
  $rs = mysql_query($sqlx);

  $_content = new Sprocket('');
  $tips = '';
  if (mysql_num_rows($rs)>0) {
    $_content->h1("Today's Lounge Tips");
  
    $tipcount = mysql_num_rows($rs);
    $i=0;
    while ($rec = mysql_fetch_array($rs)) {
      $i++;

      if ((($tipcount==1) || ($i==$tipcount) || ($i==2)) && 
          ($forum_user['is_guest'])) {
        $_tip = $_content->div('');
        $_tip->class = 'tall tip';        
        $_tip->add($adblock);        
      }

      
      $totalscore = ($rec['score'] - (($rec['reports']-$rec['score'])));
      $reporters = explode(',',$rec['reporters']);
      if ($totalscore>=0) $tips .= ' '.$rec['description'].': '.$rec['tip'].' -';      
    
      $_tip = $_content->div('');
      $_tip->rel = $rec['id'];
      if ($totalscore<-5) {
        $_tip->class = 'tip superbad';
      } elseif ($totalscore<-3) {
        $_tip->class = 'tip reallybad';    
      } elseif ($totalscore<-1) {
        $_tip->class = 'tip bad';
      } else {
        $_tip->class = 'tip';
      }
      
      if (!in_array($_SERVER['REMOTE_ADDR'], $reporters)) {
        $_thumbsUp = $_tip->img('');
        $_thumbsUp->class = 'hover thumbs up';
        $_thumbsUp->rel = '/images/thumbsuphover.jpg';
        $_thumbsUp->src = '/images/thumbsup.jpg';
      }
      
      $_text = $_tip->div('');
      $_text->class = 'text';
      $_text->add('Your <b>'.$rec['description'].'</b> tip is <b class="thetip">'.$rec['tip'].'</b>');
      
      $_detail = $_tip->div('');
      $_detail->class = 'detail';
      $_detail->add('Shared by '.($rec['user']>1?'<a href="/talk/user/'.$rec['user'].'">':'').$rec['username'].'</a> &middot;');
      $_detail->add(date('g:i a', $rec['entered']).' &middot;');
      $_detail->add('<span title="'.($rec['score']).' Good&#13;'.abs($totalscore-$rec['score']).' Bad"> Confidence: <span class="totalscore" rel="'.$totalscore.'">'.($rec['reports']>0?($totalscore<0?'':'+').$totalscore:"Unknown")."</span></span>");
      
      if (!in_array($_SERVER['REMOTE_ADDR'], $reporters)) {
        $_thumbsDown = $_tip->img('');
        $_thumbsDown->class = 'hover thumbs down';
        $_thumbsDown->rel = '/images/thumbsdownhover.jpg';      
        $_thumbsDown->src = '/images/thumbsdown.jpg';      
      }
    }
    $tips = str_replace(' - ', ' &mdash; ', trim($tips, ' -'));
    
  } elseif ($forum_user['is_guest']) {
    $_tip = $_content->div('');
    $_tip->add($adblock);
  }

  echo $_content->render();
  
  if (false) {
?>
<script language="javascript">
  if (blocking) {
    document.write("<div class=\"warning\">Can't see the tips? Try disabling adblock sofware / plugins</div>");
  }
</script>
<?
  }
  include("$site_root/include/loungeiframe.php");
  include("$site_root/include/footer.php"); 
?>
  </body>
</html>
