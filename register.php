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
$forum_page['redirect_url'] = '/welcome.php';
$forum_page['form_action'] = forum_link($forum_url['register']);
 
$forum_page['hidden_fields'] = array(
	'form_sent'	=> '<input type="hidden" name="form_sent" value="1" />',
	'redirect_url'	=> '<input type="hidden" name="redirect_url" value="'.forum_htmlencode($forum_page['redirect_url']).'" />',
	'csrf_token'	=> '<input type="hidden" name="csrf_token" value="'.generate_form_token($forum_page['form_action']).'" />'
);
 
?>
  <h1>Register</h1>
    <div class="contentbox" style="width:650px;">
		<form class="frm-form" id="afocus" method="post" accept-charset="utf-8" action="<?php echo $forum_page['form_action'] ?>">
			<div class="hidden">
				<input type="hidden" name="form_sent" value="1" />
				<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($forum_page['form_action']) ?>" />
			</div>
<?php ($hook = get_hook('rg_register_pre_group')) ? eval($hook) : null; ?>
			<div class="frm-group group<?php echo ++$forum_page['group_count'] ?>">
<?php ($hook = get_hook('rg_register_pre_username')) ? eval($hook) : null; ?>
				  <label for="fld<?php echo ++$forum_page['fld_count'] ?>"><?php echo $lang_profile['Username']; ?></label> <input type="text" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_username" value="<?php echo(isset($_POST['req_username']) ? forum_htmlencode($_POST['req_username']) : '') ?>" size="35" maxlength="25" /><br />
<?php ($hook = get_hook('rg_register_pre_password')) ? eval($hook) : null; ?>
<?php if ($forum_config['o_regs_verify'] == '0'): ?>				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
				  <label for="fld<?php echo ++$forum_page['fld_count'] ?>"><?php echo $lang_profile['Password']; ?></label>	<input type="password" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_password1" size="35" /><br />
				</div>
<?php ($hook = get_hook('rg_register_pre_confirm_password')) ? eval($hook) : null; ?>
				<label for="fld<?php echo ++$forum_page['fld_count'] ?>">Confirm Password</label> <input type="password" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_password2" size="35" /><br />
<?php endif; ($hook = get_hook('rg_register_pre_email')) ? eval($hook) : null; ?>				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
				<label for="fld<?php echo ++$forum_page['fld_count'] ?>"><?php echo $lang_profile['E-mail']; ?></label> <input type="text" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_email1" value="<?php echo(isset($_POST['req_email1']) ? forum_htmlencode($_POST['req_email1']) : '') ?>" size="35" maxlength="80" /><br />
<?php ($hook = get_hook('rg_register_pre_email_confirm')) ? eval($hook) : null; ?>
<?php if ($forum_config['o_regs_verify'] == '1'): ?>				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
				<label for="fld<?php echo ++$forum_page['fld_count'] ?>"><?php echo $lang_profile['Confirm e-mail']; ?></label> <input type="text" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_email2" value="<?php echo(isset($_POST['req_email2']) ? forum_htmlencode($_POST['req_email2']) : '') ?>" size="35" maxlength="80" /><br />
      </div>
<?php endif;

		$languages = array();
		$d = dir(FORUM_ROOT.'lang');
		while (($entry = $d->read()) !== false)
		{
			if ($entry != '.' && $entry != '..' && is_dir(FORUM_ROOT.'lang/'.$entry) && file_exists(FORUM_ROOT.'lang/'.$entry.'/common.php'))
				$languages[] = $entry;
		}
		$d->close();

		($hook = get_hook('rg_register_pre_language')) ? eval($hook) : null;

		// Only display the language selection box if there's more than one language available
		if (count($languages) > 1)
		{
			natcasesort($languages);

?>
				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
					<div class="sf-box select">
						<label for="fld<?php echo ++$forum_page['fld_count'] ?>"><span><?php echo $lang_profile['Language'] ?></span></label><br />
						<span class="fld-input"><select id="fld<?php echo $forum_page['fld_count'] ?>" name="language">
<?php

			$select_lang = isset($_POST['language']) ? $_POST['language'] : $forum_config['o_default_lang'];
			foreach ($languages as $lang)
			{
				if ($select_lang == $lang)
					echo "\t\t\t\t\t\t".'<option value="'.$lang.'" selected="selected">'.$lang.'</option>'."\n";
				else
					echo "\t\t\t\t\t\t".'<option value="'.$lang.'">'.$lang.'</option>'."\n";
			}

?>
						</select></span>
					</div>
				</div>
<?php

		}

		$select_timezone = isset($_POST['timezone']) ? $_POST['timezone'] : $forum_config['o_default_timezone'];
		$select_dst = isset($_POST['form_sent']) ? isset($_POST['dst']) : $forum_config['o_default_dst'];
?>

<?php ($hook = get_hook('rg_register_pre_group_end')) ? eval($hook) : null; ?>
			</div>
<?php ($hook = get_hook('rg_register_group_end')) ? eval($hook) : null; ?>
			<div class="frm-buttons">
				<span class="submit"><input type="submit" name="register" value="<?php echo $lang_profile['Register'] ?>" /></span>
			</div>
		</form>
		</div>
	</div>
<?php
  include("$site_root/include/footer.php"); 
?>
  </body>
</html>
