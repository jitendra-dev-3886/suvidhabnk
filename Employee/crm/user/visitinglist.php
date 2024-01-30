<?php
include('./includes/header.php');
include('./includes/sidebar.php');
include('./includes/config.php');
?>

<!----------multiselect------------>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                                    <h5>Visiting List</h5>
                                    <!--<span-->
                                    <!--  >Add class of-->
                                    <!--  <code>.form-control</code> with-->
                                    <!--  <code>&lt;input&gt;</code> tag</span-->
                                    
                                  </div>
                                  <div class="card-block">
                                    <h4 class="sub-title"><?php echo $status ?> Visiting List</h4>
                                    <div class="row">
                                            
                                          <div class="col-md-3 px-2 py-2">
                                                <label class="from" > Search From </label>
                                                <input type="date" name="From" id="From" class="form-control " placeholder="From Date"/>
                                            </div>

                                            <div class="col-md-3 px-1 py-2 ">
                                                <label >  To </label>
                                                <input type="date" name="to" id="to" class="form-control" placeholder="To Date"/>
                                            </div>    

                                            <div class="col-md-2 px-0 py-2 ">
                                                <label >   </label>
                                                <button type="button" id="serchDt" class="btn btn-info search" onclick="dtSearch()"><i class="ti-search"></i> </button>
                                            </div>
                                </div>
                                     <div class="card-block table-border-style">
                                    <div class="table-responsive" id="VisitingData">
                            
                            
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
        <h5 class="modal-title" id="exampleModalLongTitle">Update Visiting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="Visiting">
        
    </div>
  </div>
</div>
</div>

 <!--Activity Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Visiting Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="activity" class="modal-body">
      
    </div>
    </div>
  </div>
</div>

<!--Transfer Model-->
<div class="modal fade" id="Visitingtransfermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Visiting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="VisitingTransfer">
        
      </div>
    </div>
  </div>
</div>

 
<script>

    function changeCom(value){
        console.log(value);
        if(value == "Meeting Complete" || value == "Software Demo" || value == "Waiting for Confirmation" || value == "Waiting for Payment" || value == "Next Call" ){
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


$(document).on("change","#state",function(){
    
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
});
    
    $(document).on("change","#dist",function(){
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
   });

    
    function updateVisiting(id)
    {
        
        
        // console.log(id);
           $.ajax({
            
            type:'post',
            url: "Backend/VisitingDisplay.php",
            data: { pageid:1,
                    id:id    },
                    beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
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
          
          var Visiting_id = $("#Visiting_id").val();
          var date = $("#date").val();
          var time = $("#time").val();
          var description = $("#description").val();
          var VisitingStatus = $("#VisitingStatus").val();
          var uid   =   localStorage.getItem("id");
        $.ajax({
          url: "Backend/insertActivity.php",
          type : "POST",
          data : {Visiting_id: Visiting_id,uid:uid,date: date, time: time,description:description,VisitingStatus:VisitingStatus,pageid:8},
          beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
          success: function(data) {
            if(data == 1)   {
                    Swal.fire(
                      'Success!',
                      'Visiting Updated!',
                      'successfully'
                    ).then(function(){
                        location.replace("VisitingList.php");
                        $("#actForm")[0].reset();
                    });
                    
                } else
                {
                 Swal.fire('Visiting Not Inserted');
                }
                $('#exampleModalCenter').modal('toggle');
          }
        });
      });
      
    load_data();
 function load_data()
    {
      var Token = localStorage.getItem("Token");
      $.ajax({
        url:"Backend/VisitingDisplay.php",
        method:"POST",
        data:{pageid:2},
        beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
        success:function(data)
        {
          $('#VisitingData').html(data);
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
    
//      $(document).on("click",".edit-btn", function(){
//       var VisitingId = $(this).data("id");

//       $.ajax({
//         url: "Backend/VisitingDisplay.php",
//         type: "POST",
//         data: {id: VisitingId,pageid:1 },
//          beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
//         success: function(data) {
//           $("#Visiting").html(data);
//         }
//       })
//     });
    
//     $(document).on("click",".activity-btn", function(){
//       var midId = $(this).data("mid");
//     //   console.log(midId);
//       $.ajax({
//         url: "Backend/VisitingDisplay.php",
//         type: "POST",
//         data: {mid: midId,pageid:3 },
//          beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
//         success: function(data) {
//           $("#activity").html(data);
          
//           $('#example2').DataTable({
//              dom: 'Bfrtip',
//              buttons: [
//                  'excelHtml5',
//                  'copy',
//                  'csv',
//                  'print',
//                  'pdf'
//              ]
//          });
//         }
//       })
//     });
    
//     // --------------------------working here
    
//     $(document).on("click","#Visitingtbtn", function(){
//       var trId = $(this).data("transid");
//       $.ajax({
//         url: "../admin/Backend/VisitingDisplay.php",
//         type: "POST",
//         data: {tid: trId,pageid:7},
//          beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
//         success: function(data){
            
//         $("#VisitingTransfer").html(data);

//                 $('.selectpicker').selectpicker();
//                 $('#dist').selectpicker('refresh');


//         }
//       })
//     });
    
    
    
//     $(document).on("click","#transbtn",function(e){
//       e.preventDefault();
      
//       var Visiting_id = $("#Visiting_id").val();
//       var name = $("#name").val();
//       var mobile = $("#mobile_no").val();
//       var email = $("#email").val();
//       var address = $("#address").val();
//       var state = $("#state").val();
//       var district = $("#dist").val();
//       var block = $("#block").val();
     
//       $.ajax({
//         url: "../admin/Backend/VisitingDisplay.php",
//         type: "POST",
//         data: {Visiting_id,name,mobile,email,address,state,district,block,pageid:4},
//          beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
//         success: function(data){
            
//             if(data == 1){
                
//                 swal.fire({
//   title: "Success!",
//   text: "Visiting Update Successfully!",
//   icon: "success",
//   button: "Ok!",
// }).then(function(){
//     load_data();
//     location.replace("VisitingList.php");
// });
//             }else{
                
//                 swal.fire({
//   title: "OOPS!",
//   text: "Visiting Update Unsuccessfull!",
//   icon: "error",
//   button: "Close!",
// });
//             }
//         }
//       });
//     });
    
    
    
    
//     $(document).on("keyup","#mobile",function (){
//         let number = $(this).val();
        
//         $.ajax({
//             url : "Backend/VisitingDisplay.php",
//             method : "POST",
//             data : {num:number,pageid:8},
//             beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
//             success : function(data){
                
//                 $("#userdata").html(data);
//             }
//         });
//     });
    
//     $(document).on("click","#transbtn",function (){
//         let uid = $("#Visitingid").val();
//         // alert(uid);
//         var Token = localStorage.getItem("id");
//         // console.log(Token);
//         $.ajax({
//             url : "Backend/VisitingDisplay.php",
//             method : "POST",
//             data : {id:uid,
//             pageid:9,
//             myid:Token            },
//             // beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
//             success : function(data){
                
//             if(data==1){
//                 Swal.fire(
//                   'Good job!',
//                   'You clicked the button!',
//                   'success'
//                 )
//                     $("#actForm")[0].reset();
//                     location.reload();
//             }else{
//               Swal.fire('Visiting Transfer Not Inserted');
//             }
            
//             }
//         });
//     });
    
    
    
});


   

    

</script>



