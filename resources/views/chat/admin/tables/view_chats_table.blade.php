<div class="container">

<?php
$chat_sessions = DB::table('chat_sessions')->join('users as admin_users', 'admin_users.id', '=', 'chat_sessions.admin_id')->
join('users', 'users.id', '=', 'chat_sessions.user_id')->
select("chat_sessions.id as id","users.name as user_name","admin_users.name as admin_name","chat_sessions.created_at as created_at")->
where('open',0)->get();

?>

<div class="card">
  <div class="card-header" style="color:orange">Chats guardados</div>
  <div class="card-body">

@if( sizeof($chat_sessions) )

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="color:orange">Fecha (click para ver chat)</th>
      <th scope="col" style="color:orange">Hora</th>
      <th scope="col"  style="color:orange">Administrador</th>
      <th scope="col"  style="color:orange">Usuario</th>
    </tr>
  </thead>
  <tbody>
@foreach($chat_sessions as $chat_session)
<?php $created_at_timestamp = strtotime($chat_session->created_at); ?>
  <tr>
  <td>
  <a class='card-link' href="/chat/admin/view_chat?chat_session_id={{$chat_session->id}}">{{date('d/m/Y', $created_at_timestamp)}}</a>
  </td>
  <td>
  {{date('H:i', $created_at_timestamp)}}
  </td>
  <td>
  {{$chat_session->admin_name}}
  </td>
  <td>
  {{$chat_session->user_name}}
  </td>
  </tr>
@endforeach
</tbody>
</table>
@else
No hay chats registrados.
@endif
</div>
</div>


</div>
