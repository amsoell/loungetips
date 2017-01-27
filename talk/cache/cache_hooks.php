<?php

define('FORUM_HOOKS_LOADED', 1);

$forum_hooks = array (
  'po_pre_post_contents' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($fid && $forum_user[\'g_pun_tags_allow\'])
			{
				//if pun_approval is installed, we make adding of tags impossible when topic is being created.
				//User can add tags to the topic after it is approved.
				$query= array(
				\'SELECT\'=>\'id, disabled\',
				\'FROM\'=>\'extensions\',
				\'WHERE\'=>\'id=\\\'pun_approval\\\'\'
				);
				$result=$forum_db->query_build($query) or error(__FILE__, __LINE__);
				$row = $forum_db->fetch_assoc($result);
				$appr_disabled= $row[\'disabled\'];
				if(!$forum_db->num_rows($result) || $appr_disabled || $forum_user[\'g_id\']== FORUM_ADMIN) //chek if pun_approval is installed and enabled
			{
				?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required longtext">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php echo empty($_POST[\'pun_tags\']) ? \'\' : forum_htmlencode($_POST[\'pun_tags\']) ?>" size="80" maxlength="100"/></span>
					</div>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required longtext">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><div class="fld-input"><?php echo $lang_pun_tags[\'Tags warning\'] ?></div></label><br />
					</div>
				</div>
				<?php
			}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_message_box' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
				{
					foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $tag_id)
						$res_tags[] = $pun_tags[\'index\'][$tag_id];
				}

			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required longtext">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="80" maxlength="100"/></span>
					</div>
				</div>
			<?php

			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_avatars_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	include $ext_info[\'path\'].\'/lang/English/gravatar.php\';
?>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_gravatar[\'Gravatar legend\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[gravatar_force]" value="1"<?php if ($forum_config[\'o_gravatar_force\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_gravatar[\'Force gravatar\'] ?></span> <?php echo $lang_gravatar[\'Force gravatar help\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_gravatar[\'Default\'] ?></span><small><?php echo $lang_gravatar[\'Default help\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[gravatar_default]" size="50" value="<?php echo $forum_config[\'o_gravatar_default\'] ?>" /></span>
					</div>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_gravatar[\'Rating\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[gravatar_rating]" value="g"<?php if ($forum_config[\'o_gravatar_rating\'] == \'g\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_gravatar[\'Rating g\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[gravatar_rating]" value="pg"<?php if ($forum_config[\'o_gravatar_rating\'] == \'pg\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_gravatar[\'Rating pg\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[gravatar_rating]" value="r"<?php if ($forum_config[\'o_gravatar_rating\'] == \'r\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_gravatar[\'Rating r\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[gravatar_rating]" value="x"<?php if ($forum_config[\'o_gravatar_rating\'] == \'x\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_gravatar[\'Rating x\'] ?></label>
						</div>
					</div>
				</fieldset>
			</fieldset>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
			<div class="content-head">
				<h2 class="hn">
					<span><?php echo $lang_pun_tags[\'Pun Tags\']; ?></span>
				</h2>
			</div>
			<fieldset class="frm-group group1">
				<legend class="group-legend">
					<span><?php echo $lang_pun_tags[\'Settings\']; ?></span>
				</legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" <?php if ($forum_config[\'o_pun_tags_show\'] == \'1\') echo \' checked="checked"\' ?> value="1" name="form[pun_tags_show]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Show Pun Tags\']; ?></span>
							<?php echo $lang_pun_tags[\'Pun Tags notice\']; ?>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_count_in_cloud\']; ?>" maxlength="6" size="6" name="form[pun_tags_count_in_cloud]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Tags count\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Tags count info\']; ?></small>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_separator\']; ?>" maxlength="10" size="6" name="form[pun_tags_separator]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Separator\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Separator info\']; ?></small>
						</label>
					</div>
				</div>
			</fieldset>
			<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo $lang_pun_antispam[\'Captcha admin head\'] ?></span></h2>
			</div>
			<div class="ct-box"><p><?php echo $lang_pun_antispam[\'Captcha admin info\'] ?></p></div>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_pun_antispam[\'Captcha admin legend\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_register]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_register\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha admin legend\'] ?></span><?php echo $lang_pun_antispam[\'Captcha registrations info\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_login]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_login\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"> <?php echo $lang_pun_antispam[\'Captcha login info\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_guestpost]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_guestpost\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"> <?php echo $lang_pun_antispam[\'Captcha guestpost info\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_restorepass]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_restorepass\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"> <?php echo $lang_pun_antispam[\'Captcha reset info\'] ?></label>
					</div>
				</div>
			</fieldset>
<?php

// Reset fieldset counter
$forum_page[\'set_count\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_section_manage_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

($hook = get_hook(\'pun_repository_pre_display_ext_list\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content main-extensions">
		<p class="content-options options"><a href="<?php echo $base_url ?>/admin/extensions.php?pun_repository_update&amp;csrf_token=<?php echo generate_form_token(\'pun_repository_update\') ?>"><?php echo $lang_pun_repository[\'Clear cache\'] ?></a></p>
<?php

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	$pun_repository_error = \'\';

	if (pun_repository_generate_cache($pun_repository_error))
	{
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
	}
	else
	{

		?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
		<?php

		// Stop processing hook
		return;
	}
}

$pun_repository_parsed = array();
$pun_repository_skipped = array();

// Display information about extensions in repository
foreach ($pun_repository_extensions as $pun_repository_ext)
{
	// Skip installed extensions
	if (isset($inst_exts[$pun_repository_ext[\'id\']]))
	{
		$pun_repository_skipped[\'installed\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Skip uploaded extensions (including incorrect ones)
	if (is_dir(FORUM_ROOT.\'extensions/\'.$pun_repository_ext[\'id\']))
	{
		$pun_repository_skipped[\'has_dir\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Check for unresolved dependencies
	if (isset($pun_repository_ext[\'dependencies\']))
		$pun_repository_ext[\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_ext[\'dependencies\']);

	if (empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
	{
		// \'Download and install\' link
		$pun_repository_ext[\'options\'] = array(\'<a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_install=\'.$pun_repository_ext[\'id\'].\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_install_\'.$pun_repository_ext[\'id\']).\'">\'.$lang_pun_repository[\'Download and install\'].\'</a>\');
	}
	else
		$pun_repository_ext[\'options\'] = array();

	$pun_repository_parsed[] = $pun_repository_ext[\'id\'];

	// Direct links to archives
	$pun_repository_ext[\'download_links\'] = array();
	foreach (array(\'zip\', \'tgz\', \'7z\') as $pun_repository_archive_type)
		$pun_repository_ext[\'download_links\'][] = \'<a href="\'.PUN_REPOSITORY_URL.\'/\'.$pun_repository_ext[\'id\'].\'/\'.$pun_repository_ext[\'id\'].\'.\'.$pun_repository_archive_type.\'">\'.$pun_repository_archive_type.\'</a>\';

	($hook = get_hook(\'pun_repository_pre_display_ext_info\')) ? eval($hook) : null;

	// Let\'s ptint it all out
?>
		<div class="ct-box info-box extension available" id="<?php echo $pun_repository_ext[\'id\'] ?>">
			<h3 class="ct-legend hn"><span><?php echo forum_htmlencode($pun_repository_ext[\'title\']).\' \'.$pun_repository_ext[\'version\'] ?></span></h3>
			<p><?php echo forum_htmlencode($pun_repository_ext[\'description\']) ?></p>
<?php

	// List extension dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'dependency\']))
		echo \'
			<p>\', $lang_pun_repository[\'Dependencies:\'], \' \', implode(\', \', $pun_repository_ext[\'dependencies\'][\'dependency\']), \'</p>\';

?>
			<p><?php echo $lang_pun_repository[\'Direct download links:\'], \' \', implode(\' \', $pun_repository_ext[\'download_links\']) ?></p>
<?php

	// List unresolved dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
		echo \'
			<div class="ct-box warn-box">
				<p class="warn">\', $lang_pun_repository[\'Resolve dependencies:\'], \' \', implode(\', \', array_map(create_function(\'$dep\', \'return \\\'<a href="#\\\'.$dep.\\\'">\\\'.$dep.\\\'</a>\\\';\'), $pun_repository_ext[\'dependencies\'][\'unresolved\'])), \'</p>
			</div>\';

	// Actions
	if (!empty($pun_repository_ext[\'options\']))
		echo \'
			<p class="options">\', implode(\' \', $pun_repository_ext[\'options\']), \'</p>\';

?>
		</div>
<?php

}

?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $lang_pun_repository[\'Files mode and owner\'] ?></p>
		</div>
<?php

if (empty($pun_repository_parsed) && (count($pun_repository_skipped[\'installed\']) > 0 || count($pun_repository_skipped[\'has_dir\']) > 0))
{
	($hook = get_hook(\'pun_repository_no_extensions\')) ? eval($hook) : null;

	?>
		<div class="ct-box info-box">
			<p class="warn"><?php echo $lang_pun_repository[\'All installed or downloaded\'] ?></p>
		</div>
	<?php

}

($hook = get_hook(\'pun_repository_after_ext_list\')) ? eval($hook) : null;

?>
	</div>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_new_action' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Clear pun_repository cache
if (isset($_GET[\'pun_repository_update\']))
{
	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_update\')))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	@unlink(FORUM_CACHE_DIR.\'cache_pun_repository.php\');
	if (file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
		message($lang_pun_repository[\'Unable to remove cached file\'], \'\', $lang_pun_repository[\'PunBB Repository\']);

	redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Cache has been successfully cleared\']);
}

if (isset($_GET[\'pun_repository_download_and_install\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_install\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_install_\'.$ext_id)))
		csrf_confirm_form();

	// TODO: Should we check again for unresolved dependencies here?

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	($hook = get_hook(\'pun_repository_download_and_install_start\')) ? eval($hook) : null;

	// Download extension
	$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data);

	if ($pun_repository_error == \'\')
	{
		if (empty($ext_data))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Validate manifest
		$errors = validate_manifest($ext_data, $ext_id);
		if (!empty($errors))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Everything is OK. Start installation.
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_install_end\')) ? eval($hook) : null;
}

// Handling the download and update extension action
if (isset($_GET[\'pun_repository_download_and_update\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_update\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_update_\'.$ext_id)))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	$pun_repository_error = \'\';

	($hook = get_hook(\'pun_repository_download_and_update_start\')) ? eval($hook) : null;

	@pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\');

	// Check dependancies
	$query = array(
		\'SELECT\'	=> \'e.id\',
		\'FROM\'		=> \'extensions AS e\',
		\'WHERE\'		=> \'e.disabled=0 AND e.dependencies LIKE \\\'%|\'.$forum_db->escape($ext_id).\'|%\\\'\'
	);

	($hook = get_hook(\'aex_qr_get_disable_dependencies\')) ? eval($hook) : null;
	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

	if ($forum_db->num_rows($result) != 0)
	{
		$dependency = $forum_db->fetch_assoc($result);
		$pun_repository_error = sprintf($lang_admin[\'Disable dependency\'], $dependency[\'id\']);
	}

	if ($pun_repository_error == \'\' && ($ext_id != $ext_info[\'id\']))
	{
		// Disable extension
		$query = array(
			\'UPDATE\'	=> \'extensions\',
			\'SET\'		=> \'disabled=1\',
			\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
		);

		($hook = get_hook(\'aex_qr_update_disabled_status\')) ? eval($hook) : null;
		$forum_db->query_build($query) or error(__FILE__, __LINE__);

		// Regenerate the hooks cache
		require_once FORUM_ROOT.\'include/cache.php\';
		generate_hooks_cache();
	}

	if ($pun_repository_error == \'\')
	{
		if ($ext_id == $ext_info[\'id\'])
		{
			// Hey! That\'s me!
			// All the necessary files should be included before renaming old directory
			// NOTE: Self-updating is to be tested more in real-life conditions
			if (!defined(\'PUN_REPOSITORY_TAR_EXTRACT_INCLUDED\'))
				require $ext_info[\'path\'].\'/pun_repository_tar_extract.php\';
		}

		// Rename old extension dir
		if (is_writable(FORUM_ROOT.\'extensions/\'.$ext_id) && @rename(FORUM_ROOT.\'extensions/\'.$ext_id, FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\'))
			$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data); // Download extension
		else
			$pun_repository_error = sprintf($lang_pun_repository[\'Unable to rename old dir\'], FORUM_ROOT.\'extensions/\'.$ext_id);
	}

	if ($pun_repository_error == \'\')
	{
		// Do we have extension data at all? :-)
		if (empty($ext_data))
			$errors = array(true);

		// Validate manifest
		if (empty($errors))
			$errors = validate_manifest($ext_data, $ext_id);

		if (!empty($errors))
			$pun_repository_error = $lang_pun_repository[\'Incorrect manifest.xml\'];
	}

	if ($pun_repository_error == \'\')
	{
		($hook = get_hook(\'pun_repository_download_and_update_ok\')) ? eval($hook) : null;

		// Everything is OK. Start installation.
		pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\');
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_update_error\')) ? eval($hook) : null;

	// Get old version back
	@pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id);
	@rename(FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\', FORUM_ROOT.\'extensions/\'.$ext_id);

	// Enable extension
	$query = array(
		\'UPDATE\'	=> \'extensions\',
		\'SET\'		=> \'disabled=0\',
		\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
	);

	($hook = get_hook(\'aex_qr_update_enabled_status\')) ? eval($hook) : null;
	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	// Regenerate the hooks cache
	require_once FORUM_ROOT.\'include/cache.php\';
	generate_hooks_cache();

	($hook = get_hook(\'pun_repository_download_and_update_end\')) ? eval($hook) : null;
}

// Do we have some error?
if (!empty($pun_repository_error))
{
	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
		array($lang_admin_common[\'Extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		array($lang_admin_common[\'Manage extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		$lang_pun_repository[\'PunBB Repository\']
	);

	($hook = get_hook(\'pun_repository__pre_header_load\')) ? eval($hook) : null;

	define(\'FORUM_PAGE_SECTION\', \'extensions\');
	define(\'FORUM_PAGE\', \'admin-extensions-pun-repository\');
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	($hook = get_hook(\'pun_repository_display_error_output_start\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content">
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
	</div>
<?php

	($hook = get_hook(\'pun_repository_display_error_pre_ob_end\')) ? eval($hook) : null;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'events\')
			{
				require $ext_info[\'path\'].\'/page_events.php\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'manage_tags\')
			{
				//Get some info about topics with tags
				$topic_info = array();
				if (!empty($pun_tags[\'topics\']))
				{
					$pun_tags_query = array(
						\'SELECT\'	=>	\'id, subject\',
						\'FROM\'		=>	\'topics\',
						\'WHERE\'		=>	\'id IN (\'.implode(\',\', array_keys($pun_tags[\'topics\'])).\')\'
					);
					$pun_tags_result = $forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
					while ($cur_topic = $forum_db->fetch_assoc($pun_tags_result))
						$topic_info[$cur_topic[\'id\']] = $cur_topic[\'subject\'];
				}
			
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/pun_tags_url.php\';
			
				if (isset($_POST[\'change_tags\']) && !empty($_POST[\'line_tags\']) && !empty($pun_tags[\'topics\']))
				{
					foreach ($_POST[\'line_tags\'] as $topic_id => $tag_line)
					{
						if (intval($topic_id) < 1)
							break;
						$cur_tags_new = pun_tags_parse_string(utf8_trim($tag_line));
			
						//All tags was removed?
						if (empty($cur_tags_new))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
							continue;
						}
			
						//Collect old tags
						$cur_tags_old = array();
						if (!empty($pun_tags[\'topics\'][$topic_id]))
						{
							foreach ($pun_tags[\'topics\'][$topic_id] as $old_tag_id)
								$cur_tags_old[$old_tag_id] = $pun_tags[\'index\'][$old_tag_id];
						}
						//Nothing changed
						if (implode(\', \', $cur_tags_new) == implode(\', \', array_values($cur_tags_old)))
							continue;
						//This array contain indexes of processed new tags
						$processed_tags = array();
						//The array with tags for removal
						$remove_tags_id = array();
						foreach ($cur_tags_old as $tag_old_id => $tag_old)
						{
							$srch_index = array_search($tag_old, $cur_tags_new);
							//Tag was not changed
							if ($srch_index !== FALSE)
							{
								$processed_tags[] = $srch_index;
								continue;
							}
							//Was tag edited?
							$not_found_edited = TRUE;
							foreach ($cur_tags_new as $cur_tag_new)
								if (strcasecmp($cur_tag_new, $tag_old) == 0)
								{
									$not_found_edited = FALSE;
									$edited_tag_id = $tag_old_id;
									$edited_tag = $cur_tag_new;
									break;
								}
							//Tag removed?
							if ($not_found_edited)
							{
								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
							else
							{
								//Is this tag already persist in the tag list?
								$edited_tag_id_new = tag_cache_index($edited_tag);
								if ($edited_tag_id_new !== FALSE)
								{
									$pun_tags_query = array(
										\'UPDATE\'	=>	\'topic_tags\',
										\'SET\'		=>	\'tag_id = \'.$edited_tag_id_new,
										\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id = \'.$edited_tag_id
									);
									$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
								}
								else
									pun_tags_add_new($edited_tag, $topic_id);
			
								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
						}
						//Is there some new tags
						if (count($processed_tags) != count($cur_tags_new))
						{
							foreach ($cur_tags_new as $cur_new_tag_id => $cur_new_tag)
							{
								if (in_array($cur_new_tag_id, $processed_tags))
									continue;
								$tag_exist_index = tag_cache_index($cur_new_tag);
								if ($tag_exist_index === FALSE)
									pun_tags_add_new($cur_new_tag, $topic_id);
								else
									pun_tags_add_existing_tag($tag_exist_index, $topic_id);
							}
						}
						if (!empty($remove_tags_id))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id IN (\'.implode(\',\', $remove_tags_id).\')\'
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						}
					}
					pun_tags_remove_orphans();
					pun_tags_generate_cache();
			
					redirect(forum_link($pun_tags_url[\'Section pun_tags\']), $lang_pun_tags[\'Redirect with changes\'].\' \'.$lang_admin_common[\'Redirect\']);
				}
				$forum_page[\'form_action\'] = forum_link($pun_tags_url[\'Section tags\']);
				$forum_page[\'item_count\'] = 1;
			
				$forum_page[\'table_header\'] = array();
				$forum_page[\'table_header\'][\'name\'] = \'<th class="tc1" scope=col">\'.$lang_pun_tags[\'Name topic\'].\'</th>\';
				$forum_page[\'table_header\'][\'tags\'] = \'<th class="tc2" scope=col">\'.$lang_pun_tags[\'Tags of topic\'].\'</th>\';
			
				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
					array($lang_admin_common[\'Management\'], forum_link($forum_url[\'admin_reports\'])),
					array($lang_pun_tags[\'Section tags\'], forum_link($pun_tags_url[\'Section tags\']))
				);
			
				define(\'FORUM_PAGE_SECTION\', \'management\');
				define(\'FORUM_PAGE\', \'admin-management-manage_tags\');
				require FORUM_ROOT.\'header.php\';
			
				ob_start();
			
				if (!empty($topic_info))
				{
					// Load the userlist.php language file
					if (file_exists(FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\'))
						require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\';
					else
						require FORUM_ROOT.\'lang/English/userlist.php\';
			
					?>
					<div class="main-subhead">
						<h2 class="hn">
							<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
						</h2>
					</div>
					<div class="main-content main-forum">
						<form class="frm-form" id="afocus" method="post" accept-charset="utf-8" action="<?php echo $forum_page[\'form_action\'] ?>">
							<div class="hidden">
								<input type="hidden" name="form_sent" value="1" />
								<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($forum_page[\'form_action\']) ?>" />
							</div>
							<div class="ct-group">
								<table cellspacing="0" summary="<?php echo $lang_ul[\'Table summary\'] ?>">
									<thead>
										<tr><?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'table_header\'])."\\n" ?></tr>
									</thead>
									<tbody>
									<?php
			
										foreach ($topic_info as $topic_id => $topic_subject)
										{
											$tags_arr = $pun_tags[\'topics\'][$topic_id];
											$cur_tags_arr = array();
											foreach ($tags_arr as $tag_id)
												$cur_tags_arr[] = $pun_tags[\'index\'][$tag_id];
			
									?>
										<tr class="<?php echo ($forum_page[\'item_count\'] % 2 != 0) ? \'odd\' : \'even\' ?><?php echo ($forum_page[\'item_count\'] == 1) ? \' row1\' : \'\' ?>">
											<td class="tc0" scope=col"><a class="permalink" rel="bookmark" href="<?php echo forum_link($forum_url[\'topic\'], $topic_id) ?>"><?php echo forum_htmlencode($topic_subject) ?></a></td>
											<td class="tc1" scope=col"><input id="fld\'<?php echo $forum_page[\'item_count\']; ?>\'" type="text" value="<?php echo forum_htmlencode(implode(\', \', $cur_tags_arr)) ?>" size="100%" name="line_tags[<?php echo $topic_id; ?>]"/></td>
										</tr>
									<?php
			
										}
			
									?>
									</tbody>
								</table>
							</div>
							<div class="frm-buttons">
								<span class="submit"><input type="submit" name="change_tags" value="<?php echo $lang_pun_tags[\'Submit changes\'] ?>" /></span>
							</div>
						</form>
					</div>
				<?php
			
				}
				else
				{
			
					?>
						<div class="main-subhead">
							<h2 class="hn">
								<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
							</h2>
						</div>
						<div class="main-content main-forum">
							<div class="ct-box">
								<h3 class="hn"><span><strong><?php echo $lang_pun_tags[\'No tags\']; ?></strong></span></h3>
							</div>
						</div>
			
					<?php
			
				}
			
				$tpl_pun_tags = trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_pun_tags, $tpl_main);
				ob_end_clean();
			
				require FORUM_ROOT.\'footer.php\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_section_manage_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	if (pun_repository_generate_cache($pun_repository_error))
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_section_manage_pre_ext_actions' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && isset($pun_repository_extensions[$id]) && version_compare($ext[\'version\'], $pun_repository_extensions[$id][\'version\'], \'<\') && is_writable(FORUM_ROOT.\'extensions/\'.$id))
{
	// Check for unresolved dependencies
	if (isset($pun_repository_extensions[$id][\'dependencies\']))
		$pun_repository_extensions[$id][\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_extensions[$id][\'dependencies\']);

	if (empty($pun_repository_extensions[$id][\'dependencies\'][\'unresolved\']))
		$forum_page[\'ext_actions\'][] = \'<span><a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_update=\'.$id.\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_update_\'.$id).\'">\'.$lang_pun_repository[\'Download and update\'].\'</a></span>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'co_common' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_url[\'admin_management_events\'] = \'admin/extensions.php?section=events\';
			$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			require_once FORUM_ROOT.\'extensions/pun_admin_events/pun_admin_events.php\';
			$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    3 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			define(\'PUN_TAGS_CACHE_UPDATE\', 12);
			require_once $ext_info[\'path\'].\'/functions.php\';

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			// Regenerate cache
			if ((!defined(\'PUN_TAGS_LOADED\') || $pun_tags[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			}

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			// Regenerate cache if the it is more than $pun_cache_period hours old
			if ((!defined(\'PUN_TAGS_GROUPS_PERMS\') || $pun_tags_groups_perms[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_forum_perms_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    4 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'hd_head' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (FORUM_PAGE == \'admin-management-events\')
			{
				$forum_head[\'style_svents\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/pun_admin_events.css"/>\';
				$forum_head[\'eventsjs\'] = \'<script type="text/javascript" src="\'.$ext_info[\'url\'].\'/script.js"></script>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Aattach pun_tags CSS file
			if (in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\')))
			{
				$forum_head[\'style_pun_tag\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'.css" />\';
				$forum_head[\'style_cs_pun_tag\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'_cs.css" />\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ca_fn_generate_admin_menu_new_sublink' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
			{
				$forum_page[\'admin_submenu\'][\'pun_events_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-management-events\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($forum_url[\'admin_management_events\']).\'">\'.$lang_pun_admin_events[\'Events\'].\'</a></li>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			require $ext_info[\'path\'].\'/pun_tags_url.php\';
			
			if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
				$forum_page[\'admin_submenu\'][\'pun_tags_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-management-manage_tags\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($pun_tags_url[\'Section pun_tags\']).\'">\'.$lang_pun_tags[\'Section tags\'].\'</a></li>\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_paginate_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (defined(\'FORUM_PAGE\') && FORUM_PAGE == \'admin-management-events\')
		{
			// If $cur_page == -1, we link to all pages (used in viewforum.php)
			if ($cur_page == -1)
			{
				$cur_page = 1;
				$link_to_all = true;
			}

			if ($num_pages <= 1)
				$pages = array(\'<strong class="first-item">1</strong>\');
			else
			{
				// Add a previous page link
				if ($num_pages > 1 && $cur_page > 1)
					$pages[] = \'<a\'.(empty($pages) ? \' class="first-item"\' : \'\').\' href="\'.forum_sublink($link, $forum_url[\'page\'], ($cur_page - 1), $args).\'" onclick="JavaScript:PageSubmit(\'.($cur_page - 1).\'); return false;" >\'.$lang_common[\'Previous\'].\'</a>\';

				if ($cur_page > 3)
				{
					$pages[] = \'<a\'.(empty($pages) ? \' class="first-item"\' : \'\').\' href="\'.forum_sublink($link, $forum_url[\'page\'], 1, $args).\'" onclick="JavaScript:PageSubmit(1); return false;">1</a>\';
			
					if ($cur_page > 5)
						$pages[] = \'<span>\'.$lang_common[\'Spacer\'].\'</span>\';
				}

				// Don\'t ask me how the following works. It just does, OK? :-)
				for ($current = ($cur_page == 5) ? $cur_page - 3 : $cur_page - 2, $stop = ($cur_page + 4 == $num_pages) ? $cur_page + 4 : $cur_page + 3; $current < $stop; ++$current)
					if ($current < 1 || $current > $num_pages)
						continue;
					else if ($current != $cur_page || $link_to_all)
						$pages[] = \'<a\'.(empty($pages) ? \' class="first-item" \' : \'\').\' href="\'.forum_sublink($link, $forum_url[\'page\'], $current, $args).\'" onclick="JavaScript:PageSubmit(\'.$current.\'); return false;">\'.forum_number_format($current).\'</a>\';
					else
						$pages[] = \'<strong\'.(empty($pages) ? \' class="first-item"\' : \'\').\'>\'.forum_number_format($current).\'</strong>\';

				if ($cur_page <= ($num_pages-3))
				{
					if ($cur_page != ($num_pages-3) && $cur_page != ($num_pages-4))
						$pages[] = \'<span>\'.$lang_common[\'Spacer\'].\'</span>\';
			
					$pages[] = \'<a\'.(empty($pages) ? \' class="first-item" \' : \'\').\' href="\'.forum_sublink($link, $forum_url[\'page\'], $num_pages, $args).\'" onclick="JavaScript:PageSubmit(\'.$num_pages.\'); return false;">\'.forum_number_format($num_pages).\'</a>\';
				}

				// Add a next page link
				if ($num_pages > 1 && !$link_to_all && $cur_page < $num_pages)
					$pages[] = \'<a\'.(empty($pages) ? \' class="first-item" \' : \'\').\' href="\'.forum_sublink($link, $forum_url[\'page\'], ($cur_page + 1), $args).\'" onclick="JavaScript:PageSubmit(\'.($cur_page + 1).\'); return false;">\'.$lang_common[\'Next\'].\'</a>\';
			}
			
			($hook = get_hook(\'fn_paginate_end\')) ? eval($hook) : null;
			
			return implode($separator, $pages);
		}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_redirect_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

global $id, $lang_pun_admin_log, $records_file;
			require_once $ext_info[\'path\'].\'/functions.php\';

			if (isset($records_file) && !empty($records_file))
				pun_log_write_logfile($records_file);

			if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
			{
				if (isset($_POST[\'install_comply\']) && isset($_GET[\'install\']))
				{
					$action = \'Extension\';
					$comment = sprintf($lang_pun_admin_log[\'Ext install\'], $id);
				}
				else if ( isset($_GET[\'uninstall\']) && isset($_POST[\'uninstall_comply\']) )
				{
					$action = \'Extension\';
					$comment = sprintf($lang_pun_admin_log[\'Ext uninstall\'], $id);
				}
				else if (isset($_GET[\'flip\']))
				{
					global $disable;
					$action = \'Extension\';
					$comment = sprintf($disable ? $lang_pun_admin_log[\'Ext disabled\'] : $lang_pun_admin_log[\'Ext enabled\'], $id);
				}
				else if (isset($_POST[\'delete\']) && isset($_POST[\'req_confirm\']))
				{
					global $cur_post;

					if ($cur_post[\'is_topic\'])
					{
						$comment = sprintf($lang_pun_admin_log[\'Topic del\'], $cur_post[\'tid\']);
						$action = \'Topic\';
					}
					else
					{
						$comment = sprintf($lang_pun_admin_log[\'Post del\'], $id);
						$action = \'Post\';
					}
				}
				else if (isset($_GET[\'stick\']))
				{
					global $stick;
					$action = \'Topic\';
					$comment = sprintf($lang_pun_admin_log[\'Stick topic\'], $stick);
				}
				else if (isset($_GET[\'unstick\']))
				{
					global $unstick;
					$action = \'Topic\';
					$comment = sprintf($lang_pun_admin_log[\'Unstick topic\'], $unstick);
				}
				else if (isset($_POST[\'delete_topics_comply\']))
				{
					global $topics;
					$action = \'Topic\';
					$comment = sprintf(count($topics) > 1 ? $lang_pun_admin_log[\'Multidel topics\'] : $lang_pun_admin_log[\'Topic del\'], implode(\', \', $topics));
				}
				else if (isset($_REQUEST[\'open\']) || isset($_REQUEST[\'close\']))
				{
					$action = \'Post\';
					if (isset($_POST[\'open\']) || isset($_POST[\'close\']))
					{
						global $topics;
						$comment = sprintf( isset($_REQUEST[\'open\']) ? $lang_pun_admin_log[\'Multiopen topics\'] : $lang_pun_admin_log[\'Multiclose topics\'], implode(\',\', $topics));
					}
					else
					{
						global $topic_id;
						$comment = sprintf( isset($_GET[\'open\']) ? $lang_pun_admin_log[\'Topic open\'] : $lang_pun_admin_log[\'Topic close\'], $topic_id);
					}
				}
				else if (isset($_REQUEST[\'move_topics\']) || isset($_POST[\'move_topics_to\']))
				{
					global $topics, $move_to_forum_name;
					$action = \'Forum\';
					$comment = sprintf( (count($topics) > 1 ? $lang_pun_admin_log[\'Multimove forums\'] : $lang_pun_admin_log[\'Forum move\']), implode(\',\', $topics), $move_to_forum_name);
				}
				else if (isset($_POST[\'delete_posts_comply\']))
				{
					global $posts;
					$action = \'Post\';
					$comment = sprintf(count($posts) > 1 ? $lang_pun_admin_log[\'Multidel posts\'] : $lang_pun_admin_log[\'Post del\'], implode(\', \', $posts));
				}

				if (isset($comment))
				{
					if ($forum_config[\'o_pun_admin_log_write_db\'])
						pun_admin_event($action, $comment);
					if ($forum_config[\'o_pun_admin_log_write_file\'])
						pun_log_write_logfile( record_log_file($action, $comment) );
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'afo_del_forum_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
			{
				require_once $ext_info[\'path\'].\'/functions.php\';
				$comment = sprintf($lang_pun_admin_log[\'Forum del\'], $forum_to_delete);
				if ($forum_config[\'o_pun_admin_log_write_db\'])
					pun_admin_event(\'Forum\', $comment);
				if ($forum_config[\'o_pun_admin_log_write_file\'])
					pun_log_write_logfile(record_log_file(\'Forum\', $comment));
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();
			require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'acg_del_cat_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
			{
				require_once $ext_info[\'path\'].\'/functions.php\';
				$comment = sprintf($lang_pun_admin_log[\'Cat del\'], $cat_to_delete);
				if ($forum_config[\'o_pun_admin_log_write_db\'])
					pun_admin_event(\'Category\', $comment);
				if ($forum_config[\'o_pun_admin_log_write_file\'])
					pun_log_write_logfile(record_log_file(\'Category\', $comment));
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_merge_topics_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
		{
			require_once $ext_info[\'path\'].\'/functions.php\';
			$comment = sprintf($lang_pun_admin_log[\'Merge topics\'], implode(\',\', $topics));
			if ($forum_config[\'o_pun_admin_log_write_db\'])
				pun_admin_event(\'Topic\', $comment);
			if ($forum_config[\'o_pun_admin_log_write_file\'])
				pun_log_write_logfile(record_log_file(\'Topic\', $comment));
		}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query = array(
				\'UPDATE\'	=>	\'topic_tags\',
				\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\') AND topic_id != \'.$merge_to_tid
			);
			$forum_db->query_build($query) or error(__FILE__, __LINE__);
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_split_posts_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
		{
			require_once $ext_info[\'path\'].\'/functions.php\';
			$comment = sprintf($lang_pun_admin_log[\'Split posts\'], implode(\',\', $posts), $new_tid);
			if ($forum_config[\'o_pun_admin_log_write_db\'])
				pun_admin_event(\'Post\', $comment);
			if ($forum_config[\'o_pun_admin_log_write_file\'])
				pun_log_write_logfile(record_log_file(\'Post\', $comment));
		}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				foreach ($new_tags as $pun_tag)
					pun_tags_add_new($pun_tag, $new_tid);
				pun_tags_generate_cache();
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_pre_update_configuration' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$str_actions = array(\'board_title\', \'board_desc\', \'default_style\', \'default_lang\',  \'default_timezone\', \'time_format\', \'date_format\', \'timeout_visit\', \'timeout_online\', \'redirect_delay\', \'disp_topics_default\',\'disp_posts_default\', \'topic_review\', \'sef\', \'additional_navlinks\', \'indent_num_spaces\', \'quote_depth\', \'sig_length\', \'sig_lines\', \'avatars_dir\', \'avatars_width\', \'avatars_height\', \'avatars_size\', \'el_log_file\', \'announcement_heading\', \'announcement_message\', \'admin_email\', \'webmaster_email\', \'mailing_list\', \'smtp_host\', \'smtp_user\', \'smtp_pass\', \'rules_message\', \'maintenance_message\', \'pun_admin_path_log_file\');
			$radbox_actions = array(
				\'report_method\'	=> array(0 => $lang_admin_settings[\'Report internal label\'], 1 => $lang_admin_settings[\'Report email label\'], 2 => $lang_admin_settings[\'Report both label\'])
			);
			$chbox_actions = array(\'search_all_forums\', \'ranks\', \'censoring\', \'quickjump\', \'show_version\', \'users_online\', \'quickpost\', \'subscriptions\', \'force_guest_email\', \'show_dot\', \'topic_views\', \'show_post_count\', \'show_user_info\', \'message_bbcode\', \'message_img_tag\', \'smilies\', \'message_all_caps\', \'subject_all_caps\', \'signatures\', \'sig_bbcode\', \'sig_img_tag\', \'smilies_sig\', \'sig_all_caps\', \'avatars\', \'check_for_updates\', \'check_for_versions\', \'pun_log_write_file\', \'pun_log_write_db\', \'gzip\', \'announcement\', \'smtp_ssl\', \'regs_allow\', \'regs_verify\', \'allow_banned_email\', \'allow_dupe_email\', \'regs_report\', \'rules\', \'maintenance\', \'pun_admin_log_write_db\', \'pun_admin_log_write_file\');

			require_once $ext_info[\'path\'].\'/functions.php\';

			$records_file = \'\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_qr_update_permission_conf' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
			{
				$action = \'Admin settings\';

				if (in_array($key, $str_actions))
					$comment = sprintf($lang_pun_admin_log[\'Key changed\'], $key, $forum_config[\'p_\'.$key], $input);
				else if (in_array($key, $chbox_actions))
					$comment = sprintf(($input == \'1\' ? $lang_pun_admin_log[\'Key enabled\'] : $lang_pun_admin_log[\'Key disabled\']), \'p_\'.$key);
				else if (in_array($key, array_keys($radbox_actions)))
					$comment = sprintf($lang_pun_admin_log[\'Key changed\'], \'p_\'.$key, $radbox_actions[$key][ $forum_config[\'p_\'.$key] ], $radbox_actions[$key][ $input ]);

				if (isset($comment))
				{
					if ($forum_config[\'o_pun_admin_log_write_db\'])
						pun_admin_event($action, $comment);

					if ($forum_config[\'o_pun_admin_log_write_file\'])
						$records_file .= record_log_file($action, $comment);
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_qr_update_permission_option' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
			{
				$action = \'Admin settings\';

				if (in_array($key, $str_actions))
					$comment = sprintf($lang_pun_admin_log[\'Key changed\'], $key, $forum_config[\'o_\'.$key], $input);
				else if (in_array($key, $chbox_actions))
					$comment = sprintf(($input == \'1\' ? $lang_pun_admin_log[\'Key enabled\'] : $lang_pun_admin_log[\'Key disabled\']), \'o_\'.$key);
				else if (in_array($key, array_keys($radbox_actions)))
					$comment = sprintf($lang_pun_admin_log[\'Key changed\'], \'o_\'.$key, $radbox_actions[$key][ $forum_config[\'o_\'.$key] ], $radbox_actions[$key][ $input ]);

				if (isset($comment))
				{
					if ($forum_config[\'o_pun_admin_log_write_db\'])
						pun_admin_event($action, $comment);
					
					if ($forum_config[\'o_pun_admin_log_write_file\'])
						$records_file .= record_log_file($action, $comment);
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if(substr($key, 0, 8) == \'gravatar\') $gravatar_updated[\'o_\'.$key] = $value;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_edited_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';

			if ($forum_config[\'o_pun_admin_log_write_db\'] || $forum_config[\'o_pun_admin_log_write_file\'])
			{
				$comment = sprintf($lang_pun_admin_log[\'Topic edit\'], $id, $message);

				if (isset($subject))
					$comment .= \' \'.sprintf($lang_pun_admin_log[\'Subj\'], $subject);

				if ($forum_config[\'o_pun_admin_log_write_db\'])
					pun_admin_event(\'Topic\', $comment);

				if ($forum_config[\'o_pun_admin_log_write_file\'])
					pun_log_write_logfile(record_log_file(\'Topic\', $comment));
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!isset($form[\'pun_admin_log_write_file\']) || $form[\'pun_admin_log_write_file\'] != \'1\')
				$form[\'pun_admin_log_write_file\'] = \'0\';

			if (!isset($form[\'pun_admin_log_write_db\']) || $form[\'pun_admin_log_write_db\'] != \'1\')
				$form[\'pun_admin_log_write_db\'] = \'0\';

			if (substr($form[\'pun_admin_path_log_file\'], -1) == \'/\')
				$form[\'pun_admin_path_log_file\'] = substr($form[\'pun_admin_path_log_file\'], 0, -1);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!isset($form[\'pun_tags_show\']) || $form[\'pun_tags_show\'] != \'1\')
				$form[\'pun_tags_show\'] = \'0\';
			if (isset($form[\'pun_tags_count_in_cloud\']) && !empty($form[\'pun_tags_count_in_cloud\']) && intval($form[\'pun_tags_count_in_cloud\']) > 0)
				$form[\'pun_tags_count_in_cloud\'] = intval($form[\'pun_tags_count_in_cloud\']);
			else
				$form[\'pun_tags_count_in_cloud\'] = 25;
			if (isset($form[\'pun_tags_separator\']) && !empty($form[\'pun_tags_separator\']))
				$form[\'pun_tags_separator\'] = $form[\'pun_tags_separator\'];
			else
				$form[\'pun_tags_separator\'] = \' \';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!isset($form[\'pun_antispam_captcha_register\']) || $form[\'pun_antispam_captcha_register\'] != \'1\') $form[\'pun_antispam_captcha_register\'] = \'0\';
if (!isset($form[\'pun_antispam_captcha_login\']) || $form[\'pun_antispam_captcha_login\'] != \'1\') $form[\'pun_antispam_captcha_login\'] = \'0\';
if (!isset($form[\'pun_antispam_captcha_guestpost\']) || $form[\'pun_antispam_captcha_guestpost\'] != \'1\') $form[\'pun_antispam_captcha_guestpost\'] = \'0\';
if (!isset($form[\'pun_antispam_captcha_restorepass\']) || $form[\'pun_antispam_captcha_restorepass\'] != \'1\') $form[\'pun_antispam_captcha_restorepass\'] = \'0\';
$form[\'sig_min_posts\'] = isset($form[\'sig_min_posts\']) ? intval($form[\'sig_min_posts\']) : \'0\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    3 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$form[\'gravatar_force\'] = isset($form[\'gravatar_force\']) ? 1 : 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_updates_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_page[\'set_count\'] = 0;
			$forum_page[\'item_count\'] = 0;

			?>

			<div class="content-head">
				<h2 class="hn"><span><?php echo $lang_pun_admin_log[\'Part log\']; ?></span></h2>
			</div>
			<fieldset class="frm-group group<?php echo $forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_admin_settings[\'Features Avatars legend\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_admin_log_write_file]" value="1" <?php if($forum_config[\'o_pun_admin_log_write_file\'] == \'1\') echo \'checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_admin_log[\'Logging to file\'] ?></span><?php echo $lang_pun_admin_log[\'Logging file\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_admin_log_write_db]" value="1" <?php if($forum_config[\'o_pun_admin_log_write_db\'] == \'1\') echo \'checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_admin_log[\'Logging to db\'] ?></span> <?php echo $lang_pun_admin_log[\'Logging db\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_admin_log[\'Path log-file\'] ?></span><small><?php echo $lang_pun_admin_log[\'Abs path\']; ?></small></label>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[pun_admin_path_log_file]" size="80%" value="<?php echo $forum_config[\'o_pun_admin_path_log_file\'] ?>"/></span>
					</div>
				</div>
			</fieldset>

			<?php

			$forum_page[\'set_count\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_edit_group_flood_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
				<div class="content-head">
					<h3 class="hn"><span><?php echo $lang_pun_tags[\'Permissions\']; ?></span></h3>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_tags[\'Create tags perms\']; ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="pun_tags_allow" value="1"<?php if ($group[\'g_pun_tags_allow\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_tags[\'Name check\']; ?></label>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_edit_end_qr_update_group' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_tags_allow = isset($_POST[\'pun_tags_allow\']) ? intval($_POST[\'pun_tags_allow\']) : \'0\';
			$query[\'SET\'] .= \', g_pun_tags_allow=\'.$pun_tags_allow;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'hd_main_elements' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

//Output of search results
			if ($forum_config[\'o_pun_tags_show\'] == 1 && in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\')))
			{
				$output_results = array();
				switch (FORUM_PAGE)
				{
					case \'index\':
						if (isset($pun_tags[\'forums\']))
						{
							foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
							{
								//Can user read this forum?
								if (in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]))
								{
									foreach ($tags_list as $tag_id => $tag_weight)
										if (!isset($output_results[$tag_id]))
											$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
										else
											$output_results[$tag_id][\'weight\'] += $tag_weight;
								}
							}
						}
						break;
					case \'viewforum\':
						if (isset($pun_tags[\'forums\'][$id]))
						{
							foreach ($pun_tags[\'forums\'][$id] as $tag_id => $tag_weight)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $id && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;
					case \'viewtopic\':
						if (isset($pun_tags[\'topics\'][$id]))
						{
							foreach ($pun_tags[\'topics\'][$id] as $tag_id)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $pun_tags[\'forums\'][$cur_topic[\'forum_id\']][$tag_id]);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $cur_topic[\'forum_id\'] && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;
					case \'searchtopics\':
					case \'searchposts\':
						//This string will be replaced after getting search results
						$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags" class="gen-content"></div>\';
						break;
				}

				if (!empty($output_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($output_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($output_results, \'compare_tags\');
					$output_results = array_tags_slice($output_results);
					$results = array();
					foreach ($output_results as $tag_id => $tag_info)
						$results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags" class="gen-content">\'.$lang_pun_tags[\'Title\'].implode($forum_config[\'o_pun_tags_separator\'], $results).\'</div>\';
					unset($minfontsize, $maxfontsize, $step, $results, $min_pop, $max_pop);
				}
				unset($output_results, $tags_weights);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'co_modify_url_scheme' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  're_rewrite_rules' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_rewrite_rules[\'/^tag[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'search.php?action=tag&tag_id=$1\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'se_results_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($action == \'tag\')
			{
				// Regenerate paging links
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id >= 1)
					$forum_page[\'page_post\'][\'paging\'] = \'<p class="paging"><span class="pages">\'.$lang_common[\'Pages\'].\'</span> \'.paginate($forum_page[\'num_pages\'], $forum_page[\'page\'], $forum_url[\'search_tag\'], $lang_common[\'Paging separator\'], $tag_id).\'</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_end_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_user[\'is_guest\'] && $forum_config[\'o_pun_antispam_captcha_guestpost\'] == \'1\')
{
	if (session_id() == "")
		session_start();

	if (empty($_SESSION[\'pun_antispam_confirmed_user\']))
	{
		if (!isset($_SESSION[\'pun_antispam_text\']))
		{
			if (!isset($_POST[\'preview\']))
				$errors[] = $lang_pun_antispam[\'No cookies\'];
		}
		else if ((empty($_SESSION[\'pun_antispam_text\']) || strcmp(utf8_strtolower(trim($_POST[\'pun_antispam_input\'])), utf8_strtolower($_SESSION[\'pun_antispam_text\'])) !== 0))
		{
			if (!isset($_POST[\'preview\']))
				$errors[] = $lang_pun_antispam[\'Invalid Text\'];
		}
		else
			$_SESSION[\'pun_antispam_confirmed_user\'] = 1;
	}

	$_SESSION[\'pun_antispam_text\'] = \'\';

	// Post is to be written to DB, ask CAPTCHA for the next posting
	if (empty($errors) && !isset($_POST[\'preview\']))
		$_SESSION[\'pun_antispam_confirmed_user\'] = 0;
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_split_posts_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_add_topic_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

global $new_tags, $pun_tags, $forum_user;
			// Add tags to DB
			if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
				foreach ($new_tags as $pun_tag)
				{
					$tag_id = array_search($pun_tag, $search_arr);
					if ($tag_id !== FALSE)
						pun_tags_add_existing_tag($tag_id, $new_tid);
					else
						pun_tags_add_new($pun_tag, $new_tid);
				}
				pun_tags_generate_cache();
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_delete_topic_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Remove topic tags
			pun_tags_remove_topic_tags($topic_id);
			pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_post_edited' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				//Parse the string
				if (isset($_POST[\'pun_tags\']))
					$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));
				if (empty($new_tags))
				{
					if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						pun_tags_remove_topic_tags($cur_post[\'tid\']);
						$update_cache = TRUE;
					}
				}
				else
				{
					//Determine old tags
					$old_tags = array();
					if (!empty($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $old_tagid)
							$old_tags[$old_tagid] = $pun_tags[\'index\'][$old_tagid];
					}
	
					//Tags for removing
					$remove_tags = array_diff($old_tags, $new_tags);
					if (!empty($remove_tags))
					{
						$pun_tags_query = array(
							\'DELETE\'	=>	\'topic_tags\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'].\' AND tag_id IN (\'.implode(\',\', array_keys($remove_tags)).\')\'
						);
						$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						$update_cache = TRUE;
					}

					$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
					foreach ($new_tags as $tag)
					{
						//Have we current tag?
						if (in_array($tag, $old_tags))
							continue;
						$tag_id = array_search($tag, $search_arr);
						if ($tag_id === FALSE)
							pun_tags_add_new($tag, $cur_post[\'tid\']);
						else
							pun_tags_add_existing_tag($tag_id, $cur_post[\'tid\']);
						$update_cache = TRUE;
					}
					if (!empty($update_cache))
					{
						pun_tags_remove_orphans();
						pun_tags_generate_cache();
					}
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ca_fn_prune_qr_prune_subscriptions' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.$topic_ids.\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_delete_topics_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_move_topics_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_delete_topics_qr_delete_topics' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_split_posts_pre_confirm_checkbox' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($fid)
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$tid]))
				{
	
					foreach ($pun_tags[\'topics\'][$tid] as $tag_id)
						foreach ($pun_tags[\'index\'] as $tag)
							if ($tag[\'tag_id\'] == $tag_id)
								$res_tags[] = $tag[\'tag\'];
				}

				?>
				<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="80" maxlength="100"/></span>
				</div>
			<?php

			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'se_post_results_fetched' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($search_set))
			{
				//Array with tags id
				$tags = array();
				//Array with processed topics
				$processed_topics = array();
				foreach ($search_set as $res)
				{
					if (!isset($pun_tags[\'topics\'][$res[\'tid\']]) || in_array($res[\'tid\'], $processed_topics))
						continue;

					$processed_topics[] = $res[\'tid\'];
					$tags = array_merge($tags, array_diff($pun_tags[\'topics\'][$res[\'tid\']], $tags));
				}
				//Array with tags and weights
				$tags_results = array();
				if (!empty($tags))
				{
					//Calculation of tags weight
					foreach ($pun_tags_groups_perms[$forum_user[\'group_id\']] as $forum_id)
					{
						if (!isset($pun_tags[\'forums\'][$forum_id]))
							continue;
						//Calcullate common keys in arrays
						$tmp = array_intersect($tags, array_keys($pun_tags[\'forums\'][$forum_id]));
						foreach ($tmp as $cur_tag)
						{
							if (!isset($tags_results[$cur_tag]))
								$tags_results[$cur_tag] = array(\'tag\' => $pun_tags[\'index\'][$cur_tag], \'weight\' => $pun_tags[\'forums\'][$forum_id][$cur_tag]);
							else
								$tags_results[$cur_tag][\'weight\'] += $pun_tags[\'forums\'][$forum_id][$cur_tag];
						}
					}
					unset($tmp);
				}
				unset($tags);
				if (!empty($tags_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($tags_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($tags_results, \'compare_tags\');
					$tags_results = array_tags_slice($tags_results);
					$ouput_results = array();
					foreach ($tags_results as $tag_id => $tag_info)
						$ouput_results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					unset($minfontsize, $maxfontsize, $step, $tags_results, $min_pop, $max_pop);
				}
				unset($tags_results);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'sf_fn_generate_action_search_query_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($action == \'tag\')
			{
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id < 1)
					message($lang_common[\'Bad request\']);
				global $pun_tags;
				if (isset($pun_tags[\'topics\']))
				{
					foreach ($pun_tags[\'topics\'] as $topic_id => $tags)
						if (in_array($tag_id, $tags))
							$search_ids[] = $topic_id;
					if (empty($search_ids))
						message($lang_common[\'Bad request\']);
				}
				$query = array(
					\'SELECT\'	=> \'t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name\',
					\'FROM\'		=> \'topics AS t\',
					\'JOINS\'		=> array(
						array(
							\'INNER JOIN\'	=> \'forums AS f\',
							\'ON\'			=> \'f.id=t.forum_id\'
						),
						array(
							\'LEFT JOIN\'		=> \'forum_perms AS fp\',
							\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1) AND t.id IN(\'.implode(\',\', $search_ids).\')\',
					\'ORDER BY\'	=> \'t.last_post DESC\'
				);
				// With "has posted" indication
				if (!$forum_user[\'is_guest\'] && $forum_config[\'o_show_dot\'] == \'1\')
				{
					$subquery = array(
						\'SELECT\'	=> \'COUNT(p.id)\',
						\'FROM\'		=> \'posts AS p\',
						\'WHERE\'		=> \'p.poster_id=\'.$forum_user[\'id\'].\' AND p.topic_id=t.id\'
					);

					$query[\'SELECT\'] .= \', (\'.$forum_db->query_build($subquery, true).\') AS has_posted\';
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ft_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_tags_show\'] == 1)
			{
				if (!empty($ouput_results))
					$tpl_main = str_replace(\'<div id="brd-pun_tags" class="gen-content"></div>\', \'<div id="brd-pun_tags" class="gen-content">\'.$lang_pun_tags[\'Title\'].implode($forum_config[\'o_pun_tags_separator\'], $ouput_results).\'</div>\', $tpl_main);
				else
					$tpl_main = str_replace(\'<div id="brd-pun_tags" class="gen-content"></div>\', \'\', $tpl_main);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'sf_fn_validate_actions_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$valid_actions[] = \'tag\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'afo_save_forum_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'afo_revert_perms_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_edit_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_del_group_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_register_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_register\'] == \'1\')
{
	if (session_id() == "")
		session_start();

	if (empty($_SESSION[\'pun_antispam_confirmed_user\']))
	{
		if ((empty($_SESSION[\'pun_antispam_text\']) || strcmp(utf8_strtolower(trim($_POST[\'pun_antispam_input\'])), utf8_strtolower($_SESSION[\'pun_antispam_text\'])) !== 0))
			$errors[] = $lang_pun_antispam[\'Invalid Text\'];
		else
			$_SESSION[\'pun_antispam_confirmed_user\'] = 1;
	}

	$_SESSION[\'pun_antispam_text\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_register_pre_add_user' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$_SESSION[\'pun_antispam_confirmed_user\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_register_pre_language' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_register\'] == \'1\' && empty($_SESSION[\'pun_antispam_confirmed_user\']))
{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> </span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label>
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_login_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (session_id() == "")
	session_start();

if ($forum_config[\'o_pun_antispam_captcha_login\'] == \'1\' && (isset($_SESSION[\'pun_antispam_logins\']) && $_SESSION[\'pun_antispam_logins\'] > 5) && (empty($_SESSION[\'pun_antispam_text\']) || strcmp(utf8_strtolower(trim($_POST[\'pun_antispam_input\'])), utf8_strtolower($_SESSION[\'pun_antispam_text\'])) !== 0))
	$errors[] = $lang_pun_antispam[\'Invalid Text\'];

$_SESSION[\'pun_antispam_text\'] = \'\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_login_pre_auth_message' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($authorized && empty($errors))
	$_SESSION[\'pun_antispam_logins\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_login_pre_remember_me_checkbox' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_login\'] == \'1\')
{
	if (empty($errors) && session_id() == "")
		session_start();

	if (!isset($_SESSION[\'pun_antispam_logins\']))
		$_SESSION[\'pun_antispam_logins\'] = 1;
	else
		$_SESSION[\'pun_antispam_logins\']++;

	// Output CAPTCHA if first attempts failed
	if ($_SESSION[\'pun_antispam_logins\'] > 5)
	{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> </span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label>
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_forgot_pass_selected' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($_POST[\'form_sent\']))
{
	if (session_id() == "")
		session_start();

	if ($forum_config[\'o_pun_antispam_captcha_restorepass\'] == \'1\' && (empty($_SESSION[\'pun_antispam_text\']) || strcmp(utf8_strtolower(trim($_POST[\'pun_antispam_input\'])), utf8_strtolower($_SESSION[\'pun_antispam_text\'])) !== 0))
		$errors[] = $lang_pun_antispam[\'Invalid Text\'];

	$_SESSION[\'pun_antispam_text\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_forgot_pass_pre_group_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_restorepass\'] == \'1\')
{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> </span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label>
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_pre_guest_info_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_guestpost\'] == \'1\' && empty($_SESSION[\'pun_antispam_confirmed_user\']))
{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?></span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label>
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_pre_sig_content_fieldset' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Min posts for sig\'] ?></span><small><?php echo $lang_pun_antispam[\'Min posts for sig info\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[sig_min_posts]" size="5" maxlength="5" value="<?php echo $forum_config[\'p_sig_min_posts\'] ?>" /></span>
					</div>
				</div>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_signature_pre_fieldset' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($forum_page[\'sig_demo\']) && $forum_page[\'sig_demo\'] != \'\' && !$forum_user[\'is_admmod\'] && $forum_user[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	if (!isset($lang_pun_antispam))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

?>
			<div class="ct-box info-box">
				<p class="warn"><?php echo $lang_pun_antispam[\'No signature yet\']; ?></p>
			</div>
<?php

}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_identity_contact_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ((isset($form[\'url\']) ? forum_htmlencode($form[\'url\']) : forum_htmlencode($user[\'url\'])) != \'\' && !$forum_user[\'is_admmod\'] && $forum_user[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	if (!isset($lang_pun_antispam))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

?>
			<div class="ct-box info-box">
				<p class="warn"><?php echo $lang_pun_antispam[\'No website yet\']; ?></p>
			</div>
<?php

}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_post_loop_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($cur_post[\'g_id\'] != FORUM_ADMIN && $cur_post[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	$cur_post[\'signature\'] = \'\';
	$cur_post[\'url\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_view_details_selected' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_user[\'is_guest\'] && $user[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	unset($parsed_signature);
	$user[\'url\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_generate_avatar_markup_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists(FORUM_CACHE_DIR.\'cache_gravatar.php\') && !defined(\'FORUM_GRAVATAR_LOADED\'))
	include FORUM_CACHE_DIR.\'cache_gravatar.php\';

if (!defined(\'FORUM_GRAVATAR_LOADED\'))
{
	require $ext_info[\'path\'].\'/functions.php\';

	generate_gravatar_cache();
	require FORUM_CACHE_DIR.\'cache_gravatar.php\';
}

if(isset($forum_gravatar[$user_id]))
	return \'<img src="\'.$forum_gravatar[$user_id].\'" alt="" />\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if($section == \'settings\' && $user[\'gravatar\'] != $form[\'gravatar\'] && $forum_config[\'o_gravatar_force\'] == 0)
{
	require $ext_info[\'path\'].\'/functions.php\';
	generate_gravatar_cache();
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_settings_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$form[\'gravatar\'] = isset($_POST[\'form\'][\'gravatar\']) ? 1 : $forum_config[\'o_gravatar_force\'];

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_avatar_pre_fieldset' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	include $ext_info[\'path\'].\'/lang/English/gravatar.php\';
?>
			<div class="ct-box info-box">
				<p class="important"><?php echo ($forum_config[\'o_gravatar_force\']) ? $lang_gravatar[\'Gravatar forced note\'] : $lang_gravatar[\'Gravatar note\']; ?></p>
   			</div>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_settings_pre_show_sigs_checkbox' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	include $ext_info[\'path\'].\'/lang/English/gravatar.php\';
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input<?php if($forum_config[\'o_gravatar_force\']==1) echo \' disabled="disabled"\'; ?> type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[gravatar]" value="1"<?php if ($user[\'gravatar\'] == \'1\' || $forum_config[\'o_gravatar_force\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_gravatar[\'Gravatar\'] ?></span> <?php echo ($forum_config[\'o_gravatar_force\'] == \'1\') ? $lang_gravatar[\'Gravatar forced\'] : $lang_gravatar[\'Gravatar help\'] ?></label>
					</div>
				</div>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if(isset($gravatar_updated))
{
	foreach($gravatar_updated as $k=>$v) $forum_config[$k]=$v;
	require $ext_info[\'path\'].\'/functions.php\';
	generate_gravatar_cache();
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'in_qr_get_cats_and_forums' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'topic_title_on_index\',
\'path\'			=> FORUM_ROOT.\'extensions/topic_title_on_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/topic_title_on_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query[\'SELECT\'] .=\', t.subject\';
$query[\'JOINS\'][] = array(
    \'LEFT JOIN\'    => \'topics AS t\',
    \'ON\'        => \'f.last_post_id=t.last_post_id\'
);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'in_normal_row_pre_display' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'topic_title_on_index\',
\'path\'			=> FORUM_ROOT.\'extensions/topic_title_on_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/topic_title_on_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_page[\'item_body\'][\'info\'][\'lastpost\'] = str_replace(array(format_time($cur_forum[\'last_post\']), \'<cite>\'),array(forum_htmlencode($cur_forum[\'subject\']), \'<cite>\'.format_time($cur_forum[\'last_post\']).\'</cite><cite>\'),
$forum_page[\'item_body\'][\'info\'][\'lastpost\']);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ft_about_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
{
	define(\'PUN_EXTENSIONS_USED\', 1);
	if (count($pun_extensions_used) == 1)
		echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
	else
		echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
			{
				define(\'PUN_EXTENSIONS_USED\', 1);
				if (count($pun_extensions_used) == 1)
					echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
				else
					echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_log\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_log\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_log\',
\'dependencies\'	=> array (
\'pun_admin_events\'	=> array(
\'id\'				=> \'pun_admin_events\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_events\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_events\'),
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
{
	define(\'PUN_EXTENSIONS_USED\', 1);
	if (count($pun_extensions_used) == 1)
		echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
	else
		echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    3 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
			{
				define(\'PUN_EXTENSIONS_USED\', 1);
				if (count($pun_extensions_used) == 1)
					echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
				else
					echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    4 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
{
	define(\'PUN_EXTENSIONS_USED\', 1);
	if (count($pun_extensions_used) == 1)
		echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
	else
		echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
);

?>
