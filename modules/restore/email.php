<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require($root.'/inc/classes/db.php');
include($root.'/inc/system/redis.php');
include($root.'/inc/functions.php');
include($root.'/inc/variables.php');
include($root.'/inc/system/profile.php');
require($root.'/inc/classes/logs.php');
require($root.'/inc/classes/sessions.php');
require($root.'/inc/classes/restore.php');

echo $restore->restore_email();
?>