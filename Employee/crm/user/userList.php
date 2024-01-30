<?php
include('./includes/header.php');
include('./includes/sidebar.php');
include('./includes/config.php');

$user_type = $_GET['type'];

?>

<style>
    
.main-body .page-wrapper {
    padding: 0.5rem !important;
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
                                    <h5>Lead List</h5>
                                    <!--<span-->
                                    <!--  >Add class of-->
                                    <!--  <code>.form-control</code> with-->
                                    <!--  <code>&lt;input&gt;</code> tag</span-->
                                    
                                  </div>
                                  <div class="card-block">
                                    <h4 class="sub-title">All Users</h4>
                                     <div class="card-block table-border-style">
                                    <div class="table-responsive" id="leadData">
                            
                            
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

 <!--Activity Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lead Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <table class='table table-striped' id="example2">
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Name</th>
      <th scope='col'>Status</th>
      <th scope='col'>Date</th>
      <th scope='col'>Time</th>
      <th scope='col'>Description</th>
    </tr>
  </thead>
  <tbody  id="activity">
      
      
        </tbody>
    </table>
    </div>
    </div>
  </div>
</div>

<!--Transfer Model-->
<div class="modal fade" id="exampleModalTransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lead Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="leadTransfer">
        
      </div>
    </div>
  </div>
</div>

 
<script>
    function changeCom(value){
        console.log(value);
        if(value == "Intrested"){
            $("#contactSchedule").show();
        }
        else{
            $("#contactSchedule").hide();
        }
    }
    function dynamicname(value){
        console.log(value);
      
    }
</script>


<?php  include('./includes/footer.php')  ?>

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
<script type="text/javascript">
    
    function updateLead(id)
    {
        
        
        // console.log(id);
           $.ajax({
            
            type:'post',
            url: "Backend/userDisplay.php",
            data: { pageid:1,
                    id:id    },
            success: function (data){
                
            var obj = JSON.parse(data);
            $('#mobile').val(obj.MOBILE);
            $('#name').val(obj.NAME);
            $('#ldid').val(obj.ID);
            
        }
      
    });
    }
    
    
 
    
    $(document).ready( function () {
        
       $(document).on("click","#insertAct", function(){
          
          var lead_id = $("#lead_id").val();
          var date = $("#date").val();
          var time = $("#time").val();
          var description = $("#description").val();
          var leadStatus = $("#leadStatus").val();
          var uid   =   localStorage.getItem("id");
        $.ajax({
          url: "Backend/insertActivity.php",
          type : "POST",
          data : {lead_id: lead_id,uid:uid,date: date, time: time,description:description,leadStatus:leadStatus,pageid:8},
          success: function(data) {
            if(data == 1)   {
                    Swal.fire(
                      'Success!',
                      'Lead Updated!',
                      'successfully'
                    );
                    $("#actForm")[0].reset();
                } else
                {
                 Swal.fire('Lead Not Inserted');
                }
                $('#exampleModalCenter').modal('toggle');
          }
        });
      });
    load_data();
    
    
    $('#insertAct').click(function(){
      $.ajax({
            
            type:'POST',
            url: "Backend/insertActivity.php",
            data:  $('#actForm').serialize() ,
            success: function (data){
                
            if(data)
            {
                alert("activity inserted");
            }
            else
            {
            
            alert("activity Not inserted");
 
                
            }
            
        }
            
        });
     
     
     
     
       });      

 function load_data()
    {
      var Token = localStorage.getItem("id");
      $.ajax({
        url:"Backend/userDisplay.php",
        method:"POST",
        data:{pageid:2,tkn:Token, type=<?php echo $type ?>},
        success:function(data)
        {
          $('#leadData').html(data);
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
    
     $(document).on("click",".edit-btn", function(){
      var leadId = $(this).data("id");

      $.ajax({
        url: "Backend/userDisplay.php",
        type: "POST",
        data: {id: leadId,pageid:1 },
        success: function(data) {
          $("#lead").html(data);
        }
      })
    });
    
    $(document).on("click",".activity-btn", function(){
      var midId = $(this).data("mid");
    //   console.log(midId);
      $.ajax({
        url: "Backend/userDisplay.php",
        type: "POST",
        data: {mid: midId,pageid:3 },
        success: function(data) {
          $("#activity").html(data);
               $('#example2').DataTable( {
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
      })
    });
    
    $(document).on("click",".transfer-btn", function(){
      var trId = $(this).data("transid");
      console.log(trId);
      $.ajax({
        url: "Backend/userDisplay.php",
        type: "POST",
        data: {tid: trId,pageid:7 },
        success: function(data) {
          $("#leadTransfer").html(data);
        }
      })
    });
    
    
    $(document).on("keyup","#mobile",function (){
        let number = $(this).val();
        
        $.ajax({
            url : "Backend/userDisplay.php",
            method : "POST",
            data : {num:number,pageid:8},
            beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
            success : function(data){
                
                $("#userdata").html(data);
            }
        });
    });
    
    $(document).on("click","#transbtn",function (){
        let uid = $("#leadid").val();
        // alert(uid);
        var Token = localStorage.getItem("id");
        // console.log(Token);
        $.ajax({
            url : "Backend/userDisplay.php",
            method : "POST",
            data : {id:uid,
            pageid:9,
            myid:Token            },
            // beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
            success : function(data){
                
            if(data==1){
                 Swal.fire(
                      'Success!',
                      'Lead Transfer!',
                      'successfully'
                    );
                    $("#actForm")[0].reset();
                    location.reload();
            }else{
               Swal.fire('Lead Transfer Not Inserted');
            }
            
            }
        });
    });
    
    
    
});


   

    

</script>



