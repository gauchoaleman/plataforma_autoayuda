<div class="container">

<?php $chat_sessions = DB::table('chat_sessions')->where('open',1)->get();?>

<div class="card">
  <div class="card-header" style="color:orange">Profesionales disponibles para chatear</div>
  <div class="card-body">
@if( sizeof($chat_sessions) )
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="color:orange">Nombre</th>
      <th scope="col"  style="color:orange">Click para chatear</th>
    </tr>
  </thead>
  <tbody>
@foreach($chat_sessions as $chat_session)
  <tr>
  <td>
  {{$chat_session->admin_id}}
  </td>
  <td>
  <a class='card-link' target="popup" href="/chat/chat_user?chat_session_id={{$chat_session->id}}"><img src='http://{{$_SERVER['HTTP_HOST']}}/img/chat_table.png'></a>
  </td>
  </tr>
@endforeach
</tbody>
</table>
@else
No hay ningún profesional disponible.  <a href="/numbers">Click aquí</a> para acceder a números de emergencia.
@endif


</div>
</div>


</div>
