<?php
$usermsg = $_POST['usermsg'];
$user_name = Auth::user()->name;
$admin_id = $_GET['admin_id'];
$fp = fopen("chat/$admin_id.html", 'a');
fwrite($fp, "<div class='msgln'><b>$user_name</b>: ".stripslashes(htmlspecialchars($usermsg))."<br></div>");
fclose($fp);
?>
@include('chat.user.content.chat_window_user_content')
