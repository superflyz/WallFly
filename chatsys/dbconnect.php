<?php


function db_connect()
{

  date_default_timezone_set("Australia/Brisbane");

  $link = mysql_connect("localhost", "admin", "password")
            or die('Could not connect: ' . mysql_error());
  mysql_select_db("admin") or die('Could not select database');
  return true;
}



function quote($strText)
{
    $Mstr = addslashes($strText);
    return "'" . $Mstr . "'";
}


function isdate($d)
{
   $ret = true;
   try
   {
       $x = date("d",$d);
   }
   catch (Exception $e)
   {
       $ret = false;
   }
   echo $x;
   return $ret;
}

 
?>
