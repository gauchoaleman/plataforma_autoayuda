<div class="container">

<?php

$saved_chat_files_dir = opendir("chat/saved_chat_files");
?>

<div class="card">
  <div class="card-header" style="color:orange">Chats guardados</div>
  <div class="card-body">

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="color:orange">Fecha (click para ver chat)</th>
      <th scope="col" style="color:orange">Hora</th>
      <th scope="col"  style="color:orange">Administrador</th>
    </tr>
  </thead>
  <tbody>
@while(($file = readdir($saved_chat_files_dir)) !== false)
  @if ($file == "." or $file == "..")
    @continue
  @endif
  <?php $parts = explode(".",$file); ?>
  <tr>
  <td>
  <a class='card-link' href="/chat/admin/view_chat?file={{$file}}">{{date('d/m/Y', $parts[0])}}</a>
  </td>
  <td>
  {{date('H:i', $parts[0])}}
  </td>
  <td>
  {{get_admin_name_from_id($parts[1])}}
  </td>
  </tr>
@endwhile
</tbody>
</table>

</div>
</div>


</div>
