<?php

session_start();
$propertyID = $_SESSION['propertyId'];
$currentID = $_SESSION["username"];

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

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" media="all" href="style/jsDatePick_ltr.min.css" />
	<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
	<script type="text/javascript">
		window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"dateField",
				dateFormat:"%d-%M-%Y"
				/*selectedDate:{				This is an example of what the full configuration offers.
					day:5,						For full documentation about these settings please see the full version of the code.
					month:9,
					year:2006
				},
				yearsRange:[1978,2020],
				limitToToday:false,
				cellColorScheme:"beige",
				dateFormat:"%m-%d-%Y",
				imgPath:"img/",
				weekStartDay:1*/
			});
		};

		function closeWin(){
			window.close();
		}
	</script>
</head>
<body>
<?php
	$sql="SELECT tenant_id, tenant_fname, tenant_lname FROM property WHERE property_id = '$propertyID'";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result)) {
		$tenantID = $row['tenant_id'];
		$tenantFname = $row['tenant_fname'];
		$tenantLname = $row['tenant_lname'];
	}
?>
<form name='update_inspection' method='post' action="update_inspection.php" enctype="multipart/form-data" style="margin: 20px">
	<table width="100%" id="update_inspection">
		<tr>
			<td width="30%">
				<label for="inspection_date">Inspection Date</label>
			</td>
			<td width="70%">
				<input class="form-control" type="text" size="12" name="inspection_date" id="dateField" />
			</td>
		</tr>

		<tr>
			<td>
				<label for="tenant_id">Tenant ID</label>
			</td>
			<td>
				<?php
				echo "<input id='tenantId_input_payment' class='form-control' type='text' name='tenant_id' maxlength='30' size='15' value='".$tenantID."'>";
				?>
			</td>
		</tr>

		<tr>
			<td>
				<label for="tenant_fname">Tenant Name</label>
			</td>
			<td>
				<?php
				echo "<input id='tenantName_input_payment' class='form-control' type='text' name='tenant_fname' maxlength='30' size='10' placeholder='First Name' value='".$tenantFname."'>&nbsp;&nbsp;";
				echo "<input id='tenantName_input_payment' class='form-control' type='text' name='tenant_lname' maxlength='30' size='10' placeholder='Last Name' value='".$tenantLname."'>";
				?>
			</td>
		</tr>

		<tr>
			<td>
				<label for="inspection_comment">Comment</label>
			</td>
			<td>
				<textarea class="form-control" name="inspection_comment" rows="4" placeholder="Write Comment..."></textarea>
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<input type="submit" value="Save" class="btn btn-success btn-sm">&nbsp; <input type="reset" value="Reset" class="btn btn-default btn-sm">
				
			</td>
			<td>
				
			</td>
		</tr>
	</table>
</form>
<!--<button class="btn btn-danger btn-sm" onclick="closeWin()" style="float:right" style="margin:20">Close</button>-->
</body>
</html>
