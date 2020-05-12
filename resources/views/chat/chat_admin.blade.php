<?php
if( isset($_POST["chat_session_id"]) ){
  $chat_session_id =  $_POST["chat_session_id"];
  $chat_session = DB::table('chat_sessions')->where('id', $chat_session_id)->first();
  // If user isn't present, we don't post message
  if( $chat_session->user_id ){
    $insert_chat_message["chat_session_id"] = $chat_session_id;
    $insert_chat_message["from_user_id"] = $chat_session->admin_id;
    $insert_chat_message["to_user_id"] = $chat_session->user_id;
    $insert_chat_message["message"] = $_POST["chat_message"];
    DB::table('chat_messages')->insert($insert_chat_message);
  }
}
else{
  $insert_chat_session["admin_id"] = Auth::user()->id;
  $chat_session_id = DB::table('chat_sessions')->insertGetId($insert_chat_session);
}
?>
@include('includes.chat_header')
        <script type="text/javascript">
          setInterval(show_dialog, 250,{{$chat_session_id}});
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
@include('chat.content.chat_admin_content')
</body>
@include('includes.chat_footer')
