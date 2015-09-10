<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>DZS Calendar - Preview Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <link href="./bootstrap/bootstrap.css" rel="stylesheet">
    <link rel='stylesheet' type="text/css" href="style/style.css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type="text/css" href="dzstooltip/dzstooltip.css" />
    <link rel='stylesheet' type="text/css" href="dzscalendar/dzscalendar.css" />
    <script src="dzscalendar/dzscalendar.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>
    <section id="calender">
        <!--
    <div class="pat-bg">
        <div class="pat-bg-inner">

        </div>
    </div>
    -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="dzscalendar skin-responsive-galileo" id="cal-responsive-galileo2" style="">
                        <div class="events">
                            <div class="event-tobe" data-repeat="everymonth" data-day="09">
                                <div style="width:200px;">
                                    <h5>On the prowl</h5>
                                    <span class="label">Date</span> 11-8-2012 at 6PM
                                    <br/>
                                    <span class="label">Location</span> UQ, St.Lucia
                                    <br/>
                                    <br/>Kartik is meeting with the Samalaiṅgika laṛakē near the lakes.
                                </div>
                            </div>
                            <div class="event-tobe" data-repeat="everymonth" data-day="18">
                                <div style="width:200px;">
                                    <h5>Special Alone time</h5>
                                    <span class="label">Date</span> 11-8-2012 at 6PM
                                    <br/>
                                    <span class="label">Location</span> Kartik's House
                                    <br/>
                                    <br/>Kartik is watching Samalaiṅgika aślīla
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    jQuery(document).ready(function($) {

        var design_month_covers = ['img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg', 'img/kartik.jpg'];


        dzscal_init("#cal-responsive-galileo2", {
            design_month_covers: design_month_covers
        });
    });
    </script>
    <link rel="stylesheet" href="fontawesome/font-awesome.min.css" />
</body>

</html>
