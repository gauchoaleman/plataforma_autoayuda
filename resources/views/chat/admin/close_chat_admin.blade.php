<?php
function user_in_chat($chat_session_id)
{
  $chat_session = DB::table('chat_sessions')->where('id', $chat_session_id)->first();
  if( $chat_session->user_id != 0)
    return TRUE;
  else
    return FALSE;
}
$chat_session_id = $_GET["chat_session_id"];

if( user_in_chat($chat_session_id) ){
  $chat_session = DB::table('chat_sessions')->
  join('users as admin_users', 'admin_users.id', '=', 'chat_sessions.admin_id')->
  join('users', 'users.id', '=', 'chat_sessions.user_id')->
  select("chat_sessions.id as id","users.name as user_name","admin_users.name as admin_name","chat_sessions.created_at as created_at","chat_sessions.admin_id as admin_id",
  "chat_sessions.user_id as user_id")->
  where('chat_sessions.id',$chat_session_id)->first();

  $insert_chat_message["chat_session_id"] = $chat_session_id;
  $insert_chat_message["from_user_id"] = $chat_session->admin_id;
  $insert_chat_message["to_user_id"] = $chat_session->user_id;
  $insert_chat_message["message"] = "Salió del chat";
  DB::table('chat_messages')->insert($insert_chat_message);
}
else {
  $update_chat_session["open"] = 0;
  DB::table('chat_sessions')->where('id', $chat_session_id)->update($update_chat_session);
}
?>
