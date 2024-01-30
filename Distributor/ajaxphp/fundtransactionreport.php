<?php

session_start();
include("../../Db/config.php");
include("../include/Auth.php");
  $usid = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
 
$memeberid = $con->query("SELECT * FROM user WHERE OWNER_ID='$usid' ORDER BY ID DESC");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Sr</th>
                    <th>Member ID</th>
                    <th>Member Name </th>
                    <th>Member Mobile No</th>
                    <th>Total Debit</th>
                    <th>Total Credit</th>
                    <th>Balance </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                     <tbody>';
$i=1;
              while($row = $memeberid->fetch_assoc()){
                  $usid = $row["ID"];
                   $debitrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='debit' and USER_ID='$usid' and WALLET='MAIN' ")->fetch_assoc();
                    $creditrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='credit' and USER_ID='$usid' and WALLET='MAIN' ")->fetch_assoc();
                 if($debitrep['SUM(AMOUNT)'] == ''){ 
                
                $debitrep['SUM(AMOUNT)'] = 0;
              }
              
                if($creditrep['SUM(AMOUNT)'] == ''){ 
                
                $creditrep['SUM(AMOUNT)'] = 0;
              }
             
                  $userdata .="<tr>
                        
                        <td> ".$i++." </td>
                        <td> {$row['PARTNER_ID']} </td>
                        <td> {$row['FIRST_NAME']} {$row['LAST_NAME']} </td>
                        <td> {$row['MOBILE']} </td>
                        <td>{$debitrep['SUM(AMOUNT)']}</td>
                        <td>{$creditrep['SUM(AMOUNT)']}</td>
                        <td>{$row['MAIN_BAL']}</td>
                        <td><a class='btn btn-primary' href='WalletReport.php?type=MAIN&id={$row['ID']}' target='_blank'>View Details </a></td>
                    </tr>";
              }
    $userdata .= " </tbody>
                  
                </table>";
              

    echo $userdata;
}



if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
  
  $wallet = $_POST['wallet'];
 
$memeberid = $con->query("SELECT * FROM user WHERE OWNER_ID='$usid' ORDER BY ID DESC");
$userdata = "";

$waltype = $wallet."_BAL";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Member ID</th>
                    <th>Member Name </th>
                    <th>Member Mobile No</th>
                    <th>Total Debit</th>
                    <th>Total Credit</th>
                    <th>Balance </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                     <tbody>';

              while($row = $memeberid->fetch_assoc()){
                  $usid = $row["ID"];
                   $debitrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='debit' and USER_ID='$usid' and WALLET='$wallet' ")->fetch_assoc();
                    $creditrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='credit' and USER_ID='$usid' and WALLET='$wallet' ")->fetch_assoc();
                 if($debitrep['SUM(AMOUNT)'] == ''){ 
                
                $debitrep['SUM(AMOUNT)'] = 0;
              }
              
                if($creditrep['SUM(AMOUNT)'] == ''){ 
                
                $creditrep['SUM(AMOUNT)'] = 0;
              }
             
                  $userdata .="<tr>
                        
                        <td> {$row['PARTNER_ID']} </td>
                        <td> {$row['FIRST_NAME']} {$row['LAST_NAME']} </td>
                        <td> {$row['MOBILE']} </td>
                        <td>{$debitrep['SUM(AMOUNT)']}</td>
                        <td>{$creditrep['SUM(AMOUNT)']}</td>
                        <td>{$row[$waltype]}</td>
                        <td><a class='btn btn-primary' href='WalletReport.php?type=AEPS&id={$row['ID']}' target='_blank'>View Details </a></td>
                    </tr>";
              }
    $userdata .= " </tbody>
                  
                </table>";
              

    echo $userdata;
}





if (isset($_POST['pageid']) && $_POST['pageid'] == 2){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
     $type = $_POST['type'];
     $id = $_POST['id'];
     
    if($type == "MAIN"){
        $filterquery = "and  WALLET='MAIN'";
    }
    else{
        $filterquery = "and  WALLET='AEPS'";
    }
    if($id != ""){
        $userid = $id;
    }else{
        $userid = $usid;
        
    }   
    
    $sql = "SELECT * FROM report WHERE USER_ID = '$userid' $filterquery AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
// echo "SELECT * FROM report WHERE USER_ID = '$id' $filterquery ORDER BY ID DESC LIMIT {$offset},{$limit_per_page}";

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>Sr No</th>
                        <th>Date & Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>{$row['AMOUNT']}</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>{$row['AMOUNT']}</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['TRANS_DATE']} {$row['TRANS_TIME']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>{$row['AFTER_AMOUNT']}</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}




?>
