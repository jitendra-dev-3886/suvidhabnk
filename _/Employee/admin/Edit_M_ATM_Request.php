<?php
session_start();
require_once('../Db/config.php');
// require("../include/Auth.php");
$id = $_SESSION['UsId'];


if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
    $xid=$_POST['sid'];
    $sql = "SELECT * FROM `m_atm` WHERE ID='$xid'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <div id='edit_data'>
            <form>
            <div class='form-group'>
            <input type='hidden' id='update_id' value='{$row['ID']}'>
                    <lable>update Status:</lable>
                    <select class='form-control' id='update_status'>
                    <option value='{$row['STATUS']}'> {$row['STATUS']}(Already Selected) </option>
                    <option value='Approved'>Approved</option>
                    <option value='Rejected'>Rejected</option>
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