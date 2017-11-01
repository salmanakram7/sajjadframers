<?php
include('system/connection.php');
include('system/functions.php');
session_start();
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
<meta name="Sajjad Framers" content="Commercial Web App">

<!-- App Favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico">

<!-- App title -->
<title>Reporting Stock</title>

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
               <div class="row">
                    <div class="col-sm-12">

   <!-- =========================================================================================================== -->
   <!-- ================================= Notification Module ===================================================== -->
   <!-- =========================================================================================================== -->
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

<!-- =========================================================================================================== -->
<!-- ================/////////////////======== Notification Module =======//////////////////==================== -->
<!-- =========================================================================================================== -->

                    </div>
                </div>

                <div class="row">
                    <div class="hidden-print">
                        <div class="pull-xs-right">
                            <button type="button" class="btn btn-custom  waves-effect waves-light" data-toggle="modal" data-target="#addNewStock" aria-expanded="false">ADD NEW <span class="m-l-5"><i class="ion-plus-circled"></i></span></button>
                            <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">

                        <div  class="card-box table-responsive">

                            <h2 style=" margin-bottom: 35px;" class="m-t-0 header-title"><b>Remaining Stock</b></h2>

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>RATE</th>
                                        <th>SINGLE</th>
                                        <th>IN STOCK</th>
                                        <th>LENGTH SIZE</th>
                                        <th>WIDTH</th>
                                        <th>WASTAGE</th>
                                        <th>CREATED </th>
                                        <th>ADD</th>
                                    </tr>
                                </thead>

                                <tbody>

<!-- =========================================================================================================== -->
<!-- ================================= Stock Preview Table ===================================================== -->
<!-- =========================================================================================================== -->

<?php

$get_stock = "SELECT * FROM `stock`";
$result = mysqli_query($connection,$get_stock);

if(!$result){
    echo "Exception:: Message: 500 Server Response "."</br>";
    echo "Please Report Developer: This Error Code -> 500DBACC_ST_REP "."</br>";
}

while ($box = mysqli_fetch_assoc($result)){
//    Debugging_only
//    echo $box['no_of_length']. ' - ';
//    echo $box['width'];

echo '<tr>';

echo '<td>';
echo $box['pid'];
echo '</td>';

echo '<td>';
echo "Rs ".$box['rate_in_feet']." / foot";
echo ' </td>';

echo ' <td>';
echo $box['rate_of_length'];
echo '</td>';
// TODO: No of length can't be in points add check pls// TODO: handle this via Stock Manager //TODO: link to control panel
    $stockq = $box['no_of_length'];
    $h_sale = 15;
    $m_sale = 10;
    $l_sale = 5;

    $tWidth = $box['width'];

    if($tWidth > 0 && $tWidth < 2) {

        if($stockq <= $h_sale && $stockq != 0) {
            echo '<td  style="color: red;font-weight: bolder;background-color: #ffb1b1;">';
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>LOW STOCK</button>";
            echo '</td>';
        } else if(empty($stockq) || $stockq == 0) {
            echo ' <td style="color: #ff5d48;font-weight: bolder;background-color: #ff5d48;">';
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>SOLD OUT</button>";
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-info btn-sm' href='#'>Remind ?</button>";
            echo ' </td>';
        } else {
            echo ' <td class="success">';
            echo $box['no_of_length'];
            echo '</td>';
        }

    } else if($tWidth >= 2 && $tWidth <= 3) {
        if($stockq <= $m_sale && $stockq != 0) {
            echo '<td  style="color: red;font-weight: bolder;background-color: #ffb1b1;">';
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>LOW STOCK</button>";
            echo '</td>';
        } else if(empty($stockq) || $stockq == 0) {
            echo ' <td style="color: #ff5d48;font-weight: bolder;background-color: #ff5d48;">';
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>SOLD OUT</button>";
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-info btn-sm' href='#'>Remind ?</button>";
            echo ' </td>';
        } else {
            echo ' <td  class="success">';
            echo $box['no_of_length'];
            echo '</td>';
        }

    } else if($tWidth > 3) {

        if($stockq <= $l_sale && $stockq !== 0) {
            echo '<td  style="color: red;font-weight: bolder;background-color: #ffb1b1;">';
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>LOW STOCK</button>";
            echo '</td>';
        } else if(empty($stockq) || $stockq == 0) {
            echo ' <td style="color: #ff5d48;font-weight: bolder;background-color: #ff5d48;">';
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-danger btn-sm' href='#'>SOLD OUT</button>";
            echo $stockq."  &nbsp &nbsp &nbsp &nbsp<button class='btn btn-infoZ btn-sm' href='#'>Remind ?</button>";
            echo ' </td>';
        } else {
            echo ' <td class="success"> ';
            echo $box['no_of_length'];
            echo '</td>';
        }
    }


echo '<td>';
$con_to_foot = $box['size'] / 12; $con_to_foot = round($con_to_foot, 1 ); echo $con_to_foot." foot";
echo ' </td>';

echo ' <td>';
echo $box['width']." inch";
echo ' </td>';

echo ' <td>';
echo $box['wastage']." inch";
echo ' </td>';

echo ' <td>';
echo $box['invent_datetime'];
echo ' </td>';

//Import more stock here
echo ' <td>';
$productId = $box['pid'];
echo "<button type=\"button\" class=\"update_button btn btn-custom  waves-effect waves-light\" data-toggle=\"modal\" data-target=\"#updateSingleStockValue\" aria-expanded=\"false\" value=\"$productId\"><span class=\"m-l-5\"><i class=\"fa fa-plus-circle\"></i></span></button>";
//echo "<button type=\"button\" class=\"update_button btn btn-custom  waves-effect waves-light\" data-toggle=\"modal\" data-target=\"#updateSingleStockValue\" aria-expanded=\"false\" value=\"$productId\"><span class=\"m-l-5\"><i class=\"fa fa-plus-circle\"></i></span></button>";
echo ' </td>';

echo ' </tr>';
// Single Row is Ended
}
?>

<!-- =========================================================================================================== -->
<!-- ===============//////////////======== Stock Preview Table =========///////////============================= -->
<!-- =========================================================================================================== -->

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


<!--   TODO: 'Add an update button for stock because why not ??!'-->
    
<!-- Add new Stock Modal -->
<div class="modal fade" id="addNewStock" tabindex="-1" role="dialog" aria-labelledby="addNewStockLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addNewStockLabel">New Item</h4>
      </div>
      <div style="    padding: 50px 10px 25px 55px;" class="modal-body">
       
        <form action="controller/update_stock.php" method="post">
            <div class="form-group row">
                <label class="col-sm-4 form-control-label">MODEL NO <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" autofocus required class="form-control" id="s_model" name="s_pid" placeholder=""> </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 form-control-label">LENGTH QUANTITY <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" required class="form-control" id="s_no_length" name="s_no_length" placeholder=""> </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-4 form-control-label">LENGTH SIZE (inch) <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" required class="form-control" id="s_size" name="s_size" placeholder="118"> </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-4 form-control-label">RATE IN (Feet) <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" required class="form-control" id="s_rate_feet" name="s_rate_feet" placeholder=""> </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-4 form-control-label">RATE OF (length) <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" required class="form-control" id="s_rate_length" name="s_rate_length" placeholder=""> </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-4 form-control-label">WIDTH (Inch)<span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" required class="form-control" id="s_width" name="s_width" placeholder=""> </div>
            </div>
            <!-- Action for filtering requests on Update Stock page-->
            <input type="hidden" class="text-hide" name="form_request_action" value="addNewModel">

            <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

 <!-- Update Stock Modal -->
 <div class="modal fade" id="updateSingleStockValue" tabindex="-1" role="dialog" aria-labelledby="addNewStockLabel">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="addNewStockLabel">INVENTORY UPDATE</h4>
             </div>
             <div style="padding: 50px 10px 25px 55px;" class="modal-body">
                <!--TODO: input restrict to only digits-->
                 <form action="controller/update_stock.php" method="post">

                     <div class="form-group row">
                         <label class="col-sm-4 form-control-label">QUANTITY (lengths) <span class="text-danger">*</span></label>
                         <div class="col-sm-4">
                             <input type="text" required class="form-control" id="model_quantity" maxlength="4" name="model_quantity" placeholder=""> </div>
                     </div>
                     <!--  Model Id Attached -->
                     <input type="hidden" class="text-hide" id="attachedModelId" name="model_id" value="">
                     <!--  Model instock Attached -->
                     <input type="hidden" class="text-hide" id="attachedInStockValue" name="model_inStock" value="">
                     <!--  Model size Attached -->
                     <input type="hidden" class="text-hide" id="attachedInStockValue" name="model_inStock" value="">

                     <!-- Action for filtering requests on Update Stock page-->
                     <input type="hidden" class="text-hide" name="form_request_action" value="updateSingleModel">
                     <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <button  type="submit" class="btn btn-primary btn-success">Import +</button>
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

<!-- Required datatable js -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<!--<script src="assets/plugins/datatables/jszip.min.js"></script>-->
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

<!-- =====================  To Attach ModelID & InStock Value, for model that is being updated ==================== -->

<script type="text/javascript">
    console.log('Loaded');
    $('.update_button').on('click', function (){
        // Model Id being connected to request
        var modelId = this.value;
        console.log('Model-Id');
        console.log(modelId);
        $('#attachedModelId').val(modelId);
    });

</script>

        <!-- =================================== Data Tables =============================================== -->
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
    });
</script>
<!-- =================================== Alert Bar Toggle =============================================== -->
<script type="text/javascript">
    $("#system-alert").fadeTo(3000, 500).slideUp(500, function(){
        $("#system-alert").alert('close');
    });
</script>

    </body>
</html>