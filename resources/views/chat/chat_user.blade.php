<?php
if( isset($_POST["chat_session_id"]) ){
  $chat_session_id =  $_POST["chat_session_id"];
  $chat_session = DB::table('chat_sessions')->where('id', $chat_session_id)->first();

  $insert_chat_message["chat_session_id"] = $chat_session_id;
  $insert_chat_message["from_user_id"] = $chat_session->user_id;
  $insert_chat_message["to_user_id"] = $chat_session->admin_id;
  $insert_chat_message["message"] = $_POST["chat_message"];
  DB::table('chat_messages')->insert($insert_chat_message);
}
else{
  $chat_session_id =  $_GET["chat_session_id"];
  $chat_session = DB::table('chat_sessions')->where('id', $chat_session_id)->first();
  // Si otro usuario ya está chateando con ese admin se muestra mensaje de error
  if( $chat_session->user_id )
    $chat_already_started = TRUE;
  else {
    $update_chat_session["user_id"] = Auth::user()->id;
    $update_chat_session["show_notification"] = 1;
    $update_chat_session["open"] = 0;
    DB::table('chat_sessions')->where('id', $chat_session_id)->update($update_chat_session);
  }
}
?>
@include('includes.chat_header')
@if( isset($chat_already_started) )
</head>
<body>
  Chat ya se inició con otro usuario <a href="#" onclick="window.close();">Cerrar ventana</a>.
</body>
@else
        <script type="text/javascript">
        function show_dialog(chat_session_id){
            var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
            $.ajax({
              url: "{{ url('/chat/show_chat_dialog') }}",
              type:'GET',
              data: {'chat_session_id': chat_session_id},
              cache: false,
              success: function(html){
                $("#chatbox").html(html); //Insert chat log into the #chatbox div

                //Auto-scroll
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                if(newscrollHeight > oldscrollHeight){
                  $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }
                },
            });
          }

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
  @include('chat.content.chat_user_content')
</body>
@endif
@include('includes.chat_footer')
