<?php
include('system/connection.php');
session_start();
if(!isset($_SESSION['username'])){
$_SESSION['auth_err'] = "Please Login First";
header('location:index.php');
}

$list_c = mysqli_query($connection, "SELECT * FROM customers");
$list_sales_debt = mysqli_query($connection, "SELECT * FROM sale");

?>


<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Sajjad Framers</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
    

    </head>


    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index.php" class="logo">
                            <i class="zmdi zmdi-group-work icon-c-logo"></i>
                            <span>Sajjad Framers</span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav pull-right">

                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>


                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user" class="img-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Welcome ! <?php if(isset($_SESSION['username'])){echo $_SESSION['username']; }?></small> </h5>
                                    </div>

                                    <!-- item-->
                                    <a href="update_settings.php" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                    </a>

                                  
                                    <!-- item-->
                                    <a href="system/logout.php" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                    </a>

                                </div>
                            </li>

                        </ul>

                    </div> <!-- end menu-extras -->
                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->


            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li>
                                <a href="dashboard.php"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>
                            <li class="has-submenu">
                                <a href="do_sale.php"><i class="ion-ios7-cart"></i> <span> Sale </span> </a>
                                
                            </li>

                            <li class="has-submenu">
                                <a href="reporting_stock.php"><i class="zmdi zmdi-collection-text"></i> <span> Manage Stock </span> </a>
                                
                            </li>

                            <li class="has-submenu">
                                <a href="reporting_customers.php"><i class="ion-person text-muted"></i> <span> Manage Customers </span> </a>
                              
                            </li>

                           


                            <li class="has-submenu">
                                <a href="#"><i class="zmdi zmdi-collection-item"></i> <span> Reporting </span> </a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="reporting_stock.php">Stock Report</a></li>
                                            <li><a href="reporting_sale.php"> Sale Report</a></li>
                                            <li><a href="reporting_cash.php"> Cash Balance Report</a></li>
                                             
                                         
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </li>

                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
</br>
</br>
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <a href="do_sale.php">
                        <div style="border-bottom: 5px solid grey;" class="card-box tilebox-one">
                            <i class="fa   fa-plus-circle  pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">New</h6>
                            <h2 class="m-b-20" >Sale</h2>

                        </div>
                            </a>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <a href="reporting_stock.php">
                        <div class="card-box tilebox-one">
                            <i class="icon-layers pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Manage</h6>
                            <h2 class="m-b-20"><span >Stock</span></h2>

                        </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                       <a data-toggle="modal" data-target="#myModal" href="reporting_customers.php">
                        <div class="card-box tilebox-one">
                            <i class="ion-person pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Add New</h6>
                            <h2 class="m-b-20"><span >Customer</span></h2>

                        </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                         <a href="#">
                        <div class="card-box tilebox-one">
                            <i class="ion-ios7-paper-outline pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Generate</h6>
                            <h2 class="m-b-20" >Billing</h2>

                        </div>
                        </a>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">


                    <div class="col-sm-4">
                        <div class="row">
                            <div  class="card-box table-responsive">
                                <?php

                                if(isset($_SESSION['pending_dept_single_person'])){
                                    echo "<h4>";
                                    echo "Name of Debter = ". $_SESSION['selected_debter'];
                                    echo  "</br>";
                                    echo  ' Debt = '.$_SESSION['pending_dept_single_person'];
                                    echo "</h4>";
                                    unset($_SESSION['pending_dept_single_person']);
                                } else {
                                    $debtamount = 0;
                                    while($debt = mysqli_fetch_assoc($list_sales_debt)){
                                        $debtamount += $debt['amount'] ;
                                    }
                                    echo "<h4>";
                                    echo 'Total Debt = '.$debtamount;
                                    echo "</h4>";

                                }
                                ?>


                                <br>
                                <button data-toggle="modal" data-target="#askModel"  class="btn btn-success-outline btn-sm"
                                        id="user_phone_dt" href="#" value="$phone" >Show Order History ></button>
                                <br>
                                <br>
                                <br>
                                <br>
                                <hr>

                                <h4>Last Payback : Salman Akram:</h4>
                                <h6>03-05-2016: Monday: 5pm</h6>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="row">
                            <div  class="card-box table-responsive">
                                <?php

                                if(isset($_SESSION['pending_dept_single_person'])){
                                    echo "<h4>";
                                    echo "Name of Debter = ". $_SESSION['selected_debter'];
                                    echo  "</br>";
                                    echo  ' Debt = '.$_SESSION['pending_dept_single_person'];
                                    echo "</h4>";
                                    unset($_SESSION['pending_dept_single_person']);
                                } else {
                                    $debtamount = 0;
                                    while($debt = mysqli_fetch_assoc($list_sales_debt)){
                                        $debtamount += $debt['amount'] ;
                                    }
                                    echo "<h4>";
                                    echo 'Total Debt = '.$debtamount;
                                    echo "</h4>";

                                }
                                ?>


                                <br>
                                <button data-toggle="modal" data-target="#askModel"  class="btn btn-success-outline btn-sm"
                                        id="user_phone_dt" href="#" value="$phone" >Show Order History ></button>
                                <br>
                                <br>
                                <br>
                                <br>
                                <hr>

                                <h4>Last Payback : Salman Akram:</h4>
                                <h6>03-05-2016: Monday: 5pm</h6>
                            </div>

                        </div>
                    </div>



                    <div class="col-sm-4">
                        <div class="row">
                            <div  class="card-box table-responsive">
                                <?php

                                if(isset($_SESSION['pending_dept_single_person'])){
                                    echo "<h4>";
                                    echo "Name of Debter = ". $_SESSION['selected_debter'];
                                    echo  "</br>";
                                    echo  ' Debt = '.$_SESSION['pending_dept_single_person'];
                                    echo "</h4>";
                                    unset($_SESSION['pending_dept_single_person']);
                                } else {
                                    $debtamount = 0;
                                    while($debt = mysqli_fetch_assoc($list_sales_debt)){
                                        $debtamount += $debt['amount'] ;
                                    }
                                    echo "<h4>";
                                    echo 'Total Debt = '.$debtamount;
                                    echo "</h4>";

                                }
                                ?>


                                <br>
                                <button data-toggle="modal" data-target="#askModel"  class="btn btn-success-outline btn-sm"
                                        id="user_phone_dt" href="#" value="$phone" >Show Order History ></button>
                                <br>
                                <br>
                                <br>
                                <br>
                                <hr>

                                <h4>Last Payback : Salman Akram:</h4>
                                <h6>03-05-2016: Monday: 5pm</h6>
                            </div>

                        </div>
                    </div>


                </div>
                <!-- end row -->




                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                2016 © Sajjad Framers
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->


            </div> <!-- container -->






        </div> <!-- End wrapper -->



       
        

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Customer</h4>
      </div>
      <div class="modal-body">
       
        <form action="controller/update_customer.php" method="post">
            <div class="form-group row">
                <label class="col-sm-4 form-control-label">Name <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" autofocus required class="form-control" id="c_name" name="c_name" placeholder=""> </div>
            </div>
            
            
            <div class="form-group row">
                <label class="col-sm-4  form-control-label">Phone (Unique) <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" required class="form-control" id="c_name" name="c_phone" placeholder=""> </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>













        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

    </body>

</html>