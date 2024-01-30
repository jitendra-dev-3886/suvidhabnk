<?php
error_reporting(0);
session_start();
include("../../Db/config.php");
// include("../include/fetch_data.php");
// include("function.php");

 function decrypt__adhar($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $decryption_key = "WebSpidy";
    // Using openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}

if(isset($_POST['action']))
 {
     // ALL REPORT
    if($_POST['page']=="All_Report")
    {
       
        $top_row = $_POST['top_row'];
        $amount_sort = $_POST['amount_sort'];
        $status = strtolower($_POST['status']);
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $Optype = $_POST['Optype'];
        $operator = $_POST['operator'];
        $Country = $_POST['Country'];
        $mduser = $_POST['mduser'];
        $dtuser = $_POST['dtuser'];
        $user5 = $_POST['user5'];
        $tra_status = $_POST['tra_status'];
        $id = $_SESSION['id'];
        
        $filter = '';
        $top ='';
        if($top_row !="All")
        {
         $top .="LIMIT $top_row";
        }
        if($amount_sort !="All" && $amount_sort !="")
        {
         $filter .= "AND CAST(report.AFTER_AMOUNT AS DECIMAL(19,4)) >= '$amount_sort'";
        }
        if($status !='')
        {
          $filter .= "AND report.FUND_TYPE ='$status'";
        }
        
        if($from_date !='' && $to_date =='')
        {
           $filter .= "AND DATE(report.TRANS_DATE) >= '$from_date'";
        }
        
        if($to_date !='' && $from_date =='')
        {
           $filter .= "AND DATE(report.TRANS_DATE) <='$to_date'";
        }
        
        if($to_date !='' && $from_date !='')
        {
            $filter .= "AND DATE(report.TRANS_DATE) between '$from_date' and '$to_date'";
        }
        
        if($Optype !='')
        {
            if($Optype=='DMT'){
          $filter .= "AND (report.TRANS_TYPE='$Optype' || report.TRANS_TYPE='DMT Commission' || report.TRANS_TYPE='DMT Account Verify')";
            }else{
          $filter .= "AND report.TRANS_TYPE='$Optype'";
            }
            
            
        }
        
        
        if($operator !='')
        {
          $filter .= "AND report.OPERATOR='$operator'";
        }
        
        if($Country !='')
        {
          $filter .= "AND report.COUNTRY ='$Country'";
        }
        
       
         
         if($mduser !='' && $dtuser ==''  && $user5 =='')
        {
        
             $filter .= "AND user.OWNER_ID='$mduser'";
        }
        
        if($dtuser !='' && $user5 =='')
        {
               $filter .= "AND user.OWNER_ID='$dtuser'";
        }
        
        if($user5 !='')
        {
             $filter .= "AND (report.USER_ID='$user5' or report.TRANSFER_USER_ID='$user5')";
        }

        // $res = $con->query("SELECT * FROM `report` LEFT JOIN user ON report.TRANSFER_USER_ID = user.ID WHERE report.TRANSFER_USER_ID != '' $filter  order by report.ID desc $top");
        $res = $con->query("SELECT * FROM `report` LEFT JOIN user ON report.USER_ID = user.ID WHERE report.USER_ID != '' $filter AND (report.USER_ID!='Admin' && report.USER_ID!='') order by report.ID desc $top");
        // echo "SELECT * FROM `report` LEFT JOIN user ON report.USER_ID = user.ID WHERE report.USER_ID != '' $filter AND (report.USER_ID!='Admin' && report.USER_ID!='') order by report.ID desc $top";
        // exit;
        
        
//   $res1 = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID=''")->num_rows();
//   if($res1){
      
//   }
   
         
         
        if($res->num_rows > 0){
             $output = array();
             $sl_no = 1;
             $no_success =0;
            $amt_success =0;
            $no_failed =0;
            $amt_failed =0;
            $no_pending =0;
            $amt_pending =0;
             while($rc_tran = $res->fetch_assoc()){
               $refid = $rc_tran['REFERENCE_ID'];
               $amountt=$rc_tran['AMOUNT'];
            $web_ip=$rc_tran['API_IP'];
             $transaction_type=$rc_tran['TRANS_TYPE'];
             $trans_amount=$rc_tran['AMOUNT'];
             
             if($transaction_type=='Recharge'){
               
               $recharge_table_query=$con->query("SELECT * FROM `recharge_transaction` WHERE `REFERENCE_ID`='$refid'")->fetch_assoc();
               $mobilee=$recharge_table_query['MOBILE'];
               $api_response=$recharge_table_query['RESPONSE'];
               $m_operator=$recharge_table_query['OPERATOR'];
               $statusss=$recharge_table_query['STATUS'];
               $tble_id=$recharge_table_query['ID'];
               $statussss= substr($statusss,0,4);
               if($statussss=='Succ'){
                   $statuss="Success";
               }else if($statussss=="Pend"){
                   $statuss="Pending";
               }else{
                   $statuss="Failed";
               }
               
            //   echo $m_operator;
            
            
                 
                //  $rc_tran['transaction_details'] = "<span><b> Recharge-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee ($m_operator)</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-primary disabled'>$statuss</button> &nbsp <span><button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModal'>Retry</button>&nbsp<span><button type='button' class='btn btn-success'>Print</button></span>";
                //  $rc_tran['transaction_details'] = "<span><b> Recharge-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee ($m_operator)</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-primary disabled'>$statuss</button> &nbsp <span><button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModall'>Retry</button>&nbsp<span><button type='button' class='btn btn-success'>Print</button></span>&nbsp <span><button type='button' class='btn btn-info edit_btn' data-toggle='modal' data-target='#exampleModall' data-eid='$refid' data-rid='$transaction_type'>Status Update</button><br><span><button type='button' class='btn btn-danger failed_btn' data-eid='$refid' data-rid='$transaction_type' data-amount='$trans_amount'>Failed</button>";
                 $rc_tran['transaction_details'] = "<span><b> Recharge-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee ($m_operator)</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-info edit_data' data-toggle='modal' data-target='#exampleModallll' data-id='$tble_id' data-eid='$refid' data-rid='$transaction_type' data-amount='$trans_amount'>Status Update</button>";
                  $rc_tran['api_res'] = $api_response;
                 
             }else if($transaction_type=='DMT Commission' || $transaction_type=='DMT Charge' || $transaction_type=='DMT' || $transaction_type=='DMT Account Verify'){
                $recharge_table_query=$con->query("SELECT * FROM `dmt_transactions` WHERE `REFFRENCE_ID`='$refid'")->fetch_assoc();
               $mobilee=$recharge_table_query['MOBILE'];
               $api_response=$recharge_table_query['RESPONSE'];
               $m_operator=$recharge_table_query['OPERATOR'];
               $statusss=$recharge_table_query['STATUS'];
              $statussss= substr($statusss,0,4);
              if($statussss=='Tran'){
                  $statuss="Success";
              }else if($statussss=="SUCC"){
                  $statuss="SUCCESS";
              }else if($statussss=="REJE"){
                  $statuss="Rejected";
              }else if($statussss=="ACCE"){
                  $statuss="Accepted";
              }
               
            //   echo $m_operator;
            
            
                 
                //  $rc_tran['transaction_details'] = "<span><b> Recharge-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-primary disabled'>$statuss</button> &nbsp <span><button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModal'>Retry</button>&nbsp<span><button type='button' class='btn btn-success'>Print</button></span>";
                 $rc_tran['transaction_details'] = "<span><b> DMT-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-primary disabled'>$statuss</button> &nbsp <span><button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModall'>Retry</button>&nbsp<span><button type='button' class='btn btn-success'>Print</button></span>&nbsp <span><button type='button' class='btn btn-info edit_btn' data-toggle='modal' data-target='#exampleModall' data-eid='$refid' data-rid='$transaction_type'>Status Update</button><br><span><button type='button' class='btn btn-danger failed_btn' data-eid='$refid' data-rid='$transaction_type' data-amount='$trans_amount'>Failed</button>";
                 $rc_tran['api_res'] = $api_response;
             
                 
             }else if($transaction_type=='AEPS Commission' || $transaction_type=='AEPS' || $transaction_type=='Aeps MS Commission'){
                $recharge_table_query=$con->query("SELECT * FROM `aeps_transactions` WHERE `REFFRENCE_ID`='$refid'")->fetch_assoc();
               $mobilee=$recharge_table_query['MOBILE'];
               $api_response=$recharge_table_query['RESPONSE'];
               $m_operator=$recharge_table_query['OPERATOR'];
               $statusss=$recharge_table_query['STATUS'];
              $statussss= substr($statusss,0,1);
              if($statussss=='1'){
                  $statuss="Success";
            //   }else if($statussss=="Pend"){
            //       $statuss="Pending";
              }else{
                  $statuss="Failed";
              }
               
            //   echo $m_operator;
            
            
                 
                //  $rc_tran['transaction_details'] = "<span><b> Recharge-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-primary disabled'>$statuss</button> &nbsp <span><button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModal' data-id='$refid'>Retry</button>&nbsp<span><button type='button' class='btn btn-success'>Print</button></span>";
                 $rc_tran['transaction_details'] = "<span><b> AEPS-$mobilee</span></b><br><span>Ref. No: $refid</span>/<span>$m_operator</span><br><span> Rs. $amountt Recharge for $mobilee</span><br><span>Web:<b>($web_ip)</b></span><br><span><button type='button' class='btn btn-primary disabled'>$statuss</button> &nbsp <span><button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModall' data-id='$refid'>Retry</button>&nbsp<span><button type='button' class='btn btn-success'>Print</button></span>&nbsp <span><button type='button' class='btn btn-info edit_btn' data-toggle='modal' data-target='#exampleModall' data-eid='$refid' data-rid='$transaction_type'>Status Update</button><br><span><button type='button' class='btn btn-danger failed_btn' data-eid='$refid' data-rid='$transaction_type' data-amount='$trans_amount'>Failed</button>";
              $rc_tran['api_res'] = $api_response;
             }
             
                 
                 
               $sql= $con->query("SELECT * FROM dmt_transactions WHERE REFFRENCE_ID ='$refid'")->fetch_assoc();
               $rc_tran['status']=$sql['STATUS'];
            //   echo $dmt_status;
            //   echo "SELECT * FROM dmt_transactions WHERE REFFRENCE_ID ='$refid'";
                 if($rc_tran['FUND_TYPE'] =="CREDIT" || $rc_tran['FUND_TYPE'] =="Credit")
                   {
                       $rc_tran['AMOUNT']= '<span class="badge badge-success">'. number_format($rc_tran['AMOUNT'], 2)     .'</span>';
                     
                   }
                   else
                   {
                        $rc_tran['AMOUNT']= '<span class="badge badge-danger">'. number_format($rc_tran['AMOUNT'], 2)     .'</span>';
                   }
                                     
                    $rc_t = $rc_tran['USER_ID'];
                    $transfer_id = $rc_tran['TRANSFER_USER_ID'];
                    $rc_tra = $con->query("SELECT * FROM `user` WHERE ID = '$rc_t' OR ID='$transfer_id'")->fetch_assoc();
                    $rc_tran['FIRST_NAME']=$rc_tra['FIRST_NAME']." ".$rc_tra['LAST_NAME'];
                    $rc_tran['MOBILE'] = $rc_tran['MOBILE'];
                     $rc_tran['PREVIOUS_AMOUNT']=  '<span>'. number_format($rc_tran['PREVIOUS_AMOUNT'], 2);
                    $rc_tran['AFTER_AMOUNT']=  '<span style="text-align:center;">'. number_format($rc_tran['AFTER_AMOUNT'], 2);
                    $rc_tran['delete']='<a onclick="javascript:confirmationDelete($(this));return false;" href="user_type.php?delete&id='.$rc_tran['ID'].'"><i class="ti-trash" style="font-size:20px;"></i></a>';                                                              
                    
   
            
             $rc_tran['no_success']=$no_success;
             $rc_tran['amt_success']=$amt_success;
             $rc_tran['no_failed']=$no_failed;
             $rc_tran['amt_failed']=$amt_failed;
             $rc_tran['no_pending']=$no_pending;
             $rc_tran['amt_pending']=$amt_pending;
                    
                    $rc_tran['sl_no']=$sl_no;
                    $output[] = $rc_tran;
                    $sl_no++;        
            }
        echo json_encode($output);
        }
        else
         {
            echo json_encode(array("not found"));
         }
    }
    
 }
?>
