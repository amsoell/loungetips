{ "success": <?php
  require_once('../config.php');
  require('../include/Growl.class.php');
  
  $sqlx = "SELECT remoteaddr FROM blocked WHERE infractions>1";
  $rs = mysql_query($sqlx);
  $blocked = Array();
  while ($rec = mysql_fetch_array($rs)) {
    $blocked[] = $rec['remoteaddr'];
  }     

  if (in_array($_SERVER['REMOTE_ADDR'], $blocked)) {
    echo 'false, "errmsg": "You have been banned from reporting on tips." ';
  } else {
    $sqlx = "INSERT INTO report (id, remoteaddr, reported, report) VALUES ('".addslashes($_REQUEST['tip'])."', '".addslashes($_SERVER['REMOTE_ADDR'])."', NOW(), '".addslashes($_REQUEST['value'])."')";
    mysql_query($sqlx);
    if (mysql_errno()==1062) {
      echo 'false, "errmsg": "You have already reported on this tip"';
    } else {
      $sqlx = "SELECT tips.description, tips.id, tips.tip, IFNULL(SUM(report.report),0) AS score, COUNT(report.report) AS reports FROM tips LEFT JOIN report ON tips.id=report.id WHERE tips.id='".$_REQUEST['tip']."' GROUP BY tips.id LIMIT 1";
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
    
      echo "true";
    }
  }
?>}