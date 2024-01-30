<?php
session_start();
include('../Db/config.php');

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
   <!--Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    <style>
        #pagination{
  text-align: center;
  padding: 10px;
}
#pagination a{
  background: #2980b9;
  color: #fff;
  text-decoration: none;
  display: inline-block;
  padding:5px 10px;
  margin-right: 5px;
  border-radius: 3px;
}
#pagination a.active{
  background: #27ae60;
}

#adhaarpic{
    border-radius: 50% !important;
    width: 11rem;
    height: 11rem;
}

    </style>
    
<div class="wrapper">

  <!-- Preloader -->
  <?php
    include("include/preloader.php");
  ?>

  <!-- Navbar -->
   <?php
    include("include/NavBar.php");
  ?>
  <!-- /.navbar -->

 <?php
    include("include/SideBar.php");
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Member Verification Request List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Member Verification Request List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Member Verification Request Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="cbody"></div>
              <!-- /.card-body -->
                
                
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Retailer Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="modalform">
             <div id="mwrap">
            
         </div>
  
         

  <!--==============  View Profile Modal ===================-->
                
                
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


 <style>
     .switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 0px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
 </style> 


  <!-- Main Footer -->
<?php
    include("include/BottomBar.php");
 ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="js/pagination.min.js"></script>
<!-- Page specific script -->

<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $("#abtn").click(function(e){-->
<!--          e.preventDefault();-->
<!--        });-->
<!--    });-->
<!--</script>-->


<script>
    $("#modalform").submit(function(e) {
        e.preventDefault();
         $.ajax({
        url: "handler/udpatecompackage.php",
        type: "POST",
        data: new FormData(this),
        processData:false,
        contentType:false,
        success: function(data) {
            // console.log(data);
        //     let rslt = JSON.parse(data.trim());
        //      let rs_code = rslt.subCode;
        //   let msg = rslt.message;
          if(data == 200200){
            alert("Updated"); 
            location.reload();
          }
          else{
              alert("Error");
          }
        },
        error:function(err){
            alert("Server Error. Try again later.");
        }
    })
    });
    
    function createva(usid){
        let createAccount = "createAccount";
        $.ajax({
        url: "../Agent/Backend/VirtualAccount/main",
        type: "POST",
        data: {createAccount , usid },
        success: function(data) {
            console.log(data);
            let rslt = JSON.parse(data.trim());
             let rs_code = rslt.subCode;
          let msg = rslt.message;
          if(rs_code == 200){
            alert(msg); 
            location.reload();
          }
          else{
              alert(msg);
          }
        },
        error:function(err){
            alert("Server Error. Try again later .");
        }
      })
    }
    function createupi(usid){
        let createupi = "createupi";
        $.ajax({
        url: "../Agent/Backend/VirtualAccount/main",
        type: "POST",
        data: {createupi , usid },
        success: function(data) {
            console.log(data);
            let rslt = JSON.parse(data.trim());
             let rs_code = rslt.subCode;
          let msg = rslt.message;
          if(rs_code == 200){
            alert(msg); 
            location.reload();
          }
          else{
              alert(msg);
          }
        },
        error:function(err){
            alert("Server Error. Try again later .");
        }
      })
    }
    
    
    $(document).ready(function(){
    // Load Table Records
     load_data();

    function load_data()
    {
      $.ajax({
        url:"ajaxphp/select_user.php",
        method:"POST",
        data:{type:"rtverify"},
        success:function(data)
        {
          $('#cbody').html(data);
          
           $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500, 1000],
      //"responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
        }
      });
    }

    
    $(document).on("click","#rtdelbtn",function(){
        var id = $(this).data("rid");
  
 Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed){
        $.ajax({
        url: "ajaxphp/deleteuser.php",
        type: "POST",
        data: {did:id,pageid:0},
        success: function(data) {
          if(data == 1){
              Swal.fire(
      'Deleted!',
      'Member has been deleted.',
      'success'
    ).then((res) => {
        load_data();
    });
          }else{
              Swal.fire(
      'Not Deleted!',
      'Member has not deleted.',
      'error'
    )
          }
        }
    
  });
}
    
});

});
   
    
    $(document).on("click","#mbtn",function(){
        var m_id = $(this).data("mid");
        $.ajax({
        url: "ajaxphp/select_modal.php",
        type: "POST",
        data: {mid: m_id },
        success: function(data) {
          $("#mwrap").html(data);
          
        }
      })
    });
    
    //  $(document).on("change","#mlimit",function() {
    //   var page_limit = $(this).val();
      
    // loadTable(page_limit);
    // });
   
    });
</script>

</body>
</html>
