<?php

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function transform_result2array($result,$key,$value)
{
  for( $i=0,$obj=$result[0];$i<sizeof($result);$i++){
    $obj=$result[$i];
    $ret[$obj->$key] = $obj->$value;
  }
  return $ret;
}

function del_old_event_pic($event_id,$pic_id)
{
  $files = glob($_SERVER['DOCUMENT_ROOT']."/img/events/$event_id.$pic_id.*");
  foreach($files as $file)
    unlink($file);
}

function get_event_pic_url($event_id,$pic_id)
{
  $files = glob($_SERVER['DOCUMENT_ROOT']."/img/events/$event_id.$pic_id.*");
  if( isset($files[0]) )
    return "http://".$_SERVER['HTTP_HOST']."/img/events/".basename($files[0]);
}

function where_i_am($there_is_error)
{

  if( (strpos($_SERVER['REQUEST_URI'],"auth/admin/") !== FALSE) ||
      (strpos($_SERVER['REQUEST_URI'],"calendar/admin/") !== FALSE) ||
      (strpos($_SERVER['REQUEST_URI'],"categories/admin/") !== FALSE) ||
      (strpos($_SERVER['REQUEST_URI'],"documents/admin/") !== FALSE)

   )
    return "Configuration";
  elseif( strpos($_SERVER['REQUEST_URI'],"/chat/user") !== FALSE )
      return "UserChat";
  elseif( strpos($_SERVER['REQUEST_URI'],"/chat/admin") !== FALSE )
      return "AdminChat";
  elseif( $_SERVER['REQUEST_URI']=="/mail/admin/mail_form" )
      return "SendMail";
  elseif ( $_SERVER['REQUEST_URI']=="/contact/contact" )
    return "Contact";
  elseif ( strpos($_SERVER['REQUEST_URI'],"/documents/user/show_document_user") !== FALSE )
    return "Documents";
  elseif(strpos($_SERVER['REQUEST_URI'],"/calendar/user") !== FALSE )
    return "Calendar";
  elseif ($_SERVER['REQUEST_URI']=="/login")
    return "Login";
  elseif ($_SERVER['REQUEST_URI']=="/numbers")
    return "Numbers";
  elseif( $_SERVER['REQUEST_URI']=="/auth/user/register" ||
          ($_SERVER['REQUEST_URI']=="/auth/user/write_register" && $there_is_error==TRUE )
          )
    return "Register";
  elseif( $_SERVER['REQUEST_URI']=="/auth/user/update_data" ||
          $_SERVER['REQUEST_URI']=="/auth/user/update_password" ||
          ($_SERVER['REQUEST_URI']=="/auth/user/write_update_password" && $there_is_error==TRUE ) ||
          ($_SERVER['REQUEST_URI']=="/auth/user/write_update_data" && $there_is_error==TRUE )
          )
    return "Hello";
  elseif( $_SERVER['REQUEST_URI']=="/" ||
          $_SERVER['REQUEST_URI']=="/contact/send_contact" ||
          $_SERVER['REQUEST_URI']=="/mail/admin/send_mail" ||
          $_SERVER['REQUEST_URI']=="/logout" ||
          $_SERVER['REQUEST_URI']=="/home" ||
          (strpos($_SERVER['REQUEST_URI'],"/auth/user/write_") !== FALSE && $there_is_error==FALSE)
          )
    return "Home";
  else return FALSE;
}

function week_event()
{
  $events = DB::table('events')->whereRaw('DATEDIFF(date,now())<=7 AND date>=now()')->get();
  if( sizeof($events)==0 )
    return FALSE;
  else
    return TRUE;
}

function get_admin_name_from_id($id)
{
  $admin = DB::table('users')->where('id', $id)->first();
  return $admin->name;
}

function get_category_name_from_id($id)
{
  $admin = DB::table('categories')->where('id', $id)->first();
  return $admin->name;
}
?>
