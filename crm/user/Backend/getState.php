<?php
include('../includes/config.php');



        $mysql_qry = "SELECT * FROM `state_distric_block`";
        $result = mysqli_query($con ,$mysql_qry);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

      


echo json_encode($row);


?>