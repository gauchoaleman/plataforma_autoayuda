<div class="container">

<?php
$chat_session = DB::table('chat_sessions')->
join('users as admin_users', 'admin_users.id', '=', 'chat_sessions.admin_id')->
join('users', 'users.id', '=', 'chat_sessions.user_id')->
select("chat_sessions.id as id","users.name as user_name","admin_users.name as admin_name","chat_sessions.created_at as created_at")->
where('chat_sessions.id',$_GET["chat_session_id"])->first();
$created_at_timestamp = strtotime($chat_session->created_at);

$chat_messages = DB::table('chat_messages')->
join('users', 'users.id', '=', 'chat_messages.from_user_id')->
select('message', 'users.name as from_name')->
where('chat_messages.chat_session_id', '=', $_GET["chat_session_id"])->get();
?>

<div class="card">
<div class="card-header" style="color:orange">Chat guardado el {{date('d/m/Y', $created_at_timestamp)}} a las {{date('H:i', $created_at_timestamp)}}.
  Administrador: {{$chat_session->admin_name}}. Usuario: {{$chat_session->user_name}}</div>
<div class="card-body">
  @foreach($chat_messages as $chat_message)
  <b>{{$chat_message->from_name}}:</b> {{$chat_message->message}}<br>
  @endforeach
</div>
</div>


</div>
