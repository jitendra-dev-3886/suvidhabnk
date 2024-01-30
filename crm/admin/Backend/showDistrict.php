<?php

include('../includes/config.php');

if(isset($_POST['pageid']) && isset($_POST['pageid'])==2 )
{                    
     $dat = '  <select class="selectpicker" id="mul_drop" multiple aria-label="Default select example" data-live-search="true">
 <option value="">Select user type</option>';
        //   <?php
        //   include('includes/config.php');
     
     
        $user_type = $con->query("SELECT * FROM state_distric_block");
      
      
        $chk= '';
while($us_type = $user_type->fetch_assoc())
        {
         
        if($chk!=$us_type['DISTRIC_NAME'] )            
        {
        $dat.= "<option value='{$us_type['DISTRIC_NAME'] }' > {$us_type['DISTRIC_NAME']} </option>";
        }
        
        $chk = $us_type['DISTRIC_NAME'] ;
            
        }
      $dat.='</select>';
 
 echo $dat;
    
}
                            


?>