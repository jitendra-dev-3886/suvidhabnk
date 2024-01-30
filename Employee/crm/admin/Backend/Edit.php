<?php
include('../includes/config.php');

$stateid=$_POST['sid'];
$editqry="SELECT * FROM `state_distric_block` WHERE ID={$stateid}";
$result=mysqli_query($con,$editqry) or die('sql query failed');
$output="";
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
    $output.=" 
  
    <form>  
     <div class='form-row d-flex justify-content-around'>    
          <div class='form-group col-md-6'>
               <input type='hidden' name='updatelocation' id='updatelocation' value='{$row['ID']}'>
               <label for='exampleInputEmail1'>State Name</label>
               <input type='text' id='updatestate' name='updatestate' class='form-control' placeholder='State Name' value='{$row['STATE_NAME']}'>
         </div>
         
        <div class='form-group col-md-6'>
               <label for='exampleInputEmail1'>Distric Name</label>
               <input type='text' id='update_districname' name='update_districname' class='form-control' placeholder='Distric Name' value='{$row['DISTRIC_NAME']}'>
         </div>
         
    </div>
                    
             <div class='form-row d-flex justify-content-around'>    
                               <div class='col-md-12'>
                               <div class='form-group'>
                                    <label for='exampleInputEmail1'>Block Name</label>

                                   <input
                                  type='text'
                                  class='form-control'
                                  id='update_blockname'
                                  name='update_blockname'
                                  aria-describedby='emailHelp'
                                  placeholder='Block Name'
                                  value='{$row['BLOCK_NAME']}'
                                />
                              </div>
                              </div>
                     
                    </div>
                    
                      
     </div>


     <div class='row'>
     <div class='col-md-12 mt-3'>
            <button type='submit' id='edit_submit' class='btn btn-primary'>Update</button>
     </div>
     </div>
 </form>

    
    
         ";
        }
        echo $output;
        }else{
        echo'no record found';
        
        }
        
 ?>           
