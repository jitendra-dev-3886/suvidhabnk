<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"
    />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta
      name="keywords"
      content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive"
    />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
    <!-- Google font-->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700"
      rel="stylesheet"
    />
    <!-- waves.css -->
    <link
      rel="stylesheet"
      href="assets/pages/waves/css/waves.min.css"
      type="text/css"
      media="all"
    />
    <!-- Required Fremwork -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/bootstrap/css/bootstrap.min.css"
    />
    <!-- waves.css -->
    <link
      rel="stylesheet"
      href="assets/pages/waves/css/waves.min.css"
      type="text/css"
      media="all"
    />
    <!-- themify icon -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/icon/themify-icons/themify-icons.css"
    />
    <!-- font-awesome-n -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/font-awesome-n.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/font-awesome.min.css"
    />
    <!-- scrollbar.css -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/jquery.mCustomScrollbar.css"
    />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    
    <!--data table sam-->
    
    <!--<link rel="stylesheet" type="text/css" href="assets/css/style.php">-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    
    
    <!--data table sam-->
    
    
    <!-- Font Awesome -->





 </head>

  <body>
    <div class="theme-loader">
      <div class="loader-track">
        <div class="preloader-wrapper">
          <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
          <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header">
          <div class="navbar-wrapper">
            <div class="navbar-logo">
              <a
                class="mobile-menu waves-effect waves-light"
                id="mobile-collapse"
                href="#!"
              >
                <i class="ti-menu"></i>
              </a>
              <div class="mobile-search waves-effect waves-light">
                <div class="header-search">
                  <div class="main-search morphsearch-search">
                    <div class="input-group">
                      <span class="input-group-prepend search-close"
                        ><i class="ti-close input-group-text"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Keyword"
                      />
                      <span class="input-group-append search-btn"
                        ><i class="ti-search input-group-text"></i
                      ></span>
                    </div>
                  </div>
                </div>
              </div>
              <a href="index.php">
                <img
                  class="img-fluid"
                  src="https://paydeer.in/images/Logo/PaydeerLogo.png" style="background:#fff" width="120"
                  alt="Theme-Logo"
                />
              </a>
              <a class="mobile-options waves-effect waves-light">
                <i class="ti-more"></i>
              </a>
            </div>
            <div class="navbar-container container-fluid">
              <ul class="nav-left">
                <li>
                  <div class="sidebar_toggle">
                    <a href="javascript:void(0)"><i class="ti-menu"></i></a>
                  </div>
                </li>
                <li>
                  <a
                    href="#!"
                    onclick="javascript:toggleFullScreen()"
                    class="waves-effect waves-light"
                  >
                    <i class="ti-fullscreen"></i>
                  </a>
                </li>
              </ul>
              <ul class="nav-right">
                <li class="header-notification">
                  <a href="#!" class="waves-effect waves-light">
                    <i class="ti-bell"></i>
                    <span class="badge bg-c-red"></span>
                  </a>
                  <ul class="show-notification">
                    <li>
                      <h6>Notifications</h6>
                      <label class="label label-danger">New</label>
                    </li>
                    <li class="waves-effect waves-light">
                      <div class="media">
                        <img
                          class="d-flex align-self-center img-radius"
                          src="assets/images/avatar-2.jpg"
                          alt="Generic placeholder image"
                        />
                        <div class="media-body">
                          <h5 class="notification-user">Paydeer Crm</h5>
                          <p class="notification-msg">
                            Lorem ipsum dolor sit amet, consectetuer elit.
                          </p>
                          <span class="notification-time">30 minutes ago</span>
                        </div>
                      </div>
                    </li>
                    <li class="waves-effect waves-light">
                      <div class="media">
                        <img
                          class="d-flex align-self-center img-radius"
                          src="assets/images/avatar-4.jpg"
                          alt="Generic placeholder image"
                        />
                        <div class="media-body">
                          <h5 class="notification-user">Joseph William</h5>
                          <p class="notification-msg">
                            Lorem ipsum dolor sit amet, consectetuer elit.
                          </p>
                          <span class="notification-time">30 minutes ago</span>
                        </div>
                      </div>
                    </li>
                    <li class="waves-effect waves-light">
                      <div class="media">
                        <img
                          class="d-flex align-self-center img-radius"
                          src="assets/images/avatar-3.jpg"
                          alt="Generic placeholder image"
                        />
                        <div class="media-body">
                          <h5 class="notification-user">Sara Soudein</h5>
                          <p class="notification-msg">
                            Lorem ipsum dolor sit amet, consectetuer elit.
                          </p>
                          <span class="notification-time">30 minutes ago</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="user-profile header-notification">
                  <a href="#!" class="waves-effect waves-light">
                    <img
                      src="assets/images/avatar-4.jpg"
                      class="img-radius"
                      alt="User-Profile-Image"
                    />
                    <span>Paydeer crm</span>
                    <i class="ti-angle-down"></i>
                  </a>
                  <ul class="show-notification profile-notification">
                    <li class="waves-effect waves-light">
                      <a href="#!"> <i class="ti-settings"></i> Settings </a>
                    </li>
                    <li class="waves-effect waves-light">
                      <a href="user-profile.html">
                        <i class="ti-user"></i> Profile
                      </a>
                    </li>
                    <li class="waves-effect waves-light">
                      <a href="email-inbox.html">
                        <i class="ti-email"></i> My Messages
                      </a>
                    </li>
                    <li class="waves-effect waves-light">
                      <a href="auth-lock-screen.html">
                        <i class="ti-lock"></i> Lock Screen
                      </a>
                    </li>
                    <li class="waves-effect waves-light">
                      <a href="#" onclick="logout()">
                        <i class="ti-layout-sidebar-left"></i> Logout
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>