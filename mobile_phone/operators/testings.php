<?php

    include("../includes/config.php");


// $sql = "SELECT * FROM user ORDER BY ID DESC";
// $result = mysqli_query($con, $sql);

// // Fetch all
// $info =  mysqli_fetch_all($result, MYSQLI_ASSOC);


// $mysql_qry = "SELECT * FROM dmt_transactions WHERE USER_ID ='$usid' AND MOBILE='$mb' ORDER BY ID DESC LIMIT 1";
$mysql_qry = "SELECT * FROM dmt_transactions ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);//object
                // $row =  mysqli_fetch_all($result, MYSQLI_ASSOC);//array
        }
        else{
            
        }
echo json_encode($row);

?>