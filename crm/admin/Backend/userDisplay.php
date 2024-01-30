<?php
include('../includes/config.php');
// include('../auth.php');

//  show s,d,b

$fetchstate = $con->query("SELECT DISTINCT(`STATE_NAME`) FROM `state_distric_block`");
$fetchdistrict = $con->query("SELECT DISTINCT(`DISTRIC_NAME`) FROM `state_distric_block`");
$fetchblock = $con->query("SELECT DISTINCT(`BLOCK_NAME`) FROM `state_distric_block`");

if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
$i = 1;
$myid=$_POST['tkn'];

$user_type = $_GET['type'];

$sql = "SELECT * FROM `user` WHERE TYPE='$user_type' ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";
$userdata .= '<table id="example1" class="display nowrap" style="width:100%">
        
                  <thead>
                  <tr>
                    <th>Employee Id.</th>
                    <th>Name </th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Block</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody id="#example2">';
              while($row = mysqli_fetch_assoc($result)){
                  
                  if($row['STATUS'] == 'Active'){
                      $sts = "<span class='active'>Active</span>";
                  }else{
                      $sts = "<span class='deactive'>Deactive</span>";
                      
                  }
                  
                $userdata .= "  <td>{$row['EMPLOYEE_ID']}</td>
                                <td>{$row['FULL_NAME']}</td>
                                <td>{$row['MOBILE']} </td>
                                <td>{$row['EMAIL']} </td>
                                <td>{$row['STATE']}</td>
                                <td>{$row['DISTRICT']} </td>
                                <td>{$row['BLOCK']} </td>
                                <td>{$row['DATE']} </td>
                                <td>$sts</td>
                                <td><button type='button' data-transid='{$row['ID']}'  class='btn btn-sm btn-danger transfer-btn' data-toggle='modal' data-target='#leadtransfermodal'> <i class='far fa-edit'></i></button> </td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
    
    $id = $_POST['tid'];
    
    $output = "";
    
    $lead_fetch = $con->query("SELECT * FROM `user` WHERE ID='$id'")->fetch_assoc();
    $sdist = explode(",",$lead_fetch["DISTRICT"]);
    $sblock = explode(",",$lead_fetch["BLOCK"]);
    $output .= "
             <form method='post' id='ltransform'>
                      <div class='form-row'>
                        <div class='form-group col-md-6'>
                          <label for='inputEmail4'>Name</label>
                          <input type='hidden' name='pageid' value='5'>
                          <input type='hidden' name='lead_id' id='lead_id' value='{$lead_fetch['ID']}'>
                          <input type='text' class='form-control' name='name' id='name' value='{$lead_fetch['FULL_NAME']}'>
                        </div>
                        <div class='form-group col-md-6'>
                          <label for='inputPassword4'>Employee Id</label>
                          <input type='text' class='form-control' name='emp_id' id='emp_id' value='{$lead_fetch['EMPLOYEE_ID']}'>
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
                        <div class='form-group col-md-6'>
                          <label for='inputPassword4'>Password</label>
                          <input type='text' class='form-control' name='pass' id='pass' value='{$lead_fetch['PASSWORD']}'>
                        </div>
                        <div class='form-group col-md-6'>
                          <label>Select Status</label>
                          <select class='selectpicker' aria-label='Default select example' name='status' id='status' style='width:180px;'>";
                          
                          if($lead_fetch['STATUS'] == "Active"){
                           $output .="<option selected value='Active'>Active</option>";
                          $output .="<option value='Deactive'>Deactive</option>";
                          }else{
                           $output .="<option value='Active'>Active</option>";
                          $output .="<option selected value='Deactive'>Deactive</option>";
                              
                          }
                          $output .="</select>
                        </div>
                      ";
        
                       $output .=  '
                        <div class="form-group col-md-6"  >
                          <label for="inputEmail4">State</label>
                            <div class="form-group">
                                <select class="selectpicker" onchange="showdistrict()" aria-label="Default select example" multiple name="state" id="state" style="width: 200px;" data-actions-box="true" data-live-search="true">';
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
                                                                
                                
                            $output .= "<select class='selectpicker' onchange='showblock()' multiple aria-label='Default select example' data-actions-box='true' data-live-search='true' name='district' id='dist' style='width:180px;'>"; 
                                foreach($sdist as $dist){
                                      $output .= "<option selected value='$dist'>$dist</option>";
                                  }
                                 while($drow = $fetchdistrict->fetch_assoc()){
                                   
                                $output .= "<option value='{$drow['DISTRIC_NAME']}'>{$drow['DISTRIC_NAME']}</option>";
                                }
                                      $output .=  "</select>
                                      </div>";
                                    
                
                        $output .= "
                        <div class='form-group col-md-6' >
                          <label for='inputEmail4'>Block</label>";
                                                                
                                $output .= "<select class='selectpicker' aria-label='Default select example' multiple data-live-search='true' data-actions-box='true' name='block' id='block' style='width:180px;'  >"; 
                                 foreach($sblock as $blk){
                                      $output .= "<option selected value='$blk'>$blk</option>";
                                  }
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

if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
    
    $id = $_POST['lead_id'];
    $name = $_POST['name'];
    $emp_id = $_POST['emp_id'];
    $status = $_POST['status'];
    $pass = $_POST['pass'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $district = $_POST['alldistrict'];
    $block = $_POST['allblock'];
    $state = $_POST['allstate'];
  
  $sql = $con->query("UPDATE user SET EMPLOYEE_ID='$emp_id',FULL_NAME  = '$name',MOBILE='$mobile',EMAIL='$email',ADDRESS='$address',DISTRICT='$district',BLOCK='$block',STATE='$state',`PASSWORD`='$pass',STATUS='$status' WHERE ID='$id'");
   
  if($sql){
       echo 1;
  }else{
       echo 0;
  }
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
    $id = $_POST['id'];
    
    $output = "";
    $lead_fetch = $con->query("SELECT * FROM `user` WHERE ID='$id' ORDER BY ID DESC")->fetch_assoc();
     
    $output .= "
             <form id='actForm'>
  <div class='form-row'>
    <div class='form-group col-md-6'>
      <label for='inputEmail4'>Name</label>
      <input type='hidden' name='lead_id' id='lead_id' value='{$lead_fetch['ID']}'>
      <input type='text' class='form-control' name='name' id='name' readonly value='{$lead_fetch['FULL_NAME']}'>
    </div>
    <div class='form-group col-md-6'>
      <label for='inputPassword4'>Mobile</label>
      <input type='number' class='form-control' name='mobile' id='mobile' readonly value='{$lead_fetch['MOBILE']}'>
    </div>
  </div>
  <div class='form-group'>
     <label for='inputState'>Lead Status</label>
      <select  id='leadStatus' name='leadStatus' onchange='changeCom(this.value)' class='form-control'>
        <option selected disabled value=''>Select Status</option>
        <option value='Won'>Won</option>
        <option value='Intrested'>Intrested (Next Call)</option>
        <option value='Not Intrested'>Not Intrested</option>
        <option value='Loss'>Loss</option>
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
      <th scope='col'>Date</th>
      <th scope='col'>Time</th>
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
      <th>{$row['DATE']}</th>
      <td>{$row['TIME']}</td>
      <td>{$row['DESCRIPTION']} </td>
    </tr>

    ";
      }
      
      $output .= " </tbody>
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
