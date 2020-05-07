<div class="container">

<?php $users = DB::table('users')->whereRaw('chat_available IS TRUE')->get();?>

<div class="card">
  <div class="card-header" style="color:orange">Profesionales disponibles para chatear</div>
  <div class="card-body">
@if( sizeof($users) )
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="color:orange">Nombre</th>
      <th scope="col"  style="color:orange">Click para chatear</th>
    </tr>
  </thead>
  <tbody>
@foreach($users as $user)
  <tr>
  <td>
  {{$user->name}}
  </td>
  <td>
  <a class='card-link' target="popup" href="/chat/user/chat_window_user?admin_id={{$user->id}}"><img src='http://{{$_SERVER['HTTP_HOST']}}/img/chat_table.png'></a>
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
