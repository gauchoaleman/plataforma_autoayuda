<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Autoayuda</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/default_styles.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/dropdown_submenu.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/bootstrap_changes.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/custom_styles.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/chat_styles.css" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
        <script src="/js/chat_functions.js"></script>

        <script type="text/javascript">
          setInterval(load_log_admin, 250,{{Auth::user()->id}});
          window.addEventListener("unload", function(event) { $.ajax(
        {
            method:'get',
        url:'/chat/admin/unset_chat_available',
        data:
        {
            'admin_id': '{{Auth::user()->id}}'
        }
        }); });
        </script>
    </head>
    <body>
<?php
//Cambio estado de administrador a chat_available
$id = Auth::user()->id;
$res = DB::table('users')
->where('id', $id)
->update(['chat_available' => TRUE]);

//borro chat anterior
$filename = $_SERVER['DOCUMENT_ROOT']."/chat/$id.html";
if( file_exists($filename))
  unlink($filename);
 ?>
@include('chat.admin.content.chat_window_admin_content')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script src="http://{{$_SERVER['HTTP_HOST']}}/js/javascript_functions.js"></script>
</body>
</html>
