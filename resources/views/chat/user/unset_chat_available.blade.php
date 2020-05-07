@include('includes/head')
<?php
$res = DB::table('users')
->where('id', $_GET['admin_id'])
->update(['chat_available' => FALSE]);
?>
@include('includes/bottom')
