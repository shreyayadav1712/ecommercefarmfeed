<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();

    if (isset($_GET['id'])) {
        $id= (int) $_GET['id'];
        $sql = mysqli_query($con, "SELECT * FROM customer WHERE c_id = {$id}");
        $fetch = mysqli_fetch_assoc($sql);
        $email = $fetch['c_email'];
    }else{
        header("Location: ./home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
<title>Email Verify</title>
<link rel="icon" href="../images/circle.png">
</head>
<body background="../images/back2.jpg">
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';   
    ?>
    <!--NavBar Ends-->
    <br><br>

    <div style="margin:auto;width:70%;">
        <p class="languages"><a href="<?php echo "?id=".$itemid.'&lang=english'?>">English</a> | <a href="<?php echo "?id=".$itemid.'&lang=marathi'?>">मराठी</a> | <a href="<?php echo "?id=".$itemid.'&lang=hindi'?>">हिन्दी</a></p>
    </div><br><br>

    <div class="card regcard">
    <h3 class="cardhead"><?php echo lang('verify_email') ;?></h3>
    <form  action="#" id="verifyform">
    <br>
    <div class="row">
        <div class="col">
            <div class="error-text">This is an error message!!</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="form-group">
                <input hidden type="number" class="form-control" name="id" id="id" value="<?php echo($id)?>" required>    
                <input type="email" class="form-control" name="email" id="email" value="<?php echo($email)?>" placeholder=<?php echo lang('email') ;?> required>
                <span id="namemsg"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
            <button class="btn btngreen" type="submit" name="verify" id="btn"><?php echo lang('change_verify_email')?></button>
            </div>
        </div>
    </div>
    
    </form>
    </div>

  <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./verifyEmail.js"></script>
</body>
</html>
