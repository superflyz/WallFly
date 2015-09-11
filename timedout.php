
<?php
session_start();
require_once(__DIR__.'/logincheck.php');
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wall Fly</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- JQuery Validate Plugin-->
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
    <script type="text/javascript" src="js/timeout.js"></script>
</head>

<body>

<div class="modal fade" id="timeout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Timed Out</h4>
            </div>
            <div class="modal-body">
                <form id="timeout_form" name="timeout_form" method="post" autocomplete="false"  action="timeout.php">
                    <!-- <label for="username">Username</label> -->
                    <input  class="form-control" type="text" size="12" name="username" placeholder="Username" value="" id="usrname" />
                    <br>
                    <!-- <label for="password">Password</label> -->
                    <input  class="form-control" type="password" size="12" name="password" placeholder="Password" value="" id="psswrd" />
                    <br>
                    <input class="btn btn-success" type="submit" name="btnAdd" value="Add">
                    <input id="reset" class="btn btn-warning" type="button" class="button" value="Reset" onclick="clearForm()"> 
                    <button type="button" class="btn btn-danger"  onclick="logout()">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>


</html>


