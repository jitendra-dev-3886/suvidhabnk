<?php

session_start();
require_once('../../Db/config.php');

$id = $_POST['mid'];

$sql = "SELECT * FROM user WHERE ID = '$id'";
$result = mysqli_query($con, $sql) or die('SQL Query Failed.');
$userdata = '';
    

    while($row = mysqli_fetch_assoc($result)){
  $userdata = "<div class='row'>
                <!--left data-->
                <div class='col-9'>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Member ID : {$row['ID']}</label>
                    </div>
                    <div class='form-group col-md-3'>
                      <select >
                          <option>Select Status</option>
                          <option value='{$row['US_STATUS']}' selected>{$row['US_STATUS']}</option>
                          <option value='Active'>Active</option>
                          <option value='Deactive'>Deactive</option>
                      </select>
                    </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Subscription Plan Name</label>
                    </div>
                    <div class='form-group col-md-3'>
                      <select >
                          <option>Plan 1</option>
                          <option>Plan 2</option>
                          <option>Plan 3</option>
                      </select>
                    </div>
                      <div class='form-group col-md-5'>
                      <label for='inputEmail4'>Validity: ( Remaining Days)</label>
                    </div>
                    </div>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                      <label for='inputEmail4'>Member ID: {$row['ID']}</label>
                    </div>
                      <div class='form-group col-md-5'>
                      <label for='inputEmail4'>Member Type : </label>
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
                      <label for='inputEmail4'>Member Owner : </label>
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
                
                <!--right data-->
                <div class='col-md-3'>
                 <img src='dist/img/user.png' class='rounded mx-auto d-block'>
                <br>
              <label class='text-center'>Profile Picture</label>
              <label class='text-center'>Joining Date : <br> {$row['DATE']}</label>
              <label class='text-danger text-center'>Virtual Account Details </label>
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
             
         </div>";
}

    echo $userdata;




?>