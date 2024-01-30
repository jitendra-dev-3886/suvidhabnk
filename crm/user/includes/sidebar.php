    <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
            <nav class="pcoded-navbar">
              <div class="sidebar_toggle">
                <a href="#"><i class="icon-close icons"></i></a>
              </div>
              <div class="pcoded-inner-navbar main-menu">
                <div class="">
                  <div class="main-menu-header">
                    <img
                      class="img-80 img-radius"
                      src="assets/images/avatar-4.jpg"
                      alt="User-Profile-Image"
                    />
                    <div class="user-details">
                      <span id="more-details"
                        >John Doe<i class="fa fa-caret-down"></i
                      ></span>
                    </div>
                  </div>
                  <div class="main-menu-content">
                    <ul>
                      <li class="more-details">
                        <a href="user-profile.html"
                          ><i class="ti-user"></i>View Profile</a
                        >
                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                        <a href="../authsign_in.php"  onclick="logout()"
                          ><i class="ti-layout-sidebar-left"></i>Logout</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="p-15 p-b-0">
                  <form class="form-material">
                    <div class="form-group form-primary">
                      <input
                        type="text"
                        name="footer-email"
                        class="form-control"
                      />
                      <span class="form-bar"></span>
                      <label class="float-label"
                        ><i class="fa fa-search m-r-10"></i>Search Friend</label
                      >
                    </div>
                  </form>
                </div>
                <div class="pcoded-navigation-label">Navigation</div>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="active">
                    <a href="index.php" class="waves-effect waves-dark">
                      <span class="pcoded-micon"
                        ><i class="ti-home"></i><b>D</b></span
                      >
                      <span class="pcoded-mtext">Dashboard</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                  </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                  <li class=" ">
                        <a
                          href="addvisiting.php"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                              <span class="pcoded-mtext">Add Visiting</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                  <li class=" ">
                        <a
                          href="visitinglist.php"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                              <span class="pcoded-mtext">Visiting Lead list</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                  <li class=" ">
                        <a
                          href="addLead.php"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                              <span class="pcoded-mtext">Add Lead</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                </ul>

                <div class="pcoded-navigation-label">Lead Management</div>
                  
                  <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu">
                    <a
                      href="javascript:void(0)"
                      class="waves-effect waves-dark"
                    >
                      <span class="pcoded-micon"
                        ><i class="ti-layout-grid2-alt"></i><b>BC</b></span
                      >
                      <span class="pcoded-mtext">Lead List</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class=" ">
                        <a href="leadList.php?status=All Lead" class="waves-effect waves-dark">
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">All Lead</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="leadList.php?status=Call not Connect" class="waves-effect waves-dark">
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Call not Connect</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="leadList.php?status=First Call Complete" class="waves-effect waves-dark">
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">First Call Complete</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="leadList.php?status=Next Call Schedule" class="waves-effect waves-dark">
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Next Call Schedule</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="leadList.php?status=Meeting Complete" class="waves-effect waves-dark">
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Meeting Complete Lead</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    
                      <li class=" ">
                        <a
                          href="leadList.php?status=Software Demo Complete"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Software Demo Complete Lead</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Waiting for Customer Confirmation"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Waiting for Customer Confirmation</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Waiting for Payment"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Waiting for Payment Lead</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Token Money Recive"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Token Money Recive Lead</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Area Allotment and Document Complete"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Area Allotment and Document Complete</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Store Branding Under Process"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Store Branding Under Process</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Store Branding Complete"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Store Branding Complete</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Full Payment Received"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Full Payment Received</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Store Inauguration Complete"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Store Inauguration Complete</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Onboarding Complete"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Onboarding Complete</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Customer Training Complete"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Customer Training Complete</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Deal Won"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Deal Won</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a
                          href="leadList.php?status=Deal Loss"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-angle-right"></i
                          ></span>
                          <span class="pcoded-mtext">Deal Loss</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    
                   
                    </ul>
                  </li>
                </ul>
                  <!--<li class="">-->
                  <!--  <a href="addUser.php" class="waves-effect waves-dark">-->
                  <!--    <span class="pcoded-micon"-->
                  <!--      ><i class="ti-home"></i><b>D</b></span-->
                  <!--    >-->
                  <!--    <span class="pcoded-mtext">Add User</span>-->
                  <!--    <span class="pcoded-mcaret"></span>-->
                  <!--  </a>-->
                  <!--</li>-->
                 
                  <!--    <li class=" ">-->
                  <!--      <a href="stateLead.php" class="waves-effect waves-dark">-->
                  <!--        <span class="pcoded-micon"-->
                  <!--          ><i class="ti-angle-right"></i-->
                  <!--        ></span>-->
                  <!--        <span class="pcoded-mtext">State  Lead</span>-->
                  <!--        <span class="pcoded-mcaret"></span>-->
                  <!--      </a>-->
                  <!--    </li>-->
                  <!--    <li class=" ">-->
                  <!--      <a href="districtLead.php" class="waves-effect waves-dark">-->
                  <!--        <span class="pcoded-micon"-->
                  <!--          ><i class="ti-angle-right"></i-->
                  <!--        ></span>-->
                  <!--        <span class="pcoded-mtext">Disrict Lead</span>-->
                  <!--        <span class="pcoded-mcaret"></span>-->
                  <!--      </a>-->
                  <!--    </li>-->
                  <!--    <li class=" ">-->
                  <!--      <a href="blockLead.php" class="waves-effect waves-dark">-->
                  <!--        <span class="pcoded-micon"-->
                  <!--          ><i class="ti-angle-right"></i-->
                  <!--        ></span>-->
                  <!--        <span class="pcoded-mtext">Block Lead</span>-->
                  <!--        <span class="pcoded-mcaret"></span>-->
                  <!--      </a>-->
                  <!--    </li>-->

                  
                    
                  <!--<li class="pcoded-hasmenu">-->
                  <!--  <a-->
                  <!--    href="javascript:void(0)"-->
                  <!--    class="waves-effect waves-dark"-->
                  <!--  >-->
                  <!--    <span class="pcoded-micon"-->
                  <!--      ><i class="ti-layout-grid2-alt"></i><b>BC</b></span-->
                  <!--    >-->
                  <!--    <span class="pcoded-mtext">Lead</span>-->
                  <!--    <span class="pcoded-mcaret"></span>-->
                  <!--  </a>-->
                  <!--  <ul class="pcoded-submenu">-->
                

                  <!--    <li class=" ">-->
                  <!--      <a-->
                  <!--        href="addLead.php"-->
                  <!--        class="waves-effect waves-dark"-->
                  <!--      >-->
                  <!--        <span class="pcoded-micon"-->
                  <!--          ><i class="ti-angle-right"></i-->
                  <!--        ></span>-->
                  <!--            <span class="pcoded-mtext">Add Lead</span>-->
                  <!--        <span class="pcoded-mcaret"></span>-->
                  <!--      </a>-->
                  <!--    </li>-->
                  <!--    <li class=" ">-->
                  <!--      <a-->
                  <!--        href="leadList.php"-->
                  <!--        class="waves-effect waves-dark"-->
                  <!--      >-->
                  <!--        <span class="pcoded-micon"-->
                  <!--          ><i class="ti-angle-right"></i-->
                  <!--        ></span>-->
                  <!--            <span class="pcoded-mtext">Lead List</span>-->
                  <!--        <span class="pcoded-mcaret"></span>-->
                  <!--      </a>-->
                  <!--    </li>-->
                  <!--   </ul>-->
                  <!--</li>-->
                
                <?php
                    
                if($userType=="Lead Manager"){
                    
                ?>
                
                    <div class="pcoded-navigation-label">User</div>
                    <ul class="pcoded-item pcoded-left-item">
                      <li class="pcoded-hasmenu">
                        <a
                          href="javascript:void(0)"
                          class="waves-effect waves-dark"
                        >
                          <span class="pcoded-micon"
                            ><i class="ti-layout-grid2-alt"></i><b>BC</b></span
                          >
                          <span class="pcoded-mtext">User Management </span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                          <li class=" ">
                            <a href="addLead.php" class="waves-effect waves-dark">
                              <span class="pcoded-micon"
                                ><i class="ti-angle-right"></i
                              ></span>
                              <span class="pcoded-mtext">Add Lead Manager</span>
                              <span class="pcoded-mcaret"></span>
                            </a>
                          </li>
                          <li class=" ">
                            <a href="addLead.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"
                                ><i class="ti-angle-right"></i
                              ></span>
                              <span class="pcoded-mtext">Lead Manager List</span>
                              <span class="pcoded-mcaret"></span>
                            </a>
                          </li>
                          <li class=" ">
                            <a href="userList.php" class="waves-effect waves-dark">
                              <span class="pcoded-micon"
                                ><i class="ti-angle-right"></i
                              ></span>
                              <span class="pcoded-mtext"> User List</span>
                              <span class="pcoded-mcaret"></span>
                            </a>
                          </li>
                          <li class=" ">
                            <a href="addUser.php" class="waves-effect waves-dark">
                              <span class="pcoded-micon"
                                ><i class="ti-angle-right"></i
                              ></span>
                              <span class="pcoded-mtext">Add User</span>
                              <span class="pcoded-mcaret"></span>
                            </a>
                          </li>
    
                          <!--<li class=" ">-->
                          <!--  <a-->
                          <!--    href="notification.html"-->
                          <!--    class="waves-effect waves-dark"-->
                          <!--  >-->
                          <!--    <span class="pcoded-micon"-->
                          <!--      ><i class="ti-angle-right"></i-->
                          <!--    ></span>-->
                          <!--    <span class="pcoded-mtext">Select Excel File</span>-->
                          <!--    <span class="pcoded-mcaret"></span>-->
                          <!--  </a>-->
                          <!--</li>-->
                        </ul>
                      </li>
                    </ul>
                    
                <?php
                
                }
                
                ?>
             
              </div>
            </nav>


