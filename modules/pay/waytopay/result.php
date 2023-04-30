<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require($root.'/inc/classes/db.php');
include($root.'/inc/functions.php');
include($root.'/inc/variables.php');
require($root.'/inc/classes/logs.php');
/**
 * ������ ��������� ����������� �� ������
 * � ����� �������� ����� ��������� ������� ����� "OK_����� ������"
 *
 * www.WAYtoPAY.org � 2011
 *
**/

// ��������������� ����������
//id �������
$mrh_id         = 7024;
//��������� ����
$mrh_secret_key = "749ac6-280c8b-559043-a48add-06a1";

// HTTP ���������:
$out_summ = (float)$_POST["wOutSum"];
$inv_id   = (int)$_POST["wInvId"];
$is_sets  = (int)$_POST["wIsTest"];
$crc      = (string)$_POST["wSignature"];
$unique_key= $inv_id ;

// ��������� � ������� �������
$crc = strtoupper($crc);

//������� �������
$my_crc = strtoupper(md5("$mrh_id:$out_summ:$inv_id:$mrh_secret_key"));


//������� �������
if ($my_crc != $crc)
{
  //���� ������� �� �����
  echo "ERROR_bad sign\n";
  exit();
} else {
	 global $db, $dbName,$logs;
 $get_info = $db->query("SELECT `points`, `uid` FROM `logs_pay_points` WHERE `unique_key` = '$unique_key' AND `status` = '0' AND `type` = '5' ORDER BY `id` DESC LIMIT 1");
   $data_info = $db->fetch($get_info);
   $user_id= $data_info['uid'];
   $points= $data_info['points'];
    if($db->query("INSERT INTO `$dbName`.`pay_points_unique` (`id`, `unique_key`) VALUES (NULL, '$unique_key');")) {
     $db->query("UPDATE `$dbName`.`logs_pay_points` SET  `status` =  '1' WHERE  `logs_pay_points`.`unique_key` = '$unique_key';");
     $db->query("UPDATE `$dbName`.`users` SET  `upoints` = upoints + $points WHERE  `users`.`uid` = '$user_id';");
     $logs->pay_waytopay($user_id, $points);
     
     if($points >= 5) {
      // �������� ��������
      $qRef = $db->query("SELECT `to` FROM `ref` WHERE `from` = '$user_id'");
      $dRef = $db->fetch($qRef);
      
      $dRef_id = $dRef['to'];
      
      if($dRef_id) { // ���� ���� �������
       $ref_percents = round(($points / 100) * 15); // ��������� �������
       $db->query("UPDATE `$dbName`.`users` SET  `upoints` =  `upoints` + '$ref_percents' WHERE  `users`.`uid` = '$dRef_id';"); // ��������� �����
       $logs->add_ref_percents($user_id, $dRef_id, $ref_percents); // ���������� � ���
      }
     }
     
   // echo " $user_id_OK_$inv_id";
    }
  



	
	
}

// ���������������� ��������
// � ������� ������ ����� �� ���� ������
// ���� ��� ������ �� ������� ����� �������
$userid=$user_id;
 echo " id_".$userid."_O_$inv_id";

?>