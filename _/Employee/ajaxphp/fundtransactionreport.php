<?php

session_start();
include("../../Db/config.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
  
 
$memeberid = $con->query("SELECT * FROM user");
$userdata = "";

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
                   $debitrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='debit' and USER_ID='$usid' and WALLET='MAIN' ")->fetch_assoc();
                    $creditrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='credit' and USER_ID='$usid' and WALLET='MAIN' ")->fetch_assoc();
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
                        <td>".number_format((float)$debitrep['SUM(AMOUNT)'], 2, '.', '')."</td>
                        <td>".number_format((float)$creditrep['SUM(AMOUNT)'], 2, '.', '')."</td>
                        <td>".number_format((float)$row['MAIN_BAL'], 2, '.', '')."</td>
                        <td><a class='btn btn-primary' href='WalletReport.php?type=MAIN&id={$row['ID']}' target='_blank'>View Details </a></td>
                    </tr>";
              }
    $userdata .= " </tbody>
                  
                </table>";
              

    echo $userdata;
}



if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
  
 
$memeberid = $con->query("SELECT * FROM user");
$userdata = "";

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
                   $debitrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='debit' and USER_ID='$usid' and WALLET='AEPS' ")->fetch_assoc();
                    $creditrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='credit' and USER_ID='$usid' and WALLET='AEPS' ")->fetch_assoc();
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
                        <td>{$row['AEPS_BAL']}</td>
                        <td><a class='btn btn-primary' href='WalletReport.php?type=AEPS&id={$row['ID']}' target='_blank'>View Details </a></td>
                    </tr>";
              }
    $userdata .= " </tbody>
                  
                </table>";
              

    echo $userdata;
}





if (isset($_POST['pageid']) && $_POST['pageid'] == 2)
{
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
     $type = $_POST['type'];
     $id = $_POST['id'];
      if($type == "MAIN"){
        $filterquery = "where WALLET='MAIN'";
        $am = "ALL_MAIN";
    }
    else{
        $filterquery = "where WALLET='AEPS'";
        $am = "ALL_AEPS";
    }

    $sql = "SELECT * FROM report $filterquery AND USER_ID = '$id' AND TRANS_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";
// echo "SELECT * FROM report WHERE USER_ID = '$id' $filterquery ORDER BY ID DESC LIMIT {$offset},{$limit_per_page}";

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Remain Bal</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>".number_format((float)$row['AMOUNT'], 2, '.', '')."</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>".number_format((float)$row['AMOUNT'], 2, '.', '')."</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        
        $usdt = $con->query("select * from user where ID='".$row['USER_ID']."' ")->fetch_assoc();
        if(strtolower($row['USER_ID']) == "admin"){
            $prtnerid = "ADMIN";
        }
        else{
            $prtnerid = $usdt['PARTNER_ID'];
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                     <td>{$row['TRANS_DATE']}</td>     
                     <td>{$row['TRANS_TIME']}</td>
                    <td>{$prtnerid}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>".number_format($row["AFTER_AMOUNT"] , 2)."</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}

if (isset($_POST['pageid']) && $_POST['pageid'] ==4)
{
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
     $type = $_POST['type'];
     $id = $_POST['id'];
      if($type == "MAIN"){
        $filterquery = "where WALLET='MAIN'";
        $am = "ALL_MAIN";
    }
    else{
        $filterquery = "where WALLET='AEPS'";
        $am = "ALL_AEPS";
    }

    $sql = "SELECT * FROM report $filterquery and USER_ID<>'' and TRANS_DATE between '$fromdate' and '$todate' order by ID desc";
// echo $sql;

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Remain Bal</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>".number_format($row['AMOUNT'] ,2)."</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>".number_format($row['AMOUNT'] ,2)."</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        
        $usdt = $con->query("select * from user where ID='".$row['USER_ID']."' ")->fetch_assoc();
        if(strtolower($row['USER_ID']) == "admin"){
            $prtnerid = "ADMIN";
        }
        else{
            $prtnerid = $usdt['PARTNER_ID'];
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                     <td>{$row['TRANS_DATE']}</td>  
                     <td>{$row['TRANS_TIME']}</td>
                    <td>{$prtnerid}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>".number_format($row[$am] , 2)."</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}



if (isset($_POST['pageid']) && $_POST['pageid'] ==5)
{
     $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
     $type = $_POST['type'];
     $id = $_POST['id'];
      if($type == "MAIN"){
        $filterquery = "where WALLET='MAIN'";
        $am = "ALL_MAIN";
    }
    else{
        $filterquery = "where WALLET='AEPS'";
        $am = "ALL_AEPS";
    }

    $sql = "SELECT * FROM report $filterquery and USER_ID<>'' and TRANS_DATE BETWEEN '{$fromdate}' AND '{$todate}' order by ID desc";
// echo "SELECT * FROM report WHERE USER_ID = '$id' $filterquery ORDER BY ID DESC LIMIT {$offset},{$limit_per_page}";

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Remain Bal</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>".number_format($row['AMOUNT'] ,2)."</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>".number_format($row['AMOUNT'] ,2)."</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        
        $usdt = $con->query("select * from user where ID='".$row['USER_ID']."' ")->fetch_assoc();
        if(strtolower($row['USER_ID']) == "admin"){
            $prtnerid = "ADMIN";
        }
        else{
            $prtnerid = $usdt['PARTNER_ID'];
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['TRANS_DATE']}</td>
                    <td>{$row['TRANS_TIME']}</td>
                    <td>{$prtnerid}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>".number_format($row[$am] , 2)."</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}



?>
