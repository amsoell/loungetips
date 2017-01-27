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
    <script type="text/javascript" language="javascript">
    <!--
      $(document).ready(function() {
        $('#loungetoggle').click(function() {
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')===false) { ?>
          $('#loungeframe').slideToggle('slow');
          return false;
<?php } ?>          
        });
        
      });
    //-->
    </script>
  </head>
  <body>  
<?php include("$site_root/include/header.php"); ?>
<?php include("$site_root/talk/include/user/nav.php"); ?>
<!-- div class="blue announcement"></div -->
<?php
$forum_page['redirect_url'] = '/';
$forum_page['form_action'] = forum_link($forum_url['login']);
 
$forum_page['hidden_fields'] = array(
	'form_sent'	=> '<input type="hidden" name="form_sent" value="1" />',
	'redirect_url'	=> '<input type="hidden" name="redirect_url" value="'.forum_htmlencode($forum_page['redirect_url']).'" />',
	'csrf_token'	=> '<input type="hidden" name="csrf_token" value="'.generate_form_token($forum_page['form_action']).'" />'
);
 
?>
  <h1>Login</h1>
  <div class="contentbox">
    <form method="post" action="<?php echo $forum_page['form_action'] ?>" >
    	<?php echo implode("\n\t\t", $forum_page['hidden_fields'])."\n" ?>
     <div>
    	<label for="fld1">Username</label> <input type="text" id="fld1" name="req_username" value="" />
     </div>
     <div>
      <label for="fld2" style="clear:left;">Password</label> <input type="password" id="fld2" name="req_password" value="" /><br />
     </div>	
    	<input type="checkbox" id="fld3" name="save_pass" value="1" style="border:0;margin:0;padding:0;margin-left: 20px;" /> <label for="fld3" style="width: auto;margin-top:5px; margin-left: 10px;">Log me in automatically each time I visit.</label>
    	<br />
    	<a href="/talk/request/password/">Forget your password?</a>
    	<br />
     
    	<input type="submit" name="login" value="Login" style="margin-left: 20px;margin-bottom: 30px;" />
    </form>
  </div>
<?php
  include("$site_root/include/footer.php"); 
?>
  </body>
</html>
