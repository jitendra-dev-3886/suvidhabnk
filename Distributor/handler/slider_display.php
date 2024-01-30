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
      $res = $con->query("SELECT * FROM `slider`");
 if($res->num_rows >0){
    while($row = $res->fetch_assoc()){
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td><img src='dist/img/slider/{$row['IMAGE']}' width='100'/></td>
    <td>{$row['STATUS']}</td>
    <td>{$row['DATE']}</td>
    <td><a href='#deleteEmployeeModal' class='delete' data-id='{$row['ID']}' data-toggle='modal'><i class='fas fa-trash' data-toggle='tooltip' title='Delete'></i></a></td>
    </tr>";
    
}
}
echo $output;

}



if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `slider` WHERE ID=$id ";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}



 ?>
          