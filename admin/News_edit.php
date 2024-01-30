<?php
session_start();
require_once('../Db/config.php');
// require("include/Auth.php");
// $id = $_SESSION['UsId'];
if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
$xid=$_POST['sid'];
// echo"$xid";
    $sq = $con->query("SELECT * FROM user WHERE USER_TYPE = '47'");
    $sql = "SELECT * FROM `news` WHERE ID='$xid'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <form>
            <div class='form-group'>
            <input type='hidden' id='update_id' value='{$row['ID']}'>
                    <lable>Update Status:</lable>
                    <select class='form-control' name='update_user_type' id='update_user_type' class='form-control' value='{$row['USER_TYPE']}'>
                    <option value='{$row['USER_TYPE']}'>{$row['USER_TYPE']} (Already Selected)</option>
                              <option value='Employee'>Employee</option>
                              <option value='Distributor'>Distributor</option>
                              <option value='Retailer'>Retailer</option>
                    </select>
            </div>
            <div class='form-group'>
                  <lable>Update Distributor:</lable>
                  <select class='form-control select2' name='update_distributer_name' id='update_distributer_name' value='{$row['DISTRIBUTOR_ID']}'>
                        <option selected='{$row['DISTRIBUTOR_ID']}'>{$row['DISTRIBUTOR_ID']} (Already Selected)</option>
                        <option value ='All Distributor'>All Distributor</option>
                         while($ro = $sq->fetch_assoc()){                                                    
                            <option value ='{$ro['ID']}'>{$ro['FIRST_NAME']} {$ro['LAST_NAME']} {$ro['MOBILE']} </option>
                            }
                  </select>
   
          </div>
            <div class='form-group'>
                    <lable>Update Retailer:</lable>
                    <input type='text' name='update_retailer_name' id='update_retailer_name' class='form-control' value='{$row['RETAILER_ID']}'>
            </div>
            <div class='form-group'>
                  <lable>Update Employee:</lable>
                  <input type='text' name='update_employee_name' id='update_employee_name' class='form-control' value='{$row['EMPLOYEE_ID']}'>
   
          </div>
          <div class='form-group'>
                  <lable>Update From Date:</lable>
                  <input type='date' name='update_from_date' id='update_from_date' class='form-control' value='{$row['FROM_DATE']}'>
   
          </div>
          <div class='form-group'>
                  <lable>Update To date:</lable>
                  <input type='date' name='update_to_date' id='update_to_date' class='form-control' value='{$row['TO_DATE']}'>
   
          </div>
          <div class='form-group'>
                  <lable>Update Text:</lable>
                  <input type='text' name='update_news_text' id='update_news_text' class='form-control' value='{$row['NEWS_TEXT']}'>
   
          </div>

          <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          <input type='button' class='btn btn-primary' data-dismiss='modal'  id='news_update' value='Update'>
          </div>
          
 </form>
";
mysqli_close($con);
 echo $output;
        }
    }else{
        echo "No Record Found";
    // }
 
 }


}
 



?>