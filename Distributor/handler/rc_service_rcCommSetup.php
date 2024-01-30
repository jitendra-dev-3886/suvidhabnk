<?php
  session_start();
  include("../../Db/config.php");

      $user_comm = $_POST['user_comm'];
      $com_name = $_POST['company_name'];
      $pack_name = $_POST['pack_name'];
    //   $owner_id = "admin";  
    //   $usid = $_SESSION['UsId']; 
$query ="INSERT INTO `commission_package`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `USER_TYPE`, `COMPANY_NAME`, `PACKAGE_NAME`, `SERVICES`, `COMM_TYPE`, `STATUS`)
VALUES ('ADMIN','1','1','1','$user_comm','$com_name','$pack_name','Recharge','PERCENTAGE','Active')";

// echo $query;
// die();
      $run = mysqli_query($con,$query);
      if($run) {
                $operator = $con->query("select * from switchOperator WHERE SERVICETYPE='Prepaid'");
                while($all_op = $operator->fetch_assoc()){
                    $op_id = $all_op['LONGCODE'];
                    $op_nm = $all_op['PRODUCTNAME'];
                    $pack = $con->query("select * from `commission_package` where USER_TYPE='46' and PACKAGE_NAME='$pack_name'")->fetch_assoc();
                    $pack_id  = $pack['ID'];
                    $con->query("INSERT INTO `operator_comm`(`OP_ID`, `OP_NAME`, `AMOUNT`, `PACKAGE_ID`, `PACKAGE_NAME`, `TYPE`, `AMOUNT_TYPE`, `TDS`, `GST`) VALUES ('$op_id','$op_nm','0','$pack_id','$pack_name','PERCENTAGE','CREDIT','0','0')");

                }
                echo "Commission Package is Created";
            }
            else{
                echo "Failed to Create Commission Package";
            }



?>