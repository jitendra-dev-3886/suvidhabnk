<?php
include('./includes/header.php');
include('./includes/sidebar.php');
include('./includes/config.php');

$type = $_GET["type"];
?>


<!----------multiselect------------>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!----------multiselect------------>



<style>
    
.main-body .page-wrapper {
    padding: 0.5rem !important;
}


.search{
    
    height: 38px;
    width: 55px;
    padding: 5px;
    margin-top: 29px;
}

.from{
    padding-left: 10px;
}    
    
</style>

  <div class="pcoded-inner-content">
              <!-- Main-body start -->
              <div class="main-body" style="padding:0%!important; "> 
                <div class="page-wrapper"  >
                  <!-- Page-body start -->

                  <div class="pcoded-content">

                    <div class="pcoded-inner-content">
                      <!-- Main-body start -->
                      <div class="main-body">
                        <div class="page-wrapper">
                          <!-- Page body start -->
                          <div class="page-body">
                            <div class="row">
                              <div class="col-12">
                                <!-- Basic Form Inputs card start -->
                                <div class="card">
                                  <div class="card-header">
                                    <h5>All State District Block</h5>
                            
                                 
                                    
                                  </div>
                                  <div class="card-block">
                                    <h4 class="sub-title">All State District Block</h4>
                                    
                              
                            
                                     <div class="card-block table-border-style">
                                    <div class="table-responsive" id="leadData">
                                           <table id="example1" class="display nowrap" style="width:100%">
    <thead>
     <tr>
      <th scope="col">SL No</th>
      <th scope="col">StateCode</th>
      <th scope="col">StateName</th>
      <th scope="col">DistricCode</th>
      <th scope="col">DistricName</th>
      <th scope="col">BlockCode</th>
      <th scope="col">BlockVersion</th>
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
                </div>
                </div>




<!-- Update Modal -->
<div class="modal fade" id="updateleadmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Lead</h5>
        
        
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="lead">
       
      </div>
     
    </div>
  </div>
</div>
</div>

<?php  include('./includes/footer.php')  ?>


    
    <!-- multiple dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
    <!-- multiple dropdown -->
    
    
     <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

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
           $('#example1').DataTable( {
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
   
 
    
        function updateLead(id)
        {
        
        
        // console.log(id);
           $.ajax({
            
            type:'post',
            url: "Backend/Display.php",
            data: { pageid:1,
                    id:id    },
            success: function (data){
                

        }
      
    });
    }
    
    
    
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
  var updateid=$(this).data("sid");
  console.log(updateid);
  e.preventDefault();
  var updateider = $("#sampleid").val();
  var updatestatecode = $("#update_Statecode").val();
  var updatestate = $("#state").val();
  var updatedistricode = $("#update_districcode").val();
  var updatedistricname = $("#update_districname").val();
  var updateblockcodee = $("#update_blockcode").val();
  var updateblockversion = $("#update_blockversion").val();
  var updateblockname = $("#update_blockname").val();
  
  
  alert(updatestate);
  
  $.ajax({
     url:"Backend/Update.php",
     type:"POST",
     data :{uid:updateider,update_Statecode:updatestatecode,update_statename:updatestate,update_districcode:updatedistricode,update_districname:updatedistricname,update_blockcode:updateblockcodee,update_blockversion:updateblockversion,update_blockname:updateblockname},
          success:function(data){
          if(data==1){
             alert("Update data");
             location.replace("Statelist.php");
          displaystudent();
          }
          
             alert(data);
              
          }
});

});


</script>



