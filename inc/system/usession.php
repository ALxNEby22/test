<?php
if(!$time) {
 header('Location: /');
 exit;
}

// ������ ���������������� ������
$usession = $session->get('usession');
if(!$usession) {
 $usession = $session->add('usession', rand() + time());
}
?>