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
<style>
    .sale_data{
        text-align: left;padding: 10px;border-bottom: 1px solid rgba(0, 0, 0, 0.07);
        display: block;
    }

</style>
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
        <div style="padding-top: 50px; "  class="row">
            <div class="col-sm-12">
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
            </div>
        </div>



        <div class="row">
              <div class="col-sm-8">
                <div class="card-box">
                                <form id="sale_form" method="post" role="form" action="controller/update_sale.php"
                                      data-parsley-validate novalidate>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Customer<span
                                                    class="text-danger">*</span></label>
                                        <div  class=" col-sm-7">
                                            <select required id="s_customer_id" name="s_customer_id" class="form-control">
                                                <option value="" disabled selected autofocus='autofocus'>Select</option>
                                                <?php
                                                while ($row_list_c = mysqli_fetch_assoc($list_c)) {
                                                    ?>
                                                    <option value="<?php echo $row_list_c['id']; ?>">
                                                        <?php echo $row_list_c['name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <div style="    padding-top: 5px;" class="checkbox">
                                                <input style="display:inline;" id="cust_stick" name="s_credit"  type="checkbox">
                                                <label for="checkbox0"> Credit ?</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Model<span
                                                    class="text-danger">*</span></label>
                                        <div  class="col-sm-8">
                                            <select required id="s_model" name="s_model" class="form-control ">
                                                <option value="" disabled selected>Select</option>
                                                <?php
                                                while ($row_list = mysqli_fetch_assoc($list_s)) {
                                                    ?>
                                                    <option value="<?php echo $row_list['pid']; ?>">
                                                        <?php echo $row_list['pid']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Select Type<span class="text-danger">*</span></label>
                                        <div  class="col-sm-8">
                                            <select required id="s_type" name="s_type" class="form-control ">
                                                <option value="frame" selected>Frame</option>
                                                <option value="length">Length</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Inner Size<span class="text-danger">*</span></label>
                                        <div  class="col-sm-8">
                                            <input maxlength="9" type="text" class="form-control" id="s_framesize"
                                                   name="s_framesize" placeholder="e.g 10X12"></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Quantity <span
                                                    class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input required maxlength="4" type="text"  class="form-control"
                                                   id="s_quantity" name="s_quantity" placeholder=""></div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Manual cash <span
                                                    class="text-danger"></span></label>
                                        <div class="col-sm-8">
                                            <input  maxlength="4" type="text"  class="form-control"
                                                   id="s_manualCash"  name="s_manualCash" placeholder="Rs"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button  style="float:right" id="saleform_submit" type="submit" class="btn-success btn btn-info-outline btn-sm">
                                               Sale <i style="padding:7px;" class="ion-ios7-cart"></i></button>
                                        </div>
                                    </div>

                                </form>

                </div>
              </div>



                 <div class="col-sm-2">
                     <div style="height: 373px;" class="card-box ">
                         <div style=" margin-bottom: 10px;background: #78b34c;text-align: center;padding: 10px;border: 1px solid rgba(0, 0, 0, 0.07);box-shadow:  0px 0px 1px #039cfd;" class="well">
                             <h4>Frame Sold </h4>
                         </div>
                         <div class="well">
                             <span class="sale_data">Frame</span>
                             <span class="sale_data"> 300b</span>
                             <span class="sale_data"> 3 Gross</span>
                             <span class="sale_data">13 X 23 </span>
                         </div>
                         <div class="well" style="margin-bottom: 0px; position: absolute;;">
                             <button  id="saleform_submit" type="submit" class="btn-success btn btn-info-outline btn-sm">
                                 Delete <i style="padding:7px;" class="ion-ios7-cart"></i></button> </br>
                             <button id="saleform_submit" type="submit" class="btn-success btn btn-info-outline btn-sm">
                                 Print <i style="padding:7px;" class="fa fa-print"></i></button>
                         </div>
                     </div>
                 </div>
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


        <div class="notify" id="alert"></div>

    </div>
    <!-- container -->
</div>
<!-- End wrapper -->
<!--  ------------------------------------------------------------------------------------------->
<!--  ------------------------------------------------------------------------------------------->
<!--  ------------------------------------------------------------------------------------------->
<!--  ------------------------------------------------------------------------------------------->
<script>
    var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script>
<!--Notify.js-->
<script src="assets/js/notify.js"></script>
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

    $("#system-alert").fadeTo(8000, 500).slideUp(500, function(){
        $("#system-alert").alert('close');
    });
</script>
<!--    Handling Users input-->

<script src="assets/js/myCustom.js"></script>


</body>
<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/form-validation.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:11 GMT -->

</html>