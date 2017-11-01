<?php
session_start();
include('system/connection.php');
include('system/functions.php');

if(isset($_SESSION['username'])){
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:52 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="Sajjad Framers" content="Commercial Web App">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Sajjad Framers</title>

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
   

    </head>


    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">

        	<div class="account-bg">
                <div style=" min-height: 400px;" class="card-box m-b-0">
                    <div class="text-xs-center m-t-20">
                        <a href="index.php" class="logo">
                            <i class="zmdi zmdi--work icon-c-logo"></i>
                            <span>Sajjad Framers</span>
                        </a>
                    </div>
                    <div class="m-t-10 p-20">
                       
                         <div class="row">
                            <div  class="col-xs-12 text-xs-center">
                                <h6 style="color: red;" class="text-muted text-uppercase m-b-0 m-t-0">
                                <?php if(isset($_SESSION['auth_err'])){
                                    
                                    
                                    echo $_SESSION['auth_err'];
                                    unset($_SESSION['auth_err']);
                                    }
                                ?>
                                </h6>
                            </div>
                            </div>
                        
                        <form class="m-t-20" method="post" action="controller/auth.php">

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input name="username" id="username" class="form-control" type="text" required="" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input name="password" id="password" class="form-control" type="password" required="" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <div class="checkbox checkbox-custom">
                                        <input id="checkbox-signup" type="checkbox">
                                        <label for="checkbox-signup">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-10">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                             <div style="margin-top:60px" class="row">
                            <div class="col-xs-12 text-xs-center">
                                <h6 style="    font-size: 12px;" class="text-muted text-uppercase m-b-0 m-t-0">Developed by <a href="http://www.osinternational.eu.pn" target="_blank">Outsource International</a></h6>
                            </div>
                            </div>
                         

                        </form>

                        
                        
                        
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end card-box-->

          

        </div>
        <!-- end wrapper page -->


        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

<!-- Mirrored from coderthemes.com/Sajjad Framers_1.4/horizontal/pages-login.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 01:48:52 GMT -->
</html>