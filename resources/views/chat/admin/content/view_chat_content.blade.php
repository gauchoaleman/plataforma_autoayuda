<div class="container">

<?php
$parts = explode(".",$_GET["file"]);
?>

<div class="card">
<div class="card-header" style="color:orange">Chat guardado el {{date('d/m/Y', $parts[0])}} a las {{date('H:i', $parts[0])}}, nombre administrador: {{get_admin_name_from_id($parts[1])}}</div>
<div class="card-body">
  {{readfile("chat/saved_chat_files/".$_GET["file"])}} bytes
</div>
</div>


</div>
