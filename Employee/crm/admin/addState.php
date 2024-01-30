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
                        <h5>Add State-Distric-Block</h5>
                       
                      </div>
                    <div class="card-block">
                    <form action="addState.php" method="POST" id="user_Form" name="user_Form" autocomplete = "off">
                        
                     <div class="form-row d-flex justify-content-around">    
                         
                          <div class="form-group col-md-4">
                               <label for="exampleInputEmail1">State Name</label>
                               <!--<input type="text" id="state" name="state" class="form-control" placeholder="State Name">-->
                               <select name="state" id="state"  class="form-control">
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
                           <div class="form-group col-md-4">
                               <label for="exampleInputEmail1">Distric Name</label>
                               <input type="text" name="distric"  id="distric" class="form-control" placeholder="Distric Name">
                         </div>
                         
                         <div class="col-md-4">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Block Name</label>
                                <input type="text" class="form-control" name="bname" id="bname"  placeholder="Block Name" />
                              </div>
                         </div>
                         
                    </div>
                    
                    </div>
              
                      <div class="text-center mb-5">
                            <input type="hidden" name="type" value="1">
                          <button type="submit" id="submitUser" name="submitUser" class="btn btn-info"> Add Location</button>
                        </div>
                     </form>
                        </div>
                        </div>
                    
                        
                        <!-- Data table -->
                        
                          <!-- Basic Form Inputs card start -->
                                <div class="card">
                                  <div class="card-header">
                                    <h5>All State District Block</h5>
                            
                                 
                                    
                                  </div>
                                  <div class="card-block">
                                    <h4 class="sub-title">All State District Block</h4>
                                    
                              
                            
                                     <div class="card-block table-border-style">
                                    <div class="table-responsive" id="leadData">
                                        <table id="location" class="display nowrap" style="width:100%">
                                        <thead>
                                         <tr>
                                          <th scope="col">SL No</th>
                                          <!--<th scope="col">StateCode</th>-->
                                          <th scope="col">StateName</th>
                                          <!--<th scope="col">DistricCode</th>-->
                                          <th scope="col">DistricName</th>
                                          <!--<th scope="col">BlockCode</th>-->
                                          <!--<th scope="col">BlockVersion</th>-->
                                          <th scope="col">BlockName</th>
                                          <th scope="col">Date</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                      </thead>
                                        <tbody id="crud_add">
                                        
                                        </tbody>
                                        </table>
                                      </div>
                                </div>
                             </div>
                            </div>
                    
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


<!-- Update Modal -->
<div class="modal fade" id="updateleadmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Location</h5>
        
        
        
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="lead">
       
      </div>
     
    </div>
  </div>
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

 <!--DISPLAY CODE-->
 
  <script>

     $(document).ready(function(){
      displaystudent();
      function displaystudent(){
       //alert("display");

       $.ajax({
               url:"Backend/Display.php",
               type:"POST",
               success:function(status){
             // alert("status");
              $('#crud_add').html(status);
               }
       });
       
      }
     });
 </script>
 
 
 <!--insert code-->
 
<script>
 
// Add Location
$(document).ready(function(){
    $('#submitUser').click(function(e){
     e.preventDefault();
  $.ajax({
     url:"Backend/substate.php",
     type:'POST',
     data:$('#user_Form').serialize(),
               success:function(data){
            //   alert(data);

            alert("Location Add SuccessFully");
              location.replace('addState.php');
              $("#user_Form")[0].reset();
              displaystudent();
               }
      });
   })

  
  });

</script>

 <!--Delete code-->
 <script>   

               
$(document).on("click", ".dlt-btn",function(){
   var edit_id = $(this).data("dt");
//   console.log(edit_id)
   if(confirm('Are you sure to delete this record ?')) {
  $.ajax({
     url:"Backend/Update.php",
     type:'POST',
     data :{pageid:2,sid:edit_id},
     success: function(data){
        alert("Location Deleted Successfully");
        location.replace('addState.php');
     },
 });
   }
});
      </script>
      
      
  <!--edit code-->
  

    
  <!--update code-->
  

    
<!-- Display Belong Code here-->

<script type="text/javascript">
    
   
 function load_data()
    {
      var Token = localStorage.getItem("id");
      $.ajax({
        url:"Backend/Display.php",
        method:"POST",
        data:{pageid:2,tkn:Token,type:'',laedtype:'<?php echo $type ?>'},
        success:function(data)
        {
          $('#crud_add').html(data);
           $('#location').DataTable( {
             dom: 'Bfrtip',
             buttons: [
                 'excelHtml5',
                 'copy',
                 'csv',
                 'print',
                 'pdf'
             ]
         });
     
        }
      });
    }
    load_data();
   

    
    $(document).on("click", ".edit-btn",function(){
  // alert("btn worked");
  // open modal
  $('#updateleadmodal').modal("show");

  var edit_id = $(this).data("mid");
  // console.log(edit_id)
  $.ajax({
     url:"Backend/Edit.php",
     type:'POST',
     data :{pageid:9,sid:edit_id},
     success: function(data){
        $('#lead').html(data); 
        // alert(data);
     },
 });
});





$(document).on("click","#edit_submit",function(e){
    
  e.preventDefault();
  var updatelocation = $("#updatelocation").val();
  var updatestate = $("#updatestate").val();
  var updatedistricname = $("#update_districname").val();
  var updateblockname = $("#update_blockname").val();
  
  $.ajax({
     url:"Backend/Update.php",
     type:"POST",
     data :{pageid:1,uid:updatelocation,updatestate:updatestate,updatedistricname:updatedistricname,updateblockname:updateblockname},
          success:function(data){
          if(data==1){
             alert("Location Update Successfully");
            load_data();
           location.replace('addState.php');
          }

          }
});

});


</script>