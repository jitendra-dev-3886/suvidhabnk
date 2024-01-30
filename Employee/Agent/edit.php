<?php
session_start();
require_once('../Db/config.php');
require("include/Auth.php");
$id = $_SESSION['UsId'];
$xid = $_POST['sid'];
if(isset($_POST['pageid']) && $_POST['pageid'] == 9){

    $sql = "SELECT * FROM `TASK_MANAGEMENT` WHERE ID='$xid'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <form>
            <div class='form-group'>
            <input type='hidden' id='update_id' value='{$row['ID']}'>
                    <lable>Update Status:</lable>
                    <select class='form-control' name='update_status' id='update_status' class='form-control' value='{$row['STATUS']}'>
                    <option value='{$row['STATUS']}'>{$row['STATUS']} (Already Selected)</option>
                              <option value='Ongoing'>Ongoing</option>
                              <option value='Complete'>Complete</option>
                    </select>
            </div>
            <div class='form-group'>
                   <lable>Update Remark:</lable>
                   <input type='text' name='update_remark' id='update_remark' class='form-control' value='{$row['REMARKS']}'>
   
           </div>

           <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          <input type='button' class='btn btn-primary' data-dismiss='modal'  id='update' value='Update'>
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