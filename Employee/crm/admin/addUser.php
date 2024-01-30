<?php
include('./includes/header.php');
include('./includes/sidebar.php');
?>


<!----------multiselect------------>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        
        width:200px;
        
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
                        <form id="user_Form" name="user_Form" autocomplete = "off">
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
                                <label>Enter Employee Id</label>

                                <input
                                  type="text"
                                  class="form-control"
                                  id="emp_id"
                                  name="emp_id"
                                  placeholder="Employee Id"
                                  
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>

                                <input
                                  type="text"
                                  class="form-control"
                                  id="fname"
                                  name="fname"
                                  aria-describedby="emailHelp"
                                  placeholder="Full Name"
                                  
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
                                  required
                                  placeholder="Mobile"
                                />
                              </div>
                            </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">State</label>

                                <select class='selectpicker' data-actions-box="true" onchange="showdistrict()" multiple aria-label="Default select example" name="state" id="state" style="width: 200px;" data-live-search="true">
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
                         <div class="col-md-6">
                              <div class="form-group">

                                <select class='selectpicker' data-actions-box="true" onchange="showblock()" multiple aria-label="Default select example" id="dist" style="width: 200px;" name="district"  data-live-search="true" >
                                      
                             </select>
    					 
                  
                              </div>
                            </div>                       

                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Block</label>
                                <select class='blockselect' data-actions-box="true" multiple aria-label="Default select example" id="blk_Cont" style="width: 200px;" name="block"  data-live-search="true" >
                                    
                                </select>
    					 
                  
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
                                  
                                  placeholder="Address"
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
                                  
                                  placeholder="Password"
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

    <!-- Custom js -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-pax4MlgXjHEPfCwcJLQhigY7+N8rt6bVvWLFyUMuxShv170X53TRzGPmPkZmGBhk+jikR8WBM4yl7A9WMHHqvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- multiple dropdown -->
<script>

function showblock(){
        name = $('#dist').val() ;
     $.ajax({
        type: "POST",
        url: "Backend/showBlock.php",
        data: { pageid : 2,
                myarr : name},
        success: function (data) {
                $('.blockselect').selectpicker();
                if(data)
                {
               $("#blk_Cont").append(`${data}`);
               $('#blk_Cont').selectpicker('refresh');
                }

        }
      });
   }
   
   
   function showdistrict(){
        name = $('#state').val() ;
     $.ajax({
        type: "POST",
        url: "Backend/showBlock.php",
        data: { pageid : 3,
                statearray : name},
        success: function (data) {
                $('.selectpicker').selectpicker();
                if(data)
                {
               $("#dist").append(`${data}`);
               $('#dist').selectpicker('refresh');
                }

        }
      });
   }



$(document).ready(function () {
    
    
    
    // $('#state option').attr("selected","selected");
    //  $('#state').selectpicker('refresh');
    
    var block = [] ;
    var states = [] ;
    var districts = [] ;
    $("#submitUser").click(function (){
    
    if($("#fname").val() == ""){
        
        Swal.fire({
  title: "OOPS!",
  text: "Full Name is Required..!",
  icon: "error",
  button: "Close",
})
    }else if($("#mobile").val() == ""){
        
          Swal.fire({
  title: "OOPS!",
  text: "Mobile Number is Required..!",
  icon: "error",
  button: "Close",
})
        
    }else{    
        
    block =$('#blk_Cont').val();
    states =$('#state').val();
    districts =$('#dist').val();
    
    var data = $('#user_Form').serializeArray();
    data.push({name: 'alldistrict', value:districts });
    data.push({name: 'allblock', value:block });
    data.push({name: 'allstate', value:states });

      $.ajax({
        type: "POST",
        url: "Backend/submitUser.php",
        data: $.param(data),
        success: function (data) {
                
        var obj  = JSON.parse(data);
                if(obj.stat==1)
                {
                 Swal.fire({
  title: "Success!",
  text: "User Added Successfully..!",
  icon: "success",
  button: "Okay",
}).then(() => {
    $("#user_Form")[0].reset();
});
                        
                }
                else
                
                {
                    
                    if(obj.msg == "number already Exist")
                    {                    
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Mobile no already exists',
                          button: "Close",
                        })
                    }
                    else
                    {
                        
                          Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Some thing Went Wrong',
                          button: 'Close',
                        })
                    }
                        
                    }
                },

        
      });
    }
    });
  });
</script>
