<?php
session_start();
require_once('../Db/config.php');
require("include/Auth.php");
if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
$id = $_POST['eid'];

    $sql = "SELECT * FROM `distributor_appoinment` WHERE ID='$id'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <form method='post' id='updateteamform'>
              
            
                   <div class='form-row d-flex justify-content-around'>
                    
                    <div class='form-group col-md-6'>
                    <input type='hidden' name='updateid' id='update_id' value='{$row['ID']}'>
                        <input type='hidden' name='id' value='9'>
                        <label for='exampleInputEmail1'>Status</label>
                        <select class='form-control select2' id='status' name='status' style='width: 100%;'>
                                <option value = '{$row['STATUS']}' selected>{$row['STATUS']} (Already Selected) </option>           
                                <option value='Approved'>Approved</option>
                                
                            </select>
                      </div>
                     </div>
                       <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          <input type='submit' class='btn btn-primary'  id='status_update' value='Update'>
        </div>
           
         </form>";
        }
mysqli_close($con);
 echo $output;
    }else{
        echo "No Record Found";
    // }
 
 }


}
 
 ?>
 