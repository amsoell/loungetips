<?php

if (!defined('FORUM')) exit;
define('FORUM_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?><form id="qjump" method="get" accept-charset="utf-8" action="http://loungetips.com/talk/viewforum.php">
	<div class="frm-fld frm-select">
		<label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br />
		<span class="frm-input"><select id="qjump-select" name="id">
			<optgroup label="Announcements">
				<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Lounge Tip Announcements</option>
			</optgroup>
			<optgroup label="The Lounge">
				<option value="17"<?php echo ($forum_id == 17) ? ' selected="selected"' : '' ?>>Special Contests</option>
				<option value="16"<?php echo ($forum_id == 16) ? ' selected="selected"' : '' ?>>General discussion</option>
				<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Auction</option>
				<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Surveys</option>
				<option value="10"<?php echo ($forum_id == 10) ? ' selected="selected"' : '' ?>>Miscellaneous</option>
			</optgroup>
			<optgroup label="The Music">
				<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>What&#039;s Playing</option>
				<option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>What Should Be Playing</option>
				<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>Concerts</option>
				<option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>Miscellaneous</option>
			</optgroup>
			<optgroup label="The Events">
				<option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>CD101 Non-Music Events</option>
				<option value="12"<?php echo ($forum_id == 12) ? ' selected="selected"' : '' ?>>Miscellaneous</option>
			</optgroup>
			<optgroup label="The Rest">
				<option value="13"<?php echo ($forum_id == 13) ? ' selected="selected"' : '' ?>>Miscellaneous</option>
				<option value="14"<?php echo ($forum_id == 14) ? ' selected="selected"' : '' ?>>Support</option>
			</optgroup>
		</select>
		<input type="submit" value="<?php echo $lang_common['Go'] ?>" onclick="return Forum.doQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array);" /></span>
	</div>
</form>
<script type="text/javascript">
		var forum_quickjump_url = "http://loungetips.com/talk/forum$1.html";
		var sef_friendly_url_array = new Array(14);
	sef_friendly_url_array[2] = "lounge-tip-announcements";
	sef_friendly_url_array[17] = "special-contests";
	sef_friendly_url_array[16] = "general-discussion";
	sef_friendly_url_array[6] = "auction";
	sef_friendly_url_array[7] = "surveys";
	sef_friendly_url_array[10] = "miscellaneous";
	sef_friendly_url_array[3] = "whats-playing";
	sef_friendly_url_array[5] = "what-should-be-playing";
	sef_friendly_url_array[4] = "concerts";
	sef_friendly_url_array[9] = "miscellaneous";
	sef_friendly_url_array[11] = "cd101-nonmusic-events";
	sef_friendly_url_array[12] = "miscellaneous";
	sef_friendly_url_array[13] = "miscellaneous";
	sef_friendly_url_array[14] = "support";
</script>
