<?php
include("../Db/config.php");

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
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
 
  <!-- DataTables -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    
    <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    
    
     <!-- update Modal -->
  <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" >
            <div id='edit_modal'> 

            </div>
        </div>
       
      </div>
    </div>
  </div>
    
    
    
    
    
    <!--modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header head_modal">
                <h5 class="modal-title" id="exampleModalLabel"><span id="modal_head"><?php echo   "userid- Web  -  47.15.21.42 "?></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
      <div class="modal-body">
          <div class="modal-body">

                    <div id="modal_body1"><table class="table table-bordered">
        <tbody>
    <tr><td><b>Transaction Details :</b> </td> <td>Recharge -  - 1088668274 - VI</td>  </tr>
    <tr><td><b>Mobile :</b></td> <td>155 - 8691005477 - Vodafone - Prepaid- Mumbai</td>  </tr>
    <tr><td><b>Date:</b></td> <td>2022-12-06 06:31:28-Rs. 155 Recharge For 8691005477 </td> </tr>
        </tbody>
                </table>
       <div class="col-md-12">
        <div class="row">
         <div class="col-md-12">
       <div class="x_content bs-example-popovers" style="word-break: break-all;"><div class="alert alert-info alert-dismissible " role="alert">
                     <strong>digitalnetwork - Pending</strong> <br>https://www.kumare-digitalnetwork.com/KEDAPI/RechargeAPI.aspx?MobileNo=9911611346&amp;APIKey=Zpj9qewxvcpv1ujtouJ4pAnQI2eMujZzW2O&amp;REQTYPE=RECH&amp;REFNO=1088668274&amp;SERCODE=VI&amp;CUSTNO=8691005477&amp;REFMOBILENO=&amp;AMT=155&amp;STV=1&amp;RESPTYPE=JSON<br>{"STATUSCODE":"2","STATUSMSG":"Only Topup Transaction allowed for VODAFONE IDEA Service","REFNO":"1088668274","TRNID":0,"TRNSTATUS":3,"TRNSTATUSDESC":"Only Topup Transaction allowed for VODAFONE IDEA Service","OPRID":"","BAL":575.51}
    </div></div></div></div>
 </div>

       <div class="col-md-12">
        <label>Response</label>
        <div class="row">
         <div class="col-md-12">
            <textarea type="text" value="" class="form-control" id="response" name="response"> </textarea>
        </div>

    </div>

</div><div class="col-md-12">
    
    <div class="row"><div class="col-md-4">
        <label>Operator id</label>
        <input type="text" value="VI" class="form-control" id="opid" name="opid">
    </div>
    <div class="col-md-4">
        <label>Status</label>
        <select class="form-control" name="status_opid" id="status_opid">
            <option value="0"> Status </option>
            <option value="Success">Success</option>
            <option value="Failed">Failed</option>
           

        </select>
    </div></div>

</div> <br> <br> <div class="modal-footer"><input type="hidden" id="wallet_id" name="wallet_id" value="715"><button class="btn btn-orng" type="button" onclick="check_response()">Response</button><button class="btn btn-lightblue" type="button" onclick="update_opid()">Update Status</button></div></div>  
                </div>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      <!--</div>-->
    </div>
  </div>
</div>
    
    
    
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
       <?php
          include("include/preloder.php");
       ?>
	<!--<img class="animation__wobble" src="../assets/img/<?php echo $row['I_LOGO'] ?>" alt="AdminLTELogo" width="120">-->
  </div>

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
            <h1 class="m-0">All Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Report</li>
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
                                            <div class="col-md-12">
                                                
                                                <div class="card">
                                            <div class="card-header">
                                                <h5>All Report</h5>
                                                 
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="iscofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                                <form method="post">
                                                      <div class="row">
                                                           <div class="col-md-2">
                                                                <div class="me-3">
                                                                	<div class="dataTables_length" id="DataTables_Table_0_length">
                                                                	<label>
                                                                		<select name="Entries" id="Entries" onchange="load_data(true)" aria-controls="DataTables_Table_0" class="form-select">
                                                                			<option value="5">5</option>
                                                                            <option value="10">10</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                            <option value="200">200</option>
                                                                            <option value="500">500</option>
                                                                		</select>
                                                                	</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group col-md-2">
                                                                <label>Fund Type Status</label>
                                                                <select name="status" id="status" required class="form-control form-control-sm border">
                                                                     <option value="">Select</option>
                                                                     <option value="Debit">Debit</option>
                                                                     <option value="Credit">Credit</option>
                                                                     <option value="Failed">Failed</option>
                                                                     <!--<option value="Sucess">Success</option>-->
                                                                </select>
                                                              
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label>From Date</label>
                                                                <input type="date" name="from_date" id="from_date" required class="form-control">
                                                              
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label>To Date</label>
                                                                <input type="date" name="to_date" id="to_date" required  class="form-control">
                                                            </div>
                                           
                                        
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="example1_info" role="status"
                                                   aria-live="polite">Showing <span id="startSeq"></span> to   <span id="endSeq"></span> of  <span id="totalent"></span> entries</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                                    <input type="hidden" name="activepage" id="activepage" value="1">
                                                    <div >
                                                       <ul class="pagination">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                           
                                                        
                                                        </div>
                                                        <!--<div class="form-group text-center">-->
                                                        <!--   <button type="submit" name="filter_date" class="btn btn-primary">Submit</button>-->
                                                        <!--</div>-->
                                                </form>
                                            </div>
                                            
                                              <div class="card">
                                                <div class="card-header">
                                                      <div id="load" style="text-align:center;"></div>
                                            <div class="card-block">
                                               <div class="dt-responsive table-responsive">
                                               
                                                   <table class="dt-fixedheader table border-top dataTable dtr-column collapsed" id="DataTables_Table_1" 
                                                aria-describedby="DataTables_Table_1_info" style="width: 1210px;">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name </th>
                                                                <th>Mobile </th>
                                                                <th>Transaction Details</th>
                                                                <th>Transaction Type</th>
                                                                <th>Reference ID</th>
                                                                <th>Opening Balance </th>
                                                                <th>Amount</th>
                                                                <th>Closeing Balance</th>
                                                                <th>Fund type</th>
                                                                <th>Remark</th>
                                                                <th> Trans Date</th> 
                                                                <th> Trans Time</th>
                                                                <th>Status</th>
                                                                <th>Api Response</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="alldata">
                                                      
                                                        </tbody>
                                                       
                                                    </table>
                                                </div>
                                            </div>
                                                    
                                                </div>
                                            </div>
                                                 
                                 
                                       
                                        
                                            </div>
                                        </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

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

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
      <script src="plugins/select2/js/select2.full.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
    <script>
    
//for search input 

(function() {
	'use strict';

var TableFilter = (function() {
 var Arr = Array.prototype;
		var input;
  
		function onInputEvent(e) {
			input = e.target;
			var table1 = document.getElementsByClassName(input.getAttribute('data-table'));
			Arr.forEach.call(table1, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, filter);
				});
			});
		}

		function filter(row) {
			var text = row.textContent.toLowerCase();
       //console.log(text);
      var val = input.value.toLowerCase();
      //console.log(val);
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = onInputEvent;
				});
			}
		};
 
	})();

  /*console.log(document.readyState);
	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
      console.log(document.readyState);
			TableFilter.init();
		}
	}); */
  
 TableFilter.init(); 
})();


// for excel download
function htmlTableToExcel(type){
 var data = document.getElementById('example1');
 var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
 XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
 XLSX.writeFile(excelFile, 'ExportedFile:memberlist<?php echo date("Y/m/d g:i:s A") ?>.' + type);
}


    
const element = document.querySelector(".pagination");
let refresh= true;
function createPagination(totalPages, page , refresh){
  let liTag = '';
  let active;
  let beforePage = page - 1;
  let afterPage = page + 1;
  if(page > 1){ //show the next button if the page value is greater than 1
    liTag += `<li class="paginate_button page-item previous" onclick="createPagination(${totalPages}, ${page - 1})"  id="example1_previous"><span aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</span></li>`;
  }else{
    liTag += `<li class="paginate_button page-item previous" id="example1_previous"><span aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</span></li>`;
 }

  if(page > 2){ //if page value is less than 2 then add 1 after the previous button
    liTag += `<li class="paginate_button page-item" onclick="createPagination(${totalPages}, 1)"><span class="page-link">1</span></li>`;
    if(page > 3){ //if page value is greater than 3 then add this (...) after the first li or page
      liTag += `<li class="paginate_button page-item disabled" id="example1_ellipsis"><span class="page-link">...</span></li>`;
    }
  }

  // how many pages or li show before the current li
  if (page == totalPages) {
      if(totalPages != 1){
            beforePage = beforePage - 2;
      }
      else{
            beforePage = beforePage;
      }
  } else if (page == totalPages - 1) {
    beforePage = beforePage - 1;
  }
  // how many pages or li show after the current li
  if (page == 1) {
    afterPage = afterPage + 2;
  } else if (page == 2) {
    afterPage  = afterPage + 1;
  }

  for (var plength = beforePage; plength <= afterPage; plength++) {
    if (plength > totalPages) { //if plength is greater than totalPage length then continue
      continue;
    }
    if (plength == 0) { //if plength is 0 than add +1 in plength value
      plength = plength + 1;
    }
    if(page == plength){ //if page is equal to plength than assign active string in the active variable
      active = "active";
     $("#activepage").val(page);
     refreshData(refresh);
    }else{ //else leave empty to the active variable
      active = "";
    }
    liTag += `<li class="numb ${active} paginate_button page-item" onclick="createPagination(${totalPages}, ${plength})"><span class="page-link">${plength}</span></li>`;
  }
    
  if(page < totalPages - 1){ //if page value is less than totalPage value by -1 then show the last li or page
    if(page < totalPages - 2){ //if page value is less than totalPage value by -2 then add this (...) before the last li or page
      liTag += `<li class="dots paginate_button page-item disabled" id="example1_ellipsis"><span class="page-link">...</span></li>`;
    }
    liTag += `<li class="last numb paginate_button page-item" onclick="createPagination(${totalPages}, ${totalPages})"><span class="page-link">${totalPages}</span></li>`;
  }

  if(page < totalPages) { //show the next button if the page value is less than totalPage(20)
    liTag += `<li class="paginate_button page-item next" id="example1_next" onclick="createPagination(${totalPages}, ${page + 1})"><span aria-controls="example1" data-dt-idx="8" tabindex="0" class="page-link">Next</span></li>`;
  }else{
    liTag += `<li class="paginate_button page-item next" id="example1_next"><span aria-controls="example1" data-dt-idx="8" tabindex="0" class="page-link">Next</span></li>`;
}
  
  element.innerHTML = liTag; //add li tag inside ul tag
  return liTag; //reurn the li tag
}

function refreshData(refresh){
    refresh= false;
    load_data(false)
}

    function load_data(refresh)
    {
        
        let search = $("#search").val();
        let formdate = $("#fromdate").val();
        let todate = $("#todate").val();
        
        let curpage = $("#activepage").val();
        let entries = $("#Entries :selected").val();
        $('#loading_ajax').show();
      $.ajax({
        url:"handler/all_report2.php",
        method:"POST",
        data:{pageid:0 , pageNo:curpage , entries,
            search,
            formdate,
            todate
        },
        success:function(data)
        {
            console.log(data);
            $('#loading_ajax').hide();
            // console.log(data);
            let rslt = JSON.parse(data);
            
            $("#alldata").html(rslt.alldata);
            $("#startSeq").text(rslt.startEnt);
            $("#endSeq").text(rslt.endEnt);
            $("#totalent").text(rslt.totalEntries);
            
            let totalPages = rslt.totalpages;
            let page = Number($("#activepage").val());
            if(refresh == true)
            {
                $(".pagination").html(createPagination(totalPages, page  , refresh));
            }
            //calling function with passing parameters and adding inside element which is ul tag
        
        },
        
      });
        //  refresh = false;
    }
    
    load_data(refresh);
    
    
    </script>

<script>
    $(document).on("click", ".failed_btn",function(){
  var edit_id = $(this).data("eid");
  var edit_rid = $(this).data("rid");
  var edit_amount = $(this).data("amount");
  
//   console.log(edit_id);
//   console.log(edit_rid);
  $.ajax({
     url:"handler/all_report_status_backend.php",
     type:'POST',
     data :{pageidd:10,refid:edit_id,tra_type:edit_rid,edit_amount:edit_amount},
     success: function(data){
         if(data == 1){
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Status Successfully Updated!',
          }).then (function(){
           location.replace('all_report.php');
          });
       }else{
          //  alert("Failed to Add");
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        })
       }
     },
 });
});
</script>
</body>
</html>
