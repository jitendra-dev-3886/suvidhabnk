<?php
include('../includes/config.php');

 $displayqry="SELECT * FROM `state_distric_block` ORDER BY ID DESC";
 $result=mysqli_query($con,$displayqry) or die("sql query failed");
 $output="";
 if(mysqli_num_rows($result)>0){
 while($row=mysqli_fetch_assoc($result)){
     $output.="<tr>
     <td>{$row['ID']}</td>
     <td>{$row['STATE_NAME']}</td>
     <td>{$row['DISTRIC_NAME']}</td>
     <td>{$row['BLOCK_NAME']}</td>
     <td>{$row['DATE']}</td>
     <td>
     <button type='button' id='{$row['ID']}'  onclick='updateLead({$row['ID']})' data-mid='{$row['ID']}'  class='btn btn-sm btn-danger edit-btn' data-toggle='modal'  data-target='#exampleModalCenter'><i class='far fa-edit'></i>
     </button>
    <button type='button'  data-dt='{$row['ID']}'  class='btn btn-sm btn-warning dlt-btn' data-toggle='modal'  data-target='#exampleModalDelete'><i class='fa fa-trash'></i>
     </button>
     </td>
     </tr>";
 }
 echo $output;
 }else{
 echo"no record found";
 
 }
 
 ?>