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

    <title>Welcome To WallFly</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="css/wallfly.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- contents -->
    <div class="container-fluid1">
      <div class="row">
        <div class="col-md-12">
          <img class="logo" src="img/logo.jpg">
        </div>
      </div>
      <div class="row">
          <div class="container">
            <h1>Hello, Welcome to WallFly!</h1>
            <p>We are a web service that is committed to making the rental process easier for everyone, tenants, owners and agents!
            We provide owners with more visibility of properties, tenants easier communication to owners and agents and agents easier management of properties.</p>
            <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
            <a id="start_btn" href="properties.php" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-home"></span> Manage Properties</a>&nbsp;&nbsp;
            <a id="start_btn" href="calendar/calendar.php" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-calendar"></span> Calendar</a>&nbsp;&nbsp;
            <a id="start_btn" href="chatsys/chat.php" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-comment"></span> Messages</a>
          </div>
      </div>
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
	
  
	</body>
</html>