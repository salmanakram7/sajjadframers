<?php
include('system/connection.php');
include('system/functions.php');
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['auth_err'] = "Please Login First";
    header('location:index.php');
}
$list_c = mysqli_query($connection, "SELECT * FROM customers");
$cust_id = mysqli_query($connection, "SELECT * FROM customers");
$list_s = mysqli_query($connection, "SELECT * FROM stock");


?>
<!DOCTYPE html>
<html>
<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/form-validation.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:10 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="Sajjad Framers" content="Commercial Web App">
    <!-- App Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App title -->
    <title>Sajjad Framers - Responsive Admin Dashboard Template</title>
    <!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet"/>
    <!-- App CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- Sky Forms -->
    <!--    <link href="assets/css/sky_forms.css" rel="stylesheet" type="text/css" />-->
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
                <a href="index.php" class="logo"> <i class="zmdi zmdi-group-work icon-c-logo"></i> <span>Sajjad Framers</span>
                </a>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras">
                <ul class="nav navbar-nav pull-right">
                    <li class="nav-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines"><span></span> <span></span> <span></span></div>
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
            </div>
            <!-- end menu-extras -->
            <div class="clearfix"></div>
        </div>
        <!-- end container -->
    </div>
    <!-- end topbar-main -->
    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="dashboard.php"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>
                    <li class="has-submenu"><a href="do_sale.php"><i class="ion-ios7-cart"></i> <span> Sale </span> </a>
                    </li>
                    <li class="has-submenu"><a href="reporting_stock.php"><i class="zmdi zmdi-collection-text"></i>
                            <span> Manage Stock </span> </a></li>
                    <li class="has-submenu"><a href="reporting_customers.php"><i
                                    class="zmdi zmdi-collection-text"></i><span> Manage Customers </span> </a></li>
                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-collection-item"></i>
                            <span> Reporting </span> </a>
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

        <?php


        if(isset($_SESSION['alert_type'])){

            if($_SESSION['alert_type'] == 'success'){
                echo "<div style=\"margin-top: 10px;\" id=\"system-alert\" class=\"alert alert-success alert-dismissable\">";
                echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>";
                echo "<strong>";
                echo  $_SESSION['alert_title'];
                echo "</strong>";
                echo $_SESSION['alert_msg'];
                echo "</div>";

            }else if ($_SESSION['alert_type'] == 'error'){

                echo "<div style=\"margin-top: 10px;\" id=\"system-alert\" class=\"alert alert-danger alert-dismissable\">";
                echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>";
                echo "<strong>";
                echo  $_SESSION['alert_title'];
                echo "</strong>";
                echo $_SESSION['alert_msg'];
                echo "</div>";

            }
        }
        unset($_SESSION['alert_type']);
        unset($_SESSION['alert_title']);
        unset($_SESSION['alert_msg']);

        ?>



        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">

                    <div class="row">


                        <div class="col-sm-12 col-xs-12 col-md-6">
                            <h4 class="header-title m-t-0">Please verify your identity</h4>

                            <div class="p-20">
                                <form role="form" method="post" action="controller/update_settings.php" data-parsley-validate novalidate>
                                    <div class="form-group row">
                                        <div class="col-sm-7">
                                            <input minlength="6" data-parsley-equalto="#hori-pass1" type="password" required
                                                   placeholder="Password" name="u_pass"  class="form-control" id="hori-pass2">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-7 ">
                                            <button  type="submit" class="btn btn-primary waves-effect waves-light pull-right">
                                                GO
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- end row -->



                </div>
            </div><!-- end col-->

        </div>
        <!-- end row -->
        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div id="foorr" class="col-xs-12"> 2016 © Sajjad Framers.</div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
    <!-- container -->
</div>
<!-- End wrapper -->
<!--  ------------------------------------------------------------------------------------------->
<!--  ------------------------------------------------------------------------------------------->
<!--  ------------------------------------------------------------------------------------------->
<!--  ------------------------------------------------------------------------------------------->
<script type="text/javascript">
    var resizefunc = [];

</script>
<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script>
<!-- Tether for Bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley();
    });
</script>


<script>



    //Sticking Customer Name
    console.log('key ready');
    document.addEventListener("keydown", function (event) {

        if (event.which == 16) {


            if ($("#cust_stick").is(':checked')) {

                $('#cust_stick').attr('checked', false);
                console.log('unchecked');

            } else if (!$("#cust_stick").is(':checked')) {

                $('#cust_stick').attr('checked', true);
                console.log('checked');
            }
        }
    });





</script>

<script type="text/javascript">

    $("#system-alert").fadeTo(3000, 500).slideUp(500, function(){
        $("#system-alert").alert('close');
    });
</script>
<!--    Handling Users input-->

<script src="assets/js/myCustom.js"></script>


</body>
<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/form-validation.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:11 GMT -->

</html>