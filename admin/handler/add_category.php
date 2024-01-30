<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM add_category WHERE date(DATE_TIME) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>NEW CATEGORIES</th>
                    <th>STATUS</th>
                    <th>DATE & TIME</th>
                    <th>ACTION</th>
                    
                   </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  

                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['CATEGORY']}</td>
                    <td> {$row['STATUS']}</td>
                    <td> {$row['DATE_TIME']}</td>
                   <td><a href='Edit_category.php?id={$row['ID']}' class='btn btn-sm btn-warning edit-btn'>Edit</a> &nbsp; <br> <br> <button type='button' class='btn btn-sm btn-danger delete-btn' data-id='{$row['ID']}'>Delete</button></td>
                   
                    </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}



// insert code
if(isset($_POST['insert_category'])){
       $insert_categories=$_POST['insert_category'];

        $insert="INSERT INTO `add_category`(`CATEGORY`) VALUES ('$insert_categories')";
        $run=mysqli_query($con,$insert);
        if($run){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    // update code
  if(isset($_POST['id']) && $_POST['id'] == 9){
$uid=$_POST['updateid'];
$update_category=$_POST['update_category'];
$update_status=$_POST['update_status'];

$sql ="UPDATE `add_category` SET `CATEGORY`='$update_category' , `STATUS`='$update_status' WHERE ID='$uid'";
$run = mysqli_query($con,$sql);


if($run){
    echo 1;
}else{
    echo 0;
}

}
?>