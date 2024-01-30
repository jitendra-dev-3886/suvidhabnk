<?php
session_start();
require_once('../../Db/config.php');
error_reporting(0);
// ini_set("display_errros" , 1);

$id = $_POST['mid'];


$sql = "SELECT * FROM user WHERE ID = '$id'";
$result = mysqli_query($con, $sql) or die('SQL Query Failed.');
$userdata = '';
    

    $row = mysqli_fetch_assoc($result);
        $userid = $row['ID'];
        $ownerid = $row['OWNER_ID'];
        $userdt = $row;
        $userType = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
        $ownername = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
        $registerUser = $con->query("SELECT * FROM register_user_data WHERE USER_ID = '$id'")->fetch_assoc();
        
        $filteredJson =  trim(str_replace(": " , "-" ,$registerUser['AADHAAR_DATA']));
        $filteredJson =  trim(str_replace("\n" , "-" ,$filteredJson));
        $filteredJson =  rtrim($filteredJson);
        $adhdata = json_decode($filteredJson , true);
        $profilepath = $adhdata['result']['photo'];
        
        //check virtual account exist or not;
        $vaus = $con->query("SELECT * FROM `virtual_account` where USER_ID='$id' ");
        if($vaus->num_rows == 0){
              $vadetailsinfo.="<div class='form-group'>
                         <h4>No account found. </h4>
                         <button type='button' class='btn btn-primary' onclick='createva($id)' >Create Va Now</button>
                    </div>
                    </div>
                  </div>
              </div>";
            //   $vadetailsinfo = "";
        }
        else{
            // $vadetails = "";
            $vausdata = $vaus->fetch_assoc();
             $qrres = json_decode($vausdata["QR_RESPONSE"],true);
            $qrimg = $qrres["qrCode"];
            if($vausdata['UPI'] == ""){
                 $vadetailsinfo = "
               <p>Virtual Id : ".$vausdata['VA_ID']."</p>
               <p>Account Number : ".$vausdata['ACCOUNT_NUM']."</p>
               <p>IFSC : ".$vausdata['IFSC']."</p>
             <button type='button' class='btn btn-primary' onclick='createupi($id)' >Create UPI Now</button>
               " ;
            }
            else{
               $vadetailsinfo = "
               <p>Virtual Id : ".$vausdata['VA_ID']."</p>
               <p>Account Number : ".$vausdata['ACCOUNT_NUM']."</p>
               <p>IFSC : ".$vausdata['IFSC']."</p>
               <p>UPI : ".$vausdata['UPI']."</p>
               " ;
               if($vausdata['QR_RESPONSE'] == ""){
               $vadetailsinfo .= "<button type='button' class='btn btn-primary' onclick='createqr($vid)' >Create QR Now</button>" ;
               }else{
               $vadetailsinfo .= "<img src='$qrimg' class='img-fluid' width='100px' alt='qrimg'/>
               <a href='$qrimg' style='font-size: 12px;margin: 15px 0;' download='{$row['FIRST_NAME']} {$row['LASST_NAME']} QR' class='btn btn-primary'>Download QR</a>
               ";
               }
            }
        }
            
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
                    
                    </div>
                    
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Subscription Plan Name</label>
                    </div>
                    
                    
                  
                   
                    
                      <div class='form-group col-md-5'>
                      <label for='inputEmail4'>Validity: ( Remaining Days)</label>
                    </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Member ID: {$row['PARTNER_ID']}</label>
                    </div>
                      <div class='form-group col-md-5'>
                      
                      <label for='inputEmail4'>Member Type : {$userType['NAME']}</label>
                    
                    </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Mobile : {$row['MOBILE']}</label>
                    </div>
                      <div class='form-group col-md-5'>
                         <label for='inputEmail4'>Email ID: {$row['EMAIL']}</label>
                      </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-8'>
                      <label for='inputEmail4'>Member Name : {$row['FIRST_NAME']} {$row['LAST_NAME']}</label>
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
                 <img src='$profilepath' id='adhaarpic' class='rounded mx-auto d-block'>
                <br>

                
              <label class='text-center'>Profile Picture</label>
              <label class='text-center'>Joining Date : <br> {$row['DATE']}</label>
              <label class='text-danger text-center'>Virtual Account Details </label>
              ".$vadetailsinfo."
            </div>
            </div> 
             
         <div class='row'>
             <div class='col-12'>
               <div class='form-row d-flex justify-content-between '>
                <div class='form-group col-md-4'>
                  <label >Aadhar Number : {$row['ADHAAR']}</label>
                </div>
                <div class='form-group col-md-4'>
                  <label >PAN Number : {$row['PAN']}</label>
                </div>
                <div class='form-group col-md-4'>
                  <label >GST Number : {$row['']}</label>
                </div>
              </div>
          </div>
             
         </div>
             
         <div class='row'>
             <label><u>Bank Account Details</u></label>
             <div class='col-12'>
               <div class='form-row d-flex justify-content-between '>
                <div class='form-group col-md-3'>
                  <label >Account Holder Name</label>
                  <input type='text' value='{$bankdtails['beneName']}' disabled  class='form-control'>
                </div>
                <div class='form-group col-md-3'>
                   <label >Account Number</label>
                   <input type='number' value='{$bankdtails['beneAcc']}' disabled  class='form-control'>
                </div>
                <div class='form-group col-md-3'>
                  <label >IFSC Code</label>
                   <input type='text' value='{$bankdtails['beneIFSC']}' disabled  class='form-control'>
                </div>
                <div class='form-group col-md-3'>
                  <label >Bank Name</label>
                   <input type='text' disabled class='form-control'>
                </div>
                </div>
              </div>
          </div>";
         

          
      $userdata .=  "
        </div>
        <div class='modal-footer'>
       
        <button type='submit' name='submitml' class='btn btn-primary'>Update</button>
      </div>
      </form>
    </div>
  </div>
</div> ";


    echo $userdata;




?>