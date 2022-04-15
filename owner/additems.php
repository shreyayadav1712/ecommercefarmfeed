<?php
  include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
  session_start();
  if (isset($_SESSION['Ownerid'])) {
    $id=$_SESSION['Ownerid'];
  }else {
    header("Location: ./ownerlogin.php");
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
  <p class="languages"><a href="?lang=english">English</a> | <a href="?lang=marathi">मराठी</a> | <a href="?lang=hindi">हिन्दी</a></p>
</div><br><br>
<div class="card regcard">
  <h3 class="cardhead"><?php echo lang('add_new_item') ;?></h3>
  <form  action="#" enctype="multipart/form-data" id="additems">
  <br>
  <div class="row">
    <div class="col">
      <div class="error-text">This is an error message!!</div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <div class=" text-center">
          <select style="margin-bottom: 15px;" class="form-control category customselect classic" name="formcategory" id="formcategory" required>
              <option value="" selected disabled><?php echo lang('category')?></option>
              <?php
                $query=mysqli_query($con,"SELECT * FROM category");
                $rowcount=mysqli_num_rows($query);
                for($i=1;$i<=$rowcount;$i++)
                {
                  $row=mysqli_fetch_array($query);
              ?>
              <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
              <?php
                }
              ?>
          </select>
        </div>
        <span id="catmsg"></span>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="name" id="name" placeholder=<?php echo lang('name') ;?> required>
             <span id="namemsg"></span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="Hname" id="Hname" placeholder=<?php echo lang('hname') ;?> required>
             <span id="hnamemsg"></span>
         </div>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
            <input type="text" class="form-control" name="Mname" id="Mname" placeholder=<?php echo lang('mname') ;?> required>
            <span id="mnamemsg"></span>
         </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <div class=" text-center">
          <select style="margin-bottom: 15px;" class="form-control category customselect classic" name="type" id="type" required>
              <option value="" selected disabled><?php echo lang('type')?></option>
              <?php
                $query=mysqli_query($con,"SELECT * FROM type");
                $rowcount=mysqli_num_rows($query);
                for($i=1;$i<=$rowcount;$i++)
                {
                  $row=mysqli_fetch_array($query);
              ?>
              <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
              <?php
                }
              ?>
          </select>
          </div>
          <span id="typemsg"></span>
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

  <button class="btn btngreen" type="submit"name="registerd" id="btn"><?php echo lang('add')?></button>
  </form>
</div>

<br>
<div class="card ownercard">
  <h3 style="text-align:center;">Items</h3>
  <div class="row">
    <div class="col">
      <div class="del-error-text error-text">
        <?php
          if(isset($_GET['error'])){
            echo $_GET['error'];
          }
        ?>
      </div>
    </div>
  </div>
  <table class="table table-hover" style="padding:20px;">
<thead>
  <tr>
    <th scope="col"></th>
    <th scope="col" style="text-align:center;">Name</th>
    <th scope="col" style="text-align:center;">Action</th>
  </tr>
</thead>
<tbody>
    <?php
    $query = "SELECT * FROM items ORDER BY i_eng ASC;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {
        while ($row1 = mysqli_fetch_assoc($result)) {
            echo '<tr >
                    <th scope="col"><img class="image" src="../images/Veg/'.$row1['img'].'" alt=""></th>
                    <th scope="col" style="text-align:center;">'.lang($row1['i_eng']).'</th>
                    <th scope="col" style="text-align:center;">
                    <form action="./deletebackend.php" method="post" class="form">
                      <input type="hidden" name="itemid" value="'.$row1['item_id'].'">
                      <button type="submit" id="edit" class="edit btn btnwhite" name="edit" value="EDIT">EDIT</button>
                      <button type="submit" id="del" class="del btn btndelete" name="delete" value="DELETE" >DELETE</button>
                    </form>
                    </th>
                  </tr>';
        }
      }

     ?>
</tbody>
</table>

</div>


  <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./additems.js"></script>
  <!-- <script src="./actions.js"></script> -->
</body>
</html>
