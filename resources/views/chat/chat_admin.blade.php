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
            url:'/chat/admin/close_chat_admin',
            data:
            {
              'chat_session_id': {{$chat_session_id}}
            },
            cache: false
          }); });
          /*
          window.addEventListener("unload", function(event) { $.ajax(
            {
              url:"{{ url('/chat/admin/close_chat_admin') }}",
              type:'GET',
              data:
              {
                'chat_session_id': '{{$chat_session_id}}'
              }
            }); });*/
        </script>
    </head>
<body>
@include('chat.content.chat_admin_content')
</body>
@include('includes.chat_footer')
