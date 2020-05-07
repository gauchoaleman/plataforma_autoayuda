var show_noti=1;
function load_log_admin_for_post(admin_id){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url:'/chat/'+admin_id+'.start',
        type:'HEAD',
        error: function()
        {
            //file not exists
        },
        success: function()
        {
            //Mostrar notificación
            if( show_noti == 1){
              show_noti = 0;
              // Por ahora no hacemos notificación
              /*
              Push.create('Atención', {
                body: 'Tiene un compañero de chat.',

                timeout: 8000,               // Timeout before notification closes automatically.
                vibrate: [100, 100, 100],    // An array of vibration pulses for mobile devices.
                onClick: function() {
                  // Callback for when the notification is clicked.
                  //window.open("/chat/admin/chat_window_admin", "_self");
                }
              });*/
            }

        // Borrar archivo start
        $.ajax({
          method:'get',
          url: '/chat/admin/delete_start_file',
          data: {'admin_id' : admin_id }
        });
        }
    });

    $.ajax({
      url: "/chat/"+admin_id+".html",
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

  function load_log_admin_for_window(admin_id){
      var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
      $.ajax({
          url:'/chat/'+admin_id+'.start',
          type:'HEAD',
          error: function()
          {
              //file not exists
          },
          success: function()
          {
            if( show_noti == 1 ){
              show_noti = 0;
            //Por ahora sin notificación
            /*
            //Mostrar notificación
            Push.create('Atención', {
              body: 'Tiene un compañero de chat.',

              timeout: 8000,               // Timeout before notification closes automatically.
              vibrate: [100, 100, 100],    // An array of vibration pulses for mobile devices.
              onClick: function() {
          // Callback for when the notification is clicked.
              //window.open("/chat/admin/chat_window_admin", "_self");
              }
            });*/
          }
          // Borrar archivo start
          $.ajax({
            method:'get',
            url: '/chat/admin/delete_start_file',
            data: {'admin_id' : admin_id }
          });
          }
      });

      $.ajax({
        url: "/chat/"+admin_id+".html",
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


function load_log_user(admin_id){
      var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
      $.ajax({
        url: "/chat/"+admin_id+".html",
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
