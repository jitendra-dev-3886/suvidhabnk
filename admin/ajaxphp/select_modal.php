<?php
session_start();
require_once('../../Db/config.php');
// error_reporting(E_ALL);
// ini_set("display_errros" , 1);

$id = $_POST['mid'];

$sql = "SELECT * FROM user WHERE ID = '$id'";
$result = mysqli_query($con, $sql) or die('SQL Query Failed.');
$userdata = '';
    

    $row = mysqli_fetch_assoc($result);
        $userid = $row['ID'];
        $ownerid = $row['OWNER_ID'];
        $userdt = $row;
        $usermaincom = $con->query("SELECT * FROM user_comm WHERE USER_ID = '$userid'");
        if($usermaincom->num_rows == 0){
            $con->query("INSERT INTO `user_comm` ( `USER_ID`)
            VALUES ('$userid')");
        }
        
        
        $usermaincomdt = $con->query("SELECT * FROM user_comm WHERE USER_ID = '$userid'")->fetch_assoc();
        $userType = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
        $ownername = $con->query("SELECT * FROM user WHERE ID = '$userid'")->fetch_assoc();
        $ownername1 = $con->query("SELECT * FROM user_profile WHERE USER_ID = '$id'")->fetch_assoc();
        $owmb = $ownername['PARTNER_ID'];
        $owadh= $ownername1['AADHAR_CARD_NO'];
        $owpan= $ownername1['PAN_CARD_NO'];
        $owpic = $ownername1['PROFILE_IMG'];
        $registerUser = $con->query("SELECT * FROM register_user_data WHERE USER_ID = '$id'")->fetch_assoc();
        $bank_data = $con->query("SELECT * FROM `payout_users` WHERE `US_ID` = '$id'")->fetch_assoc();
        
        if($ownerid == "ADMIN"){
            $ownername = "Admin";
        }
        else{
            $ownername = $ownername['FIRST_NAME'].$ownername['LAST_NAME'];            
        }
        $filteredJson =  trim(str_replace(": " , "-" ,$registerUser['AADHAAR_DATA']));
        $filteredJson =  trim(str_replace("\n" , "-" ,$filteredJson));
        $filteredJson =  rtrim($filteredJson);
        $adhdata = json_decode($filteredJson , true);
        $profilepath = $adhdata['result']['photo'];
        
        //check virtual account exist or not;

       
            if($row['US_STATUS'] == 'Active'){
                $usersd = "<option value = 'Deactive'>Deactive</option>";
            }elseif($row['US_STATUS'] == 'Deactive'){
                $usersd = "<option value = 'Active'>Active</option>";
            }
            
  $userdata = "<div class='row'>
                <!--left data-->
                <input type='hidden' name='userid' value='$userid' >
                <div class='col-9'>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Member ID : {$row['PARTNER_ID']}</label>
                    </div>
                    <div class='form-group col-md-3'>
                    <label>Member Status</label>
                      <select id='usst' name='usst'>
                          $usersd
                          <option value='{$row['US_STATUS']}' selected>{$row['US_STATUS']}</option>
                          
                      </select>
                    </div>
                    <div class='form-group col-md-3'>
                    <label>API Access</label>
                      <select id='api_access' name='api_access'>
                          $usersd
                          <option value='{$row['API_ACCESS']}' selected>{$row['API_ACCESS']} (Already Selected)</option>
                          <option value='YES'>YES</option>
                          <option value='NO'>NO</option>
                        </select>
                    </div>
                    </div>";
                   
                    
                $up = $con->query("SELECT * FROM user_profile WHERE USER_ID = '{$row['ID']}'")->fetch_assoc();

                    
                   $userdata .= "<div class='form-row'>
                      <div class='form-group col-md-8'>
                      <label for='inputEmail4'>Member Type : {$userType['NAME']}</label>
                    </div>
                      <div class='form-group col-md-5'>
                      <label for='inputEmail4'> Member Name : {$row['FIRST_NAME']} {$row['LAST_NAME']}</label>
                    </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-8'>
                      <label for='inputEmail4'>Mobile : {$row['MOBILE']}</label>
                    </div>
                      <div class='form-group col-md-5'>
                         <label for='inputEmail4'>Email ID : {$row['EMAIL']}</label>
                      </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-8'>
                      <label for='inputEmail4'>Member Owner : {$ownername}</label>
                    </div>
                    </div>
                    <label><u>Permanent Address</u></label>
                    <div class='form-row'>
                      <div class='form-group col-md-12'>
                        <label for='inputEmail4'>Full Address : {$row['ADDRESS']}</label>
                      </div>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>State : {$row['STATE']}</label>
                    </div>
                      <div class='form-group col-md-4'>
                        <label for='inputEmail4'>City : {$row['CITY']}</label>
                      </div>
                      <div class='form-group col-md-4'>
                        <label for='inputEmail4'>Pin Code : {$row['PIN']}</label>
                      </div>
                       
                    </div>
                    <label><u>Office Address</u></label>
                    <div class='form-row'>
                      <div class='form-group col-md-12'>
                        <label for='inputEmail4'>Full Address : {$row['ADDRESS']}</label>
                      </div>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>State : {$row['STATE']}</label>
                    </div>
                      <div class='form-group col-md-4'>
                        <label for='inputEmail4'>City : {$row['CITY']}</label>
                      </div>
                      <div class='form-group col-md-4'>
                        <label for='inputEmail4'>Pin Code : {$row['PIN']}</label>
                      </div>
                      
                    </div>
                    
                    
                </div>
                

                
               <div class='col-md-3'>
                 <img src='assets/Documents/$owmb/$owpic' id='adhaarpic' class='rounded mx-auto d-block'>
                <br>

              <label class='text-center'>Profile Picture</label>
                
              <label class='text-center'>Joining Date : <br> {$row['DATE']}</label>
              <label class='text-danger text-center'>Virtual Account Details </label>
              ".$vadetailsinfo."
            </div>
            </div> 
             
    ";
    
    
    
    
        //  <div class='row'>
        //      <div class='col-12'>
        //       <div class='form-row d-flex justify-content-between '>
        //         <div class='form-group col-md-4'>
        //           <label >Aadhar Number:{'hello'}</label>
        //         </div>
        //         <div class='form-group col-md-4'>
        //           <label >PAN Number : {$up['PAN_CARD_NO']}</label>
        //         </div>
        //         <div class='form-group col-md-4'>
        //           <label >GST Number : {$row['']}</label>
        //         </div>
        //       </div>
        //   </div>
             
        //  </div>
    
    
    
    
    
    
    $sql1 = "SELECT * FROM register_user_data WHERE USER_ID = '$id'";
$result1 = mysqli_query($con,$sql1);

$row1 = mysqli_fetch_assoc($result1);
    
     $bankdata = $row1['BANK_DATA'];
          
    $bankdtails = json_decode($bankdata,true);
   
    
    $userdata .= "<div class='row'>
             <div class='col-12'>
             
               <div class='form-row d-flex justify-content-between '>
                <div class='form-group col-md-3'>
                  <a class='badge badge-info right' href='assets/Documents/{$row['PARTNER_ID']}/{$row['ADHAAR']}' download>Download Aadhar</a>
                  <a href='assets/Documents/{$row['PARTNER_ID']}/{$row['ADHAAR']}' download>
                      <img src='assets/Documents/{$row['PARTNER_ID']}/{$row['ADHAAR']}' alt='Aadhar' width='150' height='100'>
                    </a>
                </div>
                
                <div class='form-group col-md-3'>
                  <a href='assets/Documents/{$row['PARTNER_ID']}/{$row['PAN']}' target='_blank' class='badge badge-info right' download>Download PAN</a>
                  <a href='assets/Documents/{$row['PARTNER_ID']}/{$row['PAN']}' download>
                      <img src='assets/Documents/{$row['PARTNER_ID']}/{$row['PAN']}' alt='PAN' width='150' height='100'>
                    </a>
                </div>
                
                <div class='form-group col-md-3'>
                </div>";
            
               $userdata .= "</div>
              </div>
          </div>     
         <div class='row'>
             <label><u>Bank Account Details</u></label>
             <div class='col-12'>
               <div class='form-row d-flex justify-content-between '>
                <div class='form-group col-md-3'>
                  <label >Account Holder Name</label>
                  <input type='text' value='{$ownername1['B_NAME']}' disabled  class='form-control'>
                </div>
                <div class='form-group col-md-3'>
                   <label >Account Number</label>
                   <input type='text' value='{$ownername1['AC_NUM']}' disabled  class='form-control'>
                </div>
                <div class='form-group col-md-3'>
                  <label >IFSC Code</label>
                   <input type='text' value='{$ownername1['IFSC_CODE']}' disabled  class='form-control'>
                </div>
                
               <div class='form-group col-md-3'>
                  <label >New Mobile No.</label>
                   <input type='text' value='{$row['MOBILE']}' name='newmobile' class='form-control'>
                </div>
                
                <div class='form-group col-md-3'>
                  <label >New Email</label>
                   <input type='text' value='{$row['EMAIL']}' name='newemail' class='form-control'>
                </div>
                
                </div>
              </div>
          </div>
         

            
             
       <div class='row'>
       
       <label><u>Payout</u> 
             --
            <span>OFF</span>
            <label class='switch'>
              <input type='checkbox' checked>
              <span class='slider round'></span>
            </label>
            <span>ON</span>
            
            </label>
       
       ";
       
       if($row["USER_TYPE"] != '47'){
       
           $userdata .= "<label><u>Services</u> 
             --
            <span>OFF</span>
            <label class='switch'>
              <input type='checkbox' checked>
              <span class='slider round'></span>
            </label>
            <span>ON</span>
            
            </label>
             <div class='col-12'>
               <div class='form-row d-flex justify-content-between '>
                <div class='form-group col-md-3'>
                  <label >AePs</label>
                   -
                   <span>OFF</span>
                    <label class='switch'>
                      <input type='checkbox' checked>
                      <span class='slider round'></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class='form-group col-md-3'>
                   <label >DMT</label>
                    -
                   <span>OFF</span>
                    <label class='switch'>
                      <input type='checkbox' checked>
                      <span class='slider round'></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class='form-group col-md-3'>
                  <label >X-DMT</label>
                   -
                   <span>OFF</span>
                    <label class='switch'>
                      <input type='checkbox' checked>
                      <span class='slider round'></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class='form-group col-md-3'>
                  <label >Payout</label>
                   -
                   <span>OFF</span>
                    <label class='switch'>
                      <input type='checkbox' checked>
                      <span class='slider round'></span>
                    </label>
                    <span>ON</span>
                </div>";
                
       }
             $userdata.= $vadetails;
          
       
              $aeps = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Aeps'");
          $adharpay = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'AadharPay'");
           $dmt = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'DMT'");
           $elct = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Electricity'");
           $rech = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Recharge'");
           $payoutcom = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Payout'");
           $xdmtcom = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'XDMT'");
           $bbpscom = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'BBPS'");
           $upicom = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'UPI'");
           $fastagcomm = $con->query("SELECT * FROM commission_package WHERE SERVICES = 'Fastag'");
          
          
          if($row["USER_TYPE"] != '47'){
          
       

          $userdata .= "
         <div class='row'>
             <label><u>Commission Setup</u></label>
             <div class='col-12'>
               <div class='form-row d-flex justify-content-between '>
               
                <div class='form-group col-md-3'>
                  <label >AePs (Cash Withdraw) -</label>";
                 $userdata .= "<select  name='aepspack'>";
                 $userdata .= "<option value=''>Select Pack</option>";
                 while($aepsdt = mysqli_fetch_assoc($aeps)){
                     if($userdt['AEPS_COMM'] == $aepsdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$aepsdt['ID']}' $slected >{$aepsdt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= "</div>";
                
                $userdata .= " <div class='form-group col-md-3'>
                  <label >AePs (Adhaar Pay) - </label>";
                  $userdata .= "<select  name='adhaarpaypack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($adharpaydata = mysqli_fetch_assoc($adharpay)){
                    if($userdt['AADHAR_COMM'] == $adharpaydata['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$adharpaydata['ID']}' $slected>{$adharpaydata['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";;
                  
               $userdata .= "</div>";
                
               $userdata .= " <div class='form-group col-md-3'>
                  <label >DMT (Money Transfer)</label>";
                 $userdata .= "<select  name='dmtpack'>";
                 $userdata .= "<option value=''>Select Pack</option>";
                 while($dmtdt = mysqli_fetch_assoc($dmt)){
                      if($userdt['DMT_COMM'] == $dmtdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$dmtdt['ID']}' $slected>{$dmtdt['PACKAGE_NAME']}</option>";
                 }
                      
                 $userdata .= "</select>";
                  
              $userdata .= "</div>";
              
            //   $userdata .= " <div class='form-group col-md-3'>
            //       <label >Electric Bill - </label>";
                   
            //       $userdata .= "<select>";
            //       $userdata .= "<option value=''>Select Pack</option>";
            //      while($elctdt = mysqli_fetch_assoc($elct)){
            //          if($row['DMT_COMM'] == $adharpay['ID']){
            //              $slected = "selected";
            //          }
            //          else{
            //              $slected = "";
            //          }
            //          $userdata .= "<option value = '{$elctdt['ID']}'>{$elctdt['PACKAGE_NAME']}</option>";
            //      }
            //      $userdata .= "</select>";
            //   $userdata .= " </div>";
               
              
               $userdata .= " <div class='form-group col-md-3'>
                  <label >Recharge - (Recharge) </label>";
                   
                  $userdata .= "<select name='rcpack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($rechdt = mysqli_fetch_assoc($rech)){
                    if($userdt['RC_COMM'] == $rechdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$rechdt['ID']}' $slected >{$rechdt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
               
               
               
               $userdata .= " <div class='form-group col-md-3'>
                  <label >Payout - (Payout) </label>";
                   
                  $userdata .= "<select name='payoutpack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($payout = mysqli_fetch_assoc($payoutcom)){
                    if($userdt['PAYOUT_COMM'] == $payout['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$payout['ID']}' $slected >{$payout['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
             
               
          
          $userdata .= " <div class='form-group col-md-3'>
                  <label >X-DMT - (Money Transfer) </label>";
                   
                  $userdata .= "<select name='xdmtpack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($xdmt = mysqli_fetch_assoc($xdmtcom)){
                    if($userdt['XDMT'] == $xdmt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$xdmt['ID']}' $slected >{$xdmt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
               
               
               $userdata .= " <div class='form-group col-md-3'>
                  <label >BBPS - (Bill Payment) </label>";
                   
                  $userdata .= "<select name='bbpspack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($bbps = mysqli_fetch_assoc($bbpscom)){
                    if($userdt['BBPS_COMM'] == $bbps['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$bbps['ID']}' $slected >{$bbps['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
               
               $userdata .= " <div class='form-group col-md-3'>
                  <label >UPI - (Money Transfer) </label>";
                   
                  $userdata .= "<select name='upipack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($upicomdt = mysqli_fetch_assoc($upicom)){
                    if($userdt['UPI_COMM'] == $upicomdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$upicomdt['ID']}' $slected >{$upicomdt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
             
             
             $userdata .= " <div class='form-group col-md-3'>
                  <label >Fastag -(BBPS)</label>";
                   
                  $userdata .= "<select name='fastagpack'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($fastagcomdt = mysqli_fetch_assoc($fastagcomm)){
                    if($userdt['FASTAG_COMM'] == $fastagcomdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$fastagcomdt['ID']}' $slected >{$fastagcomdt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
               
                  //bbps packages 
          
          $ar = ["VIRTUAL_ACCOUNT" ,"EMI" , "DATACARDPREPAID" , "DIGITALVOUCHER" , "MUNICIPALITY" , "LPG" , "HOSPITAL" , "CABLE" , "TRAFFICCHALLAN" , "LANDLINE" , "POSTPAID" , "WATER", "INSURANCE" , "ELECTRICITY" , "BROADBAND" , "GAS" , ""];
            foreach($ar as $word){
               $comms = $con->query("SELECT * FROM commission_package WHERE SERVICES = '$word' ");
          
                  $userdata .= " <div class='form-group col-md-3'>
                  <label style='display:block;' >$word </label>";
                   
                  $userdata .= "<select name='$word'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($comdt = mysqli_fetch_assoc($comms)){
                    if($usermaincomdt[$word] == $comdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$comdt['ID']}' $slected >{$comdt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
            }

          
          //offline bbps packages 
          $ar = ["EMI" , "DATACARDPREPAID" , "DIGITALVOUCHER" , "MUNICIPALITY" , "LPG" , "HOSPITAL" , "CABLE" , "TRAFFICCHALLAN" , "LANDLINE" , "POSTPAID" , "WATER", "INSURANCE" , "ELECTRICITY" , "BROADBAND" , "GAS" ];
            foreach($ar as $word){
                $wrd = "OFFLINE_".$word;
               $comms = $con->query("SELECT * FROM commission_package WHERE SERVICES = '$wrd' ");
          
                  $userdata .= " <div class='form-group col-md-3'>
                  <label style='display:block;' >$wrd </label>";
                   
                  $userdata .= "<select name='$wrd'>";
                  $userdata .= "<option value=''>Select Pack</option>";
                 while($comdt = mysqli_fetch_assoc($comms)){
                    if($usermaincomdt[$wrd] == $comdt['ID']){
                         $slected = "selected";
                     }
                     else{
                         $slected = "";
                     }
                     $userdata .= "<option value = '{$comdt['ID']}' $slected >{$comdt['PACKAGE_NAME']}</option>";
                 }
                 $userdata .= "</select>";
               $userdata .= " </div>";
            }



              $userdata .= " </div>
              </div>
          </div>";
          
          }
          
          
          
          
          
          
      $userdata .=  "
        </div>
        <div class='modal-footer'>
        <button type='button' class='btn btn-secondary'>Activity</button>
        <button type='submit' name='submitml' class='btn btn-primary'>Update</button>
      </div>
      </form>
    </div>
  </div>
</div> ";


    echo $userdata;




?>