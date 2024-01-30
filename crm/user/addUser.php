<?php
include('./includes/header.php');
include('./includes/sidebar.php');
?>


<!----------multiselect------------>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</script>

<!----------multiselect------------>


<style>
    .multiselect-dropdown{
        width:90% !important;
    padding: 11px 5px 0px 5px !important;
    display:none;
    }
    
    .custom-select{
        
            height: calc(3.25rem + 2px);
    }
    .btn >dropdown-toggle> bs-placeholder > btn-default{
        display:none;
    }
    .bootstrap-select>.dropdown-toggle {
     /*width: 100%;*/
    }
    .bootstrap-select>.dropdown-toggle {
      width: 164%;
    }
.bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:active, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover 
{
    
    width:349px;
    
}

.inner {
    overflow-y: unset !important;
}

.dropdown-menu.show {
    overflow: auto !important;
    
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

                                    <select class="custom-select " id="typeusr" name="typeusr" >
                                              <option  selected>Select</option>
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

                                <select class="selectpicker" aria-label="Default select example" data-live-search="true" name="state" id="state" class="form-control" required>
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
                        
                                  <div class="col-md-12">
                              <div class="form-group">
                                <label for="exampleInputEmail1">District</label>

                            
                              </div>
                            </div>      
                         <div class="col-md-12">
                              <div class="form-group">


                                     <select class="selectpicker" data-actions-box="true" multiple aria-label="Default select example" id="dist" name="district"  onchange="showblock()" data-live-search="true" >
                                      <?php
                                      include('includes/config.php');
                                        $user_type = $con->query("SELECT DISTINCT(`DISTRIC_NAME`) FROM state_distric_block order by ID desc");
                                         while($us_type = $user_type->fetch_assoc()){
                                            
                                            ?>
                                            <option  class="mydist"  value="<?php echo $us_type['DISTRIC_NAME']?> "> <?php echo $us_type['DISTRIC_NAME']?> </option>
                                          <?php 
                                         
                                            
                                            }
                                         ?>
                             </select>
    					 
                  
                              </div>
                            </div>                       

                            

                        <div class="col-md-6">
                        <div class="form-group mb-3" id="selectBlock">
                              <label for="exampleInputEmail1">Block</label>
                                   <select class="selectpicker" data-actions-box="true" multiple aria-label="Default select example" data-live-search="true" id="block" name="block" ></select>
                          
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



<!-- multiple dropdown -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
<!-- multiple dropdown -->

<script>


var name = [];
function showblock(){
        name = $('#dist').val() ;
        myarr = name.split(",");

     $.ajax({
        type: "POST",
        url: "Backend/showBlock.php",
        data: { pageid : 2,
                myarr : myarr,},
        success: function (data) {
                
                if(data)
                {
                    
                   $("#block").append(data);
                   $('#block').selectpicker('refresh');
                    
                }

        }
      });

          
      }



$(document).ready(function () {
    
    $("#submitUser").click(function () {
                var data = $('#user_Form').serializeArray();
                data.push({name: 'alldistrict', value:name });
                data.push({name: 'allblock', value:$("#block").val()});
      $.ajax({
        type: "POST",
        url: "Backend/submitUser.php",
        data: $.param(data),
        success: function (data) {
                
                if(data==1)
                {
                 Swal.fire(
                  'Good job!',
                  'User Inserted Sucessfully!',
                  'success'
                ) 
                        $("#user_Form")[0].reset();
                }
                else
                {
                    
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'User Not Inserted!',
                          footer: ''
                        })
                    
                }

        },
      });
    });
  });
</script>
