<?php

session_start();
$id = $_SESSION['UsId'];
include("../../Db/config.php");

    $user = $con->query("SELECT * FROM `user`")->fetch_assoc();
    $userid = $user['ID'];
    
    //insert part
    if(isset($_POST['amount'])){
        
        mkdir("../assets/AddFund/".$userid);
        
        $amount = $_POST['amount'];
        $refrenceid = $_POST['refrenceid']; 
        $payment_mode = $_POST['payment_mode'];
        $recipt = $_FILES['recipt']['name'];
        $recipt_tmp = $_FILES['recipt']['tmp_name'];

        $target = "../assets/AddFund/".$userid."/".$recipt;
     
        move_uploaded_file($recipt_tmp,$target);


        $insertquery = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `RECIEPT`, `PAYMENT_MODE`) VALUES ('Admin', '1', 'ADMIN', '$userid', '$refrenceid', '$amount', 'Offline Request','', 'Pending', '$recipt', '$payment_mode')");
        if($insertquery){
            echo 1;
        }else{
            echo 0;
        }
    }

if (isset($_POST['pageid']) && $_POST['pageid'] == 5){
    
    $sql = "SELECT * FROM fund WHERE USER_ID='$id' order by ID desc";
// echo $sql;

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>Member ID</th>
                        <th>Ref Id</th>
                        <th>Amount</th>
                        <th>Fund Type</th>
                        <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                     <td>{$row['DATE']}</td>  
                    <td>{$row['USER_ID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['FUND_TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}

?>
