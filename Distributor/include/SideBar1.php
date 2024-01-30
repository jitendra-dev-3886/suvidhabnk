<style>

.os-host-overflow {
    overflow: initial !important;
 
}

.sidebar{
      overflow-x: initial !important;
    overflow-y: initial !important;
     
}

</style>


 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image" style="width: 150px">
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
          <a href="#" class="d-block">Hello, <?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME'] ?> </a>
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
            <a href="index.php" class="nav-link active">
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
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Mpin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
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
                <a href="MemberList.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member List</p>
                </a>
              </li>
  
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
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
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-exchange-alt"></i>
             <p>
                Cash Deposite
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="AePsServicesCashDepositeServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Cash Deposite Report</p>
                </a>
              </li>
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
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Purchase Request</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
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
                    <a href="RechargeServicesLandlineReport.php" class="nav-link">
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
                    <a href="RechargeServicesDataCardReport.php" class="nav-link">
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
                <a href="PayoutServiceReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Payout Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-credit-card"></i>
              <p>
                Loan/Finance (Offline)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Loan/FinanceOfflineServiceReport.php" class="nav-link">
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
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Application Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="InsuranceOfflineServiceReport.php" class="nav-link">
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
                <a href="ETaxServicesOfflinePanCardServiceReport.php" class="nav-link">
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
                <a href="ETaxServicesOfflineGSTServiceReport.php" class="nav-link">
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
                <a href="ETaxServicesOfflineCompamyRegistrationServiceReport.php" class="nav-link">
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
                <a href="ETaxServicesOfflineTDSServiceReport.phpl" class="nav-link">
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
                <a href="ETaxServicesOfflineITRServiceReport.php" class="nav-link">
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
                <a href="ETaxServicesOfflineDSCServiceReport.php" class="nav-link">
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
                <a href="AccountOpeningAxisBankReport.php" class="nav-link">
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
                    <a href="BBPSOnlineBBPSServiceReport.php" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
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
                    <a href="BBPSOfflineBBPSServiceReport.php" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-wifi"></i>
                  <p>
                    Broadband
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSBroadbandServiceReport.php" class="nav-link">
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
                    Electricity
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSElectricityServiceReport.php" class="nav-link">
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
                    Water Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSWaterBillPaymentServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
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
                    <a href="BBPSLICBillPaymentServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Payment Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    EMI Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSEMIPaymentServiceReport.php" class="nav-link">
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
                    GAS Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSGASPaymentServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Credit Card Bill Payment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Requset Page</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BBPSCreditCardBillPaymentServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                   <i class=" nav-icon fas fa-credit-card"></i>
                  <p>
                    Rent On Credit Card 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                    <a href="BBPSRentOnCreditCardServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-car"></i>
                  <p>
                    FasTag
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="BBPSFasTagServiceReport.php" class="nav-link">
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
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                 Ticket Booking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-bus-alt"></i>
                  <p>
                    Bus
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                    <a href="TicketBookingBusServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-plane-departure"></i>
                  <p>
                    Flight
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                    <a href="TicketBookingFlightServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-subway"></i>
                  <p>
                    Train
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                    <a href="TicketBookingTrainServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hotel"></i>
                  <p>
                    Hotel
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                    <a href="TicketBookingHotelServiceReport.php" class="nav-link">
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
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-headset"></i>
              <p>
                 Customer Support  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/search/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Ticket Rice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
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