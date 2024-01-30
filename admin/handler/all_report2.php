<?php
error_reporting(E_ALL);
session_start();
include("../../Db/config.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){
    
$pageNo = $_POST['pageNo'];
$entries = $_POST['entries'];
if($entries == ""){
    $entries = 3;
}
if($pageNo == ""){
    $pageNo =1;
}
$search = $_POST['search'];
if($search!=""){
    $pageNo = 1;
}

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
$filter = "";


if($from_date !='' && $to_date =='')
        {
           $filter .= "AND DATE(report.TRANS_DATE) >= '$from_date'";
        }
        
        if($to_date !='' && $from_date =='')
        {
           $filter .= "AND DATE(report.TRANS_DATE) <='$to_date'";
        }

$sql = $con->query("SELECT * FROM `report` LEFT JOIN user ON report.USER_ID = user.ID WHERE report.USER_ID != '' $filter AND (report.USER_ID!='Admin' && report.USER_ID!='') order by report.ID desc LIMIT");

//   echo "SELECT * FROM `report` LEFT JOIN user ON report.USER_ID = user.ID WHERE report.USER_ID != '' $filter AND (report.USER_ID!='Admin' && report.USER_ID!='') order by report.ID desc LIMIT $pageNo, $entries";
//  echo $sql;
//   exit;
$totalEnteries = $con->query("SELECT * FROM `report` LEFT JOIN user ON report.USER_ID = user.ID WHERE report.USER_ID != '' $filter AND (report.USER_ID!='Admin' && report.USER_ID!='') order by report.ID desc")->num_rows;

$pages = ceil($totalEnteries/$entries);

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

      while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>{$row['DATE']}</td>
                 
                    <td>{$row['FIRST_NAME']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$usertype['NAME']}</td>
                    <td>{$ownername}</td>";
       
                    $userdata .= "</tr>";
              }
    if($pageNo == 1){
        $strent = $pageNo;
        $endent = $pageNo*$entries;
    }
    else{
        $strent = ($pageNo*$entries)-$entries;
        $endent = $strent + $entries;
    }
    
    if($endent >= $totalEnteries){
        $endent = $totalEnteries;
    }
    echo json_encode(["totalEntries"=>$totalEnteries , "totalpages"=> $pages, "startEnt"=> $strent, "endEnt"=> $endent,  "currentpage"=> $pageNo , "showingEnteries"=> $entries, "alldata"=> $userdata ]);
    
    
    }
    

?>
