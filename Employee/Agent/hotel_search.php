<?php
session_start();
include("../Db/config.php");
$my_id = $_SESSION["UsId"];

if(isset($_GET['logout'])){
    session_destroy();
    header("location:Login");
}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PayDeer | Dashboard </title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" integrity="sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<link rel="stylesheet" href="assets/travellstyle.css">
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<style>
		.mat-clr-stat-card .card-block .mat-icon {
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			font-size: 24px;
		}
		
		.mat-clr-stat-card {
			overflow: hidden;
		}
		
		.card {
			border-radius: 5px;
			box-shadow: 0 1px 20px 0 rgb(69 90 100 / 18%);
			border: none;
			margin-bottom: 30px;
			transition: all 0.3s ease-in-out;
		}
		
		.icons_section {
			padding: 50px 0;
			padding-bottom: 0;
			margin: 20px 0 40px 0;
			background: #fff;
			border-radius: 5px;
		}
		
		.miconsec {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-bottom: 50px;
		}
		
		.serviceicon {
			background: #00adff45;
			border-radius: 50%;
			padding: 16px;
			margin-bottom: 20px;
		}
		
		.news {
			background: white;
			width: 100%;
			border: 3px solid #18A3AE;
			padding: 3px;
			margin: 10px;
			border-radius: 20px;
		}
		</style>
	</head>

	<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
		<div class="wrapper">
			<!-- Preloader -->
			<div class="preloader flex-column justify-content-center align-items-center"> <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" width="120"> </div>
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
						<div class="content-header"> Search Hotel </div>
						<!-- /.content-header -->
						<!-- Main content -->
						<section class="content">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-12">
										<form method='post' id="hotelsearchform">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-md-4 mt-md-0 mt-2">
															<label>Select Country</label>
															<select class="selectpicker" data-live-Search="true">
																<option selected>Select Country</option>
																<option>Ketchup</option>
																<option>Barbecue</option>
															</select>
														</div>
														<div class="col-md-4 mt-md-0 mt-2">
															<label>Select City</label>
															<select class="selectpicker" data-live-Search="true">
																<option selected>Select City</option>
																<option>Ketchup</option>
																<option>Barbecue</option>
															</select>
														</div>
														<div class="col-md-4 mt-md-0 mt-2">
															<label>Check In Date</label>
															<input type="text" class="form-control" id="date" class="date form-control"> </div>
														<div class="col-md-3 mt-3">
															<label>Travellers</label>
															<input type="text" class="form-control" class="date form-control" data-toggle="modal" value="1 Room, 2 Travellers" data-target="#guestmodal" readonly> </div>
														<div class="col-md-3 mt-5">
															<button type="button" id="searchhotelbtn" class="btn btn-primary btn-rounded"><i class="fas fa-search mr-2"></i>Search</button>
														</div>
													</div>
												</div>
											</div>
											<!-- Modal -->
											<div class="modal" id="guestmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Travellers</h5> </div>
														<div class="modal-body">
															<div class="row" id="guestromminfo">
																<div class="col-md-12" id="guestdealisdiv">
																<input type="hidden" id="roomno">
																	<h4 class="my-3">Room 1</h4>
																	<div class="guestadroommen">
																		<p>Adults : </p>
																		<div class="adultsno guestno">
																			<button type="button" class="adldecbtn">-</button>
																			<input type="number" class="form-control adultsno" id="adultsno1" readonly onkeypress="return this.value < 8" value="2">
																			<button type="button" class="adlincbtn">+</button>
																		</div>
																	</div>
																	<div class="guestadroommen">
																		<p>Children : </p>
																		<div class="childsno guestno">
																			<button type="button" class="chlddecbtn">-</button>
																			<input type="number" class="form-control childno" id="childno1" readonly onkeypress="return this.value < 6" value="0">
																			<button type="button" class="chldincbtn">+</button>
																		</div>
																	</div>
																	<div class="row" id="addchildagebox">
																		<div class="col-md-4">
																			<select class="form-control mb-3 childage">
																				<option selected>1st child age</option>
																				<option>Ketchup</option>
																				<option>Barbecue</option>
																			</select>
																		</div>
																	</div>
																	</div>
															</div>
															<h5 class="text-primary addrooanbtn" id="addrmbtn">Add another room</h5> </div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary">Save</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									<!-- /.card -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
					</div>
					<!--/. container-fluid -->
					</section>
					<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-light">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
		<!-- Main Footer -->
		<?php
    include("include/BottomBar.php");
 ?>
			<!-- REQUIRED SCRIPTS -->
			<!-- jQuery -->
			<script src="plugins/jquery/jquery.min.js"></script>
			<!-- Bootstrap -->
			<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
			<!-- overlayScrollbars -->
			<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
			<!-- AdminLTE App -->
			<script src="dist/js/adminlte.js"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<!-- PAGE PLUGINS -->
			<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
			<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
			<!-- jQuery Mapael -->
			<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
			<script src="plugins/raphael/raphael.min.js"></script>
			<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
			<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
			<!-- ChartJS -->
			<script src="plugins/chart.js/Chart.min.js"></script>
			<!-- AdminLTE for demo purposes -->
			<script src="dist/js/demo.js"></script>
			<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
			<script src="dist/js/pages/dashboard2.js"></script>
			<script src="assets/travel.js"></script>
			<script>
			$(document).ready(function() {
				$('#date').daterangepicker({
					opens: 'left',
				});
				
			})
			</script>
	</body>

	</html>