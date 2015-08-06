<?php
//session start
  session_start();
  $usertype = $_SESSION['usertype'];
  $permission_1 = "ADMIN";
  $permission_2 = "OWNER";
  $permission_3 = "AGENT";

  //connect DB
  $username = "admin";
  $password = "password";
  $hostname = "localhost"; 
  
  //connection to the database
  $dbhandle = mysql_connect($hostname, $username, $password)
   or die("Unable to connect to MySQL");
  
  //select a database to work with
  $selected = mysql_select_db("admin",$dbhandle)
    or die("Could not select database");
?>

<!DOCTYPE HTML>
<html>
	<head lang="en">
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="distributor" content="Global" />
    <meta itemprop="contentRating" content="General" />
    <meta name="robots" content="All" />
    <meta name="revisit-after" content="7 days" />
    <meta name="description" content="The source of truly unique and awesome jquery plugins." />
    <meta name="keywords" content="slider, carousel, responsive, swipe, one to one movement, touch devices, jquery, plugin, bootstrap compatible, html5, css3" />
    <meta name="author" content="w3widgets.com">
		<title>Wall Fly</title>
		<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link rel="stylesheet" href="/bootstrap-calendar/dist/css/font-awesome.min.css">
    <!-- Respomsive slider -->
    <link href="style/responsive-calendar.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script src="js/responsive-calendar.js"></script>

	</head>

	<body>
    <!-- Navigator-->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a style="color: #ffffff;" class="navbar-brand" href="home.php"><span style="color: #ffffff;" class="glyphicon glyphicon-home"></span>&nbsp;Wall Fly</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <!-- notification test -->
          <li>
            <div class="dropdown" id="alert">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" style="background-color: #036E2C;">
              <i class="glyphicon glyphicon-bell"></i>
            </a>
            
            <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
              
              <div class="notification-heading"><h4 class="menu-title"><b>Notifications</b></h4>
              </div>
              <li class="divider"></li>
              <div class="notifications-wrapper">
                <a class="content" href="calendar.php">
                <div class="notification-item">
                  <h4 class="item-title">An Event has been updated (1 hour ago)</h4>
                </div>
                </a>

                <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">You have got a message (1 hour ago)</h4>
                </div>
                </a>

                <a class="content" href="#">
                <div class="notification-item">
                  <h4 class="item-title">You have got a message (2 hour ago)</h4>
                </div>
                </a>

                <a class="content" href="calendar.php">
                <div class="notification-item">
                  <h4 class="item-title">An event has been updated (4 hour ago)</h4>
                </div>
                </a>
              </div>
              <li class="divider"></li> 
            </ul>
            </div>
          </li>
          <li>
            <ul class="nav navbar-nav" id="user_dropdown">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["username"]; ?>(<?php echo $_SESSION["usertype"];?>) <span class="glyphicon glyphicon-user pull-right"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="property.php">Property <span class="glyphicon glyphicon-home pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="calendar.php">Calendar <span class="glyphicon glyphicon-calendar pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="chatsys/chat.html">Messages <span class="glyphicon glyphicon-comment pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="login_page.html">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                  </ul>
              </li>
            </ul>
          </li>
          <li><button type="button" class="logout" onclick="window.location.href='login_page.html'"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</button></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <!-- Responsive calendar - START -->
      <div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn btn-primary">Prev</div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn btn-primary">Next</div></a>
        </div><hr/>
        <div class="day-headers">
          <div class="day header">Mon</div>
          <div class="day header">Tue</div>
          <div class="day header">Wed</div>
          <div class="day header">Thu</div>
          <div class="day header">Fri</div>
          <div class="day header">Sat</div>
          <div class="day header">Sun</div>
        </div>
        <div class="days" data-group="days">
          
        </div>
      </div>
      <!-- Responsive calendar - END -->
      <button id='back_calendar' class='btn btn-primary btn-lg btn-block'>Go Back to Property Lists</button>
    </div>
    <br>
    <br>
    <div>
      <ul style="list-style-type: none; text-align: center; text-decoration: none;">
        <li style="display:inline; padding:25px;"><a href="#">About Us</li>
        <li style="display:inline; padding:25px;"><a href="#">Contact Us</li>
        <li style="display:inline; padding:25px;"><a href="#">RTA Website</li>
        <li style="display:inline; padding:25px;"><a href="#">Report an Issue</li>
      </ul>
    </div>

    
    <script type="text/javascript">
      $(document).ready(function () {
        $(".responsive-calendar").responsiveCalendar({
          time: '2015-05',
          events: {
            "2015-04-30": {"number": 1, "url": ""},
            "2015-04-26": {"number": 1, "url": ""}, 
            "2015-05-03":{"number": 1}, 
            "2015-06-12": {}}
        });
      });

      //back button
      document.getElementById("back_calendar").onclick = function() {
        location.href = "property.php";
      };
    </script>
  </body>
</html>