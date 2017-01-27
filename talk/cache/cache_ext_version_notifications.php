<?php

if (!defined('FORUM_EXT_VERSIONS_LOADED')) define('FORUM_EXT_VERSIONS_LOADED', 1);

$forum_ext_repos = array (
  'http://punbb.informer.com/extensions' => 
  array (
    'timestamp' => '1322555942',
    'extension_versions' => 
    array (
      'pun_antispam' => '1.3.4',
      'pun_admin_events' => '0.8.2',
      'pun_admin_log' => '1.0',
      'pun_tags' => '1.5.1',
      'pun_repository' => '1.2.4',
    ),
  ),
);

 $forum_ext_last_versions = array (
  'pun_antispam' => 
  array (
    'version' => '1.3.4',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Fixed the malfunction of the previous version of the extension.',
  ),
  'pun_admin_events' => 
  array (
    'version' => '0.8.2',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'The mechanism of searching events was improved. Interface of the "Events" page was changed.',
  ),
  'pun_admin_log' => 
  array (
    'version' => '1.0',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Release of pun_admin_log 1.0.',
  ),
  'pun_tags' => 
  array (
    'version' => '1.5.1',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Improved update cache mechanism.',
  ),
  'pun_repository' => 
  array (
    'version' => '1.2.4',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Add more checking for pun_repository and update for PunBB 1.3.5.',
  ),
  'gravatar' => 
  array (
    'version' => '1.1.1',
    'repo_url' => '',
    'changes' => '',
  ),
  'topic_title_on_index' => 
  array (
    'version' => '1.0.0 Beta',
    'repo_url' => '',
    'changes' => '',
  ),
);

$forum_ext_versions_update_cache = 1337266002;

?>