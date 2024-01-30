 <?php
 
 include("../../Db/config.php");
 
 $row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
 ?>
 <style>
     .nav .nav-item .nav-link i{
         color:#276569;
     }
     .nav .nav-item .nav-link p{
         color:#276569;
     }
 </style>
 
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index2.html" class="brand-link">
      <img src="../../assets/images/<?php echo $row['I_LOGO']?>" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="90">
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
                <a href="UserProfile.php" class="nav-link">
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
    
            </ul>
          </li>
          
          <li class="nav-header">MEMBER MANAGMENT</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="AddMember.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Member</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="MemberList.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member List</p>
                </a>
              </li>
  
              <li class="nav-item">
                <a href="#!" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meeting</p>
                </a>
              </li>
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
                  <p>Main Wallet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="AePsWalletReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Commission Wallet</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-header">ACCOUNT MANAGMENT</li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Account Managment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Agent Fund Transfer
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="AgentFundTransferMainWallet.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Main Wallet</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Fund Transfer Report
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="FundTransferReportMainWallet.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Main Wallet</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Agent Transaction Report
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="AgentTransactionReportMainWallet.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Main Wallet</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="AgentTransactionReportAePsWallet.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>AePs Wallet</p>
                    </a>
                  </li>
                </ul>
              </li>
              
               <li class="nav-item">
                <a href="AllCommissionReport.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    All Commission Report
                  </p>
                </a>
              </li>
               <li class="nav-item">
                <a href="P&LReport.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    P & L Report
                  </p>
                </a>
              </li>
               <li class="nav-item">
                <a href="Invoices.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Invoices
                  </p>
                </a>
              </li>
               <li class="nav-item">
                <a href="TDSReport.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    TDS Report
                  </p>
                </a>
              </li>
               <li class="nav-item">
                <a href="GSTReport.php" class="nav-link">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Sales GST Report
                  </p>
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
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                AePs - Cash Withdraw
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="AePsServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>AePs Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
               <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                Mini Statement
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="AePsServicesMiniStatementServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Mini Statement Report</p>
                </a>
              </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
               <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                AdharPay
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="AePsServicesAdharPayServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>AdharPay Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
                <a href="AepsBalReport.php" class="nav-link">
                  <i class="nav-icon fas fa-wallet"></i>
                  <p>Balance Enquery</p>
                </a>
              </li>
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">-->
          <!--   <i class="nav-icon fas fa-exchange-alt"></i>-->
          <!--   <p>-->
          <!--      Cash Deposite-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
            <!--<ul class="nav nav-treeview">-->
            <!--  <li class="nav-item">-->
            <!--    <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">-->
            <!--      <i class="nav-icon fas fa-receipt"></i>-->
            <!--      <p>Cash Deposite Report</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--</ul>-->
          <!--</li>-->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                M-ATM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="M-ATMReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>M-ATM Report</p>
                </a>
              </li>
            </ul>
          </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Money Transfer
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
              <li class="nav-item">
                <a href="MoneyTransferDMTReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DMT Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                X-DMT
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="MoneyTransferXDMTReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>X-DMT Report</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                UPI
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="MoneyTransferUPIReport.php" class="nav-link">
                <!--<a href="MoneyTransferUPIReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>UPI Report</p>
                </a>
              </li>
            </ul>
          </li>     
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
              <li class="nav-item">
                <a href="RechargeServicesRechargeReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Recharge Report</p>
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
              <li class="nav-item">
                <a href="RechargeServicesDTHReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>DTH Report</p>
                </a>
              </li>
            </ul>
          </li> 
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tty"></i>
                  <p>
                    Landline
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSCategoryReport.php?type=Landline&mode=ONLINE" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Landline Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tty"></i>
                  <p>
                    Data Card
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="BBPSCategoryReport.php?type=Datacard Prepaid&mode=ONLINE" class="nav-link">
                    <!--<a href="RechargeServicesDataCardReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Card Report</p>
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
                <a href="PayoutService.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Do Transaction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="MyPayoutServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p><?php echo $user["FIRST_NAME"] ?> Payout Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="PayoutServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Payout Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon far fa-credit-card"></i>
              <p>
                Loan/Finance (Offline)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="LoanReport" class="nav-link">
                <!--<a href="Loan/FinanceOfflineServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Loan Report</p>
                </a>
              </li>
            
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                Insurance (Offline)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                    <a href="BBPSCategoryReport.php?type=Insurance&mode=OFFLINE" class="nav-link">
                <!--<a href="InsuranceOfflineServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                E-Tax Services (Offline)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
                <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                Pan Card
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="Etax_report.php?type=Pancard" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
          
            </ul>
          </li>
          
                <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                GST
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="Etax_report.php?type=GST" class="nav-link">
                <!--<a href="ETaxServicesOfflineGSTServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
            </ul>
          </li>
          
                <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                Compamy Registration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="Etax_report.php?type=Company Registration" class="nav-link">
                <!--<a href="ETaxServicesOfflineCompamyRegistrationServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
            </ul>
          </li>
          
         <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                TDS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="Etax_report.php?type=TDS" class="nav-link">
                <!--<a href="ETaxServicesOfflineTDSServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
             </ul>
          </li>
          
                <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                ITR
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                    <a href="Etax_report.php?type=ITR" class="nav-link">
                <!--<a href="ETaxServicesOfflineITRServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
              </ul>
          </li>
          
                <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
              <p>
                DSC
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                    <a href="Etax_report.php?type=DSC" class="nav-link">
                <!--<a href="ETaxServicesOfflineDSCServiceReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Report</p>
                </a>
              </li>
             </ul>
          </li>
              
            </ul>
          </li>
          

          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Account Opening
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Axis Bank
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 <li class="nav-item">
                       <a href="#!" class="nav-link">
                <!--<a href="AccountOpeningAxisBankReport.php" class="nav-link">-->
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Axis Bank Report</p>
                </a>
              </li>
            </ul>
          </li>   
            </ul>
          </li>
 
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
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Online BBPS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                        <a href="#!" class="nav-link">
                    <!--<a href="BBPSOnlineBBPSServiceReport.php" class="nav-link">-->
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
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
                    Online Cable Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Cable&mode=ONLINE" class="nav-link">
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
                    Online Insurance Payment
                    <i class="fas fa-angle-left right"></i>    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Insurance&mode=ONLINE" class="nav-link">
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
                    Online Hospital Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Hospital&mode=ONLINE" class="nav-link">
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
                    Online LPG Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=LPG&mode=ONLINE" class="nav-link">
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
                    Online Municipality Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Municipality&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
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
                    Online Datacard Prepaid Payment
                    <i class="fas fa-angle-left right"></i>       
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Datacard Prepaid&mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSGASPaymentServiceReport.php" class="nav-link">-->
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
                        <a href="#!" class="nav-link">
                    <!--<a href="BBPSOfflineBBPSServiceReport.php" class="nav-link">-->
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
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
                    <!--<a href="BBPSBroadbandServiceReport.php" class="nav-link">-->
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
                   Offline Water Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSCategoryReport.php?type=Water&mode=OFFLINE" class="nav-link">
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
              
              
              
              
              
              
              
              
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                    <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Credit Card Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Requset Page</p>
                    </a>
                  </li>
                  <li class="nav-item">
                        <a href="#!" class="nav-link">
                    <!--<a href="BBPSCreditCardBillPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                   <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Rent On Credit Card 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                         <a href="#!" class="nav-link">
                    <!--<a href="BBPSRentOnCreditCardServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-car" data-toggle="modal" data-target="#exampleModalCenterC"></i>
                  <p>
                    FasTag
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="BBPSFasTagServiceReport.php" class="nav-link">
                          <!--<a href="#!" class="nav-link">-->
                    <!--<a href="BBPSFasTagServiceReport.php" class="nav-link">-->
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
                    <i class="nav-icon fas fa-hands"></i>
                  <p>
                    LIC Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="LICReport.php?mode=ONLINE" class="nav-link">
                    <!--<a href="BBPSLICBillPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p> Online Payment Report</p>
                    </a>
                  </li>
                 </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="LICReport.php?mode=OFFLINE" class="nav-link">
                    <!--<a href="BBPSLICBillPaymentServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p> Offline Payment Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                 Ticket Booking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                    <i class="nav-icon fas fa-bus-alt"></i>
                  <p>
                    Bus
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                         <a href="#!" class="nav-link">
                    <!--<a href="TicketBookingBusServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                      <i class="nav-icon fas fa-plane-departure"></i>
                  <p>
                    Flight
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                         <a href="#!" class="nav-link">
                    <!--<a href="TicketBookingFlightServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                       <i class="nav-icon fas fa-subway"></i>
                  <p>
                    Train
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                         <a href="#!" class="nav-link">
                    <!--<a href="TicketBookingTrainServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                        <i class="nav-icon fas fa-hotel"></i>
                  <p>
                    Hotel
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                         <a href="#!" class="nav-link">
                    <!--<a href="TicketBookingHotelServiceReport.php" class="nav-link">-->
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              
            </ul>
          </li>

 
        <!--================ START CUSTOMER SUPPORT MANAGMENT ================-->
        <li class="nav-header">CUSTOMER SUPPORT</li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenterC">
                <i class="nav-icon fas fa-headset"></i>
              <p>
                 Customer Support  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#exampleModalCenterContact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Ticket Rice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Ticket Report</p>
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