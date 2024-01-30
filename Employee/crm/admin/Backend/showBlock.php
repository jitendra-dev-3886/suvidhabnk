<?php
include('../includes/config.php');


if(isset($_POST['pageid']) && $_POST['pageid'] == 2)
{    
    
  $block = "";
  $myarr = $_POST['myarr'];
  
  $districtArray = explode(",",$myarr);
  $districts = implode("','",$districtArray);
  

            $service = $con->query("SELECT DISTINCT(`BLOCK_NAME`) FROM state_distric_block WHERE DISTRIC_NAME IN ('$districts')");
            while($s_manager = $service->fetch_assoc()){
                  $block .= "<option class='mydist' value='{$s_manager['BLOCK_NAME']}'> {$s_manager['BLOCK_NAME'] } </option>";
        }    
         
       
    echo $block;
    
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 3)
{    
    
  $block = "";
  $myarr = $_POST['statearray'];
  
  $statearray = explode(",",$myarr);
  $states = implode("','",$statearray);

            $service = $con->query("SELECT DISTINCT(`DISTRIC_NAME`) FROM state_distric_block WHERE STATE_NAME IN ('$states')");
            while($s_manager = $service->fetch_assoc()){
                  $block .= "<option class='mydist' value='{$s_manager['DISTRIC_NAME']}'> {$s_manager['DISTRIC_NAME'] } </option>";
        }    
         
       
    echo $block;
    
}



     ?>