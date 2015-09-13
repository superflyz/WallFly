<?php
  session_start();
  $property_id = $_SESSION['propertyId'];

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


  if($_POST['edit']){
    echo "<script type='javascript'>openEditPopup();</script>";
  }
  elseif($_POST['delete']){
    $sql_delete_property = "DELETE FROM property WHERE property_id = $property_id";
    $result_delete_property = mysql_query($sql_delete_property);
    if(!$result_delete_property){
      die('Could not delete data: ' . mysql_error());
    }
    $sql_delete_payment = "DELETE FROM payment WHERE property = $property_id";
    $result_delete_payment = mysql_query($sql_delete_payment);
    if(!$result_delete_payment){
      die('Could not delete data: ' . mysql_error());
    }
    header('Location: properties.php');
  }

?>
<script type="javascript">
function openEditPopup(){
  window.open('property_edit.php','1428456850982','width=700,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');
}
</script>