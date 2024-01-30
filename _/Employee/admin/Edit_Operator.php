<?php
include('../Db/config.php');

if(isset($_POST['pageid']) == 9){
    $xid=$_POST['sid'];
    $sql = "SELECT * FROM `operatorManager` WHERE id='$xid'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <div id='edit_data'>
            <form>
            <div class='form-group'>
            <input type='hidden' id='update_id' value='{$row['ID']}'>
                    <lable>SERVICE:</lable>
                    <input type='text' name='upate_service' id='upate_service' class='form-control' value='{$row['SERVICE']}'>
            </div>
            <div class='form-group'>
                   <lable>SERVICE API:</lable>
                   <input type='text' name='update_serviceapi' id='update_serviceapi' class='form-control' value='{$row['SERVICEAPI']}'>
   
           </div>
           <div class='form-group'>
                   <lable>BACKUP API:</lable>
                   <input type='email' name='update_backup' id='update_backup' class='form-control' value='{$row['BACKUPAPI']}'>
   
           </div>
           <div class='form-group'>
                   <lable>PRODUCT NAME:</lable>
                   <input type='text' name='update_pro_name' id='update_pro_name' class='form-control' value='{$row['PRODUCTNAME']}'>
           </div>
           <div class='form-group'>
                   <lable>PRODUCT CODE:</lable>
                   <input type='text' name='update_pro_code' id='update_pro_code' class='form-control' value='{$row['PRODUCTCODE']}'>
           </div>
           <div class='form-group'>
                   <lable>API SERVICE NAME:</lable>
                   <input type='text' name='update_api_ser_name' id='update_api_ser_name' class='form-control' value='{$row['APISERVICENAME']}'>
           </div>
           <div class='form-group'>
                   <lable>update_Status:</lable>
                   <select name='status' id='update_status' class='form-control'>
                   <option value ='{$row['STATUS']}'>{$row['STATUS']}(Already Selected)</option>
                   <option value ='Active'>Active</option>
                   <option value ='Deactive'>Deactive</option>
                   </select>
           </div>

           <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          <input type='button' class='btn btn-primary' data-dismiss='modal'  id='update' value='Update'>
        </div>
          
 </form>
 </div>";
mysqli_close($con);
 echo $output;
        }
    }else{
        echo "No Record Found";
    // }
 
 }


}

?>