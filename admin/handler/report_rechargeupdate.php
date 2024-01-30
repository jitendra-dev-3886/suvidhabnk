<?php
    session_start();
 include("../../Db/config.php");
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../../Agent/Backend/Recharge/recharge_function.php");


    // error_reporting(E_ALL);
    // ini_set("display_errors",1);

        if(isset($_POST['pageid']) && $_POST['pageid'] == 3){

           $editId = $_POST['editId'];  
      
      // fetch data from student table..  
      $sql = "SELECT * FROM `recharge_transaction` WHERE ID = '$editId'";  
      $query = $con->query($sql);  
      if ($query->num_rows > 0) {  
      $output = "";  
      while ($row = $query->fetch_assoc()) {  
      $output .= "  
                        <form id='load_form'>
                         <div class='form-group'>
                            <input type='hidden' class='form-control' id='editId' value='{$row['ID']}'>  
                            <label>Mobie Number</label>
                            <input type='number' class='form-control' name='mb' id='edit_mb' placeholder='Enter Mobile Number' value='{$row['MOBILE']}' readonly>
                          </div>
                         <div class='form-group'>
                            <label>Operator Name</label>
                            <input type='text' class='form-control'  name='op_name' id='edit_opname' placeholder='Enter Operator Name' value='{$row['OPERATOR']}'>
                          </div>
                         <div class='form-group'>
                            <label>Amount</label>
                            <input type='text' class='form-control' name='amt' id='edit_amt' placeholder='Enter Amount' value='{$row['AMOUNT']}'>
                          </div>
                         <div class='form-group'>
                            <label>TransactionId</label>
                            <input type='text' class='form-control' name='trans_id' id='edit_tid' placeholder='Enter TransactionId' value='{$row['REFERENCE_ID']}' readonly>
                          </div>
                          <select class='form-control form-control-sm' name='edit_status' id='edit_status'>
                              <option value='{$row['STATUS']}' selected>{$row['STATUS']}</option>
                              <option value='Failed'>Refund</option>
                              <option value='Success'>Success</option>
                            </select>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-primary' name='editSubmit' id='editSubmit'>Submit</button>
                  </div>
                      </form>
";            
        }  
      }  
      echo $output;  
      }  
    
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
        $usId=$_POST['edit_id'];
        $mb=strip_tags($_POST['edit_mb']);
        $amt=strip_tags($_POST['edit_amt']);
        $opName=strip_tags($_POST['edit_opname']);
        $refId=strip_tags($_POST['edit_tid']);
        $opId=strip_tags($_POST['edit_opid']);
        $staus=strip_tags($_POST['edit_status']);
        
        $fetch_rc_trans = $con->query("SELECT * FROM `recharge_transaction` WHERE `ID`='$usId'")->fetch_assoc();
        $update_rep=$fetch_rc_trans['REFERENCE_ID'];
        $user_id = $fetch_rc_trans['USER_ID'];
        
        $fetch_user_data = $con->query("SELECT * FROM `user` WHERE `ID`='$user_id'")->fetch_assoc();
         
        $user_prev_bal = $fetch_user_data['MAIN_BAL'];
        
        // if($staus == "Refund"){
        //     $update_bal = $user_prev_bal + $amt;
            
        //     $con->query("UPDATE `user` SET `MAIN_BAL`='$update_bal' WHERE ID='$user_id'");
            
        //     $report_update = "UPDATE `report` SET `USER_ID`='$user_id',`PREVIOUS_AMOUNT`='$user_prev_bal',`AMOUNT`='$amt',`AFTER_AMOUNT`='$update_bal',`FUND_TYPE`='Recharge Refund',`STATUS`='$staus' WHERE REFERENCE_ID='$update_rep'";
            
        // }
        
        
        if($staus == "Failed"){
            $retailer_comm=$con->query("SELECT * FROM report WHERE REFERENCE_ID='$refId' AND FUND_TYPE='CREDIT'");
            $retailer_commmm=$con->query("SELECT * FROM report WHERE REFERENCE_ID='$refId' AND FUND_TYPE='Debit'")->fetch_assoc();
            $user_iddd= $retailer_commmm['USER_ID'];
               
               $trans_ammountt=$retailer_commmm['AMOUNT'];
               
               $user_main_bal_queryy=$con->query("SELECT * FROM user WHERE ID='$user_iddd'")->fetch_assoc();
               
               $user_main_ball=$user_main_bal_queryy['MAIN_BAL'];
               
               $new_ammount=$user_main_ball+$trans_ammountt;
               
              $update_user_bal=$con->query("UPDATE user SET `MAIN_BAL`='$new_ammount' WHERE ID='$user_iddd'");
              
              
         $update_credit_report=$con->query("UPDATE report SET PREVIOUS_AMOUNT='$user_main_ball', AMOUNT='$trans_ammountt', AFTER_AMOUNT='$new_ammount',FUND_TYPE='CREDIT'  WHERE REFERENCE_ID='$refId' AND USER_ID='$user_id' AND FUND_TYPE='Debit'");


                
            while($roww = mysqli_fetch_assoc($retailer_comm)){
                // echo $roww['OWNER'];
                
               $user_idd= $roww['USER_ID'];
               
               $trans_ammount=$roww['AMOUNT'];
               
               $user_main_bal_query=$con->query("SELECT * FROM user WHERE ID='$user_idd'")->fetch_assoc();
               
               $user_main_bal=$user_main_bal_query['MAIN_BAL'];
               
               $comm_minus_ammount=$user_main_bal-$trans_ammount;
               
              $update_user_bal=$con->query("UPDATE user SET `MAIN_BAL`='$comm_minus_ammount' WHERE ID='$user_idd'");

                insert_allreport($user_idd  ,$refId , "Recharge Comission Refund" , $user_main_bal  , $comm_minus_ammount , $trans_ammount , "Debit" , "Debited Successfully" , "MAIN");
            }
        }

        
      if($staus == "Success"){
          $retailer_comm=$con->query("SELECT * FROM report WHERE REFERENCE_ID='$refId'")->fetch_assoc();
            $ref_id=$refId;
            $user_id=$retailer_comm['USER_ID'];
            $usertype=46;
            
            
            $trans = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
       
       //fetch user and its owner distributer and master distributer
        $update_ball = $user_prev_bal - $amt;
        
        $main_bal=$update_ball;
        

            
            // echo $ref_id;
            
            // echo $user_id;
            
            $update_failed_report=$con->query("UPDATE report SET PREVIOUS_AMOUNT='$user_prev_bal', AMOUNT='$amt', AFTER_AMOUNT='$update_ball',FUND_TYPE='Debit'  WHERE REFERENCE_ID='$refId' AND USER_ID='$user_id' AND FUND_TYPE='Failed'");
            givee_comm($ref_id , $user_id , $usertype, $main_bal);
            
            
            // echo "UPDATE report SET PREVIOUS_AMOUNT='$user_prev_bal', AMOUNT='$amt', AFTER_AMOUNT='$update_ball',FUND_TYPE='Debit'  WHERE REFERENCE_ID='$refId' AND USER_ID='$usId' AND FUND_TYPE='Failed'";
            
            
            
        //       $retailer_comm=$con->query("SELECT * FROM report WHERE REFERENCE_ID='$refId'");
        //         // echo $roww['OWNER'];
                
        //       $user_idd= $roww['USER_ID'];
               
        //       $trans_ammount=$roww['AMOUNT'];
               
        //       $user_main_bal_query=$con->query("SELECT * FROM user WHERE ID='$user_idd'")->fetch_assoc();
               
        //       $user_main_bal=$user_main_bal_query['MAIN_BAL'];
               
        //       $comm_minus_ammount=$user_main_bal-$trans_ammount;
               
        //       $update_user_bal=$con->query("UPDATE user SET `MAIN_BAL`='$comm_minus_ammount' WHERE ID='$user_idd'");

        //         insert_allreport($user_idd  ,$refId , "Comission Return" , $user_main_bal  , $comm_minus_ammount , $trans_ammount , "Debit" , "Debited Successfully" , "MAIN");
            
          
          
        // //   User Distributor Details
            
        //     $user_distributor_id=$user_main_bal_query['OWNER_ID'];
            
        //     $fetch_distributor_query=$con->query("SELECT * FROM user WHERE ID='$user_distributor_id'")->fetch_assoc();
            
        //     $dist_Main_bal=$fetch_distributor_query['MAIN_BAL'];
            
            
            
            
            
            
        //     // User Master Distributor Details
            
        //     $user_master_dist_id=$fetch_distributor_query['OWNER_ID'];
            
        //     $fetch_master_dist_query=$con->query("SELECT * FROM user WHERE ID='$user_master_dist_id'")->fetch_assoc();
            
            
           
            
        }
        
        
        
        
        
        

        
        
        
        
        $sql_up="UPDATE `recharge_transaction` SET  `MOBILE`='{$mb}',`AMOUNT`='{$amt}',`OPERATOR`='{$opName}', `REFERENCE_ID`='{$refId}',`OPERATOR_ID`='{$opId}',`STATUS`='{$staus}' WHERE ID='{$usId}'";
        
         if ($con->query($sql_up)) {  
               echo 1;  
          }else{  
               echo 0;  
          } 
    }
    
    ?>