<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$page_name = 'del_task';

require($root.'/inc/classes/db.php');
include($root.'/inc/system/redis.php');
include($root.'/inc/functions.php');
include($root.'/inc/variables.php');
require($root.'/inc/classes/logs.php');
require($root.'/inc/classes/users.php');
include($root.'/inc/system/profile.php');
require($root.'/inc/classes/vk.api.php');
require($root.'/inc/classes/sessions.php');
require($root.'/inc/classes/tasks.php');

echo $tasks->delete_task(array(
 'id' => $_GET['id'],
 'uid' => $user_id,
 'ssid' => $_GET['ssid']
));
?>