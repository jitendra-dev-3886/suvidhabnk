 <style>
     .nav .nav-item .nav-link duser i{
         color:javascript:void(0)276569;
     }
     .nav .nav-item .nav-link duser p{
         color:javascript:void(0)276569;
     }
 </style>
 
 
 <?php 
 session_start();
 $usid = $_SESSION['UsId'];
 
 $server = $con->query("select * from serversetup where ID='1' ")->fetch_assoc();
 
 $user_type_que=$con->query("select * from user where ID='$usid'")->fetch_assoc();
 $user_type=$user_type_que['USER_TYPE'];
// if($user_type=='46'){
 if($user["US_STATUS"] == 'Active'){
 
 $row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
 ?>
<script src="../js/Main.js"></script>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="https://suvidhabnk.com/assets/images/logo.png" class="rounded mx-auto d-block" width="120">
      <!--<span class="brand-text font-weight-light">AdminLTE 3</span>-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hello, <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                My Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="UserProfile" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="AgentChangeMPIN.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Mpin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="AgentChangePassword.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="index?logout" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Logout</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="WalletExchange.php" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Wallet Exchange</p>-->
              <!--  </a>-->
              <!--</li>-->
             
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Wallet Managment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="MainWalletReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main Wallet Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="AePsWalletReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>AePs Wallet Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="WalletExchange.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wallet Exchange</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="WalletExchangeReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wallet Exchange Report</p>
                </a>
              </li>
             
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Wallet Recharge
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cashfree_wallet_recharge_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Online Wallet Recharge Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="OfflineWalletRechargeReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offline Wallet Recharge Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          
         
          
          <li class="nav-header">SERVICE MANAGMENT</li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                AePs Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              
            <ul class="nav nav-treeview">
                
          
            <!-- DO Transaction -->
            
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                AePs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                  <!-- DO Transaction -->
            <li class="nav-item">
                <a href="<?php if($server['AEPS'] == "PAYSPRINT"){
                
                echo "Fing_AEPS.php";
                }else{
                echo "InstantAEPS.php";
                    
                }
                ?>" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>AePs 1</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="AePsService.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>AePs 2</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="AePsServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>AePs Report</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="AePsServicesAePsCommissionSetup.php" class="nav-link">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>AePs Commission</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="AePsServicesAdharPayCommissionSetup.php" class="nav-link">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>Aadharpay Commission</p>
                </a>
              </li>
              
              <li class="nav-item">
                <!--<a href="AePsServicesAePsCommissionSetup.php" class="nav-link">-->
                <a href="E-tax_mycomm.php?type=Mini Statement" class="nav-link">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>Mini-Statement Commission</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--   <i class="nav-icon fas fa-exchange-alt"></i>-->
          <!--   <p>-->
          <!--      Cash Deposite-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
            <!--<ul class="nav nav-treeview">-->
            <!--  <li class="nav-item">-->
            <!--    <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                <!--<a href="AePsServicesCashDepositeServiceReport.php" class="nav-link">-->
            <!--      <i class="nav-icon fas fa-receipt"></i>-->
            <!--      <p>Cash Deposite Report</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--     <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
            <!--    <a href="AePsServicesCashDepositeCommissionSetup.php" class="nav-link">-->
            <!--      <i class="nav-icon fas fa-coins"></i>-->
            <!--      <p>My Commission</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--</ul>-->
          <!--</li>-->
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Banking Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
                
               <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                DMT
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- DO Transaction -->
                <li class="nav-item">
                <a href="dmt_trans" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
              <li class="nav-item">
                <a href="MoneyTransferDMTReport" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DMT Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="DMTServicesDMTCommissionSetup" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>DMT Charge</p>
                </a>
              </li>
            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--   <i class="nav-icon fas fa-exchange-alt"></i>-->
          <!--   <p>-->
          <!--      X-DMT-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                <!-- DO Transaction -->
          <!--  <li class="nav-item">-->
          <!--      <a href="XDMTServices.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Do Transaction</p>-->
          <!--      </a>-->
          <!--    </li>-->
            <!-- DO Transaction -->
            
          <!--    <li class="nav-item">-->
          <!--      <a href="MoneyTransferXDMTReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>X-DMT Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="XDMTServerSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>X-DMT Charge</p>-->
          <!--      </a>-->
          <!--    </li>-->
         
          <!--  </ul>-->
          <!--</li>-->
          <!--  <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--   <i class="nav-icon fas fa-exchange-alt"></i>-->
          <!--   <p>-->
          <!--      UPI-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                <!-- DO Transaction -->
          <!--      <li class="nav-item">-->
          <!--       <a href="UPI_Service" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Do Transaction</p>-->
          <!--      </a>-->
          <!--    </li>-->
            <!-- DO Transaction -->
          <!--    <li class="nav-item">-->
          <!--       <a href="MoneyTransferUPIReport" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>UPI Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>UPI Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->

          <!--  </ul>-->
          <!--</li>     -->
        </ul>
          </li>
         <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                M-ATM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">-->
              <!--   <a href="M-ATMRequest.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-receipt"></i>-->
              <!--    <p>M-ATM Request</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
                 <a href="M-ATMReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>M-ATM Report</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--   <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
              <!--  <a href="AePsServicesM-ATMCommissionSetup.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-coins"></i>-->
              <!--    <p>My Commission</p>-->
              <!--  </a>-->
              <!--</li>-->
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-mobile-alt"></i>
              <p>
                Recharge Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-mobile-alt"></i>
              <p>
                Recharge
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
            <!-- DO Transaction -->
                <li class="nav-item">
                <a href="RechargeService.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
            
              <li class="nav-item">
                <a href="RechargeServicesRechargeReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Recharge Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="RechargeServicesRechargeCommissionSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Recharge Commission</p>
                </a>
              </li>
            </ul>
          </li>
               <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon  fas fa-baby-carriage"></i>
              <p>
                DTH
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- DO Transaction -->
                <li class="nav-item">
                <a href="DTHRechargeService.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
            
              <li class="nav-item">
                <a href="RechargeServicesDTHReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DTH Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>DTH Commission</p>
                </a>
              </li>
            </ul>
          </li> 
            </ul>
          </li>
          
          
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
              <p>
                Payout
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Payout_new.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Payout</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="PayoutService.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-receipt"></i>-->
              <!--    <p>Payout 2</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
                <a href="PayoutServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Payout Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="PayoutCharge.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Payout Charge</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-university"></i>-->
          <!--    <p>-->
          <!--      Virtual Account-->
          <!--      <i class="right fas fa-angle-left"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="VirtualAccountReport" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p> Virtual Account Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--  <i class="nav-icon far fa-credit-card"></i>-->
          <!--    <p>-->
          <!--      Loan/Finance (Offline)-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--       <a href="LoanRequest.php"  data-target="#exampleModalCenterC" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Application Request</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="LoanReport" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Loan Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                <!--<a href="LoanCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Loan Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--  <i class="nav-icon far fa-credit-card"></i>-->
          <!--    <p>-->
          <!--      Vehicle Insurance-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--       <a href="VehicleInsuranceRequest.php"class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Application Request</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="VehicleInsuranceReport" class="nav-link">-->
                <!--<a href="InsuranceOfflineServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Insurance Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                 
          <!--           <a href="E-tax_mycomm.php?type=Insurance" class="nav-link">-->
                <!--<a href="InsuranceCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      E-Tax Services (Offline)-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                
            <li class="nav-item">
             <a href="#!"class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                Pan Card
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                 <a href="ekndPan" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <!--  <li class="nav-item">-->
              <!--   <a href="PanCardRequest.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-receipt"></i>-->
              <!--    <p>Coupon Request</p>-->
              <!--  </a>-->
              <!--</li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="PanCardServiceReport.php" class="nav-link">-->
                <!--<a href="ETaxServicesOfflinePanCardServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
            
          <!--    <li class="nav-item">-->
                <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--      <a href="E-tax_mycomm.php?type=Pancard" class="nav-link">-->
                <!--<a href="E-TaxServicesPanCardCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
            </ul>
          </li>
          
          <!--  <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      GST-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--      <li class="nav-item">-->
          <!--       <a href="Request_E-Tax?type=GST" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Gst</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="E-TaxReport?type=GST"  class="nav-link">-->
                <!--<a href="ETaxServicesOfflineGSTServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                 <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--       <a href="E-tax_mycomm.php?type=GST" class="nav-link">-->
                <!--<a href="E-TaxServicesGSTCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--      <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      Company Registration-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--       <a href="Request_E-Tax?type=Compamy" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Company Registration</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="E-TaxReport?type=Company Registration" class="nav-link">-->
                <!--<a href="ETaxServicesOfflineCompamyRegistrationServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                 <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--       <a href="E-tax_mycomm.php?type=Company Registration" class="nav-link">-->
                <!--<a href="E-TaxServicesCompamyRegistrationCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--      <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      TDS-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--       <a href="Request_E-Tax?type=TDS" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request TDS</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="E-TaxReport?type=TDS" class="nav-link">-->
                <!--<a href="ETaxServicesOfflineTDSServiceReport.phpl" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--      <a href="E-tax_mycomm.php?type=TDS" class="nav-link">-->
                <!--<a href="ETaxServicesTDSCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      ITR-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--       <a href="Request_E-Tax?type=ITR" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request ITR</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="E-TaxReport?type=ITR" class="nav-link">-->
                <!--<a href="ETaxServicesOfflineITRServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                 <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--       <a href="E-tax_mycomm.php?type=ITR" class="nav-link">-->
                <!--<a href="ETaxServicesITRCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--      <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      DSC-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--       <a href="Request_E-Tax?type=DSC" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request DSC</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="E-TaxReport?type=DSC" class="nav-link">-->
                <!--<a href="ETaxServicesOfflineDSCServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                 <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--       <a href="E-tax_mycomm.php?type=DSC" class="nav-link">-->
                <!--<a href="ETaxServicesDSCCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
            
          <!--  </ul>-->
          <!--</li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      Account Opening-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!-- <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      Axis Bank-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--  <li class="nav-item">-->
          <!--       <a href="AccountOpening" target="_blank"  class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Open Account</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--       <li class="nav-item">-->
          <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                <!--<a href="AccountOpeningAxisBankReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Axis Bank Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                <!--<a href="AccountOpeningAxisBankCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>My Commission</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>   -->
          <!--  </ul>-->
          <!--</li>-->
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-lightbulb"></i>
              <p>
                BBPS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
              <li class="nav-item">
                 <a href="BillAvenueBBPS" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="BBPS_Service?bbpscat=Electricity" class="nav-link">
                    <!--<a href="BBPSOnlineBBPSServiceReport.php" class="nav-link">-->
                      <img src="img/BBPS_Logo 2.png" style="width: 20px;margin: 0px 6px;">
                      <p>Pay Bills</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BBPSReport.php?mode=ONLINE" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">
                    <!--<a href="BBPSOnlineBBPSCommissionSetup.php" class="nav-link">-->
                      <i class="nav-icon fas fa-coins"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                  
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-wifi"></i>
                  <p>
                    Online Broadband
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Broadband&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSBroadbandServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
                 
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-lightbulb"></i>
                  <p>
                    Online Electricity
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Electricity&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSElectricityServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tint"></i>
                  <p>
                    Online Water Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Water&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSWaterBillPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                   Online EMI Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=EMI&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSEMIPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>EMI Payment Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-burn"></i>
                  <p>
                   Online GAS Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Gas&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-mobile"></i>
                  <p>
                    Online Postpaid Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Postpaid&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-phone-square" aria-hidden="true"></i>
                  <p>
                    Online Landline Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Landline&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-indent" aria-hidden="true"></i>
                  <p>
                    Online Traffic Challan Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Traffic Challan&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bolt" aria-hidden="true"></i>
                  <p>
                    Online Cable Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Cable&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-car"></i>
                  <p>
                    Online Insurance Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Insurance&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-university" aria-hidden="true"></i>
                  <p>
                    Online Hospital Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Hospital&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-flask" aria-hidden="true"></i>
                  <p>
                    Online LPG Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=LPG&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-building" aria-hidden="true"></i>
                  <p>
                    Online Municipality Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Municipality&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-window-maximize" aria-hidden="true"></i>
                  <p>
                    Online Digital Voucher Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Digital Voucher&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-credit-card" aria-hidden="true"></i>
                  <p>
                    Online Datacard Prepaid Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Datacard Prepaid&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Offline BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="offlinebbpsService.php" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>Do Transaction</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BBPSReport.php?mode=OFFLINE" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">
                    <!--<a href="BBPSOfflineBBPSCommissionSetup.php" class="nav-link">-->
                      <i class="nav-icon fas fa-coins"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-wifi"></i>
                  <p>
                    Offline Broadband
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Broadband&mode=OFFLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
                 <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-lightbulb"></i>
                  <p>
                    Offline Electricity
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Electricity&mode=OFFLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tint"></i>
                  <p>
                   Offline Water Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Water&mode=OFFLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Offline EMI Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=EMI&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSEMIPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>EMI Payment Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-burn"></i>
                  <p>
                    Offline GAS Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Gas&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-car"></i>
                  <p>
                    Offline Insurance Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Insurance&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-mobile"></i>
                  <p>
                    Offline Postpaid Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Postpaid&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-phone-square"></i>
                  <p>
                    Offline Landline Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Landline&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-indent" aria-hidden="true"></i>
                  <p>
                    Offline Traffic Challan Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Traffic Challan&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-bolt" aria-hidden="true"></i>
                  <p>
                    Offline Cable Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Cable&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-university" aria-hidden="true"></i>
                  <p>
                    Offline Hospital Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Hospital&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-flask" aria-hidden="true"></i>
                  <p>
                    Offline LPG Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=LPG&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-building" aria-hidden="true"></i>
                  <p>
                    Offline Municipality Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Municipality&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-window-maximize"></i>
                  <p>
                    Offine Digital Voucher Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Digital Voucher&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-credit-card" aria-hidden="true"></i>
                  <p>
                    Offine Datacard Prepaid Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Datacard Prepaid&mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
                </ul>
              </li>
            
      
              <!--<li class="nav-item">-->
              <!--  <a href="#" class="nav-link">-->
              <!--      <i class=" nav-icon fas fa-credit-card"></i>-->
              <!--    <p>-->
              <!--      Credit Card Bill Payment-->
              <!--      <i class="fas fa-angle-left right"></i>-->
              <!--    </p>-->
              <!--  </a>-->
              <!--  <ul class="nav nav-treeview">-->
              <!--    <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>Requset Page</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="BBPSCreditCardBillPaymentServiceReport.php" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>Report</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="BBPSCreditCardBillPaymentCommissionSetup.php" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>My Commission</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--   </ul>-->
              <!--</li>-->
              
              <!--<li class="nav-item">-->
              <!--  <a href="#" class="nav-link">-->
              <!--     <i class=" nav-icon fas fa-credit-card"></i>-->
              <!--    <p>-->
              <!--      Rent On Credit Card -->
              <!--      <i class="fas fa-angle-left right"></i>-->
              <!--    </p>-->
              <!--  </a>-->
              <!--  <ul class="nav nav-treeview">-->
              <!--     <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>Request Page</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--     <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="BBPSRentOnCreditCardServiceReport.php" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>Report</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="BBPSRentOnCreditCardCommissionSetup.php" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>My Commission</p>-->
              <!--      </a>-->
              <!--    </li>-->
                  
              <!--   </ul>-->
              <!--</li>-->
              
              <!--<li class="nav-item">-->
              <!--  <a href="#" class="nav-link">-->
              <!--      <i class="nav-icon fas fa-car"></i>-->
              <!--    <p>-->
              <!--      FasTag-->
              <!--      <i class="fas fa-angle-left right"></i>-->
              <!--    </p>-->
              <!--  </a>-->
              <!--  <ul class="nav nav-treeview">-->
              <!--       <li class="nav-item">-->
              <!--          <a href="Fastag_Service" class="nav-link">-->
              <!--            <i class="nav-icon fas fa-receipt"></i>-->
              <!--            <p>Do Transaction</p>-->
              <!--          </a>-->
              <!--        </li>-->
              <!--      <li class="nav-item">-->
              <!--       <a href="BBPSFasTagServiceReport.php" class="nav-link">-->
                    <!--<a href="BBPSFasTagServiceReport.php" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>Report</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="nav-item">-->
                     <!--<a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
              <!--      <a href="BBPSFasTagCommissionSetup.php" class="nav-link">-->
              <!--        <i class="far fa-circle nav-icon"></i>-->
              <!--        <p>Fastag Commission</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--   </ul>-->
              <!--</li>-->
            </ul>
          </li>
          
          
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-hands"></i>-->
          <!--    <p>-->
          <!--     LIC Payment-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                
          <!--    <li class="nav-item">-->
          <!--       <a href="#!" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Online LIC Payment-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--           <a href="BBPS_Service?bbpscat=Electricity" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-receipt"></i>-->
          <!--            <p>Do Transaction</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="LICReport.php?mode=ONLINE" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-receipt"></i>-->
          <!--            <p>LIC Report</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-coins"></i>-->
          <!--            <p>My Commission</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Offline LIC Payment-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--           <a href="offlinebbpsService.php" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-receipt"></i>-->
          <!--            <p>Do Transaction</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="LICReport.php?mode=OFFLINE" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-receipt"></i>-->
          <!--            <p>LIC Report</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-coins"></i>-->
          <!--            <p>My Commission</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
      
          <!--  </ul>-->
          <!--</li>-->
          
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-ticket-alt"></i>-->
          <!--    <p>-->
          <!--       Ticket Booking-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--          <i class="nav-icon fas fa-bus-alt"></i>-->
          <!--        <p>-->
          <!--          Bus-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Request Page</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingBusServiceReport.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Report</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingBusCommissionSetup.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>My Commission</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--       </ul>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--            <i class="nav-icon fas fa-plane-departure"></i>-->
          <!--        <p>-->
          <!--          Flight-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Request Page</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingFlightServiceReport.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Report</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingFlightCommissionSetup.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Commission Setup</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--       </ul>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--             <i class="nav-icon fas fa-subway"></i>-->
          <!--        <p>-->
          <!--          Train-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Request Page</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingTrainServiceReport.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Report</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingTrainCommissionSetup.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Commission Setup</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--       </ul>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--              <i class="nav-icon fas fa-hotel"></i>-->
          <!--        <p>-->
          <!--          Hotel-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingHotelCommissionSetup.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Request Page</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--         <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
                    <!--<a href="TicketBookingHotelServiceReport.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Report</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--           <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>My Commission</p>-->
          <!--          </a>-->
          <!--        </li>-->
                  
          <!--       </ul>-->
          <!--    </li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
         <?php 
         if($user['API_ACCESS']=="YES"){
         ?> 
        <!--================ DEVELOPER MODE ================-->
        <li class="nav-header">DEVELOPER MODE</li>
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Developer Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="IP_WhiteList.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ip Whitelist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Token_key.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Api Key</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="callback.php"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Callback Url</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://documenter.getpostman.com/view/26012909/2s93CRJAiW" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Documentation</p>
                </a>
              </li>
            </ul>
          </li>
        <!--================ DEVELOPER MODE ================-->
        <?php
         }
         ?>
        
        <!--================ START CUSTOMER SUPPORT MANAGMENT ================-->
        <li class="nav-header">CUSTOMER SUPPORT</li>
            <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#exampleModalCenterContact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Details</p>
                </a>
              </li>
          <li class="nav-item">
            <a href="#"  class="nav-link">
                <i class="nav-icon fas fa-headset"></i>
              <p>
                 Customer Support  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="TicketRise"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Ticket Raise</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Ticket_Request_List" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Ticket Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Notification & News
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#!" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#!"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>News</p>
                </a>
              </li>
            </ul>
          </li>
        <!--================ END CUSTOMER SUPPORT MANAGMENT ================-->
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?php }else{
      
  ?>
  
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="indexjavascript:void(0)" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="90">
      <!--<span class="brand-text font-weight-light">AdminLTE 3</span>-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block">Hello, <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="indexjavascript:void(0)" class="nav-link duser">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
              <i class="nav-icon fas fa-users"></i>
              <p>
                My Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Mpin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="index?logout" class="nav-link duser">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Logout</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="WalletExchangejavascript:void(0)" class="nav-link duser">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Wallet Exchange</p>-->
              <!--  </a>-->
              <!--</li>-->
             
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Wallet Managment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main Wallet Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>AePs Wallet Report</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="WalletExchangejavascript:void(0)" class="nav-link duser">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Wallet Exchange</p>-->
              <!--  </a>-->
              <!--</li>-->
             
            </ul>
          </li>
          
          
         
          
          <li class="nav-header">SERVICE MANAGMENT</li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                AePs Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              
            <ul class="nav nav-treeview">
                
          
            <!-- DO Transaction -->
            
            <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                AePs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                  <!-- DO Transaction -->
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>AePs Report</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>AePs Commission</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>Aadharpay Commission</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>Mini-Statement Commission</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <!--<a href="javascript:void(0)" class="nav-link duser">-->
            <!-- <i class="nav-icon fas fa-exchange-alt"></i>-->
            <!-- <p>-->
            <!--    Cash Deposite-->
            <!--    <i class="fas fa-angle-left right"></i>-->
            <!--  </p>-->
            <!--</a>-->
            <!--<ul class="nav nav-treeview">-->
            <!--  <li class="nav-item">-->
            <!--    <a href="javascript:void(0)"  class="nav-link duser">-->
                <!--<a href="AePsServicesCashDepositeServiceReportjavascript:void(0)" class="nav-link duser">-->
            <!--      <i class="nav-icon fas fa-receipt"></i>-->
            <!--      <p>Cash Deposite Report</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--     <a href="javascript:void(0)"  class="nav-link duser">-->
            <!--    <a href="javascript:void(0)" class="nav-link duser">-->
            <!--      <i class="nav-icon fas fa-coins"></i>-->
            <!--      <p>My Commission</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--</ul>-->
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                M-ATM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>M-ATM Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>M-ATM Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="AePsServicesM-ATMCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                 <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Banking Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
                
               <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                DMT
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- DO Transaction -->
                <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DMT Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>DMT Charge</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                X-DMT
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- DO Transaction -->
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
            
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>X-DMT Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>X-DMT Charge</p>
                </a>
              </li>
         
            </ul>
          </li>
            <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                UPI
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- DO Transaction -->
                <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>UPI Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>UPI Commission</p>
                </a>
              </li>

            </ul>
          </li>     
        </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-mobile-alt"></i>
              <p>
                Recharge Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-mobile-alt"></i>
              <p>
                Recharge
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
            <!-- DO Transaction -->
                <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
            
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Recharge Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Recharge Commission</p>
                </a>
              </li>
            </ul>
          </li>
               <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon  fas fa-baby-carriage"></i>
              <p>
                DTH
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- DO Transaction -->
                <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
            <!-- DO Transaction -->
            
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DTH Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>DTH Commission</p>
                </a>
              </li>
            </ul>
          </li> 
                <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-tty"></i>
                  <p>
                    Landline
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="RechargeServicesLandlineReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Landline Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="RechargeServicesLandlineCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Landline Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
                <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-tty"></i>
                  <p>
                    Data Card
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="RechargeServicesDataCardReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Card Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="RechargeServicesDataCardDataCardCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
            </ul>
          </li>
          
          
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-university"></i>
              <p>
                Payout
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DO Transaction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Payout Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Payout Charge</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-university"></i>
              <p>
                Virtual Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p> Virtual Account Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                Loan/Finance (Offline)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Application Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="LoanReport" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Loan Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="LoanCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Loan Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                Vehicle Insurance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Application Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)" class="nav-link duser">
                <!--<a href="InsuranceOfflineServiceReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Insurance Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="InsuranceCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                E-Tax Services (Offline)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
                <li class="nav-item">
             <a href="javascript:void(0)"class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                Pan Card
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                 <a href="javascript:void(0)" class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)" class="nav-link duser">
                <!--<a href="ETaxServicesOfflinePanCardServiceReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="E-TaxServicesPanCardCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
                <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                GST
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesOfflineGSTServiceReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="E-TaxServicesGSTCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
                <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                Company Registration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesOfflineCompamyRegistrationServiceReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">>
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="E-TaxServicesCompamyRegistrationCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
                <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                TDS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesOfflineTDSServiceReportjavascript:void(0)l" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesTDSCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                ITR
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesOfflineITRServiceReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesITRCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>
          
                <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon fas fa-building"></i>
              <p>
                DSC
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesOfflineDSCServiceReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Coupon Request</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="ETaxServicesDSCCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            
            </ul>
          </li>
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Account Opening
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Axis Bank
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="AccountOpeningAxisBankReportjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Axis Bank Report</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="javascript:void(0)"  class="nav-link duser">
                <!--<a href="AccountOpeningAxisBankCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                  <i class="nav-icon fas fa-coins"></i>
                  <p>My Commission</p>
                </a>
              </li>
            </ul>
          </li>   
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon far fa-lightbulb"></i>
              <p>
                BBPS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
              <li class="nav-item">
                 <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Online BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="BBPS_Service" class="nav-link duser">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>Do Transaction</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-coins"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Offline BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-coins"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-hands"></i>
                  <p>
                    LIC Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Payment Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
              

              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Credit Card Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Requset Page</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                   <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Rent On Credit Card 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                  
                 </ul>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-car"></i>
                  <p>
                    FasTag
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                      <!-- <li class="nav-item">-->
                      <!--  <a href="Fastag_Service" class="nav-link duser">-->
                      <!--    <i class="nav-icon fas fa-receipt"></i>-->
                      <!--    <p>Do Transaction</p>-->
                      <!--  </a>-->
                      <!--</li>-->
                    <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="BBPSFasTagServiceReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Reports</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="BBPSFasTagCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                 </ul>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
                <i class="nav-icon far fa-lightbulb"></i>
              <p>
                LIC Payment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
              <li class="nav-item">
                 <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Online BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="BBPS_Service" class="nav-link duser">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>Do Transaction</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-coins"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Offline BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="nav-icon fas fa-coins"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-hands"></i>
                  <p>
                    LIC Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Payment Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
              

              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Credit Card Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Requset Page</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                   <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Rent On Credit Card 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                  
                 </ul>
              </li>
              
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-car"></i>
                  <p>
                    FasTag
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                      <!-- <li class="nav-item">-->
                      <!--  <a href="Fastag_Service" class="nav-link duser">-->
                      <!--    <i class="nav-icon fas fa-receipt"></i>-->
                      <!--    <p>Do Transaction</p>-->
                      <!--  </a>-->
                      <!--</li>-->
                    <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="BBPSFasTagServiceReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Reports</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="BBPSFasTagCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                 </ul>
              </li>
            </ul>
          </li>
          
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link duser">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                 Ticket Booking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                    <i class="nav-icon fas fa-bus-alt"></i>
                  <p>
                    Bus
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingBusServiceReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingBusCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                      <i class="nav-icon fas fa-plane-departure"></i>
                  <p>
                    Flight
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingFlightServiceReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingFlightCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                       <i class="nav-icon fas fa-subway"></i>
                  <p>
                    Train
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingTrainServiceReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingTrainCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                        <i class="nav-icon fas fa-hotel"></i>
                  <p>
                    Hotel
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingHotelCommissionSetupjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                    <!--<a href="TicketBookingHotelServiceReportjavascript:void(0)" class="nav-link duser">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="javascript:void(0)"  class="nav-link duser">
                      <i class="far fa-circle nav-icon"></i>
                      <p>My Commission</p>
                    </a>
                  </li>
                  
                 </ul>
              </li>
              
            </ul>
          </li>
        <!--================ START CUSTOMER SUPPORT MANAGMENT ================-->
        <li class="nav-header">CUSTOMER SUPPORT</li>
            <li class="nav-item">
                <a href="javascript:void(0)" data-toggle="modal" data-target="javascript:void(0)exampleModalCenterContact" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Details</p>
                </a>
              </li>
          <li class="nav-item">
            <a href="javascript:void(0)"  class="nav-link duser">
                <i class="nav-icon fas fa-headset"></i>
              <p>
                 Customer Support  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Ticket Raise</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Ticket Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="javascript:void(0)"  class="nav-link duser">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Notification & News
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)"  class="nav-link duser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>News</p>
                </a>
              </li>
            </ul>
          </li>
          
          
        <!--================ END CUSTOMER SUPPORT MANAGMENT ================-->
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
 <?php }?> 