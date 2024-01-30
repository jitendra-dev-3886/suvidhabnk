<?php
include('./includes/header.php');
include('./includes/sidebar.php');
?>

<style>
    .multiselect-dropdown{
        width:90% !important;
    padding: 11px 5px 0px 5px !important;
    }
</style>

<div class="pcoded-inner-content">
  <!-- Main-body start -->
  <div class="main-body">
    <div class="page-wrapper">
      <!-- Page-body start -->

      <div class="pcoded-content">
 
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
          <!-- Main-body start -->
          <div class="main-body">
            <div class="page-wrapper">
              <!-- Page body start -->
              <div class="page-body">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                    <div class="card">
                      <div class="card-header">
                        <h5>Add Member</h5>
                        <!--<span-->
                        <!--  >Add class of <code>.form-control</code> with-->
                        <!--  <code>&lt;input&gt;</code> tag</span-->
                        
                      </div>
                      <div class="card-block">
                        <form id="user_Form" name="user_Form">
                          <div class="row">
                              
                                <div class="col-md-6">
                                        <label for="exampleInputEmail1">User Type </label>

                                    <select class="custom-select" id="typeusr" name="typeusr">
                                              <option selected>Select</option>
                                              <option value="Lead Manager"> Lead Manager </option>
                                              <option value="User"> User</option>
                                    </select>
                              </div>
                              
                              
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>

                                <input
                                  type="text"
                                  class="form-control"
                                  name="fname"
                                  aria-describedby="emailHelp"
                                  placeholder="Full Name"
                                  reuired
                                />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">mobile</label>

                                <input
                                  type="number"
                                  class="form-control"
                                  id="mobile"
                                  name="mobile"
                                  reuired
                                  placeholder="Mobile"
                                />
                              </div>
                            </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">State</label>

                                <select name="state" id="state" class="form-control">
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="manually_service"  >
                                 
                                 
                                <!--<lable>Select Distric</lable>-->
                                 
                          
                                </div>
                                
                           
                                
                                
                             
                        <div class="col-md-6" id="selectBlock">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Block</label>

                          
                          
                          
                          
                              </div>
                            </div>   
                        
                             <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">District</label>

                                <input
                                  type="text"
                                  class="form-control"
                                  name="district"
                                  id="district"
                                  reuired
                                  placeholder="District"
                                />
                              </div>
                            </div> 
                        
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>

                                <input
                                  type="email"
                                  class="form-control"
                                  name="email"
                                  id="email"
                                  placeholder="Enter Email"
                                  reuired
                                />
                              </div>
                            </div>    
                          
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>

                                <input
                                  type="password"
                                  class="form-control"
                                  id="password"
                                  name="password"
                                  reuired
                                  placeholder="Password"
                                />
                              </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>

                                <input
                                  type="text"
                                  class="form-control"
                                  id="address"
                                  name="address"
                                  reuired
                                  placeholder="Address"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="text-center">
                           
                         <input type="hidden" name="type" value="1">

                            <button
                              type="button"
                              id="submitUser"
                              class="btn btn-info"
                            >
                              Submit
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Basic Form Inputs card end -->
                  </div>
                </div>
              </div>
              <!-- Page body end -->
            </div>
          </div>
          <!-- Main-body end -->
          <div id="styleSelector"></div>
        </div>
      </div>

      <!-- Page-body end -->
    </div>
    <div id="styleSelector"></div>
  </div>
</div>




<?php
include('includes/footer.php');
?>



<!-- Latest compiled and minified JavaScript -->
<script>


  function showBlock(){
        name = $('#myMulti').val() ;

     $.ajax({
        type: "POST",
        url: "Backend/showBlock.php",
        data: { pageid : 2,
                name : name,},
        success: function (data) {
                
                if(data)
                {
                    $('#selectBlock').html(data);
                }
                else
                {
                
                    alert("error");
                }

        }
      });

          
      }


$('#langOpt').multiselect({
    columns: 1,
    placeholder: 'Select Languages',
    search: true
});
    
    
    // multi drop down



$('#langOpt').multiselect({
    columns: 1,
    placeholder: 'Select Languages',
    search: true,
    selectAll: true
});

$('#langOptgroup').multiselect({
    columns: 4,
    placeholder: 'Select Languages',
    search: true,
    selectAll: true
});


    
    // multi drop down
    
    
          function callOption(){
         $.ajax({
        type: "POST",
        url: "Backend/showDistrict.php",
        data: { pageid : 1   },
        success: function (data) {
                
                if(data)
                {
                    $('#manually_service').html(data);
                }
                else
                {
                
                $('#manually_service').html("Data Error");

                }

        },
      });
          
          
      }// call Options
      
      
      
      
      
     callOption();
      
      
    $("#submitUser").click(function () {
        
      //   alert("hey");
      $.ajax({
        type: "POST",
        url: "Backend/submitUser.php",
        data: $("#user_Form").serialize(),
        success: function (data) {
                
                if(data==1)
                {
                    
                    alert("User Inserted Sucessfully");
                    $("#user_Form")[0].reset();
                }
                else
                {
                    
                alert("User Not Inserted ");

                    
                }

        },
      });
    });
  
</script>
