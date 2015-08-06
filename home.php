<?php
	session_start();
	if(!isset($_SESSION)){
		header("location:login_page.html");
	}
?>

<!DOCTYPE HTML>
<html>
	<head lang="en">
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Wall Fly</title>
		<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

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

    <!-- contents -->
    <div class="container-fluid1">
      <div class="row">
        <div class="col-md-12">
          <img class="logo" src="img/logo.jpg">
        </div>
      </div>
      <div class="row">
        <div class="jumbotron">
          <div class="container">
            <h1>Hello, Welcome to WallFly!</h1>
            <p>We are a web service that is committed to making the rental process easier for everyone, tenants, owners and agents!
            We provide owners with more visibility of properties, tenants easier communication to owners and agents and agents easier management of properties.</p>
            <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
            <a id="start_btn" href="property.php" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-home"></span> Manage Properties</a>&nbsp;&nbsp;
            <a id="start_btn" href="calendar.php" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-calendar"></span> Calendar</a>&nbsp;&nbsp;
            <a id="start_btn" href="chatsys/chat.html" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-comment"></span> Messages</a>
          </div>
        </div>
      </div>
      <!--<div class="row">
        <div class="col-md-12">
		      <a id="start_btn" href="property.php" class="btn btn-block btn-lg btn-success"><span class="glyphicon glyphicon-home"></span> Manage Properties</a>
		      <a id="start_btn" href="calendar.php" class="btn btn-block btn-lg btn-success"><span class="glyphicon glyphicon-calendar"></span> Calendar</a>
		      <a id="start_btn" href="chatsys/chat.html" class="btn btn-block btn-lg btn-success"><span class="glyphicon glyphicon-comment"></span> Messages</a>
        </div>
      </div>-->
    </div>
    
    <!--<div class="container-fluid" id="content">
      <div class="row">
        <div class="col-md-2">
          <a>About us</a>
          <a>Application form</a>
        </div>
      </div>
    </div>-->
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
	
  
	</body>
</html>