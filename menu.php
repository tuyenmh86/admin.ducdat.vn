
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!-- <a href="index.html" class="logo">
                            <span class="logo-small"><i class="mdi mdi-radar"></i></span>
                            <span class="logo-large"><i class="mdi mdi-radar"></i> Highdmin</span>
                        </a> -->
                        <!-- Image Logo -->
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo_sm.png" alt="" height="26" class="logo-small">
                            <img src="assets/images/logo.png" alt="" height="22" class="logo-large">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                       <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li class="menu-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>
                            

                            <li class="dropdown notification-list">
                                <a id="tb" class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="fi-bell noti-icon"></i>
                                    <span class="badge badge-danger badge-pill noti-icon-badge">N</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h6 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Xóa tất cả</small></a> </span>Thông Báo</h6>
                                    </div>

                                    <div id="tbs" >
                                                                       
                                       
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        ALL <i class="fi-arrow-right"></i>
                                    </a>

                                </div>
                            </li>


                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="<?=$admin["img"]?>" alt="user" class="rounded-circle"> <span class="ml-1 pro-user-name"><?=$admin["name"]?> <i class="mdi mdi-chevron-down"></i> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h6 class="text-overflow m-0">Chào Mừng !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="viewme.php" class="dropdown-item notify-item">
                                        <i class="fi-head"></i> <span>Đơn Hàng Của Tôi</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fi-cog"></i> <span>Cài đặt</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fi-help"></i> <span>Hỗ trợ</span>
                                    </a>

                                   
                                    <!-- item-->
                                    <a href="<?=BASE_URL?>/login.php" class="dropdown-item notify-item">
                                        <i class="fi-power"></i> <span>Đăng xuất</span>
                                    </a>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="<?=BASE_URL?>index.php">Home</a>
                            </li>
                             <li class="has-submenu">
                                <a href="<?=BASE_URL?>index.php?viewme=true">Đơn hàng của tôi</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?=BASE_URL?>all.php">Tất Cả.</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?=BASE_URL?>allimg.php">Hình ảnh.</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?=BASE_URL?>vip.php">Vip member.</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?=BASE_URL?>add.php">Thêm mới đơn hàng.</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?=BASE_URL?>phoi.php">Media.</a>
                            </li>
                            <?php if (!isset($admin["block"]["bc"])): ?>
                                <li class="has-submenu">
                                    <a href="<?=BASE_URL?>baocao.php">Thống kê.</a>
                                </li>
                            <?php endif ?>                            
                           
                            <?php if (!isset($admin["block"]["us"])): ?>
                                <li class="has-submenu">
                                    <a href="<?=BASE_URL?>user.php">User</a>
                                </li>
                            <?php endif ?>
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->