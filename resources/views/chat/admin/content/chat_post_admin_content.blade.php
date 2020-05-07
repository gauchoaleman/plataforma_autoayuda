<?php
$usermsg = $_POST['usermsg'];
$user_name = Auth::user()->name;
$user_id = Auth::user()->id;
$fp = fopen("chat/$user_id.html", 'a');
fwrite($fp, "<div class='msgln'><b>$user_name</b>: ".stripslashes(htmlspecialchars($usermsg))."<br></div>");
fclose($fp);
?>
@include('chat.admin.content.chat_window_admin_content')
