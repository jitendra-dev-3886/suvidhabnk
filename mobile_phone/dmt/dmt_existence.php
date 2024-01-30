<?php
    
    include("../includes/config.php");
    if(isset($_POST['usertype_id'])){
        
        $id = $_POST['id'];
        $usertype_id = $_POST['usertype_id'];
        
        $mysql_qry = "select * FROM dmt_user WHERE USER_ID ='$id' AND USER_TYPE = '$usertype_id'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            echo 1;
        }
        else{
            echo 0;
        }
    }

?>