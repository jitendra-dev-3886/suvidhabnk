<?php
include('../includes/config.php');
include('userdata.php');


if(isset($_POST['pageid']) && $_POST['pageid'] == 2){

$BlockArray = explode(",",$user['BLOCK']);
$StateArray = explode(",",$user['STATE']);
$DistrictArray = explode(",",$user['DISTRICT']);


$userBlock = implode("','",$BlockArray);
$userState = implode("','",$StateArray);
$userDistrict = implode("','",$DistrictArray);

            
               
                $sql = "SELECT * FROM `visiting` WHERE STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC";
                
              
                $result = mysqli_query($con, $sql) or die("SQL Query Failed.");

    
        $userdata = "";
        $userdata .= '<table id="example1" class="display nowrap" style="width:100%">
        
        
    
                  <thead>
                  <tr>
                    <th>Sl no. </th>
                    <th>Name </th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Block</th>
                    <th>Address</th>
                    <th>Shop Image</th>
                    <th>Remark</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Activity</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody id="#example2">';
                  if(mysqli_num_rows($result)>0)
                  {
              while($row = mysqli_fetch_assoc($result)){
                  
                  $imges = "assets/shopimg/".$row['SHOP_IMG'];
                  $owner_id = $row['USER_ID'];
                  $fetch_owner = $con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$row['NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['ADDRESS']} </td>
                                <td><img src='$imges' class='img-fluid'></td>
                                <td>{$row['REMARK']} </td>
                                <td>{$row['STATUS']} </td>
                                <td><button type='button'   onclick='updateLead({$row['ID']})' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'>Action</button></td>
                                <td><button type='button'  onclick='updateactivity({$row['ID']})'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#exampleModalLong'> <i class='ti-eye'>  </i>  </button> </td>
                             </tr>";
  
              
                  }
                  
                  }
    $userdata .= " </tfoot>
                  
                </table>";
                
        echo $userdata;          
}


?>