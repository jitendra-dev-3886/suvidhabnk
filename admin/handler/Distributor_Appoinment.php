<?php

session_start();
require_once('../../Db/config.php');

 //-----Distributor Appointment report-------//

    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        $i = 1;
        
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "
SELECT * FROM distributor_appoinment WHERE date(DATE) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";
  
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Distributor Name</th>
                    <th>Member Name</th>
                    <th>Member Mobile No.</th>
                    <th>Member State</th>
                    <th>Member District</th>
                    <th>Member Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date & Time</th>
                    <th>Edit Action</th>
                    <th>Delete Action</th>
                 </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT * FROM team WHERE ID = '{$row["DIS_ID"]}' ")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$user1['NAME']}</td>
                    <td>{$row['FULL_NAME']}</td>
                    <td>{$row['MOBILE_NO']}</td>
                    <td>{$row['STATE']}</td>
                    <td>{$row['DISTRICT']}</td>
                    <td>{$row['EMAIL_ID']}</td>
                    <td>{$row['MESSAGE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                    <td><button type='submit' class='btn btn-sm btn-warning edit-btn' data-eid='{$row['ID']}'>Edit</button></td>
                    <td><button type='button' class='btn btn-sm btn-danger delete-btn' data-id='{$row['ID']}'>Delete</button></td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
    }
    
    
    
    
    // update code
  if(isset($_POST['id']) && $_POST['id'] == 9){
$uid=$_POST['updateid'];
$update_sta=$_POST['status'];
$sql ="UPDATE `distributor_appoinment` SET `STATUS`='$update_sta' WHERE ID='$uid'";
$run = mysqli_query($con,$sql);
if($run){
    echo 1;
}else{
    echo 0;
}

}
?>