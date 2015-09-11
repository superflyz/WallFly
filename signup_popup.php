<?php
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
<html>
<head>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<script type="text/javascript">
		function closeWin(){
			window.close();
		}
	</script>
</head>

<body>
<div>
	<form id="signup_form" name="signup_form" method="post" action="signup.php">
		<table width="100%" height="100%">
		<tr>
			<td>
				<label for="username">Username *</label>
			</td>
			<td>
				<input class="form-control" type="text" size="12" name="username" placeholder="Username"/>
			</td>
		</tr>

		<tr>
			<td>
				<label for="tenant_id">Password *</label>
			</td>
			<td>
				<input class="form-control" type="password" size="12" name="password" placeholder="Password"/>
			</td>
		</tr>

		<tr>
			<td>
				<label for="first_name">Name *</label>
			</td>
			<td>
				<input class="form-control" type='text' name='first_name' maxlength='50' size='30' placeholder='First Name'>
				<input class="form-control" type='text' name='last_name' maxlength='50' size='30' placeholder='Last Name'>
			</td>
		</tr>

		<tr>
			<td>
				<label for="email">Email Address *</label>
			</td>
			<td>
				<input class="form-control" type="text" name="email" maxlength="50" size="12" placeholder='Email Address'>
			</td>
		</tr>

		<tr>
			<td>
				<label for="usertype">User Type *</label>
			</td>
			<td>
				<select class="form-control" name="usertype">
					<option value="AGENT">AGENT</option>
					<option value="OWNER">OWNER</option>
					<option value="TENANT">TENANT</option>
				</select>
			</td>
		</tr>
		
	</table>

		<input class="btn btn-success btn-sm" type="submit" name="btnAdd" value="Add">
		&nbsp;&nbsp;
		<input class="btn btn-success btn-sm" type="reset" class="button" value="Reset">
		&nbsp;&nbsp;
		<button class="btn btn-danger btn-sm" onclick="closeWin()">Cancel</button>
	</form>
</div>

</body>
</html>