<?php
    $itemid = $_GET['id'];
    $sql = mysqli_query($con, "SELECT * FROM items WHERE item_id = {$itemid}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $eName = $row['i_eng'];
        $hName = $row['i_hin'];
        $mName = $row['i_mar'];
    }

?>