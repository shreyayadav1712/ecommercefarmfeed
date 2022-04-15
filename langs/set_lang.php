<?php
if(isset($_SESSION['language'])){
switch ($_SESSION['language']) {
case 'English':
	include "english.php";
	break;
case 'marathi':
	include "marathi.php";
	break;
case 'hindi':
	include "hindi.php";
	break;
default:
	$_SESSION['language'] = "English";
	include "english.php";
	break;
}
}else{
	$_SESSION['language'] = "English";
	include "english.php";
  }
?>