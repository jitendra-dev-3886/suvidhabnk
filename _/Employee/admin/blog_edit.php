<?php
session_start();
require_once('../Db/config.php');
require('include/Auth.php');
if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
$id = $_POST['eid'];

    $sql = "SELECT * FROM `blog` WHERE ID='$id'";
    $res= mysqli_query($con,$sql) or die('Sql query Failed');
    $output = "";
    if(mysqli_num_rows($res) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
              <form method='post' id='updateblogform'>
              
            <div class=form-row d-flex justify-content-around>
               <div class='form-group col-md-6'>
                        <input type='hidden' name='updateid' id='update_id' value='{$row['ID']}'>
                        <input type='hidden' name='id' value='9'>
                        <label for='exampleInputEmail1'>Categories</label>
                        <select class='form-control select2' id='categories' name='categories' value='{$row['CATEGORIES']}' name='categories' style='width: 100%;'>
                            <option>Select categories</option>           
                                <option value='Aadhaar ATM(AePS)'>Aadhaar ATM(AePS)</option>
                                <option value='Aaghaaz'>Aaghaaz</option>
                                <option value='Design'>Design</option>
                                <option value='Digi Gold'>Digi Gold</option>
                                <option value='Digital'>Digital</option>
                                <option value='Digital Payments'>Digital Payments</option>
                                <option value='Distributor'>Distributor</option>
                                <option value='Distributor Testimonial'>Distributor Testimonial</option>
                                <option value='DMT'>DMT</option>
                                <option value='Employee engagement'>Employee engagement</option>
                                <option value='Festivals'>Festivals</option>
                                <option value='Indian Bazar'>Indian Bazar</option>
                                <option value='Merchant'>Merchant</option>
                                <option value='Merchant Testimonial'>Merchant Testimonial</option>
                                <option value='mPOS'>mPOS</option>
                                <option value='Pancard'>Pancard</option>
                                <option value='Pay1 Digi'>Pay1Digi</option>
                                <option value='pay1 Platform'>pay1 Platform</option>
                                <option value='Pragati Capital'>Pragati Capital</option>
                                <option value='Predict and Win'>Predict and Win</option>
                                <option value='Process'>Process</option>
                                <option value='Retail'>Retail</option>
                                <option value='Retailer'>Retailer</option>
                                <option value='Sharing Experience'>Sharing Experience</option>
                                <option value='Startup'>Startup</option>
                                <option value='Testimonial'>Testimonial</option>
                                <option value='Travel'>Travel</option>
                                <option value='Uncategorized'>Uncategorized</option>
                                <option value='UPI'>UPI</option>
                                <option value='Upskill'>Upskill</option>
                                <option value='Upskill Employee Story'>Upskill Employee Story</option>
                                <option value='Policy'>Policy</option>
                               
                            </select>
                      </div>  
                          <div class='form-group col-md-6'>
                           <label for='exampleInputEmail1'>Image</label>
                            <input type='file' class='form-control' name='image' id='image' value='{$row['IMAGE']}'>
                        </div>
                     </div>
                    <div class=form-row d-flex justify-content-around>
                       <div class='form-group col-md-6'>
                        <label for='exampleInputEmail1'>Title</label>
                       <input type='text' id='title' name='title' class='form-control' value='{$row['TITLE']}'>
                       </div>
                    <div class='form-group col-md-6'>
                         <label for='exampleInputEmail1'>Written by</label>
                            <input type='text' id='writtenby' name='writtenby' class='form-control'value='{$row['WRITTEN_BY']}'>
                      </div>
                    </div>
                    
                     <div class='form-row d-flex justify-content-around'>   
                      <div class='form-group col-md-12'>
                             <textarea id='summernote' name='richtext' id='richtext'> {$row['RICH_TEXT']}
                              </textarea>
                       </div>
                    </div>  
          
                    
                 <div class='modal-footer'>
                 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                 <input type='submit' class='btn btn-primary' id='blog_update' value='Update'>
                </div>
           
         </form>";
        }
mysqli_close($con);
 echo $output;
    }else{
        echo "No Record Found";
 }
}
?>