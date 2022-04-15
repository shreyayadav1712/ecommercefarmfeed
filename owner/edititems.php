<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();
    if (isset($_SESSION['Ownerid'])) {
        $id=$_SESSION['Ownerid'];
    }else {
        header("Location: ./ownerlogin.php");
    }
    // include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'checker.php';
    $itemid = $_GET['id'];
    $sql = mysqli_query($con, "SELECT * FROM items WHERE item_id = {$itemid}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $eName = $row['i_eng'];
        $hName = $row['i_hin'];
        $mName = $row['i_mar'];
        $category = $row['category_type'];
        $type = $row['type'];
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
<title>Owner</title>
<link rel="icon" href="../images/circle.png">
</head>
<body background="../images/back2.jpg">
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ownerheader.php';
        
    ?>
    <!--NavBar Ends-->
    <br><br>

    <div style="margin:auto;width:70%;">
        <p class="languages"><a href="<?php echo "?id=".$itemid.'&lang=english'?>">English</a> | <a href="<?php echo "?id=".$itemid.'&lang=marathi'?>">मराठी</a> | <a href="<?php echo "?id=".$itemid.'&lang=hindi'?>">हिन्दी</a></p>
    </div><br><br>
    <div class="card regcard">
    <h3 class="cardhead"><?php echo lang('edit_item') ;?></h3>
    <form  action="#" enctype="multipart/form-data" id="edititems">
    <br>
    <div class="row">
        <div class="col">
            <div class="error-text">This is an error message!!</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div style="font-weight: 700; font-size:20px; float: center; margin-bottom: 10px">ITEM NAME : <?php echo $eName?></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div style="font-weight: 700; font-size:20px; float: center; margin-bottom: 10px">ITEM CATEGORY : 
            
            <?php
                $sql = mysqli_query($con,"SELECT name FROM category WHERE id={$category}");
                $row1 = mysqli_fetch_assoc($sql);
                $category_name = $row1['name'];
                echo $category_name
             ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div style="font-weight: 700; font-size:20px; float: center; margin-bottom: 10px">ITEM TYPE :
            <?php
            $sql = mysqli_query($con,"SELECT name FROM type WHERE id={$type}");
            $row1 = mysqli_fetch_assoc($sql);
            $type_name = $row1['name'];
             echo $type_name
             ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" value="<?php echo($eName)?>" placeholder=<?php echo lang('name') ;?> required>
                <span id="namemsg"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="Hname" id="Hname" value="<?php echo($hName)?>" placeholder=<?php echo lang('hname') ;?> required>
                <span id="hnamemsg"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="Mname" id="Mname" value="<?php echo($mName)?>" placeholder=<?php echo lang('mname') ;?> required>
                <span id="mnamemsg"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
        <div class="form-group">
            <input type="file" class="form-control" name="image" id="image" required>
            <span id="imagemsg">
                </div>
            </div>
        </div>
        <input type="text" class="form-control" name="itemid" value="<?php echo $itemid?>" hidden>

    <button class="btn btngreen" type="submit"name="registerd" id="btn"><?php echo lang('edit')?></button>
    </form>
    </div>

  <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./edit.js"></script>
</body>
</html>
