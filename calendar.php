<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">

    <title>Home - WallFly</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/wallfly.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body class="index d-body">

<div class="container-fluid fill">
    <div class="row no-gutter row-offcanvas row-offcanvas-left">
        <div class="col-md-2 col-sm-2 sidebar-offcanvas">
            <div class="navbar-dashboard-left">
                <div id="logo">
                    <img src="images/wallfly_logo.svg" alt="WallFly logo">
                </div>
                <nav id="navbg">
                    <ul id="tab-nav" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="dashboard.php">Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                        <li><a href="#"><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                        <li><a href="calendar.php">Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                        <li><a href="#">Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                        <li><a href="#">Payment<i class="fa fa-credit-card pull-right"></i></a></li>
                        <li><a href="#">Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                    </ul>
                </nav>
                <div id="dfooter">
                    <p>Copyright &copy; <span class="diff-color"><span class="diff-font">WallFly</span> 2015</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="navbar-dashboard-main">
                <div class="visible-xs pull-left smtog">
                    <a class="tog" href="#" data-toggle="offcanvas">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="user pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn user-btn inc" aria-label="Left Align">
                            <span class="glyphicon glyphicon-bell" aria-hidden="true"></span><span
                                class="badge anown">3</span>
                        </button>
                        <div class="btn-group">
                            <a class="btn user-btn dropdown-toggle" data-toggle="dropdown" href="#"><span
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<span class="user-name">User</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="i"></i> Make admin</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn user-btn inc" aria-label="Left Align">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                        </button>
                        <a href="logout.php"><button type="button" class="btn user-btn-diff inc" aria-label="Left Align">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </button></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid fill">
                <div class="pill-content">



                    <!--PUT PAGE STUFF HERE-->
                    <div class="pill-pane fade" id=""></div>
                    <object class="iiframe" data="./calendar/calendar.php" type="text/html"></object>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/wallfly.js"></script>
<script src="js/offcanvas.js"></script>
</body>
</html>