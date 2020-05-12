<?php
//echo "Blade Dialog";
//echo "Chat session id: ".$_POST["chat_session_id"];
$chat_messages = DB::table('chat_messages')->
join('users', 'users.id', '=', 'chat_messages.from_user_id')->
select('message', 'users.name as from_name')->
where('chat_messages.chat_session_id', '=', $_GET["chat_session_id"])->get();
?>
@foreach($chat_messages as $chat_message)
<b>{{$chat_message->from_name}}:</b> {{$chat_message->message}}<br>
@endforeach
