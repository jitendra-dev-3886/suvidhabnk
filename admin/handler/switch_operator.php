  <?php
  session_start();

  include("../../Db/config.php");
    $id = $GET['ID'];
//   if(isset($_POST['submitswitch_operator']))
//   {
//      $service = $_POST['selectservice'];
//      $serviceapi = $_POST['serviceapi'];
//      $productname = $_POST['productname'];
//      $productcode = $_POST['productcode'];
//      $apiservicename = $_POST['apiservicename'];
//      $status = $_POST['status'];
     
     
//      $query = "INSERT INTO `switch_operator`( `SERVICE`, `API_NAME` , `PRODUCT_NAME`, `PRODUCT_CODE` , `TYPE`, `STATUS`)
//      		VALUES('$service' , '$serviceapi' , '$productname' , '$productcode' , '$apiservicename' , '$status') ";
//      	echo $query;	
//     $query_run = mysqli_query($con,$query);
    
//      if($query_run)
//      {
//       echo '<script>alert("Operator Manager is Updated")</script>';
//      }
 
//      else
//      {
//       echo '<script>alert("Failed to Update Operator Manaager")</script>';
//      }

//   }
//   if(isset($_GET['delete']))
//   {
//       $id = $_GET['id'];
//       $query = "DELETE FROM `switch_operator` WHERE ID = '$id'";
//         $query_run = mysqli_query($con,$query);
//         echo "<script> alert('Deleted')
//         location.replace('operator-manager.php');
//         </script>
//         ";
         
//      }
     
     //Add Switch Operator
       if(isset($_POST['add_switch']))
      {
              $product_name = $_POST['product_name'];
              $long_code = $_POST['long_code'];
              
              $service_type = $_POST['service_type'];
           
              $min_amount = $_POST['min_amount'];
              $max_amount = $_POST['max_amount'];
              $api_company = $_POST['api_company'];
              $r_offer = $_POST['r_offer'];
              $api_user_code = $_POST['api_user_code'];
              $api_product_name = $_POST['api_product_name'];
              
             //logo images 
              $operator_logo = $_FILES['operator_logo'];
              $img_name = $operator_logo['name'];
              $img_tmp = $operator_logo['tmp_name'];
              $dest = "../assets/switch_opertor/".$img_name;
        
              $status = $_POST['status'];
              
              $switch_query = " INSERT INTO `switchOperator`(`PRODUCTNAME`, `LONGCODE`, `SERVICETYPE`, `MINRCAMOUNT`, `MAXRCAMOUNT`, `APICOMPANY`, `BACKUP_API`, `APIPRODUCT`, `LOGO`, `STATUS`, `roffer`, `API_USER_CODE`) VALUES 
              ('$product_name','$long_code','$service_type','$min_amount','$max_amount','$api_company','','$api_product_name','$img_name','$status','$r_offer','$api_user_code') ";

                $query_runs = mysqli_query($con,$switch_query);
                 if($query_runs)
                 {
                   move_uploaded_file($img_tmp,$dest);
                   echo '<script>
                            location.replace("../switch_operator.php?status=add_switch_operator&?msg=successfully&desc=Switch Operator Added")
                           </script>';
                   
                //   header("location:../switch_operator.php?status=add_switch_operator&?msg=successfully&desc=Switch Operator Added");
                 }
             
                 else
                 {
                     echo'<script>
                            location.replace("../switch_operator.php?status=edit_switch_operator&?error=Failed&desc=Opps Someting went Wrong Failed to Added")
                         </script>';
                    //   header("location:../switch_operator.php?status=add_switch_operator&?msg=successfully&desc=Switch Operator Added");
                 }
}


 //Update Switch Operator
 
 if(isset($_POST['update_switch']))
   {
      $row_id = $_POST['row_id'];
      
      $product_name = $_POST['product_name'];
              $long_code = $_POST['long_code'];
              
              $service_type = $_POST['service_type'];
           
              $min_amount = $_POST['min_amount'];
              $max_amount = $_POST['max_amount'];
              $api_company = $_POST['api_company'];
              $r_offer = $_POST['r_offer'];
              $api_user_code = $_POST['api_user_code'];
              $api_product_name = $_POST['api_product_name'];
              
            	$images = $_FILES['operator_logo'];
            	$img_name = $images['name'];
            	$img_tmp = $images['tmp_name'];
            	
            	
                if(!empty($img_name)){
            	   $con->query("UPDATE `switchOperator` SET  LOGO = '$img_name' WHERE ID = '$row_id'" );
            	   move_uploaded_file($images['tmp_name'] , "../assets/switch_opertor/".$img_name);
               }
            	
             $status = $_POST['status'];
             
            $query = "UPDATE `switchOperator` SET `PRODUCTNAME`='$product_name',`LONGCODE`='$long_code',`SERVICETYPE`='$service_type',`MINRCAMOUNT`='$min_amount',`MAXRCAMOUNT`='$max_amount',`APICOMPANY`='$api_company',`BACKUP_API`='',`APIPRODUCT`='$api_product_name', `STATUS`='$status',`roffer`='$r_offer',`API_USER_CODE`='$api_user_code' WHERE ID = '$row_id'";
            
            $query_run = mysqli_query($con,$query);
            
             if($query_run)
             {
                             echo '<script>
                                    location.replace("../switch_operator.php?status=add_switch_operator&?msg=successfully&desc=Switch operator Updated")
                                   </script>';
             }
         
             else
             {
                       echo'<script>
                         location.replace("../switch_operator.php?status=edit_switch_operator&?error=Failed&desc=Opps Someting went Wrong Failed to Update")
                         </script>';
             }
        
          }
  
   if(isset($_GET['delete']))
  {
     $id = $GET['id'];
       $query = "DELETE FROM `switchOperator` WHERE ID = '$id'";
       echo"DELETE FROM `switchOperator` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
         header("location:../switch_operator.php?status=add_switch_operator&?msg=successfully&desc=Deleted row");
         
     }
     ?>