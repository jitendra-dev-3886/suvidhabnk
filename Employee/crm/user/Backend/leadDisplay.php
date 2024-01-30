<?php
include('../includes/config.php');
include('userdata.php');


//  display lead for multiple district
if(isset($_POST['pageid']) && $_POST['pageid'] == 15  ){
$i = 0;
$myid=$_POST['tkn'];
$type = $_POST['type'];
        
        // fetch district

        
                  $users_data = $con->query( "SELECT * FROM `user` WHERE ID='$myid'")->fetch_assoc();
                  $dist =$users_data['DISTRICT'];
                  
        // fetch district
        

$district = explode(",",$dist);
$no=sizeof($district);
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
                    <th>Status</th>
                    <th>Action</th>
                    <th>Activity</th>
                    <th>Transfer</th>
                  </tr>
                  </thead>
                  <tbody id="#example2">';
    
    while($i < $no)

    {



         $sql = "SELECT * FROM `lead`  WHERE $type='$district[$i]'";
         $result = mysqli_query($con, $sql) or die("SQL Query Failed.");
    
      
              while($row = mysqli_fetch_assoc($result)){
                  $owner_id = $row['USER_ID'];
                  $fetch_owner = $con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$row['NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['STATUS']} </td>
                                <td><button type='button'   onclick='updateLead({$row['ID']})' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'>Action</button></td>
                                <td><button type='button'  onclick='updateactivity({$row['ID']})'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#exampleModalLong'> <i class='ti-eye'>  </i>  </button> </td>
                                <td><button type='button'    data-trans  class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#exampleModalTransfer'> <i class='ti-eye'>  </i>  </button> </td>
                 </tr>";
  

              }
    
        $i= $i+1;
    }
    $userdata .= " </tfoot>
    
                  
                </table>";
                
     
    echo $userdata;
}
//  display lead for multiple district


// display lead for state, block and for all lead list
if(isset($_POST['pageid']) && $_POST['pageid'] == 2){

$status = $_POST["status"];
$BlockArray = explode(",",$user['BLOCK']);
$StateArray = explode(",",$user['STATE']);
$DistrictArray = explode(",",$user['DISTRICT']);


$userBlock = implode("','",$BlockArray);
$userState = implode("','",$StateArray);
$userDistrict = implode("','",$DistrictArray);

if($status == 'All Lead'){
            
               
                $sql = "SELECT * FROM `lead` WHERE STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC";
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
                  
                  
                  $owner_id = $row['USER_ID'];
                  $fetch_owner = $con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$row['NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['STATUS']} </td>
                                <td><button type='button'   onclick='updateLead({$row['ID']})' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'>Action</button></td>
                                <td><button type='button'  onclick='updateactivity({$row['ID']})'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#exampleModalLong'> <i class='ti-eye'>  </i>  </button> </td>
                                <td><button type='button'  data-transid='{$row['ID']}' id='leadtbtn' class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#leadtransfermodal'><i class='far fa-edit'></i></button> </td>
                 </tr>";
  
              
                  }
                  
                  }
    $userdata .= " </tfoot>
                  
                </table>";
                
                  
    
}else{
    
          $sql = "SELECT * FROM `lead` WHERE STATUS = '$status' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC";
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
    
                  $owner_id = $row['USER_ID'];
                  $fetch_owner = $con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$row['NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['STATUS']} </td>
                                <td><button type='button'   onclick='updateLead({$row['ID']})' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'>Action</button></td>
                                <td><button type='button'  onclick='updateactivity({$row['ID']})'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#exampleModalLong'> <i class='ti-eye'>  </i>  </button> </td>
                                <td><button type='button'    data-transid='{$row['ID']}' id='leadtbtn' class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#leadtransfermodal'> <i class='far fa-edit'></i> </button> </td>
                 </tr>";
  
              
                  }
                  
                  }
    $userdata .= " </tfoot>
                  
                </table>";
    
}

echo $userdata;

}


//  show lead with date filter

if(isset($_POST['pageid']) && $_POST['pageid'] == 16){

        $myid=$_POST['tkn'];
        $from = $_POST['From'];
        $to=$_POST['to'];
        $type=$_POST['type'];
        
        if($type!='')
        {

                $users_data =$con->query("SELECT * FROM `user`  WHERE ID = '$myid' ORDER BY ID DESC")->fetch_assoc();
                $myPlace = $users_data[$type];
                    
                $sql = "SELECT * FROM `lead`WHERE $type='$myPlace' AND  FILTER_DATE  BETWEEN '".$from."' AND '".$to."' ORDER BY ID DESC";
                $result = mysqli_query($con, $sql) or die("SQL Query Failed.");
        }
        else
        {
            
              $sql = "SELECT * FROM `lead`  ORDER BY ID DESC";
              $result = mysqli_query($con, $sql) or die("SQL Query Failed.");

                        
        }        

    
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
                    <th>Status</th>
                    <th>Action</th>
                    <th>Activity</th>
                    <th>Transfer</th>
                  </tr>
                  </thead>
                  <tbody id="#example2">';
                  if(mysqli_num_rows($result)>0)
                  {
              while($row = mysqli_fetch_assoc($result)){
                  $owner_id = $row['USER_ID'];
                  $fetch_owner = $con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$row['NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['STATUS']} </td>
                                <td><button type='button'   onclick='updateLead({$row['ID']})' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'>Action</button></td>
                                <td><button type='button'   onclick='updateactivity({$row['ID']})'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#exampleModalLong'> <i class='ti-eye'>  </i>  </button> </td>
                                <td><button type='button'   data-trans  class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#exampleModalTransfer'> <i class='ti-eye'>  </i>  </button> </td>
                 </tr>";
  
              }
                  }
                  else
                  {
                      echo false;
                  }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}

//  show lead with date filter


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
    $id = $_POST['id'];
    
    $output = "";
    $lead_fetch = $con->query("SELECT * FROM `lead` WHERE ID='$id'")->fetch_assoc();
     
    $output .= "
             <form id='actForm'>
  <div class='form-row'>
    <div class='form-group col-md-6'>
      <label for='inputEmail4'>Name</label>
      <input type='hidden' name='lead_id' id='lead_id' value='{$lead_fetch['ID']}'>
      <input type='text' class='form-control' name='name' id='name' readonly value='{$lead_fetch['NAME']}'>
    </div>
    <div class='form-group col-md-6'>
      <label for='inputPassword4'>Mobile</label>
      <input type='number' class='form-control' name='mobile' id='mobile' readonly value='{$lead_fetch['MOBILE']}'>
    </div>
  </div>
  <div class='form-group'>
     <label for='inputState'>Lead Status</label>
      <select  id='leadStatus' name='leadStatus' onchange='changeCom(this.value)' class='form-control'>
        <option selected value='{$lead_fetch['STATUS']}'>{$lead_fetch['STATUS']}</option>
            <option value='Call not Connect' selected>Call not Connect</option>
            <option value='First Call Complete'>First Call Complete</option>
            <option value='Next Call Schedule'>Next Call Schedule</option>
            <option value='Meeting Complete'>Meeting Complete</option>
            <option value='Software Demo Complete'>Software Demo Complete</option>
            <option value='Waiting for Customer Confirmation'>Waiting for Customer Confirmation</option>
            <option value='Waiting for Payment'>Waiting for Payment</option>
            <option value='Token Money Recive'>Token Money Recive</option>
            <option value='Area Allotment and Document Complete'>Area Allotment and Document Complete</option>
            <option value='Store Branding Under Process'>Store Branding Under Process</option>
            <option value='Store Branding Complete'>Store Branding Complete</option>
            <option value='Full Payment Received'>Full Payment Received</option>
            <option value='Store Inauguration Complete'>Store Inauguration Complete</option>
            <option value='Onboarding Complete'>Onboarding Complete </option>
            <option value='Customer Training Complete'>Customer Training Complete</option>
            <option value='Deal Won'>Deal Won</option>
            <option value='Deal Loss'>Deal Loss</option>
        
      </select>
  </div>

 <div class='form-row' id='contactSchedule' style='display:none;'>
    <div class='col'>
        <label for='inputState'>Date</label>
      <input type='date' name='date' id='date' class='form-control'>
    </div>
    <div class='col'>
        <label for='inputState'>Time</label>
      <input type='time' name='time' id='time' class='form-control'>
    </div>
  </div>
  
  
  <br>
  
    <div class='form-group'>
     <label for='inputState'>Description</label>
      <textarea class='form-control' id='description' name='description' row='3'></textarea>
  </div>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <input type='button' id='insertAct' class='btn btn-primary' value='Submit'>
      </div>
</form>
    ";
    
    echo $output;
    
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
    
    $id = $_POST['mid'];
    
    $output = "";
    
    $i = 1;
    $lead_activity = $con->query("SELECT * FROM `activity` WHERE LEAD_ID='$id' ORDER BY ID ASC");
    
    $output .= "<table class='table table-striped' id='example2'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Name</th>
      <th scope='col'>Status</th>
      <th scope='col'>Date&Time</th>
      <th scope='col'>Description</th>
    </tr>
  </thead>
    <tbody>";
    
      while($row = mysqli_fetch_assoc($lead_activity)){
          $userId=$row['USER_ID'];
          $user = $con->query("SELECT * FROM `user` WHERE ID='$userId'")->fetch_assoc();
    $output .= "
     <tr>
      <td>".$i++."</td>
      <td>{$user['FULL_NAME']}</td>
      <td>{$row['STATUS']}</td>
      <th>{$row['DATE_OF_SUBMISSION']}</th>
      <td>{$row['DESCRIPTION']} </td>
    </tr>

    ";
      }
      
      $output .= "</tbody>
    </table>";
    
    echo $output;
    
}
if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
    
    $id = $_POST['tid'];
    
    $output = "";
    
    $lead_fetch = $con->query("SELECT * FROM `lead` WHERE ID='$id'")->fetch_assoc();
    // $lead_activity = $con->query("SELECT * FROM `lead` WHERE LEAD_ID='$id' ORDER BY ID ASC");
    //   while($row = mysqli_fetch_assoc($lead_activity)){
    //       $userId=$row['USER_ID'];
    //       $user = $con->query("SELECT * FROM `user` WHERE ID='$userId'")->fetch_assoc();
    $output .= "
             <form id='actForm'>
  <div class='form-row'>
    <div class='form-group col-md-6'>
      <label for='inputEmail4'>Name</label>
      <input type='hidden' name='lead_id' id='lead_id' value='{$lead_fetch['ID']}'>
      <input type='text' class='form-control' name='name' id='name' readonly value='{$lead_fetch['NAME']}'>
    </div>
    <div class='form-group col-md-6'>
      <label for='inputPassword4'>Mobile</label>
      <input type='number' class='form-control' name='mobile' id='mobile_no' readonly value='{$lead_fetch['MOBILE']}'>
    </div>
  </div>
  <div class='form-row'>
    <div class='form-group col-md-12' onchange='dynamicname(this.value)'>
      <label for='inputEmail4'>Mobile</label>
      <input type='number' class='form-control' name='mobile' id='mobile'>
    </div>
  </div>

 <br>
 
 <div id='userdata'>
 
 </div>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <input type='button' id='transbtn' class='btn btn-primary' value='Submit'>
      </div>
</form>
    ";
    //   }
    echo $output;
    
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
    
    $number = $_POST["num"];
    
    $output = "";
    $fetchuser = $con->query("SELECT * FROM lead WHERE MOBILE LIKE '%{$number}%'")->fetch_assoc();
    
    $output = "
    <input type='text' class='form-control' readonly name='usernum' id='usernum' value='{$fetchuser['NAME']}'>
    <input type='hidden' name='usernum' id='leadid' value='{$fetchuser['ID']}'>
    
    ";
    
    echo $output;
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
    
    $id = $_POST['id'];
    $user_id = $_POST['myid'];
  
   
    $sql = $con->query("UPDATE lead SET USER_ID = '$user_id' WHERE ID='$id'");
   
  if($sql){
       echo 1 ;
  }else{
       echo 0;
  }
}


?>
