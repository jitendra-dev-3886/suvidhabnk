<?php
session_start();
// include("../config.php");
require_once('../../Db/config.php');


      //  Display Code

if(isset($_POST['id']) && $_POST['id'] == 1){
    
// $query = "SELECT * FROM `contact` ORDER BY ID DESC";
// $query_run = mysqli_query($con,$query);

$i = 1;
$output = "";
      $res = $con->query("SELECT * FROM `contact` ORDER BY ID DESC");
 if($res->num_rows >0){
    while($row = $res->fetch_assoc()){
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$row['FULLNAME']}</td>
    <td>{$row['EMAIL']}</td>
    <td>{$row['DESCRIPTION']}</td>
    <td>{$row['MESSAGE']}</td>
    <td>{$row['DATE']}</td>
    </tr>";
    
}
}
echo $output;

}
 ?>