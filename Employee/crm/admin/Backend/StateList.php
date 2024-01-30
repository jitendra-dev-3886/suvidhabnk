<?php
include('../includes/config.php');
// include('../auth.php');

date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
$time = date("h:i:s A");

//  show lead with date filter

$fetchstate = $con->query("SELECT DISTINCT(`STATE_NAME`) FROM `state_distric_block`");
$fetchdistrict = $con->query("SELECT DISTINCT(`DISTRIC_NAME`) FROM `state_distric_block`");
$fetchblock = $con->query("SELECT DISTINCT(`BLOCK_NAME`) FROM `state_distric_block`");

if(isset($_POST['pageid']) && $_POST['pageid'] == 16){

        $myid=$_POST['tkn'];
        $from = $_POST['From'];
        $to=$_POST['to'];

        
                $sql = "SELECT * FROM `state_distric_block` WHERE date(DATE_OF_SUBMISSION) BETWEEN '$from' AND '$to' ORDER BY ID DESC";
                $result = mysqli_query($con, $sql) or die("SQL Query Failed.");
        
        $userdata = "";
        $userdata .= '<table id="example1" class="display nowrap" style="width:100%">
        
                  <thead>
                  <tr>
                    <th>Sl no. </th>
                    <th>StateCode </th>
                    <th>StateName </th>
                    <th>DistricCode</th>
                    <th>DistricName</th>
                    <th>BlockCode</th>
                    <th>BlockVersion</th>
                    <th>BlockName</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Activity</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody id="#example2">';
                  if(mysqli_num_rows($result)>0)
                  {
              while($row = mysqli_fetch_assoc($result)){
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$row['STATE_CODE']}</td>
                                <td>{$row['STATE_NAME']} </td>
                                <td>{$row['DISTRIC_CODE']} </td>
                                <td>{$row['DISTRIC_NAME']}</td>
                                <td>{$row['BLOCK_CODE']} </td>
                                <td>{$row['BLOCK_VERSION']} </td>
                                <td>{$row['BLOCK_NAME']} </td>
                                <td><button type='button' id='{$row['ID']}'  onclick='updateLead({$row['ID']})' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'>Action</button></td>
                                <td><button type='button' id='{$row['ID']}'  onclick='updateactivity({$row['ID']})'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#exampleModalLong'> <i class='ti-eye'>  </i>  </button> </td>
                                <td><button type='button' id='{$row['ID']}'  data-transid='{$row['ID']}'  class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#exampleModalTransfer'> <i class='far fa-edit'></i></button> </td>
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


if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
$i = 1;
$myid=$_POST['tkn'];
$BLOCK=$_POST['type'];
$laedtype=$_POST['laedtype'];

if($laedtype != ''){
    $filtre = "WHERE STATUS = '$laedtype'";
}else{
    $filtre = "";
}

    if($BLOCK !='' )
    
    {
$sql = "SELECT * FROM `user` WHERE ID='$myid'  ";
$result  =mysqli_query($con, $sql) or die("SQL Query Failed.");

$BLK =$result[$BLOCK];
$sql = "SELECT * FROM `lead` WHERE BLOCK='$BLK' ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");

    }  
    else
    {
      
        
        $sql = "SELECT * FROM `lead` $filtre ORDER BY ID DESC";
        $result = mysqli_query($con, $sql) or die("SQL Query Failed.");
    }
        $userdata = "";
        $userdata .= '<table id="example1" class="display nowrap" style="width:100%">
        
        
    
                  <thead>
                  <tr>
                    <th>Sl no. </th>
                    <th>User </th>
                    <th>Name </th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Block</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Activity</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody id="#example2">';
              while($row = mysqli_fetch_assoc($result)){
                  $owner_id = $row['USER_ID'];
                  $fetch_owner = $con->query("SELECT * FROM user WHERE ID='$owner_id'")->fetch_assoc();
                $userdata .= "  <td>{$row['ID']}</td>
                                <td>{$fetch_owner['FULL_NAME']}</td>
                                <td>{$row['NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['STATUS']} </td>
                                <td>{$row['DATE_OF_SUBMISSION']} </td>
                                <td><button type='button' data-id='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#updateleadmodal'>Action</button></td>
                                <td><button type='button'  data-mid='{$row['ID']}'  class='btn btn-sm btn-danger activity-btn' data-toggle='modal' data-target='#activityleadmodal'> <i class='ti-eye'>  </i> </button> </td>
                                <td><button type='button' id='leadtbtn'   data-transid='{$row['ID']}'  class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#leadtransfermodal'><i class='far fa-edit'></i></button></td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
    $id = $_POST['id'];
    
    $output = "";
    $lead_fetch = $con->query("SELECT * FROM `state_distric_block` WHERE ID='$id'")->fetch_assoc();
     
    $output .= "
             <form id='actForm'>
  <div class='form-row'>
     <div class='form-row d-flex justify-content-around'>    
                               <div class='col-md-6'>
                               <div class='form-group'>
                                    <label for='exampleInputEmail1'>State Code</label>

                                   <input
                                  type='number'
                                  class='form-control'
                                  id='scode'
                                  name='scode'
                                  aria-describedby='emailHelp'
                                  placeholder='State Code'
                                  value='{$row['STATE_CODE']}'
                                />
                              </div>
                              </div>
                          <div class='form-group col-md-6'>
                               <label for='exampleInputEmail1'>State Name</label>
                               <input type='text' id='state' name='state' class='form-control' placeholder='State Name' value='{$row['STATE_NAME']}'>
                         </div>
                    </div>
                    
                    
                     <div class='form-row d-flex justify-content-around'>    
                               <div class='col-md-6'>
                               <div class='form-group'>
                                    <label for='exampleInputEmail1'>Distric Code</label>

                                   <input
                                  type='number'
                                  class='form-control'
                                  id='dcode'
                                  name='dcode'
                                  aria-describedby='emailHelp'
                                  placeholder='Distric Code'
                                  value='{$row['DISTRIC_CODE']}'
                                />
                              </div>
                              </div>
                          <div class='form-group col-md-6'>
                               <label for='exampleInputEmail1'>Distric Name</label>
                               <input type='text' id='distric' name='distric' class='form-control' placeholder='Distric Name' value='{$row['DISTRIC_NAME']}'>
                         </div>
                    </div>
                     
                    
                     <div class='form-row d-flex justify-content-around'>    
                               <div class='col-md-6'>
                               <div class='form-group'>
                                    <label for='exampleInputEmail1'>Block Code</label>

                                   <input
                                  type='number'
                                  class='form-control'
                                  id='bcode'
                                  name='bcode'
                                  aria-describedby='emailHelp'
                                  placeholder='Block Code'
                                  value='{$row['BLOCK_CODE']}'
                                />
                              </div>
                              </div>
                          <div class='form-group col-md-6'>
                               <label for='exampleInputEmail1'>Block Version</label>
                               <input type='text' id='blockver' name='blockver' class='form-control' placeholder='Block Version' value='{$row['BLOCK_VERSION']}'>
                         </div>
                    </div>
                    
                    
                    
                     <div class='form-row d-flex justify-content-around'>    
                               <div class='col-md-6'>
                               <div class='form-group'>
                                    <label for='exampleInputEmail1'>Block Name</label>

                                   <input
                                  type='text'
                                  class='form-control'
                                  id='bname'
                                  name='bname'
                                  aria-describedby='emailHelp'
                                  placeholder='Block Name'
                                  value='{$row['BLOCK_NAME']}'
                                />
                              </div>
                              </div>
                          <div class='form-group col-md-6'>
                               <label for='exampleInputEmail1'>Date</label>
                               <input type='date' id='date' name='date' class='form-control' placeholder='Date' value='{$row['DATE']}'>
                         </div>
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
    $lead_activity = $con->query("SELECT * FROM `activity` WHERE LEAD_ID='$id' ORDER BY ID DESC");
    
    $output .= "<table class='table table-striped' id='activitytable'>
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
      <td>".$row['DATE_OF_SUBMISSION']."</td>
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
    $output .= "
             <form method='post' id='ltransform'>
                      <div class='form-row'>
                        <div class='form-group col-md-6'>
                          <label for='inputEmail4'>Name</label>
                          <input type='hidden' name='pageid' value='4'>
                          <input type='hidden' name='lead_id' id='lead_id' value='{$lead_fetch['ID']}'>
                          <input type='text' class='form-control' name='name' id='name' value='{$lead_fetch['NAME']}'>
                        </div>
                        <div class='form-group col-md-6'>
                          <label for='inputPassword4'>Mobile</label>
                          <input type='number' class='form-control' name='mobile' id='mobile_no' value='{$lead_fetch['MOBILE']}'>
                        </div>
                        <div class='form-group col-md-6'>
                          <label for='inputPassword4'>EMAIL</label>
                          <input type='email' class='form-control' name='email' id='email' value='{$lead_fetch['EMAIL']}'>
                        </div>
                        <div class='form-group col-md-6'>
                          <label for='inputPassword4'>ADDRESS</label>
                          <input type='textarea' class='form-control' name='address' id='address' value='{$lead_fetch['ADDRESS']}'>
                        </div>
                      ";
        
                       $output .=  '
                        <div class="form-group col-md-6"  >
                          <label for="inputEmail4">State</label>
                            <div class="form-group">
                                <select class="selectpicker" onchange="showdistrict()" aria-label="Default select example" name="state" id="state" style="width: 200px;" data-live-search="true">';
                                    while($srow = $fetchstate->fetch_assoc()){
                                    if($lead_fetch['STATE'] == $srow['STATE_NAME']){
                                        $selected = "selected";
                                    }else{
                                        $selected = "";
                                        
                                    }
                                $output .= "<option $selected value='{$srow['STATE_NAME']}'>{$srow['STATE_NAME']}</option>";
                                }
                                 $output .='</select>
                            </div>
                        </div>';
                            
                        $output .= "
                        <div class='form-group col-md-6' >
                          <label for='inputEmail4'>District</label>";
                                                                
                                $output .= "<select class='selectpicker' onchange='showblock()' aria-label='Default select example' data-live-search='true' name='district' id='dist' style='width:180px;'>";
                                while($drow = $fetchdistrict->fetch_assoc()){
                                    if($lead_fetch['DISTRICT'] == $drow['DISTRIC_NAME']){
                                        $selected = "selected";
                                    }else{
                                        $selected = "";
                                        
                                    }
                                $output .= "<option $selected value='{$drow['DISTRIC_NAME']}'>{$drow['DISTRIC_NAME']}</option>";
                                }
                                      $output .=  "</select>
                                      </div>";
                                    
                
                        $output .= "
                        <div class='form-group col-md-6' >
                          <label for='inputEmail4'>Block</label>";
                                                                
                                $output .= "<select class='selectpicker' aria-label='Default select example' data-live-search='true' name='block' id='block' style='width:180px;'  >";
                                
                                while($brow = $fetchblock->fetch_assoc()){
                                    if($lead_fetch['BLOCK'] == $brow['BLOCK_NAME']){
                                        $selected = "selected";
                                    }else{
                                        $selected = "";
                                        
                                    }
                                $output .= "<option $selected value='{$brow['BLOCK_NAME']}'>{$brow['BLOCK_NAME']}</option>";
                                }
                                            
                                      $output .=  "</select>
                                      </div>";

                        
                    $output .= "</div>
                    <br>
                      <div id='userdata'>
                     </div>
                    </div>
                   <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    <input type='button' id='transbtn' class='btn btn-primary' value='Submit'>
                  </div>
                  </div>
            </form>
    ";
    
    
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

if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
    
    $id = $_POST['lead_id'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $block = $_POST['block'];
    $state = $_POST['state'];
  
  $fetchleaduser = $con->query("SELECT USER_ID FROM lead WHERE ID = '$id'")->fetch_assoc();
  $Userid = $fetchleaduser['USER_ID'];
  $desc = "User update the lead and change his name = $name, mobile = $mobile, email=$email , address = $address ,district = $district , block = $block and state = $state";
  
  $sql = $con->query("UPDATE lead SET NAME = '$name',MOBILE='$mobile',EMAIL='$email',ADDRESS='$address',DISTRICT='$district',BLOCK='$block',STATE='$state' WHERE ID='$id'");
   
  if($sql){
      $con->query("INSERT INTO `activity`(`LEAD_ID`, `USER_ID`, `DATE`, `TIME`, `DESCRIPTION`, `STATUS`) VALUES 
      ('$id','$Userid','$date','$time','$desc','Lead Update')");
       echo 1;
  }else{
       echo 0;
  }
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
