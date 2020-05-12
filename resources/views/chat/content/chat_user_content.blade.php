<br><br>
<div id="wrapper">
  <div id="menu">
        <p class="welcome">Hola {{Auth::user()->name}}<b></b></p>
        <p class="logout"><a href="#" onclick="window.close();">Abandonar chat</a></p>

        <div style="clear:both"></div>
    </div>

    <div id="chatbox">
    </div>

    <form name="message" action="/chat/chat_user" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div align=center> <input name="chat_message" type="text" id="chat_message" style="width:80%" />
          <input name="chat_session_id" type="hidden" value="{{$chat_session_id}}" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Enviar" /> </div>
    </form>
</div>


<script type="text/javascript">
// jQuery Document
$(document).ready(function(){

});
</script>
