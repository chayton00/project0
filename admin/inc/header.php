<?php session_start();ob_start();include('inc/config.php');include('functions.php'); ?>
<?php 
if(strlen($_SESSION['alogin'])==0)
	{	
header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Admin Dashbord</title>

        <!-- Custom fonts for this template-->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="vendor/country-picker/css/countrySelect.css">
<link rel='stylesheet' href='css/textediter.min.css'>

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="settings.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">



                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="advertisement.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Advertisement</span></a>
                </li>                
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="pages.php">
                        <i class="fas fa-tools"></i>
                        <span>Tools</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link" href="new_pages.php">
                        <i class="fas fa-file-alt"></i>
                        <span>Pages</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="custom_codes.php">
                        <i class="fas fa-code"></i>
                        <span>Custom Codes</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="fas fa-rss-square"></i>
                      <span>Blog</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="blog.php">All Posts</a>
                        <a class="collapse-item" href="add_blog.php">Add New Posts</a>
                        <!--<a class="collapse-item" href="blogcategory.php">Category</a> -->
                      </div>
                    </div>
                </li>
                
                <!-- Divider -->
                <!--<hr class="sidebar-divider">-->
                  <!-- Nav Item - Tables -->
                <!--<li class="nav-item">-->
                <!--    <a class="nav-link" href="updatecheck.php">-->
                <!--        <i class="fas fa-code-branch"></i>-->
                <!--        <span>Check for update</span></a>-->
                <!--</li>-->

                

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline mt-5">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top ">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>



                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3  animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>



                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="../" target="_blank">
                                    <i class="fab fa-internet-explorer"></i> &nbsp;Site

                                </a>

                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->

                            <?php
                            $sql = "SELECT * from admin;";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $result=$query->fetch(PDO::FETCH_OBJ);
                            $cnt=1;	
                            ?>            
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlentities($result->username);?></span>
                                    <img class="img-profile rounded-circle" src="uploads/<?php echo htmlentities($result->image);?>">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right  animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="settings.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="settings.php">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->