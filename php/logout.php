<?php
session_start();
if(isset($_SESSION['logintype'])){

  if ($_SESSION['logintype']==1) {
    session_destroy();
   header("Location: ./home.php");
  }

  if ($_SESSION['logintype']==0) {
    session_destroy();
   header("Location: ../owner/ownerlogin.php");
  }
  if ($_SESSION['logintype']==2) {
    session_destroy();
   header("Location: ../delivery/dlogin.php");
  }

}

 ?>
