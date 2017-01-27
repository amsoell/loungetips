<?php
  require_once('config.php');
  require('include/Growl.class.php');
  if (!defined('AUTOCLOSE')) {
?>
<html>
  <head>
    <title>Lounge Tip Quick Entry</title>
    <link rel="stylesheet" href="quick.css" type="text/css" media="screen" />
  </head>
  <body>
<?php
  }

  $sqlx = "SELECT remoteaddr FROM blocked WHERE infractions>1";
  $rs = mysql_query($sqlx);
  $blocked = Array();
  while ($rec = mysql_fetch_array($rs)) {
    $blocked[] = $rec['remoteaddr'];
  }   

  if ($_REQUEST['action']=='report') {
    if (in_array($_SERVER['REMOTE_ADDR'], $blocked)) {
      $errmsg = "You can no longer report on tips. You have been blocked for submitting fake tips and/or misreporting good tips as bad";
    } else {
      $sqlx = "INSERT INTO report (id, remoteaddr, reported, report) VALUES ('".addslashes($_REQUEST['id'])."', '".addslashes($_SERVER['REMOTE_ADDR'])."', NOW(), '".addslashes($_REQUEST['value'])."')";
      mysql_query($sqlx);
      if (mysql_errno()==1062) {
        $errmsg = "You have already reported on this tip";
      } else {
        $sqlx = "SELECT tips.description, tips.id, tips.tip, IFNULL(SUM(report.report),0) AS score, COUNT(report.report) AS reports FROM tips LEFT JOIN report ON tips.id=report.id WHERE tips.id='".$_REQUEST['id']."' GROUP BY tips.id LIMIT 1";
        $rs = mysql_query($sqlx);
        
        if ($rec = mysql_fetch_array($rs)) {

          if ($_REQUEST['value']!=1) {
            $growl = new Growl();
            $growl->setAddress('home.amsoell.com');
            $growl->addNotification("LoungeTips Report");
            $growl->register();
            $growl->notify("LoungeTips Report", "LoungeTips.com Report: ".strtolower($rec['tip']), "The ".$rec['description']." tip \"".strtolower($rec['tip'])."\" was just reported as ".($_REQUEST['value']==1?'good':'bad'), 0, true);
          }
      
          $totalscore = ($rec['score'] - (($rec['reports']-$rec['score'])));
          
          if (($_REQUEST['value']==1) && ((($rec['reports']>3) && ($rec['score']==3)) || (($rec['reports']==2) && ($rec['score']==2)))) {
            // post tip to Twitter
          	$twtPost = curl_init();     
          	curl_setopt($twtPost, CURLOPT_VERBOSE, 1);
          	curl_setopt($twtPost, CURLOPT_RETURNTRANSFER, 1);
          	curl_setopt($twtPost, CURLOPT_USERPWD, "$twtUsername:$twtPassword");
          	curl_setopt($twtPost, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
          	curl_setopt($twtPost, CURLOPT_POST, 1);  
            curl_setopt($twtPost, CURLOPT_URL, "http://www.twitter.com/statuses/update.xml?status=".urlencode('Your '.$rec['description'].' lounge tip is: '.strtolower($rec['tip']).' http://loungetips.com/t #cd101'));	
          	$result = curl_exec($twtPost);	
          	$resultArray = curl_getinfo($twtPost);
          }
        }
      
        $errmsg = "Thank you for reporting!";
      }
    }
  }

  if ((strlen($_POST['description'])>0) && (strlen($_POST['tip'])>0)) {
    if (in_array($_SERVER['REMOTE_ADDR'], $blocked)) {
      $errmsg = "You can no longer submit lounge tips. You have been blocked for submitting fake tips and/or misreporting good tips as bad";
    } elseif (eregi('^[A-Za-z0-9]+$', $_POST['tip'])===false) {
      $errmsg = "Tips can only include letters and numbers. No spaces or punctuation, please.";
    } elseif (((time() - $_POST['token'])>60) && ($_SERVER['REMOTE_ADDR']!='65.60.220.187')) {
      $errmsg = "Bookmark blocker. If you're seeing this you either:<ul><li>Have a bookmark to this site that is set to submit a tip automatically; or</li><li>Took more than a minute to fill out the tip submission form.</li></ul><p>If it's the former, fix your bookmark. If it's the latter, try submitting your tip again.";
      // here to prevent autoposting from bookmarks
    } else {
      $tip = trim($_POST['tip']);
      $description = trim($_POST['description']);
      $uid = trim($_POST['uid']);
      
      // make sure tip isn't already entered
      $sqlx = "SELECT id FROM tips WHERE UCASE(tip)='".addslashes($tip)."' AND (entered>=DATE_ADD(NOW(), INTERVAL -12 HOUR) OR sticky=1)";
      $rs = mysql_query($sqlx);
      if (mysql_num_rows($rs)<=0) {
    
        // add tip to database  
        $sqlx = "INSERT INTO tips (tip, description, entered, user, remoteaddr, useragent) VALUES ('".addslashes($tip)."', '".addslashes($description)."', NOW(), '".addslashes($uid)."', '".addslashes($_SERVER['REMOTE_ADDR'])."','".addslashes($_SERVER['HTTP_USER_AGENT'])."')";
        mysql_query($sqlx);
        // INCREMENT num_tips VALUE IN USER DATABASE
        $sqlx = "UPDATE talk_users SET num_tips=num_tips+1 WHERE id='".addslashes($uid)."'";
        mysql_query($sqlx);
        
        $growl = new Growl();
        $growl->setAddress('home.amsoell.com');
        $growl->addNotification("LoungeTips Report");
        $growl->register();
        $growl->notify("LoungeTips Report", "New Lounge Tip", "The ".strtolower($description)." tip is ".strtolower(addslashes($tip)), 0, true);
        
        
      } else {
        $errmsg = "That tip has already been submitted";
      }
    }

    if (!defined('AUTOCLOSE')) {
      if ($_POST['redeem']==1) {
        print "<script> window.opener.location='http://loungetips.com'; self.close(); </script>";
      } elseif (strlen($errmsg)>0) {
        print "<script> alert('".addslashes($errmsg)."'); </script>"; 
      } else {
        print "<script> alert('Your tip has been posted!'); self.close(); </script>";
      }
    }
    
  } elseif (strlen($_GET['badtip'])>0) {
    if (in_array($_SERVER['REMOTE_ADDR'], $blocked)) {  
      $errmsg = "You can no longer flag tips as bad. You have been blocked for submitting fake tips and/or misreporting good tips as bad";    
    } else {
      $sqlx = "UPDATE tips SET reported='".addslashes($_SERVER['REMOTE_ADDR'])."' WHERE id='".$_GET['badtip']."'";
      mysql_query($sqlx);
    }
  } elseif (strlen($_GET['notbad'])>0) {
    if (isAdmin()) {
      $sqlx = "SELECT reported FROM tips WHERE id='".$_GET['notbad']."' LIMIT 1";
      $rs = mysql_query($sqlx);
      
      if ($rec = mysql_fetch_array($rs)) {
        $reporter = $rec['reported'];
        
        $sqlx = "UPDATE tips SET reported=null WHERE id='".$_GET['notbad']."' LIMIT 1";
        mysql_query($sqlx);
        
        if ($_GET['penalize']>0) {
          $sqlx = "REPLACE INTO blocked (remoteaddr, infractions) VALUES ('".$reporter."', ".$_GET['penalize'].")";
          mysql_query($sqlx);
        }
      }
    }

  }  elseif (strlen($_GET['confirmbad'])>0) {
    if (isAdmin()) {
      $sqlx = "SELECT remoteaddr FROM tips WHERE id='".$_GET['confirmbad']."' LIMIT 1";
      $rs = mysql_query($sqlx);
      
      if ($rec = mysql_fetch_array($rs)) {
        $reporter = $rec['remoteaddr'];
        
        $sqlx = "DELETE FROM tips WHERE id='".$_GET['confirmbad']."' LIMIT 1";
        mysql_query($sqlx);
        
        if ($_GET['penalize']>0) {
          $sqlx = "REPLACE INTO blocked (remoteaddr, infractions) VALUES ('".$reporter."', ".$_GET['penalize'].")";
          mysql_query($sqlx);
        }
      }
    }

  } elseif (strlen($_GET['toggleSticky'])>0) {
    if (isAdmin()) {
      $sqlx = "UPDATE tips SET sticky=NULLIF(1, sticky) WHERE id='".$_GET['toggleSticky']."'";
      mysql_query($sqlx);
    }

  }

?>
      <script>
        function toolTipOn(tip, o) {
          if (o.value=='') { 
            o.value=tip; 
            o.style.color='#999';
            o.style.fontStyle = 'italic';          
          }
        }
        
        function toolTipOff(tip, o) {
          if (o.value==tip) { 
            o.value=''; 
            o.style.color='#000'; 
            o.style.fontStyle = 'normal';
          }    
        }  
        
        function validate(o) {
          if (o[o.selectedIndex].value == '') {
            window.location = 'rules.php';
          }
        }
      </script>
      <h1 class="pagehead">Got a tip? Share it!</h1>
      <div class="expandable tip">
        <div class="text" style="padding-top: 10px;">
      <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="tipform" onSubmit="if ((this.description.selectedIndex<=0) || (this.tip.value=='')) return false; ">
        <input type="hidden" name="csrf_token" value="<?php echo generate_form_token('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); ?>" />      
        <input type="hidden" name="token" value="<?php print time(); ?>" />
        <input type="hidden" name="uid" value="<?php print $forum_user['id']; ?>">
        <label style="width:auto; padding-right:10px;">Your</label> <select name="description" id="description" onChange="validate(this)"> 
          <option value="">time</option>
          <optgroup label="morning">
            <option value="7am">7am</option>
            <option value="8am">8am</option>
            <option value="9am">9am</option>
            <option value="10am">10am</option>
            <option value="11am">11am</option>
          </optgroup>
          <optgroup label="afternoon">
            <option value="noon">noon</option>
            <option value="1pm">1pm</option>
            <option value="2pm">2pm</option>
            <option value="3pm">3pm</option>
            <option value="4pm">4pm</option>
          </optgroup>
          <optgroup label="evening">            
            <option value="5pm">5pm</option>
            <option value="6pm">6pm</option>
            <option value="7pm">7pm</option>
            <option value="8pm">8pm</option>
          </optgroup>
          <optgroup label="bonus">
            <option value="9pm">9pm</option>
            <option value="10pm">10pm</option>
            <option value="11pm">11pm</option>
            <option value="midnight">midnight</option>
            <option value="1am">1am</option>
            <option value="2am">2am</option>
            <option value="3am">3am</option>
            <option value="4am">4am</option>
            <option value="5am">5am</option>
            <option value="6am">6am</option>
          </optgroup>
          <optgroup label="special">
            <option value="">Sounding Board</option>
            <option value="">Text Club</option>
            <option value="">Trivia</option>
          </optgroup>          
        </select> tip is: <input name="tip" id="tip" maxlength="15" size="10" class="ui-corner-all" onFocus="toolTipOff('tip',this)" onBlur="toolTipOn('tip',this)" value="tip" style="color: #999; font-style: italic" />
        <input type="hidden" name="redeem" value="" />
        <button type="submit" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-hover ui-state-active">Share</button>
<?php
  if (strlen($errmsg)>0) print '<p class="error">'.$errmsg.'</p>';
  if (!defined('AUTOCLOSE')) {
?>
&nbsp;<button type="submit" onClick="this.form.redeem.value=1">Share and redeem</button>
<?php
  }
?>
      </form>
        </div>
      </div>
<?php
  if (!defined('AUTOCLOSE')) {
?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8588127-1");
pageTracker._trackPageview();
} catch(err) {}</script>
  </body>
</html>
<?php
  }
?>
