<?php


error_reporting(E_ALL ^ E_NOTICE);

if(isset($_GET['lang'])){
$getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
}else{
  $getLang="english";
}
if (!empty($getLang)) {
$_SESSION['language'] = $getLang;
}

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'langs'.DIRECTORY_SEPARATOR.'set_lang.php';

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/cards.css">
  <link rel="stylesheet" href="../css/load.css">
  <link rel="icon" href="../images/circle.png">
  <script src="../js/load.js"></script>
</head>
<div id="load_screen"><div class="nb-spinner"></div>
<!-- <h1 style="width:100%;height:100%;margin:auto;margin-left: 46%;
    margin-top: 17%;">Loading...</h1> -->
</div>
<nav class="navbar navbar-expand-lg navigation navbar-dark py-md-3">
  <a class="navbar-brand" href="../delivery/dlogin.php">
    <img src="../images/Logo.png" class="logostyle" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
<?php if (isset($_SESSION['Ownerid'])) { ?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active" href="./ownerdash.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./dispatched.php">Dispatched</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./delivered.php">Delivered</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./additems.php">Add Item</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./itemoption.php">STOCKS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./dregister.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="./analysis.php">Analysis</a>
      </li>
    </ul>
  <?php } ?>
  </div>
  <?php if (isset($_SESSION['Ownerid'])) { ?>
  <ul class="nav justify-content-end">
      <li class="nav-item">
          <a class="nav-link" href="../php/logout.php">Log Out <span class="sr-only">(current)</span></a>
      </li>
  </ul>
<?php } ?>
</nav>
