<?php
include('../includes/config.php');


if(isset($_POST['myarr']))
{    
    
  $block =  '';

  $myarr = $_POST['myarr'];
  
  $no = sizeof($myarr);

        $i=0;
        while($i<$no)
        {
            
            $service = $con->query("SELECT * FROM state_distric_block WHERE DISTRIC_NAME='$myarr[$i]'");
            while($s_manager = $service->fetch_assoc()){
                  $block.=  "<option value='{$s_manager['BLOCK_NAME']}'> {$s_manager['BLOCK_NAME'] } </option>";
         
                                                       }    
         
         $i++;   
        }

    echo $block;
    
}                                
     ?>