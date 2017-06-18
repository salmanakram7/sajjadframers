<?php
include('system/connection.php');
include('system/functions.php');
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['auth_err'] = "Please Login First";
    header('location:index.php');
}
$list_c = mysqli_query($connection, "SELECT * FROM customers");
$list_sales_debt = mysqli_query($connection, "SELECT * FROM sale");
?>
<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:21 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Pending Cash</title>

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



<div class="row"></br></br></div>


                <div class="row">


                    <div class="col-sm-4">
                        <div class="row">
                            <div  class="card-box table-responsive">
                                    <form id="sale_form" method="post" role="form" action="controller/update_debter.php"
                                          data-parsley-validate novalidate>
                                        <div class="form-group row">
                                            <div class="col-sm-6">

                                                <select required id="s_customer_username" name="s_customer_username" class="form-control">
                                                    <option value="null" disabled selected autofocus='autofocus'>Select Customer</option>
                                                    <?php
                                                    while ($row_list_c = mysqli_fetch_assoc($list_c)) {
                                                        ?>
                                                        <option value="<?php echo $row_list_c['username']; ?>">
                                                            <?php echo $row_list_c['name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="s_customer_name" id="s_customer_name" value="">
                                            </div>
                                            <button type="submit" id="name_submit" class="btn btn-dark btn-sm" value="submit"   aria-expanded="false">Show Balance</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="card-box table-responsive">
                                <?php

                                if(isset($_SESSION['pending_dept_single_person'])){
                                    echo "<div style=' text-align: left;padding: 10px;border: 1px solid rgba(0, 0, 0, 0.07);box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.33)' class='well'>";
                                    echo "<h4>";
                                    echo  'Debter = '.$_SESSION['selected_debter_name'];
                                    echo  "</br>";
                                    echo  'Debt = '.$_SESSION['pending_dept_single_person'];
                                    echo "</h4>";
                                    echo "</br>";

                                    echo "<button href=\"#\" type='submit'  data-toggle=\"modal\" data-target=\"#revievePayment\" 
                                            name='submit ' class=' btn-success btn btn-info-outline btn-sm' >Recieve Payment</button>";
                                    echo "<button  href=\"#\" type='submit'  data-toggle=\"modal\" data-target=\"#confirmClear\" 
                                            name='submit' class=' btn-success btn btn-success-outline btn-sm' style='margin-left: 5px'  >Clear Payment</button>";

                                    echo "</div>";
                                    unset($_SESSION['pending_dept_single_person']);
                                } else {
                                    $debtamount = 0;
                                  while($debt = mysqli_fetch_assoc($list_sales_debt)){
                                      $debtamount += $debt['amount'] ;
                                  }
                                    echo "<div style=' text-align: left;padding: 10px;border: 1px solid rgba(0, 0, 0, 0.07);box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.33)' class='well'>";
                                    echo "<h4>";
                                    echo 'Total Debt = '.$debtamount;
                                    echo "</h4>";
                                    echo "</div>";
                                }
                                ?>
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

                    <div class="col-sm-8">
                        <div  class="card-box table-responsive">
<!--  TODO 'Name of the user for which listing is generated or show all customer lisitng'-->
<!--                            <div class="hidden-print">-->
<!--                                <div class="pull-xs-right">-->
<!--                                    <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>-->
<!--                                </div>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total frames</th>
                                    <th>Total Orders</th>
                                    <th>Pending Debt</th>

                                </tr>
                                </thead>
                                <?php
                                if(isset($_SESSION['selected_debter_username'])){
                                    $gotDebter = $_SESSION['selected_debter_username'];
                                    $query_list = "SELECT * FROM `sale` WHERE `username` = \"$gotDebter\" && `credit` = 1 ";
                                    unset($_SESSION['selected_debter_username']);
                                } else {
                                    $query_list   = "SELECT * FROM `sale` WHERE credit=1";
                                }
                                $result_list  = mysqli_query($connection,$query_list);
                                if( mysqli_num_rows($result_list) > 0){
                                    while ($row = mysqli_fetch_assoc($result_list))
                                    {
                                        echo '<tbody><tr>';
                                        echo '<td>';
                                        echo $row['name'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['name'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo '600';
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['amount'];
                                        echo '</td>';
                                        echo '</tr></tbody>';
                                    }
                                }else{
                        echo "<h4  class='alert alert-danger alert-dismissible'>Internal Application Error!</h4>";
                                }
    ?>
                            </table>
                        </div>
                    </div>


                    </div>
                <!-- end row -->


<!--Confirm clear paymane-->

                <!-- Ask Modeld -->
                <div class="modal fade" id="confirmClear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-body">


                                <h2>Clear Confirmation</h2>
                                <p>This process cannot be Un-Done</p>

                                <div class="modal-footer">
                                    <form method="post" role="form" id="delte_customer" action="controller/delete_customer.php">
                                        <input type="hidden" id="nuke_phone" name="nuke_phone" value="">
                                        <input type="text" id="pop_clear_payment" name="payment" value="">
                                        <input type="password" id="pop_clear_password" name="password" value="">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                        <input  type="submit" value="Delete" class="btn btn-danger-outline btn-sm" >
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


<!--   Add payment              -->

                <!-- Ask Modeld -->
                <div class="modal fade" id="recievePayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-body">


                                <h2>Receive payment</h2>
                                <p>This process cannot be Un-Done</p>

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





                <!-- Ask Modeld -->
                <div class="modal fade" id="askModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <h2>Last Order from: </h2>
                                <p>This is the demo of last order</p>

                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table m-t-30">
                                                    <thead class="bg-faded">
                                                    <tr><th>#</th>
                                                        <th>Item</th>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Cost</th>

                                                    </tr></thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>LCD</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>1</td>
                                                        <td>$380</td>

                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Mobile</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>5</td>
                                                        <td>$50</td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>LED</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>2</td>
                                                        <td>$500</td>

                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>LCD</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>3</td>
                                                        <td>$300</td>

                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Mobile</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>5</td>
                                                        <td>$80</td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>



            </div> <!-- container -->
        </div> <!-- End wrapper -->




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

//Restricting user to press button without selecting a customer name
            $("#name_submit").prop('disabled', true);
            $("#s_customer_username").change(function(){
                console.log('clicked');
                if($("#s_customer_username").text() !==  'null ' ){
                    $('#name_submit').prop('disabled', false);
                } else {
                    $('#name_submit').prop('disabled', true);
                }
            });




        </script>

    </body>

<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:35 GMT -->
</html>