<?php
session_start();
require_once('../Db/config.php');
require("include/Auth.php");
if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
$id = $_POST['eid'];

    $sql = "SELECT * FROM `team` WHERE ID='$id'";
    $res= mysqli_query($con,$sql) or die("Sql query Failed");
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <form method='post' id='updateteamform'>
              
            <div class=form-row d-flex justify-content-around>
               <div class='form-group col-md-6'>
                        <input type='hidden' name='updateid' id='update_id' value='{$row['ID']}'>
                        <input type='hidden' name='id' value='9'>
                        <label for='exampleInputEmail1'>Upload Profile Picture</label>
                        <img src = 'assets/Team/{$row['PROFILE_PIC']}' class='img-fluid' width='50px' />
                        <input type='file' class='form-control' name='uimage' id='image' >
                </div>
                    <div class='form-group col-md-6'>
                        <label for='exampleInputEmail1'>Distributor Name</label>
                        <input type='text' id='team_member' name='team_member' class='form-control'value='{$row['NAME']}' placeholder='Name'>
                    </div>
            </div>
                      
                   <div class='form-row d-flex justify-content-around'>
                    
                    <div class='form-group col-md-6'>
                        <label for='exampleInputEmail1'>State</label>
                        <select class='form-control select2' id='state' name='state' style='width: 100%;'>
                                <option value = '{$row['STATE']}' selected>{$row['STATE']}</option>           
                                <option value='Andhra Pradesh'>Andhra Pradesh</option>
                                <option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
                                <option value='Arunachal Pradesh'>Arunachal Pradesh</option>
                                <option value='Assam'>Assam</option>
                                <option value='Bihar'>Bihar</option>
                                <option value='Chandigarh'>Chandigarh</option>
                                <option value='Chhattisgarh'>Chhattisgarh</option>
                                <option value='Dadar and Nagar Haveli'>Dadar and Nagar Haveli</option>
                                <option value='Daman and Diu'>Daman and Diu</option>
                                <option value='Delhi'>Delhi</option>
                                <option value='Lakshadweep'>Lakshadweep</option>
                                <option value='Puducherry'>Puducherry</option>
                                <option value='Goa'>Goa</option>
                                <option value='Gujarat'>Gujarat</option>
                                <option value='Haryana'>Haryana</option>
                                <option value='Himachal Pradesh'>Himachal Pradesh</option>
                                <option value='Jammu and Kashmir'>Jammu and Kashmir</option>
                                <option value='Jharkhand'>Jharkhand</option>
                                <option value='Karnataka'>Karnataka</option>
                                <option value='Kerala'>Kerala</option>
                                <option value='Madhya Pradesh'>Madhya Pradesh</option>
                                <option value='Maharashtra'>Maharashtra</option>
                                <option value='Manipur'>Manipur</option>
                                <option value='Meghalaya'>Meghalaya</option>
                                <option value='Mizoram'>Mizoram</option>
                                <option value='Nagaland'>Nagaland</option>
                                <option value='Odisha'>Odisha</option>
                                <option value='Punjab'>Punjab</option>
                                <option value='Rajasthan'>Rajasthan</option>
                                <option value='Sikkim'>Sikkim</option>
                                <option value='Tamil Nadu'>Tamil Nadu</option>
                                <option value='Telangana'>Telangana</option>
                                <option value='Tripura'>Tripura</option>
                                <option value='Uttar Pradesh'>Uttar Pradesh</option>
                                <option value='Uttarakhand'>Uttarakhand</option>
                                <option value='West Bengal'>West Bengal</option>
                            </select>
                      </div>
                      
                      
                     <div class='form-group col-md-6'>
                        <label for='exampleInputEmail1'>District</label>
                        <input type='text' id='district' value='{$row['DISTRICT']}' name='district' class='form-control' placeholder='District'>
                      </div>
                    </div>
                      
                        <div class='form-row d-flex justify-content-around'>
                         <div class='form-group col-md-4'>
                        <label for='exampleInputEmail1'>Block</label>
                        <input type='text' id='block' value='{$row['BLOCK']}' name='block' class='form-control' placeholder='Block'>
                      </div> 
                       <div class='form-group col-md-4'>
                        <label for='exampleInputEmail1'>Village</label>
                        <input type='text' id='village' value='{$row['VILLAGE']}' name='village' class='form-control' placeholder='Village'>
                      </div>
                     </div>
                       <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          <input type='submit' class='btn btn-primary'  id='team_update' value='Update'>
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
 