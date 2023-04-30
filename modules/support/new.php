<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$page_name = 'support';

require($root.'/inc/classes/db.php');
include($root.'/inc/system/redis.php');
include($root.'/inc/functions.php');
include($root.'/inc/variables.php');
require($root.'/inc/classes/users.php');
include($root.'/inc/system/profile.php');
include($root.'/inc/system/profile_redirect.php');
require($root.'/inc/classes/sessions.php');
include($root.'/inc/system/usession.php');
require($root.'/inc/classes/tasks_blacklist.php');

if($ugroup == 4 || $ugroup == 5) {
 $support_new_my = my_support_new();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
 <head>
  <title>Помощь по сайту</title>
<? include($root.'/include/head.php') ?>

 </head>
 <body>
 <div id="page">
<? include($root.'/include/header.php') ?>

   <div id="content">
<? include($root.'/include/left.php') ?>

    <div id="right_wrap">
     <div id="right_wrap_b">
      <div id="right">
       <div class="main nopad">
        <div class="tabs">
         <a href="/support" onclick="nav.go(this); return false;"><div class="tabdiv">Мои вопросы <? if($support_new_my) echo '(<b>'.$support_new_my.'</b>)'; ?></div></a>
         <? if($ugroup == 4 || $ugroup == 5) { ?><a href="/support/questions" onclick="nav.go(this); return false;"><div class="tabdiv">Все вопросы <? if($support_new) echo '(<b>'.$support_new.'</b>)'; ?></div></a><? } ?>
         <? if($ugroup == 4 || $ugroup == 5) { ?><a href="/support/rate" onclick="nav.go(this); return false;"><div class="tabdiv">Рейтинг агентов</div></a><? } ?>
         <a class="active" href="/support/new" onclick="nav.go(this); return false;"><div class="tabdiv">Новый вопрос</div></a>
        </div>
        <div id="support_add_content">
         <div id="support_add_content_inner">
          <div id="support_add_content_fields">
           Здесь Вы можете сообщить нам о любой проблеме, связанной с <b>Piar.Name</b>. <br />
           Мы также будем рады выслушать Ваши замечания и предложения.
           <div id="support_add_content_field_theme">
            <input iplaceholder="Пожалуйста, добавьте заголовок к Вашему вопросу..." id="support_add_field_theme" type="text">
           </div>
           <div id="support_add_content_field_text">
            <textarea iplaceholder="Пожалуйста, расскажите о Вашей проблеме чуть подробнее..." id="support_add_field_text"></textarea>
           </div>
           <div id="support_images_attach"></div>
           <input type="hidden" id="support_images_attach_img_field_ids">
           <div id="support_grad_progress"></div>
           <div id="support_add_content_buttons">
            <div id="support_add_content_buttons_left">
             <div onclick="support._new();" class="blue_button_wrap"><div class="blue_button">Отправить</div></div>
             <div id="error_msg_support_error"></div>
            </div>
            <div id="support_add_content_buttons_right">
             <a href="javascript://">
              Прикрепить изображение
              <iframe id="support_upload_iframe" name="support_upload_iframe"></iframe>
              <form method="post" enctype="multipart/form-data" action="/support/img.upload" target="support_upload_iframe">
               <input id="support_add_img_file" onchange="support.upload_img(); return false;" type="file" name="file">
               <input id="support_upload_iframe_submit" style="display: none;" type="submit">
              </form>
             </a>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
     <input type="hidden" value="<? echo $usession; ?>" id="ssid">
<? include($root.'/include/footer.php') ?>
 
    </div>
   </div>
  </div>
<? include($root.'/include/scripts.php') ?> 
 </body>
</html>