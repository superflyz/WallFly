<?php
	session_start();
	require_once(__DIR__.'/logincheck.php');
	require_once(__DIR__.'/timeoutcheck.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">
    <title>Dashboard - WallFly</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/wallfly.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</head>
<body class="gbody">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="wlcm-h1">Welcome <span class="user-color"> User !</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Features Section -->
            <section id="dash-links">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-md-4 col-sm-6">
                            <a href="#calendar" data-toggle="pill">
                                <div class="dash-link">
                                    <span class="icons">
                                        <i class="fa fa-calendar fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">Calendar</h4>
                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                </div>
                            </div>
                        </a>
                        <div class="col-md-4 col-sm-6">
                            <a href="dashboard.php/manageProperties" data-toggle="pill">
                                <div class="dash-link">
                                    <span class="icons">
                                        <i class="fa fa-home fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">Manage Properties</h4>
                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a href="#messages" data-toggle="pill">
                                <div class="dash-link">
                                    <span class="icons">
                                        <i class="fa fa-comments-o fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">Messages</h4>
                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                </div>
                            </a>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>


</body>
</html>