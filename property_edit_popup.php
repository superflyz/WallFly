<?php

session_start();
$propertyID = $_SESSION['propertyId'];
$usertype = $_SESSION['usertype'];
$current_user = $_SESSION['username'];

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

//find values
$sql="SELECT owner_id, agent_id, tenant_id, owner_fname, owner_lname, tenant_fname, tenant_lname, property_agent, contact_owner, contact_agent, contact_tenant, property_street, property_suburb, property_state, property_postcode
		FROM property WHERE property_id = '$propertyID'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	$ownerFname = $row['owner_fname'];
	$ownerLname = $row['owner_lname'];
	$tenantFname = $row['tenant_fname'];
	$tenantLname = $row['tenant_lname'];
	$agentName = $row['property_agent'];
	$ownerID = $row['owner_id'];
	$agentID = $row['agent_id'];
	$tenantID = $row['tenant_id'];
	$ownerContact = $row['contact_owner'];
	$agentContact = $row['contact_agent'];
	$tenantContact = $row['contact_tenant'];
	$street = $row['property_street'];
	$suburb = $row['property_suburb'];
	$state = $row['property_state'];
	$pc = $row['property_postcode'];
}

?>

<script type="text/javascript">
	function closeWin(){
		window.close();
	}
</script>
<head>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<div>
	<form name="edit_form" method="post" action="edit_property.php" enctype="multipart/form-data" style="width:80%; margin-right:auto; margin-left:auto;">
		<h2>Property Details</h2><br>
		<table width="100%">
			<!-- Tenant, Owner, Agent Names-->
			<tr>
				<td width="25%">
					<label for="owner_fname">Owner Name</label>
				</td>
				<td width="75%">
					<?php
					echo "<input class='form-control' type='text' name='owner_fname' maxlength='50' size='30' placeholder='First Name' value='".$ownerFname."' style='width:30%; display:inline-block'>&nbsp;";
					echo "<input class='form-control' type='text' name='owner_lname' maxlength='50' size='30' placeholder='Last Name' value='".$ownerLname."' style='width:30%; display:inline-block'>";
					?>
				</td>
			</tr>

			<tr>
				<td>
					<label for="tenant_fname">Tenant Name</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='tenant_fname' maxlength='50' size='30' placeholder='First Name' value='".$tenantFname."' style='width:30%; display:inline-block'>&nbsp;";
					echo "<input class='form-control' type='text' name='tenant_lname' maxlength='50' size='30' placeholder='Last Name' value='".$tenantLname."' style='width:30%; display:inline-block'>";
					?>
				</td>
			</tr>

			<tr>
				<td>
					<label for="agent_name">Agent</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='agent_name' maxlength='50' size='30' placeholder='Agent Name' value='".$agentName."' style='width:50%''>";
					?>
				</td>
			</tr>

			<!-- ID -->
			<tr>
				<td>
					<label for="owner_id">Owner ID</label>
				</td>
				<td>
					<?php
					if($usertype == "OWNER"){
						echo "<input class='form-control' type='text' name='owner_id' maxlength='50' size='30' value='".$current_user."' style='width:50%' disabled>";
					}else{
						echo "<input class='form-control' type='text' name='owner_id' maxlength='50' size='30' value='".$ownerID."' style='width:50%'>";
					}
					?>
				</td>
			</tr>

			<tr>
				<td>
					<label for="agent_id">Agent ID</label>
				</td>
				<td>
					<?php
					if($usertype == "AGENT"){
						echo "<input class='form-control' type='text' name='agent_id' maxlength='50' size='30' value='".$current_user."' style='width:50%' disabled>";
					}else{
						echo "<input class='form-control' type='text' name='agent_id' maxlength='50' size='30' value='".$agentID."' style='width:50%'>";
					}
					?>
				</td>
			</tr>

			<tr>
				<td>
					<label for="tenant_id">Tenant ID</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='tenant_id' maxlength='50' size='30' value='".$tenantID."' style='width:50%'>";
					?>
				</td>
			</tr>
		</table>


		<!-- Contact -->
		<h3>Contacts</h3>
		<table width="100%">
			<tr>
				<td width="25%">
					<label for="owner_contact">Owner</label>
				</td>
				<td width="75%">
					<?php
					echo "<input class='form-control' type='text' name='owner_contact' maxlength='50' size='30' placeholder='Owner Contact' value='".$ownerContact."' style='width:50%'>";
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="agent_contact">Agent</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='agent_contact' maxlength='50' size='30' placeholder='Agent Contact' value='".$agentContact."' style='width:50%'>";
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="tenant_contact">Tenant</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='tenant_contact' maxlength='50' size='30' placeholder='Tenant Contact' value='".$tenantContact."' style='width:50%'>";
					?>
				</td>
			</tr>
		</table>


		<!-- Address -->
		<h3>Address</h3>
		<table width="100%">
			<tr>
				<td width="25%">
					<label for="street">Street</label>
				</td>
				<td width="75%">
					<?php
					echo "<input class='form-control' type='text' name='street' maxlength='50' size='30' placeholder='Street' value='".$street."' style='width:50%'>";
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="suburb">Suburb</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='suburb' maxlength='50' size='30' placeholder='Suburb' value='".$suburb."' style='width:50%'>";
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="state">State</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='state' maxlength='50' size='30' placeholder='State' value='".$state."' style='width:50%'>";
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="pc">Post Code</label>
				</td>
				<td>
					<?php
					echo "<input class='form-control' type='text' name='pc' maxlength='50' size='30' placeholder='Post Code' value='".$pc."' style='width:15%'>";
					?>
				</td>
			</tr>
		</table>
		<br><br>
		<input type="file" name="photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br><br>

		<input class="btn btn-success" type="submit" value="Edit">&nbsp; <input class="btn btn-success" type="reset" value="Reset">

		<button class="btn btn-danger" onclick="closeWin()" style="margin-left:50%">Cancel</button>
	</form>
</div>