<?php
session_start();
include('system/connection.php');
if(!isset($_SESSION['username'])){
$_SESSION['auth_err'] = "Please Login First";
header('location:index.php');
}
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
        <title>Reporting Customers</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
    <!-- Jquery-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                                <a href="reporting_customers.php"><i class="zmdi zmdi-collection-text"></i><span> Manage Customers </span> </a>
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
 <!-- =========================================================================================================== -->
 <!-- ================================= Notification Module ===================================================== -->
 <!-- =========================================================================================================== -->
              <div style="padding-top:20px"  class="row">
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

                        } else if ($_SESSION['alert_type'] == 'error'){

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
                <div  class="row">
                    <div class="hidden-print">
                        <div class="pull-xs-right">
                            <button type="button" class="btn btn-custom  waves-effect waves-light" data-toggle="modal" data-target="#addModal" aria-expanded="false">Add New <span class="m-l-5"><i class="ion-plus-circled"></i></span></button>
<!--                            <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>-->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">
                        <div  class="card-box table-responsive">
                            <h2 style=" margin-bottom: 35px;" class="m-t-0 header-title"><b>Customers List</b></h2>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Area</th>
                                        <th>Remove</th>
                                        <th>Edit Details</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$get_cust = "SELECT * FROM `customers`";

$result = mysqli_query($connection,$get_cust);

if(!$result){
    echo "Error in Query Exe";
}

while ($cust_blob = mysqli_fetch_assoc($result)){
echo '<tr> <td>';
echo $cust_blob['name'];
echo '</td><td>';
echo $phone = $cust_blob['phone'];
echo ' </td><td>';
echo 'Lahore';
echo '</td><td>';
echo "<button data-toggle=\"modal\" data-target=\"#askModal\"  
class=\"btn btn-danger-outline btn-sm\" id=\"user_phone_dt\" value=\"$phone\">Remove</button>";
echo '</td><td>';
echo "<button data-toggle=\"modal\" data-target=\"#editModal\"  
class=\"edit_user btn btn-danger-outline btn-sm\" id=\"user_edit\" value=\"$phone\">Edit </button></td></tr>";
}
?>

<!-- ================== Fill Customer Data for editing ====================== -->
<script>
    $('.edit_user').click(function(){

        var user_id = $(this).attr("value");
        $.post('./controller/requestHandler.php', {callback: 'edit_client', user_edit: user_id}, function(data) {

            var res = $.parseJSON(data);

            console.log(res);

            $("#c_edit_name:text").val(res.name);
            $("#c_edit_phone:text").val(res.phone);
        });

    });
</script>
<!-- ========////////////////////////////////////////////////================ -->


<!-- TODO: 'add edit button for customer info'-->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
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

<!-- =========================================================================================================== -->
<!-- ===============//////////////======== New Customer Add Dialogue =========///////////======================== -->
<!-- =========================================================================================================== -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addModalLabel">New Customer</h4>
      </div>
      <div class="modal-body">

        <form action="controller/update_customer.php" method="post">
            <div class="form-group row">
                <label class="col-sm-4 form-control-label">Name <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" autofocus required class="form-control" id="c_name" name="c_name" placeholder=""> </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 form-control-label">Phone<span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" minlength="11" maxlength="13" required class="form-control" id="c_phone" name="c_phone" placeholder=""> </div>
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

<!-- =========================================================================================================== -->
<!-- =========================================================================================================== -->
<!-- =========================================================================================================== -->



<!-- =========================================================================================================== -->
<!-- ===============//////////////======== Customer Edit Dialogue =========///////////============================= -->
<!-- =========================================================================================================== -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit Customer details</h4>
            </div>
            <div class="modal-body">
                <form action="controller/update_customer.php" method="post">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">NAME <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" autofocus required class="form-control" id="c_edit_name" name="c_edit_name" placeholder=""> </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">PHONE<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" minlength="11" maxlength="13" required class="form-control" id="c_edit_phone" name="c_edit_phone" placeholder=""> </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="c_edit_update" name="c_edit_update" value="1">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button  type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- =========================================================================================================== -->
<!-- =========================================================================================================== -->
<!-- =========================================================================================================== -->




<!-- =========================================================================================================== -->
<!-- ===============//////////////======== Customer Delete Confirmation Dialogue =========///////////============================= -->
<!-- =========================================================================================================== -->

<div class="modal fade" id="askModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                    <h2>Delete Confirmation</h2>
                    <p>This process cannot be Un-Done</p>
            </br>
            <div id="#uif" class="well">

            </div>
                    <div class="modal-footer">
                        <form method="post" role="form" id="delte_customer" action="controller/delete_customer.php">
                        <input type="hidden" id="nuke_phone" name="nuke_phone" value="">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <input  type="submit" value="Delete" class="btn btn-danger-outline btn-sm" >
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>




<!-- ================== Get Customer data: so user decides to Delete/DoNothing ====================== -->
<script>
    $('#user_phone_dt').click(function(){

        var user_id = $(this).attr("value");
        $.post('./controller/requestHandler.php', {callback: 'edit_client', user_edit: user_id}, function(data) {

            var res = $.parseJSON(data);

            console.log(res);

            $("#c_edit_name:text").val(res.name);
            $("#c_edit_phone:text").val(res.phone);
        });

    });
</script>
<!-- ========////////////////////////////////////////////////================ -->
<!-- =========================================================================================================== -->
<!-- =========================================================================================================== -->
<!-- =========================================================================================================== -->



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

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<!--        <script src="assets/plugins/datatables/jszip.min.js"></script>-->
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


        <script type="text/javascript">

            $('button').on('click', function (){
//                console.log( this.value);
                var phone = this.value;
                $('#nuke_phone').val(phone);
                });

        </script>

        <script type="text/javascript">
            //Restrict number input to PHONE in customer update form
            $(document).ready(function () {
                //called when key is pressed in textbox
                $("#c_phone").keypress(function (e) {
                    //if the letter is not digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which < 47 || e.which > 57)) {
                        return false;
                    }
                });
            });

            //Restrict number input to PHONE in customer update form
            $(document).ready(function () {
                //called when key is pressed in textbox
                $("#c_phone").keypress(function (e) {
                    //if the letter is not digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which < 47 || e.which > 57)) {
                        return false;
                    }
                });
                //called when key is pressed in textbox
                $("#c_edit_phone").keypress(function (e) {
                    //if the letter is not digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which < 47 || e.which > 57)) {
                        return false;
                    }
                });
            });
        </script>

        <script type="text/javascript">

                   $("#system-alert").fadeTo(6000, 500).slideUp(500, function(){
                       $("#system-alert").alert('close');
                   });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

        <script src="assets/js/myCustom.js"></script>
    </body>
</html>