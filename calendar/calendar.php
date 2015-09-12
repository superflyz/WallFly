<?php
session_start();
require_once(__DIR__.'/../logincheck.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Wallfly Calendar</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">
    <link href="./bootstrap/bootstrap.css" rel="stylesheet">
<!--    <link href="../css/bootstrap.min.css" rel="stylesheet">-->

    <link rel='stylesheet' type="text/css" href="style/style.css"/>
    <script src="js/jquery.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type="text/css" href="dzstooltip/dzstooltip.css"/>
    <link rel='stylesheet' type="text/css" href="dzscalendar/dzscalendar.css"/>
    <script src="dzscalendar/dzscalendar.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<!--    <link href="../css/wallfly.css" rel="stylesheet">-->
</head>

<body>
<!--start calendar-->
<section id="calender">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dzscalendar skin-responsive-galileo" id="cal-responsive-galileo2" style="">
                    <div class="events">
                        <div class="event-tobe" data-repeat="everymonth" data-day="09" data-tag="blue" data-eventbg="">
                            <div style="width:200px;">
                                <h5>Inspection</h5>
                                <span class="label">Time:</span> 10:00AM
                                <br/>
                                <span class="label">Agent:</span> Gemma Chan
                                <br/>
                                <br/>Please be home or notify Ray White asap to organise alternate arrangements
                            </div>
                        </div>
                        <div class="event-tobe"  data-day="18" data-month="9" data-year="2015" data-tag="blue" data-eventbg="">
                            <div style="width:200px;">
                                <h5>Maintenace Repair</h5>
                                <span class="label">Time:</span>12:00PM
                                <br/>
                                <span class="label">Contractor:</span> Mike's Plumbing
                                <br/>
                                <br/>Fixing leaking tap
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end calendar-->
<script>
    jQuery(document).ready(function ($) {
        // cover pictures for calendar jan->dec in order
        var design_month_covers = ['img/jan.jpg', 'img/feb.jpg', 'img/mar.jpg', 'img/apr.jpg', 'img/may.jpg', 'img/jun.jpg', 'img/jul.jpg', 'img/aug.jpg', 'img/sep.jpg', 'img/oct.jpg', 'img/nov.jpg', 'img/dec.jpg'];

        //set cover pictures
        dzscal_init("#cal-responsive-galileo2", {
            design_month_covers: design_month_covers
        });
    });
</script>
<link rel="stylesheet" href="fontawesome/font-awesome.min.css"/>
</body>

</html>
