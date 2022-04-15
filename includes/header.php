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
<!-- <nav class="navbar navbar-expand-lg navigation navbar-dark py-md-3">
  <a class="navbar-brand anim" href="../php/home.php">
    <img src="../images/Logo.png" class="logostyle" alt="">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <form class="form-inline my-2 my-lg-0">
      <input class="navbar-form collapsed form-control mr-sm-2 searchbox" type="text" id="search" placeholder="&#xF002;  <?php echo lang('Search')?>..." aria-label="Search">
    </form>
      <li class="nav-item">
        <a class="nav-link active" href="../php/policy.php"><?php echo lang('POLICY') ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../php/contact.php"><?php echo lang('CONTACT US') ?></a>
      </li>
      <?php if (isset($_SESSION['Custid'])) {?>
      <li class="nav-item">
        <a class="nav-link active" href="./orders.php"><?php echo lang('my_orders') ?></a>
      </li>
    <?php } ?>
      <?php if (!isset($_SESSION['Custid'])) {?>
      <li class="nav-item">
      <a class="nav-link active" href="./register.php"><?php echo lang('REGISTER') ?></a>
      </li>

      <li class="nav-item">
      <a class="nav-link active" href="./login.php"><?php echo lang('LOGIN') ?></a>
      </li>
      <?php } ?>



<?php if (isset($_SESSION['Custid'])) {
  $query = "SELECT * FROM cart WHERE c_id=$id && o_id=0";
  $result = mysqli_query($con, $query);
  $noofitems=mysqli_num_rows($result);
  ?>
          <a class="cartlink" href="./cart.php" style="text-decoration:none;color:#000"><i class="fa carticon" style="font-size:34px">&#xf07a;</i>
          <span class='badge' id='lblCartCount'> <?php echo $noofitems; ?> </span></a>
<?php } ?>
    </ul>

    <?php if (isset($_SESSION['Custid'])) {
      $id=$_SESSION['Custid'];
      $query = "SELECT * FROM customer WHERE c_id=$id";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);

        ?>
      <ul class="nav justify-content-end">
        <li class="nav-item">
            <p class="navbar-brand" style="margin-top:6%;" ><?php echo lang('hello')?>, <?php echo $row['f_name']; ?><span class="sr-only">(current)</span></p>
        </li>

        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item">
              <a class="nav-link" href="./logout.php"><?php echo lang('logout'); ?> <span class="sr-only">(current)</span></a>
          </li>
      </ul>
    <?php } ?>
  </div>
</nav> -->
<!--NavBar Ends-->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #009975 " >
  <a class="navbar-brand anim" href="../php/home.php">
    <img src="../images/Logo.png" class="logostyle" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <form class="form-inline my-2 my-lg-0">
      <input class="navbar-form collapsed form-control mr-sm-2 searchbox" type="text" id="search" placeholder="&#xF002; <?php echo lang('Search')?>..." aria-label="Search">
    </form>
      <li class="nav-item">
        <a class="nav-link active" href="../php/policy.php"><?php echo lang('POLICY') ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../php/contact.php"><?php echo lang('CONTACT US') ?></a>
      </li>
      <?php if (isset($_SESSION['Custid'])) {?>
      <li class="nav-item">
        <a class="nav-link active" href="./orders.php"><?php echo lang('my_orders') ?></a>
      </li>
    <?php } ?>
      <?php if (!isset($_SESSION['Custid'])) {?>
      <li class="nav-item">
      <a class="nav-link active" href="./register.php"><?php echo lang('REGISTER') ?></a>
      </li>

      <li class="nav-item">
      <a class="nav-link active" href="./login.php"><?php echo lang('LOGIN') ?></a>
      </li>
      <?php } ?>



<?php if (isset($_SESSION['Custid'])) {
  $query = "SELECT * FROM cart WHERE c_id=$id && o_id=0";
  $result = mysqli_query($con, $query);
  $noofitems=mysqli_num_rows($result);
  ?>
          <a class="cartlink" href="./cart.php" style="text-decoration:none;color:#000"><i class="fa carticon" style="font-size:34px">&#xf07a;</i>
          <span class='badge' id='lblCartCount'> <?php echo $noofitems; ?> </span></a>
<?php } ?>
    </ul>

    <?php if (isset($_SESSION['Custid'])) {
      $id=$_SESSION['Custid'];
      $query = "SELECT * FROM customer WHERE c_id=$id";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);

        ?>
      <ul class="nav justify-content-end">
        <li class="nav-item">
            <p class="navbar-brand" style="margin-top:6%;" ><?php echo lang('hello')?>, <?php echo $row['f_name']; ?><span class="sr-only">(current)</span></p>
        </li>

        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item">
              <a class="nav-link" href="./logout.php"><?php echo lang('logout'); ?> <span class="sr-only">(current)</span></a>
          </li>
      </ul>
    <?php } ?>
  </div>
</nav>
