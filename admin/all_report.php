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
    
    
    
      <div class="modal fade" id="exampleModallll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Recharge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="editForm">
                 
                  </div>
              </div>
            </div>
        </div>
        
        
        
  <!--DMT Modal        -->
      <div class="modal fade" id="dmt_exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update DMT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="edit_dmt_Form">
                 
                  </div>
              </div>
            </div>
        </div>
        
        
        
  <!--Payout Modal        -->
      <div class="modal fade" id="payout_exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update PAYOUT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="edit_payout_data">
                 
                  </div>
              </div>
            </div>
        </div>
    
    
    
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
    
    
    
    
<!--    <div class="modal fade show" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="padding-right: 17px; display: block;">-->
<!--    <div class="modal-dialog modal-lg" role="document" style="    margin-top: 5px;">-->

<!--        <div class="modal-content">-->
<!--            <div class="modal-header head_modal">-->
<!--                <h5 class="modal-title" id="exampleModalLabel"><span id="modal_head">PPA003  - Web  -  47.15.21.42 </span></h5>-->
<!--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">×</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div id="retry_div">-->
<!--                <div class="modal-body">-->

<!--                    <div id="modal_body1"><table class="table table-bordered">-->
<!--        <tbody>-->
<!--    <tr><td><b>Transaction Details :</b> </td> <td>Recharge -  - 1088668274 - VI</td>  </tr>-->
<!--    <tr><td><b>Mobile :</b></td> <td>155 - 8691005477 - Vodafone - Prepaid- Mumbai</td>  </tr>-->
<!--    <tr><td><b>Date:</b></td> <td>2022-12-06 06:31:28-Rs. 155 Recharge For 8691005477 </td> </tr>-->
<!--        </tbody>-->
<!--                </table>-->
<!--       <div class="col-md-12">-->
<!--        <div class="row">-->
<!--         <div class="col-md-12">-->
<!--       <div class="x_content bs-example-popovers" style="word-break: break-all;"><div class="alert alert-info alert-dismissible " role="alert">-->
<!--                     <strong>digitalnetwork - Pending</strong> <br>https://www.kumare-digitalnetwork.com/KEDAPI/RechargeAPI.aspx?MobileNo=9911611346&amp;APIKey=Zpj9qewxvcpv1ujtouJ4pAnQI2eMujZzW2O&amp;REQTYPE=RECH&amp;REFNO=1088668274&amp;SERCODE=VI&amp;CUSTNO=8691005477&amp;REFMOBILENO=&amp;AMT=155&amp;STV=1&amp;RESPTYPE=JSON<br>{"STATUSCODE":"2","STATUSMSG":"Only Topup Transaction allowed for VODAFONE IDEA Service","REFNO":"1088668274","TRNID":0,"TRNSTATUS":3,"TRNSTATUSDESC":"Only Topup Transaction allowed for VODAFONE IDEA Service","OPRID":"","BAL":575.51}-->
<!--    </div></div></div></div>-->
<!-- </div>-->

<!--       <div class="col-md-12">-->
<!--        <label>Response</label>-->
<!--        <div class="row">-->
<!--         <div class="col-md-12">-->
<!--            <textarea type="text" value="" class="form-control" id="response" name="response"> </textarea>-->
<!--        </div>-->

<!--    </div>-->

<!--</div><div class="col-md-12">-->
    
<!--    <div class="row"><div class="col-md-4">-->
<!--        <label>Operator id</label>-->
<!--        <input type="text" value="VI" class="form-control" id="opid" name="opid">-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <label>Status</label>-->
<!--        <select class="form-control" name="status_opid" id="status_opid">-->
<!--            <option value="0"> Status </option>-->
<!--            <option value="Success">Success</option>-->
<!--            <option value="Failed">Failed</option>-->
           

<!--        </select>-->
<!--    </div></div>-->

<!--</div> <br> <br> <div class="modal-footer"><input type="hidden" id="wallet_id" name="wallet_id" value="715"><button class="btn btn-orng" type="button" onclick="check_response()">Response</button><button class="btn btn-lightblue" type="button" onclick="update_opid()">Update Status</button></div></div>  -->
<!--                </div>-->

<!--            </div>-->
<!--            <div id="processing_wallet" style="display:none;width:100%;text-align: center;">-->
<!--                <div class="row">-->
<!--	<div class="col-md-12">-->
<!--		<img src="../img/rings.svg" width="40%">-->
<!--	</div>-->
<!--</div>            </div>-->

<!--        </div>-->
<!--    </div>-->
<!--</div>-->
    
    
    
    
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
                                                           <div class="form-group col-md-2">
                                                                <label>Top</label>
                                                                <select name="top_row" id="top_row" required class="form-control form-control-sm border">
                                                                     <option value="10">10</option>
                                                                     <option value="50">50</option>
                                                                     <option value="100">100</option>
                                                                     <option value="200">200</option>
                                                                     <option value="300">300</option>
                                                                     <option value="400">400</option>
                                                                     <option value="500">500</option>
                                                                     <option value="All">All</option>
                                                                </select>
                                                              
                                                            </div>
                                                            <!--<div class="form-group col-md-2">-->
                                                            <!--    <label>User Balance Sort</label>-->
                                                            <!--    <select name="amount_sort" id="amount_sort" required class="form-control form-control-sm border">-->
                                                            <!--         <option value="">Select</option>-->
                                                            <!--         <option value="100000.00">1 Lakh</option>-->
                                                            <!--         <option value="200000.00">2 Lakh</option>-->
                                                            <!--         <option value="300000.00">3 Lakh</option>-->
                                                            <!--         <option value="400000.00">4 Lakh</option>-->
                                                            <!--         <option value="500000.00">5 Lakh</option>-->
                                                            <!--         <option value="All">All</option>-->
                                                            <!--    </select>-->
                                                              
                                                            <!--</div>-->
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
                                                            <div class="form-group col-md-2">
                                                                <label>Transaction Type</label>
                                                                <select name="Optype" id="Optype" required class="form-control form-control-sm border">
                                                                     <option value="">Select</option>
                                                                     <option value="Recharge">Recharge</option>
                                                                     <option value="DMT">DMT</option>
                                                                     <option value="PAYOUT">PAYOUT</option>
                                                                      <option value="ATM">MICRO ATM</option>
                                                                     <option value="FundTransfer">Fund Transfer</option>
                                                                     <option value="Add Fund (PayUMoney)">Add Fund</option>
                                                                     <option value="AEPS">AEPS</option>
                                                                     <option value="PAN">PAN</option>
                                                                     <option value="LIC">LIC</option>
                                                                     <option value="Credit Card Bill">Credit Card Bill</option>
                                                                     <!--<option value="DMT Commission">DMT Commission</option>-->
                                                                     <!--<option value="DMT Account Verify">DMT Account Verify</option>-->
                                                                     <option value="BBPS">BBPS</option>
                                                                     <option value="Wallet Exchange">Wallet Exchange</option>
                                                                     <option value="Electricity">Electricity</option>
                                                                     <option value="Electricity Bbps">Electricity Bbps</option>
                                                                     <option value="Electricity BBPS">Electricity BBPS</option>
                                                                     
                                                                </select>
                                                            </div>
                                                           
                                                            <!--
                                                            <div class="form-group col-md-2">
                                                                <label>Select User Type</label>
                                                                        <select name="user_t" id="user_t" class="form-control" onChange="show(this.value)"> 
                                                                        <option value="">----Select User Type----</option>
                                                                        <?php
                                                                     $res = $con->query("SELECT * FROM user_type ");
                                                                   while($rom= $res->fetch_assoc()){
                                                                        ?>
                                                                        <option value="<?php echo $rom['ID'] ?>"><?php echo $rom['NAME'] ?></option>
                                                                        <?php
                                                                  }
                                                                 ?>
                                                                        </select>
                                                                   
                                                              
                                                            </div>
                                                            -->
                                                     
                                                            <div class="form-group col-md-4">
                                                                <label>Select User</label>
                                                                        <select name="user5" id="user5" class="form-control select2" > 
                                                                        <option value="">----Select User----</option>
                                                                                <?php
                                                                     $res = $con->query("SELECT * from user");
                                                                   while($row= $res->fetch_assoc()){
                                                                      $us_id = $row['USER_TYPE'];
                                                                      $res1 = $con->query("SELECT * from user_type where ID='$us_id'")->fetch_assoc();
                                                                        ?>
                                                                         <option value="<?php echo $row['ID']?>"><?php echo  $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'] .' ('. $row['MOBILE'] .')' ?></option>
                                                                        <?php
                                                                  }
                                                                 ?>
                                                                    
                                                                   
                                                                        </select>
                                                              
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Status</label>
                                                                        <select name="tra_status" id="tra_status" class="form-control" > 
                                                                        <option value="">----Select Status----</option>
                                                                        <option value="Failed">Failed</option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="Success">Success</option>
                                                                                
                                                                    
                                                                   
                                                                        </select>
                                                              
                                                            </div>
                                                            
                                                            <!--<div class="form-group col-md-3">-->
                                                             <!--<label>Total Amount</label>-->
                                                             <!--<h3 id="total_amount_val"></h3>-->
                                                             <!--<h4><?php echo number_format($maae,2)?></h4>-->
                                                            <!--</div>-->
                                                             <div class="form-group col-md-2" style="display:none;">
                                                                <label>Country</label>
                                                                <select name="Country" id="Country" required class="form-control form-control-sm border">
                                                                     <option value="">Select</option>
                                                                     <option value="India">India</option>
                                                                     <option value="Japan">Japan</option>
                                                                     
                                                                </select>
                                                            </div>
                                                           
                                                            <div class="form-group col-md-2" style="display:none;">
                                                                <label>Choose Operator</label>
                                                                <select name="operator_type" id="operator_type" required class="form-control form-control-sm border">
                                                                     <option value="">Select Operator</option>
                                                                     <?php
                                                                       $res = $con->query("SELECT `ID`, `OPERATOR_CODE`, `NAME` FROM `operator_list` ORDER BY ID ASC");
                                                                        if($res->num_rows > 0){
                                                                            while($op = $res->fetch_assoc()){
                                                                                ?>
                                                                               <option value="<?php echo $op['OPERATOR_CODE']; ?>"><?php echo $op['NAME']; ?></option>
                                                                               <?php
                                                                            }
                                                                        }
                                                                     ?>
                                                                     
                                                                </select>
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
                                                   <!--<div class="row mt-2 mb-3">-->
                                                   <!--       <div class="col-md-2"><span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Number of SUCCESS Transaction" id="no_success"></span></div>-->
                                                   <!--       <div class="col-md-2"><span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Amount of SUCCESS Transaction" id="amt_success"></span></div>-->
                                                          
                                                   <!--       <div class="col-md-2"><span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Number of FAILED Transaction" id="no_failed"></span></div>-->
                                                   <!--       <div class="col-md-2"><span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Amount of FAILED Transaction" id="amt_failed"></span></div>-->
                                                          
                                                   <!--       <div class="col-md-2"><span class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="Number of PENDING Transaction" id="no_pending"></span></div>-->
                                                   <!--       <div class="col-md-2"><span class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="Amount of PENDING Transaction" id="amt_pending"></span></div>-->
                                                          
                                                   <!--   </div>-->
                                                   <table id="example" class="display " style="width:100%">
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
                                                        <tbody>
                                                             <td></td>
                                                             <td  colspan="6"></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
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
    $(document).ready(function(){
       
        Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
        
        function Display_All_Record(top_row,amount_sort,status,from_date,to_date,Optype,operator,Country,mduser,dtuser,user5,tra_status)
		  {
		      $.ajax({
		        url : "handler/all_report.php",
		        type : "POST",
		        data : {
		          page : "All_Report",
		          action :"All_Report",
		          top_row : top_row,
		          amount_sort : amount_sort,
		          status : status,
		          from_date : from_date,
		          to_date : to_date,
		          Optype : Optype,
		          operator : operator,
		          Country : Country,
		           mduser : mduser, 
		           dtuser : dtuser,
		          user5 : user5,
		          tra_status:tra_status
		        },
		        dataType : "json",
		        beforeSend :  function(){
		          $('#load').html('<i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i><span class="sr-only">Loading...</span>');  
		        },
		        success : function(data){
		            console.log(data);
		          $('#load').html('');
		           $(data).each(function (index, item) {
                       // each iteration
                       
                       $('#no_success').html('<i class="fa fa-tachometer font-weight-bold" style="font-size:13px;" aria-hidden="true">&nbsp;'+item.no_success+'</i>');
                       $('#amt_success').html('<i class="fa fa-inr font-weight-bold" style="font-size:13px;" aria-hidden="true">&nbsp;'+item.amt_success+'</i>');
                       $('#no_failed').html('<i class="fa fa-tachometer font-weight-bold" style="font-size:13px;" aria-hidden="true">&nbsp;'+item.no_failed+'</i>');
                       $('#amt_failed').html('<i class="fa fa-inr font-weight-bold" style="font-size:13px;" aria-hidden="true">&nbsp;'+item.amt_failed+'</i>');
                       $('#no_pending').html('<i class="fa fa-tachometer font-weight-bold" style="font-size:13px;" aria-hidden="true">&nbsp;'+item.no_pending+'</i>');
                       $('#amt_pending').html('<i class="fa fa-inr font-weight-bold" style="font-size:13px;" aria-hidden="true">&nbsp;'+item.amt_pending+'</i>');
                   
                   });
		          $.fn.dataTable.ext.errMode = 'none';
		          $('#example').DataTable({
                          
                    });
		          $('#example').DataTable( {
		                
		                "bProcessing": true,
		                "bDestroy": true ,
                        data: data,
                        columns: [
                            { data: 'sl_no' },
                            { data: 'FIRST_NAME' },
                            { data: 'MOBILE' },
                            { data: 'transaction_details' },
                            { data: 'TRANS_TYPE' },
                            { data: 'REFERENCE_ID' },
                            { data: 'PREVIOUS_AMOUNT' },
                            { data: 'AMOUNT' },
                            { data: 'AFTER_AMOUNT' },
                            { data: 'FUND_TYPE' },
                            { data: 'REMARK' },
                            { data: 'TRANS_DATE' },
                            { data: 'TRANS_TIME' },
                            { data: 'status' },
                            { data: 'api_res' }
                        ],
                            // dom: 'Bfrtip',
                            buttons: [
                                
                                'excelHtml5',
                                
                                'pdfHtml5',
                                
                            ],
                              lengthMenu: [
                                [10,50, 100, 200,300,400,500, -1],
                                [10,50, 100, 200,300,400,500, 'All'],
                            ],
                    });
		        }
		    });
		  }
		  
	  $('#top_row').change(function(event){
	      let top_row = $(this).val();
          Display_All_Record($('#top_row').val());
	      
         
	    event.preventDefault();
	   });
	   
	     $('#amount_sort').change(function(event){
	      let top_row = $(this).val();
          Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
	      
         
	    event.preventDefault();
	   });
	   
	   $('#status').change(function(event){
	      let status = $(this).val();
         
	          Display_All_Record($('#top_row').val(),$('#amount_sort').val(),status,$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
	      
	    event.preventDefault();
	   });
	   
	   $('#from_date').change(function(event){
	      let from_date = $(this).val();
         
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),from_date,$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val()); 
	    
        
	    event.preventDefault();
	   });
	   
	   $('#to_date').change(function(event){
	      let to_date = $(this).val();
         
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),to_date,$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val()); 
	      
         
	    event.preventDefault();
	   });
	   
	   $('#Optype').change(function(event){
	      let Optype = $(this).val();
          
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),Optype,$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val()); 
	     
         
	    event.preventDefault();
	   });
	   
	   $('#operator_type').change(function(event){
	      let operator_type = $(this).val();
	     
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),operator_type,$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
	      
         
	    event.preventDefault();
	   });
	   
	   $('#mduser').change(function(event){
	      let mduser = $(this).val();
	     
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
	      
         
	    event.preventDefault();
	   });
	   
	   $('#dtuser').change(function(event){
	      let dtuser = $(this).val();
	     
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
	      
         
	    event.preventDefault();
	   });
	   
	   $('#user5').change(function(event){
	      let user5 = $(this).val();
	     
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
         
	    event.preventDefault();
	   });
	   
	   $('#tra_status').change(function(event){
	      let tra_status = $(this).val();
	     
	         Display_All_Record($('#top_row').val(),$('#amount_sort').val(),$('#status').val(),$('#from_date').val(),$('#to_date').val(),$('#Optype').val(),$('#operator_type').val(),$('#Country').val(),$('#mduser').val(),$('#dtuser').val(),$('#user5').val(),$('#tra_status').val());
	      
         
	    event.preventDefault();
	   });
		  
    });

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
 
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End// // // // // // // // // // // // // // // // // // // // // // 
</script>
<script>
    $(document).on("click", ".edit_btn",function(){
  // alert("btn worked");
  // open modal
//   $('#update_user_modal').modal("show");
  $('#exampleModallll').modal("show");

  var edit_id = $(this).data("eid");
  var edit_rid = $(this).data("rid");
  
//   console.log(edit_id);
//   console.log(edit_rid);
  $.ajax({
     url:"handler/all_report_status_backend.php",
     type:'POST',
     data :{pageid:9,refid:edit_id,tra_type:edit_rid},
     success: function(data){
        $('#edit_modal').html(data); 
        // alert(data);
     },
 });
});
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
<script>
     $(document).on("click",".edit_data",function(){  
                var id = $(this).data('id');  
                // console.log(id);
                $.ajax({  
                     url :"handler/report_rechargeupdate.php",  
                     type:"POST",  
                     cache:false,  
                     data:{editId:id,pageid:3},  
                     success:function(data){  
                          $("#editForm").html(data);  
                     },  
                });  
           }); 
           
           
     $(document).on("click","#editSubmit", function(){  
                var edit_id = $("#editId").val();  
                var edit_mb = $("#edit_mb").val();  
                var edit_opname = $("#edit_opname").val();  
                var edit_amt = $("#edit_amt").val();  
                var edit_tid = $("#edit_tid").val();  
                var edit_opid = $("#edit_opid").val();  
                var edit_status = $("#edit_status").val();  
                
                $.ajax({  
                     url:"handler/report_rechargeupdate.php",  
                     type:"POST",  
                     cache:false,  
                     data:{pageid:1,edit_id:edit_id,edit_mb:edit_mb,edit_opname:edit_opname,edit_amt:edit_amt,edit_tid:edit_tid,edit_opid:edit_opid,edit_status:edit_status},  
                     success:function(data){  
                         if(data == 1){
                            Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                  button: "Okay",
                                  text: 'Recharge Report Updated Successfully.',
                                }).then(function(){ 
                                  location.replace("all_report");
                        }); 
                         }
                     }  
                });  
           });  
    </script>
<script>
     $(document).on("click",".edit_dmt_data",function(){  
                var id = $(this).data('id');  
                // console.log(id);
                $.ajax({  
                     url :"handler/report_dmtupdate.php",  
                     type:"POST",  
                     cache:false,  
                     data:{editId:id,pageid:3},  
                     success:function(data){  
                          $("#edit_dmt_Form").html(data); 
                          $('#dmt_exampleModal').modal("show");
                     },  
                });  
           }); 
           
           
     $(document).on("click","#editSubmit_dmt", function(){  
                var edit_id = $("#editId").val();  
                var edit_mb = $("#edit_mb").val();  
                var edit_opname = $("#edit_opname").val();  
                var edit_amt = $("#edit_amt").val();  
                var edit_tid = $("#edit_tid").val();  
                var edit_opid = $("#edit_opid").val();  
                var edit_status = $("#edit_status").val();  
                
                $.ajax({  
                     url:"handler/report_dmtupdate.php",  
                     type:"POST",  
                     cache:false,  
                     data:{pageid:1,edit_id:edit_id,edit_mb:edit_mb,edit_opname:edit_opname,edit_amt:edit_amt,edit_tid:edit_tid,edit_opid:edit_opid,edit_status:edit_status},  
                     success:function(data){  
                         if(data == 1){
                            Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                  button: "Okay",
                                  text: 'DMT Report Updated Successfully.',
                                }).then(function(){ 
                                  location.replace("all_report");
                        }); 
                         }
                     }  
                });  
           });  
    </script>
    
    
    
<script>
     $(document).on("click",".edit_payout_data",function(){  
                var id = $(this).data('id');  
                // console.log(id);
                $.ajax({  
                     url :"handler/report_payoutupdate.php",  
                     type:"POST",  
                     cache:false,  
                     data:{editId:id,pageid:3},  
                     success:function(data){  
                          $("#edit_payout_data").html(data); 
                          $('#payout_exampleModal').modal("show");
                     },  
                });  
           }); 
           
           
     $(document).on("click","#editSubmit_payout", function(){  
                var edit_id = $("#editId").val();  
                var edit_mb = $("#edit_mb").val();  
                var edit_opname = $("#edit_opname").val();  
                var edit_amt = $("#edit_amt").val();  
                var edit_tid = $("#edit_tid").val();  
                var edit_opid = $("#edit_opid").val();  
                var edit_status = $("#edit_status").val();  
                
                $.ajax({  
                     url:"handler/report_payoutupdate.php",  
                     type:"POST",  
                     cache:false,  
                     data:{pageid:1,edit_id:edit_id,edit_mb:edit_mb,edit_opname:edit_opname,edit_amt:edit_amt,edit_tid:edit_tid,edit_opid:edit_opid,edit_status:edit_status},  
                     success:function(data){  
                         if(data == 1){
                            Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                  button: "Okay",
                                  text: 'Payout Report Updated Successfully.',
                                }).then(function(){ 
                                  location.replace("all_report");
                        }); 
                         }
                     }  
                });  
           });  
    </script>
</body>
</html>
