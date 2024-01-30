<?php
include("../../Db/config.php");

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../../assets/images/<?php echo $row['I_LOGO']?>" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="120">
      <!--<span class="brand-text font-weight-light">AdminLTE 3</span>-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="margin-top: 25% !important;">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Welcome, Admin</a>
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
            <!--<ul class="nav nav-treeview">-->
            <!--  <li class="nav-item">-->
            <!--    <a href="" class="nav-link active">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>Home</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--</ul>-->
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
              <!--<li class="nav-item">-->
              <!--  <a href="pages/layout/top-nav.html" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Add Member</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="AddMember.php" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Add Member</p>-->
              <!--  </a>-->
              <!--</li>-->
              
              <!--<li class="nav-item">-->
              <!--  <a href="AddDistributor.php" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Add Distributor</p>-->
              <!--  </a>-->
              <!--</li>-->
              
              <li class="nav-item">
                <a href="MemberTransfer1.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member Transfer</p>
                </a>
              </li>
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
              <!--<li class="nav-item">-->
              <!--  <a href="RetailerVerificationRequest.php" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>CSP Verification</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="DistributorVerificationRequest.php" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>BC Request</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="#!" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Meeting</p>-->
              <!--  </a>-->
              <!--</li>-->
            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-fingerprint"></i>-->
          <!--    <p>-->
          <!--      Employee Managment-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="AddEmployee.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Add Employee</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="Employee_List.php" class="nav-link">-->
          <!--          <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Employee List</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="AddDepartment.php" class="nav-link">-->
          <!--          <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Add Department</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="DepartmentList.php" class="nav-link">-->
          <!--          <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Department List</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
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
                <a href="OfflineWalletRechargeRequest.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offline Wallet Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="OfflineWalletRechargeReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offline Wallet Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fund_transfer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fund Transfer</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <!--<li class="nav-header">ACCOUNT MANAGMENT</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-users"></i>-->
          <!--    <p>-->
          <!--      Account Managment-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--      <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Agent Fund Transfer-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="AgentFundTransferMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="AgentFundTransferAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Fund Transfer Report-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="FundTransferReportMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="FundTransferReportAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Agent Transaction Report-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="AgentTransactionReportMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="AgentTransactionReportAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
          <!--     <li class="nav-item">-->
          <!--      <a href="AllCommissionReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-calendar-alt"></i>-->
          <!--        <p>-->
          <!--          All Commission Report-->
          <!--        </p>-->
          <!--      </a>-->
          <!--    </li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="P&LReport.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      P & L Report-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="Invoices.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      Invoices-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="TDSReport.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      TDS Report-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="GSTReport.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      Sales GST Report-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-users"></i>-->
          <!--    <p>-->
          <!--          Reseller Accounts -->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
         
              
          <!--  <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-fingerprint"></i>-->
          <!--    <p>-->
          <!--      Reseller-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                
          <!--      <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Fund Transfer -->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerFundTransferMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerFundTransferAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
          <!--      <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Fund Transfer Report-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerFundTransferReportMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerFundTransferReportAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
              
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Transaction Report-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerTransactionReportMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerTransactionReportAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>   -->
          <!--  </ul>-->
          <!--</li>-->
              
          <!--  <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-fingerprint"></i>-->
          <!--    <p>-->
          <!--      Reseller Agent-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                
          <!--      <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Fund Transfer -->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerAgentFundTransferMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerAgentFundTransferAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
          <!--      <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--          Fund Transfer Report-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerAgentFundTransferReportMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerAgentFundTransferReportAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>-->
              
              
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>-->
          <!--           Transaction Report-->
          <!--          <i class="fas fa-angle-left right"></i>-->
          <!--        </p>-->
          <!--      </a>-->
          <!--      <ul class="nav nav-treeview">-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerAgentTransactionReportMainWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>Main Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--          <a href="ResellerAgentTransactionReportAePsWallet.php" class="nav-link">-->
          <!--            <i class="far fa-circle nav-icon"></i>-->
          <!--            <p>AePs Wallet</p>-->
          <!--          </a>-->
          <!--        </li>-->
          <!--      </ul>-->
          <!--    </li>   -->
          <!--  </ul>-->
          <!--</li>-->
              
             
              
              
              
          <!--     <li class="nav-item">-->
          <!--      <a href="ResellerAllCommissionReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-calendar-alt"></i>-->
          <!--        <p>-->
          <!--          All Commission Report-->
          <!--        </p>-->
          <!--      </a>-->
          <!--    </li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="ResellerP&LReport.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      P & L Report-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="ResellerInvoices.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      Invoices-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="ResellerTDSReport.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--      TDS Report-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!-- <li class="nav-item">-->
              <!--  <a href="ResellerGSTReport.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-calendar-alt"></i>-->
              <!--    <p>-->
              <!--     Sales GST Report-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
          <li class="nav-header">PAYMENT GATEWAY CHARGES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Cashfree
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <li class="nav-item">
                <a href="PaymentGatewayCharges.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cashfree Payment Gateway Charges</p>
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
              <li class="nav-item">
                <a href="AePsServicesAePsCommissionSetup.php" class="nav-link">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>Commission Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="AePsServerSetup.php" class="nav-link">
                    <i class="nav-icon fas fa-server"></i>
                  <p>AePs Server Setup</p>
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
                  <p>Report</p>
                </a>
              </li>
              <li class="nav-item">
                <!--<a href="AePsServicesMiniStatementCommissionSetup.php" class="nav-link">-->
                <a href="offline_commission_setup.php?type=Mini Statement" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Commission Setup</p>
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
              <li class="nav-item">
                <a href="AePsServicesAdharPayCommissionSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Commission Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="AdharPayServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                  <p>AdharPay Server Setup</p>
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
                Cash Deposit
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
              <li class="nav-item">
                <a href="AePsServicesCashDepositeCommissionSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Commission Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="CashDepositeServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                  <p>Server Setup</p>
                </a>
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
              <!--  <a href="M-ATMRequest.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-receipt"></i>-->
              <!--    <p>Purchase Request</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="PriceSetUp.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-coins"></i>-->
              <!--    <p>M-ATM Price Setup</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
                <a href="M-ATMReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>M-ATM Report</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="AePsServicesM-ATMCommissionSetup.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-coins"></i>-->
              <!--    <p>Commission Setup</p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="MATMServerSetup.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-server"></i>-->
              <!--    <p>M-ATM Server Setup</p>-->
              <!--  </a>-->
              <!--</li>-->
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
              <li class="nav-item">
                <a href="DMTServicesDMTCommissionSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>DMT Charge Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="DMTServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                  <p>DMT Server Setup</p>
                </a>
              </li>
            </ul>
          </li>
          <!--  <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--   <i class="nav-icon fas fa-exchange-alt"></i>-->
          <!--   <p>-->
          <!--      X-DMT-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="MoneyTransferXDMTReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>X-DMT Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="XDMTServicesXDMTCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>X-DMT Charge Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#!" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-server"></i>-->
          <!--        <p>X-DMT Server Setup</p>-->
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
          <!--    <li class="nav-item">-->
          <!--      <a href="MoneyTransferUPIReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>UPI Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="MoneyTransferUPICommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>UPI Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="UPIServerSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-server"></i>-->
          <!--        <p>UPI Server Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>     -->
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
                <!--<a href="operator_manager.php?status=add_operator_manager" class="nav-link">-->
                <a href="OperatorManager.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Operator Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="switch_operator.php?status=add_switch_operator" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Switch Operator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="RechargeServicesRechargeReport.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Recharge Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="RechargeServicesRechargeCommissionSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Commission Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="RechargeServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                  <p>Recharge Server Setup</p>
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
              <li class="nav-item">
                <a href="#!" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>DTH Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="DTHServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                  <p>DTH Server Setup</p>
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
              <li class="nav-item">
                <a href="PayoutServicesPayoutCommissionSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Payout Charge Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="PayoutServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                   <p>Payout Server Setup</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
              <p>
                Wallet Commission
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="CashfreeWalletComm?s=debitcard" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Debit Card</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="CashfreeWalletComm?s=creditcard" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Credit Card</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="CashfreeWalletComm?s=netbanking" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                   <p>Net Banking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="CashfreeWalletComm?s=wallet" class="nav-link">
                  <i class="nav-icon fas fa-server"></i>
                   <p>Wallet </p>
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
          <!--      <a href="VirtualAccountReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="VirtualAccountChargeSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Charge Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="PayoutServerSetup.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-server"></i>-->
              <!--     <p>Server Setup</p>-->
              <!--  </a>-->
              <!--</li>-->
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
          <!--      <a href="LoanReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Loan Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="LoanCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Loan Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="LoanFinanceOfflineServerSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-server"></i>-->
          <!--        <p>Server Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--  <i class="nav-icon far fa-credit-card"></i>-->
          <!--    <p>-->
          <!--      Insurance (Offline)-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
              <!--<li class="nav-item">-->
              <!--  <a href="pages/forms/general.html" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-receipt"></i>-->
              <!--    <p>Application Request</p>-->
              <!--  </a>-->
              <!--</li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="InsuranceOfflineServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="InsuranceCommissionSetup.php" class="nav-link">-->
          <!--      <a href="offline_commission_setup.php?type=Insurance" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="InsuranceOfflineServerSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-server"></i>-->
          <!--        <p>Server Setup</p>-->
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
                
          <!--      <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      Pan Card-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="PanCardRequest.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Coupon Request</p>-->
          <!--      </a>-->
          <!--    </li>    -->
          <!--    <li class="nav-item">-->
          <!--      <a href="ETaxServicesOfflinePanCardServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
            
          <!--    <li class="nav-item">-->
                <!--<a href="SetE-TaxServicesPanCardCommission.php" class="nav-link">-->
          <!--      <a href="offline_commission_setup.php?type=Pancard" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
              <!--<li class="nav-item">-->
              <!--  <a href="PanCardServerSetup.php" class="nav-link">-->
              <!--    <i class="nav-icon fas fa-server"></i>-->
              <!--    <p>Server Setup</p>-->
              <!--  </a>-->
              <!--</li>-->
         
          <!--  </ul>-->
          <!--</li>-->
          
          <!--      <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      GST-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="E-TaxRequest.php?Type=GST" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Data</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="ETaxServicesOfflineGSTServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="E-TaxServicesGSTCommissionSetup.php" class="nav-link">-->
          <!--       <a href="offline_commission_setup.php?type=GST" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
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
          <!--      <a href="ETaxServicesOfflineCompamyRegistrationServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="E-TaxRequest.php?Type=Company Registration" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Data</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="E-TaxServicesCompamyRegistrationCommissionSetup.php" class="nav-link">-->
          <!--       <a href="offline_commission_setup.php?type=Company Registration" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
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
          <!--      <a href="ETaxServicesOfflineTDSServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="E-TaxRequest.php?Type=TDS" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Data</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="ETaxServicesTDSCommissionSetup.php" class="nav-link">-->
          <!--      <a href="offline_commission_setup.php?type=TDS" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->

          <!--  </ul>-->
          <!--</li>-->
          
          <!--      <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      ITR-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="ETaxServicesOfflineITRServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="E-TaxRequest.php?Type=ITR" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Data</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="ETaxServicesITRCommissionSetup.php" class="nav-link">-->
          <!--      <a href="offline_commission_setup.php?type=ITR" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->

          <!--  </ul>-->
          <!--</li>-->
          
          <!--  <li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      DSC-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="ETaxServicesOfflineDSCServiceReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="E-TaxRequest.php?Type=DSC" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Request Data</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
                <!--<a href="ETaxServicesDSCCommissionSetup.php" class="nav-link">-->
          <!--      <a href="offline_commission_setup.php?type=DSC" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->

          <!--  </ul>-->
          <!--</li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-fingerprint"></i>-->
          <!--    <p>-->
          <!--      Money Transfer-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                    
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
          <!--       <li class="nav-item">-->
          <!--      <a href="AccountOpeningAxisBankReport.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Axis Bank Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="AccountOpeningAxisBankCommissionSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="AxisBankServerSetup.php" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-server"></i>-->
          <!--        <p>Server Setup</p>-->
          <!--      </a>-->
          <!--    </li>   -->
          <!--  </ul>-->
          <!--</li>   -->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-building"></i>-->
          <!--    <p>-->
          <!--      Account Opening-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="pages/tables/simple.html" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Axis Bank Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="pages/tables/simple.html" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-receipt"></i>-->
          <!--        <p>Axis Bank Transaction Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="pages/tables/data.html" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-coins"></i>-->
          <!--        <p>Axis Bank Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="pages/tables/jsgrid.html" class="nav-link">-->
          <!--        <i class="nav-icon fas fa-server"></i>-->
          <!--        <p>A/C Opening Server Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
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
                  <li class="nav-item">
                    <a href="BBPSOnlineBBPSCommissionSetup.php" class="nav-link">
                      <i class="nav-icon fas fa-coins"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="OnlineBBPSServerSetup.php" class="nav-link">
                      <i class="nav-icon fas fa-server"></i>
                      <p>BBPS Server Setup</p>
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
                    <a href="BBPS_Req.php" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>Offline BBPS Request</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BBPSOfflineBBPSServiceReport.php" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>BBPS Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BBPSOfflineBBPSCommissionSetup.php" class="nav-link">
                      <i class="nav-icon fas fa-coins"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="OfflineBBPSServerSetup.php" class="nav-link">
                      <i class="nav-icon fas fa-server"></i>
                      <p>BBPS Server Setup</p>
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
                    <a href="#" class="nav-link">
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
                  <li class="nav-item">
                    <a href="BBPSCreditCardBillPaymentCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="CreditCardBillPaymentServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
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
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="BBPSRentOnCreditCardServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BBPSRentOnCreditCardCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="RentOnCreditCardServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
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
                  <li class="nav-item">
                    <a href="BBPSFasTagCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="FasTagPaymentServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
                    </a>
                  </li>
                 </ul>
              </li>
            </ul>
          </li>
          
          
          
          <li class="nav-item">
            <a href="SetE-TaxServicesPanCardCommission.php" class="nav-link">
                <i class="nav-icon far fa-lightbulb"></i>
              <p>
                PAN Commission
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
          
          
          
          
          
          
          
           <!--<li class="nav-item">-->
           <!-- <a href="#" class="nav-link">-->
           <!--     <i class="nav-icon fas fa-hands"></i>-->
           <!--   <p>-->
           <!--    LIC Payment-->
           <!--     <i class="fas fa-angle-left right"></i>-->
           <!--   </p>-->
           <!-- </a>-->
           <!-- <ul class="nav nav-treeview">-->
                
           <!--   <li class="nav-item">-->
           <!--      <a href="#!" class="nav-link">-->
           <!--       <i class="far fa-circle nav-icon"></i>-->
           <!--       <p>-->
           <!--         Online LIC Payment-->
           <!--         <i class="fas fa-angle-left right"></i>-->
           <!--       </p>-->
           <!--     </a>-->
           <!--     <ul class="nav nav-treeview">-->
           <!--       <li class="nav-item">-->
           <!--          <a href="BBPS_Service?bbpscat=Electricity" class="nav-link">-->
           <!--           <i class="nav-icon fas fa-receipt"></i>-->
           <!--           <p>Do Transaction</p>-->
           <!--         </a>-->
           <!--       </li>-->
           <!--       <li class="nav-item">-->
           <!--         <a href="LICReport.php?mode=ONLINE" class="nav-link">-->
           <!--           <i class="nav-icon fas fa-receipt"></i>-->
           <!--           <p>LIC Report</p>-->
           <!--         </a>-->
           <!--       </li>-->
           <!--       <li class="nav-item">-->
           <!--          <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
           <!--           <i class="nav-icon fas fa-coins"></i>-->
           <!--           <p>My Commission</p>-->
           <!--         </a>-->
           <!--       </li>-->
           <!--     </ul>-->
           <!--   </li>-->
              
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
          
          
          
          <!-- <li class="nav-item">-->
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
                  <!--<li class="nav-item">-->
                  <!--   <a href="BBPS_Service?bbpscat=Electricity" class="nav-link">-->
                  <!--    <i class="nav-icon fas fa-receipt"></i>-->
                  <!--    <p>Do Transaction</p>-->
                  <!--  </a>-->
                  <!--</li>-->
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
              
              <!--<li class="nav-item">-->
              <!--  <a href="#" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>-->
              <!--      Offline LIC Payment-->
              <!--      <i class="fas fa-angle-left right"></i>-->
              <!--    </p>-->
              <!--  </a>-->
              <!--  <ul class="nav nav-treeview">-->
                  <!--<li class="nav-item">-->
                  <!--   <a href="offlinebbpsService.php" class="nav-link">-->
                  <!--    <i class="nav-icon fas fa-receipt"></i>-->
                  <!--    <p>Do Transaction</p>-->
                  <!--  </a>-->
                  <!--</li>-->
              <!--    <li class="nav-item">-->
              <!--      <a href="LIC_Req.php?mode=OFFLINE" class="nav-link">-->
              <!--        <i class="nav-icon fas fa-receipt"></i>-->
              <!--        <p> Offline LIC Request</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="nav-item">-->
              <!--      <a href="LICReport.php?mode=OFFLINE" class="nav-link">-->
              <!--        <i class="nav-icon fas fa-receipt"></i>-->
              <!--        <p>LIC Report</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="nav-item">-->
              <!--       <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
              <!--        <i class="nav-icon fas fa-coins"></i>-->
              <!--        <p>My Commission</p>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--  </ul>-->
              <!--</li>-->
              
      
          <!--  </ul>-->
          <!--</li>-->
          
         
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
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="TicketBookingBusServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="TicketBookingBusCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="BusServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
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
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="TicketBookingFlightServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="TicketBookingFlightCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="FlightServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
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
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="TicketBookingTrainServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="TicketBookingTrainCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="TrainServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
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
                    <a href="TicketBookingHotelCommissionSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Page</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="TicketBookingHotelServiceReport.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commission Setup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="HotelServerSetup.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Server Setup</p>
                    </a>
                  </li>
                 </ul>
              </li>
              
            </ul>
          </li>
          <li class="nav-header">SOFTWARE MANAGMENT</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                Service & Server
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="AllServerSetup.php" class="nav-link">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Manage Server</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="SoftwareManagementServiceandServerManageService.php" class="nav-link">
                    <i class="nav-icon fas fa-coins"></i>
                  <p>Manage Service</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Website Managment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <!--  <li class="nav-item">-->
            <!--    <a href="#" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>Home</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a href="#" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>About</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a href="#" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>service</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--   <li class="nav-item">-->
            <!--    <a href="OurTeam.php" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>Our Team</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--   <li class="nav-item">-->
            <!--    <a href="OurDistributor.php" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>Our Distributor</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--    <li class="nav-item">-->
            <!--     <a href="#" class="nav-link">-->
            <!--  <i class="nav-icon fas fa-columns"></i>-->
            <!--  <p>-->
            <!--    Blog Managment-->
            <!--    <i class="fas fa-angle-left right"></i>-->
            <!--  </p>-->
            <!--</a>-->
            <!--<ul class="nav nav-treeview">-->
            <!--  <li class="nav-item">-->
            <!--    <a href="Add_Blog" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>Add Blog</p>-->
            <!--    </a>-->
            <!--  </li>-->
             
            <!--   <li class="nav-item">-->
            <!--    <a href="AddCategory.php" class="nav-link">-->
            <!--      <i class="far fa-circle nav-icon"></i>-->
            <!--      <p>Add Category</p>-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  </ul>-->
              <!--</li>-->
              <li class="nav-item">
                <a href="Bank_Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Contact_Us.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact</p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="#" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Websettings</p>-->
              <!--  </a>-->
              <!--</li>-->
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
               Slider Managment 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">-->
              <!--  <a href="#" class="nav-link">-->
              <!--    <i class="far fa-circle nav-icon"></i>-->
              <!--    <p>Website Slider</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
                <a href="Slider.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Application Slider</p>
                </a>
              </li>
            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-gifts"></i>-->
          <!--    <p>-->
          <!--      Promo Code-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="PromoCode.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Create Promo Code</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="PromoCodeList.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Promo Code List</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="pages/mailbox/compose.html" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Uses Report of Promo Code</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--      <i class="nav-icon fas fa-gifts"></i>-->
          <!--    <p>-->
          <!--      Subscription-->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="CreatePlan.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Create Plan</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="PlanList.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Plan List</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="CreateSubscription.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Create Subscription</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="SubscriptionList.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Subscription List</p>-->
          <!--      </a>-->
          <!--    </li>-->
             
          <!--  </ul>-->
          <!--</li>-->
          
          <li class="nav-item">
            <a href="APIHITLOG.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                API HIT LOG
                <span class="badge badge-info right">per day hit</span>
              </p>
            </a>
          </li>
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-chart-pie"></i>-->
          <!--    <p>-->
          <!--       Activity -->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Member Verification</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="ActivityCommissionSetup.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Commission Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="ActivityServerSetup.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Server Setup</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Ofline Request</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-chart-pie"></i>-->
          <!--    <p>-->
          <!--       Target / Task Managment -->
          <!--      <i class="fas fa-angle-left right"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="TaskManagement.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Set New Target</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="TaskManagementReport.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Target Reports</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="TaskManagementReport.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Target Working Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="task.php" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Task Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="#!" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Task Working Report</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
 
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
                <a href="Ticket_Request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ticket Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Ticket_Report.php" class="nav-link">
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
                <a href="Notification.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="News.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>News</p>
                </a>
              </li>
            </ul>
          </li>
          
          
        <!--================ END CUSTOMER SUPPORT MANAGMENT ================-->
         
         
         
         <!--============= START RESELLER MANAGMENT =============-->
         
        <!--<li class="nav-header">RESELLER MANAGMENT</li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <i class="nav-icon fas fa-users"></i>-->
        <!--      <p>-->
        <!--        Reseller Managment-->
        <!--        <i class="fas fa-angle-left right"></i>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--    <ul class="nav nav-treeview">-->
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Add Member</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Member List</p>-->
        <!--        </a>-->
        <!--      </li>-->
           
        <!--      <li class="nav-item">-->
        <!--        <a href="ResellerManagmentManagerService.php" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Manager Service</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="#!" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Manage Service Server</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--    </ul>-->
        <!--  </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <i class="nav-icon fas fa-users"></i>-->
        <!--      <p>-->
        <!--        Reseller Wallet-->
        <!--        <i class="fas fa-angle-left right"></i>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--    <ul class="nav nav-treeview">-->
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Main Wallet</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>AePs Wallet</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--    </ul>-->
        <!--  </li>-->
          
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <i class="nav-icon fas fa-users"></i>-->
        <!--      <p>-->
        <!--        Reseller's Agents-->
        <!--        <i class="fas fa-angle-left right"></i>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--    <ul class="nav nav-treeview">-->
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Member List</p>-->
        <!--        </a>-->
        <!--      </li>-->
              
        <!--        <li class="nav-item">-->
        <!--        <a href="#" class="nav-link">-->
        <!--          <i class="nav-icon fas fa-users"></i>-->
        <!--          <p>-->
        <!--             Wallet-->
        <!--            <i class="fas fa-angle-left right"></i>-->
        <!--          </p>-->
        <!--        </a>-->
        <!--        <ul class="nav nav-treeview">-->
        <!--          <li class="nav-item">-->
        <!--            <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--              <i class="far fa-circle nav-icon"></i>-->
        <!--              <p>Main Wallet</p>-->
        <!--            </a>-->
        <!--          </li>-->
        <!--          <li class="nav-item">-->
        <!--            <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--              <i class="far fa-circle nav-icon"></i>-->
        <!--              <p>AePs Wallet</p>-->
        <!--            </a>-->
        <!--          </li>-->
        <!--        </ul>-->
        <!--      </li>-->
              
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Main Wallet Report</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="pages/layout/top-nav.html" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>AePs Wallet Report</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="#!" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Reseller's Agent</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="#!" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>Manually Fund Report</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="#!" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>All AePs Wallet Report</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="#!" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>All Main Wallet Report</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="#!" class="nav-link">-->
        <!--          <i class="far fa-circle nav-icon"></i>-->
        <!--          <p>P & L Report</p>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--    </ul>-->
        <!--  </li>-->
          
         <!--=============  END  RESELLER MANAGMENT =============-->
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>