<?php
$res = DB::table('users')
->where('id', $_GET['admin_id'])
->update(['chat_available' => FALSE]);

$copy_from = "chat/".$_GET['admin_id'].".html";
$copy_to = "chat/saved_chat_files/".time().".".$_GET['admin_id'].".html";
copy($copy_from,$copy_to);



$copy_log_fp = fopen("chat/check_copy.log","w");
fwrite($copy_log_fp,"From: ".$copy_from."\n\r");
fwrite($copy_log_fp,"To: ".$copy_to."\n\r");
fclose($copy_log_fp);
?>
