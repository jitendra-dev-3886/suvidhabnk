<?php  
        include('./includes/config.php');
        include('./includes/header.php');
        include('./includes/sidebar.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
            <!-- Page-header start -->
            <div class="page-header">
              <div class="page-block">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="page-header-title">
                      <h5 class="m-b-10">Dashboard</h5>
                      <p class="m-b-0">Add Leads </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.php"> <i class="fa fa-home"></i> </a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page-header end -->
            <div class="pcoded-inner-content">
              <!-- Main-body start -->
              <div class="main-body">
                <div class="page-wrapper">
                  <!-- Page-body start -->

                  <div class="pcoded-content">

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
                                    <h5>Add Leads</h5>
                                    <!--<span-->
                                    <!--  >Add class of-->
                                    <!--  <code>.form-control</code> with-->
                                    <!--  <code>&lt;input&gt;</code> tag</span-->
                                    
                                  </div>
                                  <div class="card-block">



                        <form id="formData" >
                            
                                        
                                 <div class="row">
                              
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>

                                <input
                                  type="text"
                                  class="form-control"
                                  id="fname"
                                  name="name"
                                  aria-describedby="emailHelp"
                                  placeholder="Name"
                                  
                                />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Mobile</label>

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
                                <label for="exampleInputEmail1">Email</label>

                                <input
                                  type="email"
                                  class="form-control"
                                  name="email"
                                  id="email"
                                  placeholder="Email"
                                  
                                />
                              </div>
                            </div>
                         
                         
                             <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">State</label>
                                  <select name="state" id="state" onchange="showdistrict()" class='selectpicker' aria-label="Default select example" data-live-search="true">
                                    <option value="">Select</option>
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
                                <!--<input-->
                                <!--  type="text"-->
                                <!--  class="form-control"-->
                                <!--  name="STATE"-->
                                <!--  id="STATE"-->
                                <!--  reuired-->
                                <!--  placeholder="State"-->
                                <!--/>-->
                              </div>
                            </div> 
                              <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">District</label>

                                <select class='selectpicker' onchange="showblock()" aria-label="Default select example" id="dist" style="width: 200px;" name="district"  data-live-search="true" >
                                    
                                     
                             </select>
                              </div>
                            </div>  
                                     <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Block</label>

                                <select class='selectpicker' aria-label="Default select example" id="block" style="width: 200px;" name="block"  data-live-search="true" >
                                    
                             </select>
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
                                  <label for="inputState">Lead Status</label>
                                  <select  name="lead_status" id="lead_status" class="form-control" onchange="changeCom(this.value)">
                                    <option>Select Status</option>
                                    <option value="Call not Connect" selected>Call not Connect</option>
                                    <option value="First Call Complete">First Call Complete</option>
                                    <option value="Next Call Schedule">Next Call Schedule</option>
                                    <option value="Meeting Complete">Meeting Complete</option>
                                    <option value="Software Demo Complete">Software Demo Complete</option>
                                    <option value="Waiting for Customer Confirmation">Waiting for Customer Confirmation</option>
                                    <option value="Waiting for Payment">Waiting for Payment</option>
                                    <option value="Token Money Recive">Token Money Recive</option>
                                    <option value="Area Allotment and Document Complete">Area Allotment and Document Complete</option>
                                    <option value="Store Branding Under Process">Store Branding Under Process</option>
                                    <option value="Store Branding Complete">Store Branding Complete</option>
                                    <option value="Full Payment Received">Full Payment Received</option>
                                    <option value="Store Inauguration Complete">Store Inauguration Complete</option>
                                    <option value="Onboarding Complete">Onboarding Complete </option>
                                    <option value="Customer Training Complete">Customer Training Complete</option>
                                    <option value="Deal Won">Deal Won</option>
                                    <option value="Deal Loss">Deal Loss</option>
                                  </select>
                              </div>
                            </div> 
                            <div id="contactSchedule" class="form-row col-md-12" style="display:none;">
                              
                             <div class="col-md-6">
                              <div class="form-group">
                                   <label for="inputState">Date</label>
                                  <input type="date" name="date" id="date" class="form-control" placeholder="">
                                   </div>
                              </div>
                             <div class="col-md-6">
                              <div class="form-group">
                                  <label for="inputState">Time</label>
                                  <input type="time" name="time" id="time" class="form-control" placeholder="">
                                   </div>
                              </div>
                                
                            </div>
                         
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Remark</label>
                                   <textarea class="form-control" row="3" id="remark" name="remark"></textarea>
                           
                              </div>
                              
                            </div>
                          </div>
                          <div class="text-center">
                            <input type="hidden" name="type" value="1">
                            <input type="hidden" name="uid" id="uid">
                            <div class="text-center">
                            <button type="button" id="submitLead" class="btn btn-info">Submit</button>
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
          </div>
        </div>
      </div>
    </div>
    <script>
    function changeCom(value){
        // console.log(value);
        // if(value == "Meeting Complete" || value == "Software Demo" || value == "Waiting for Confirmation" || value == "Waiting for Payment" || value == "Next Call" ){
        //     $("#contactSchedule").show();
        // }
        if(value == "Next Call Schedule" || value == "Waiting for Customer Confirmation" || value == "Waiting for Payment" || value == "Store Branding Complete"){
            $("#contactSchedule").show();
        }
        else{
            $("#contactSchedule").hide();
        }
    }
</script>
<?php include('./includes/footer.php');  ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


function showdistrict(){
        name = $('#state').val();
     $.ajax({
        type: "POST",
        url: "../admin/Backend/showBlock.php",
        data: { pageid : 3,
                statearray : name},
        success: function (data) {
                $('.selectpicker').selectpicker();
                if(data)
                {
               $("#dist").html(`
               <option selected value="">Select District</option>
               ${data}
               `);
               $('#dist').selectpicker('refresh');
                }

        }
      });
   }
    
    function showblock(){
        name = $('#dist').val();
     $.ajax({
        type: "POST",
        url: "../admin/Backend/showBlock.php",
        data: { pageid : 2,
                myarr : name},
        success: function (data) {
                $('.selectpicker').selectpicker();
                if(data)
                {
               $("#block").html(`
               <option selected value="">Select Block</option>
               ${data}
               `);
               $('#block').selectpicker('refresh');
                }

        }
      });
   }
 
 
  $(document).ready(function () {
    $('#submitLead').click(function () {
        
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
    
    var idi  =  localStorage.getItem("id");
    $('#uid').val(idi);

         $.ajax({
        type: "POST",
        url: "Backend/uploadLead.php",
        data: $("#formData").serialize(),
        beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
        success: function (data) {
            data  = JSON.parse(data);
            if(data==1)
                {
                    Swal.fire({
  title: "Success!",
  text: "Lead Added Successfully..!",
  icon: "success",
  button: "Okay",
}).then(() => {
    $("#formData")[0].reset();
});
                    
                }
                else
                {
                    Swal.fire(
                      'Sorry!',
                      'Lead not!',
                      'inserted'
                    );                }
          },
      });
    }
    });
  });
</script>


