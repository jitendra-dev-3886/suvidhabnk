<?php

include("../includes/config.php");

    $user_type = $user['USER_TYPE'];
    $op = $con->query("SELECT * FROM `news_alert` WHERE USER_TYPE='$user_type' AND STATUS ='active' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        $row = $op->fetch_assoc();
        $news_top = $row['ALERT_TEXT'];
        echo json_encode($news_top);
 
    }
    else{
            echo json_encode("No News Available");
    }



?>