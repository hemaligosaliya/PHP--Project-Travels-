<?php

require_once './connection.php';

 if($_SESSION[type]==0 || $_SESSION[type]==1)
 {
     $uplogin=$con->query("update loginhistory set datetime='$_SESSION[dt]' where emailid like '$_SESSION[user]'");
 }
 unset($_SESSION[user],$_SESSION[password],$_SESSION[dt],$_SESSION[type],$_SESSION[taxicompanyid],$_SESSION[hotelid]);

 if($_SESSION[type]==0 || $_SESSION[type]==2 || $_SESSION[type]==3)
 {
      session_destroy();
      header('location:../thejourney/index.php');
 }
 else 
 {
      session_destroy();
      header('location:/index.php');
 }
 
 
?>