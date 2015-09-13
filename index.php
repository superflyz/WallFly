<?php
ob_start();
session_start();
require_once(__DIR__ . '/classes/Database.php');
require_once(__DIR__ . '/classes/serversignupvalidation.php');
if (!isset($_SESSION['loginError'])) {

    $_SESSION['loginError'] = "";
}


$validForm = true;
$returnedValidation = ["", "", "", "", "", "", "", "", "", "", "", ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validate = new Validator;

    $returnedValidation = $validate->validForm($_POST["username"], $_POST["password"], $_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["usertype"]);
    $userName = $returnedValidation[7];
    $password = $returnedValidation[8];
    $firstName = $returnedValidation[9];
    $lastName = $returnedValidation[10];
    $email = $returnedValidation[11];
    $userType = $returnedValidation[12];
    $validForm = $returnedValidation[0];

}


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
    <link href="css/wallfly.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle toggled" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top"><img id="logo" src="images/wallfly_logo.svg"
                                                                      alt="WallFly logo" title="Go Top"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#features">Features</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about-i-e">About I. E.</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container">
        <div class="intro">
            <div class="row">
                <div class="col-md-12 intro-text-1">
                    Welcome To WallFly!
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 intro-text-2">
                    The rental experience that actually works
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn login-btn" data-toggle="modal" data-target=".login-modal-sm">Login</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text">
                <p>New to WallFly? <a href="#" class="s-link" data-toggle="modal" data-target=".sign-up-modal-sm">Sign
                        Up</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text">
                <a href="#features" class="btn-scroll-down page-scroll" title="Scroll Down">
                    <i class="fa fa-angle-double-down animated"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Features Section -->
<section id="features">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 feature">
                    <span class="fa-stack fa-3x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="feature-heading">E-Commerce</h4>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                    architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-3 col-sm-6 feature">
                    <span class="fa-stack fa-3x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="feature-heading">Responsive Design</h4>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                    architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-3 col-sm-6 feature">
                    <span class="fa-stack fa-3x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="feature-heading feature">Web Security</h4>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                    architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-3 col-sm-6 feature">
                    <span class="fa-stack fa-3x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="feature-heading">Responsive Design</h4>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam
                    architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Information Ecosystems Section -->
<section id="about-i-e">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <img src="images/information_ecosystems.png" alt="Information Ecosystems Logo"/>
            </div>
            <div class="col-md-6">
                <p>Franz Eilert, has been in the information technology field for most of his career. He sits on a few
                    boards including the Spatial Information Business Association and is the director for Information
                    Ecosystems. He is interested in this project as he sees the need to have some type of communication
                    between all parties of the rental industry.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container text-right">
        <p>Copyright &copy; <span class="diff-color">WallFly 2015</span></p>
    </div>
</footer>


<!-- Login & sign up forms -->
<div class="modal modal-vcenter fade sign-up-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Sign Up</p>
            </div>

            <div class="modal-body">
                <form id="signup_form" name="signup_form" method="post"
                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <div class="form-field ff1">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" size="12" name="username"
                               value="<?php echo $returnedValidation[7]; ?>" id="usrname"/>
                        <span class="error"><?php echo $returnedValidation[1]; ?></span>
                    </div>

                    <div class="form-field">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" size="12" name="password"
                               value="<?php echo $returnedValidation[8]; ?>" id="psswrd"/>
                        <span class="error"><?php echo $returnedValidation[2]; ?></span>
                    </div>

                    <div class="form-field">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type='text' name='first_name' maxlength='50' size='30'
                               value="<?php echo $returnedValidation[9]; ?>" id="fname"/>
                        <span class="error"><?php echo $returnedValidation[3]; ?></span>
                    </div>

                    <div class="form-field">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type='text' name='last_name' maxlength='50' size='30'
                               value="<?php echo $returnedValidation[10]; ?>" id="lname"/>
                        <span class="error"><?php echo $returnedValidation[4]; ?></span>
                    </div>

                    <div class="form-field">
                        <label for="email">Email Address</label>
                        <input class="form-control" type="text" name="email" maxlength="50" size="12"
                               value="<?php echo $returnedValidation[11]; ?>" id="email"/>
                        <span class="error"><?php echo $returnedValidation[5]; ?></span>
                    </div>

                    <div class="form-field">
                        <label for="usertype">User Type</label>

                        <select class="form-control select-style" name="usertype">
                            <option value="">Please Select</option>
                            <option value="AGENT">Agent</option>
                            <option value="OWNER">Owner</option>
                            <option value="TENANT">Tenant</option>
                        </select>


                    </div>
                    <span class="error"><?php echo $returnedValidation[6]; ?></span>

                    <div class="form-field">
                        <button type="submit" name="btnAdd" class="btn btn-default btn-block submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-vcenter fade login-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Login</p>
            </div>

            <div class="modal-body">
                <form id="login" name="login" method="post" action="login.php">
                    <div class="form-field ff1">
                        <label for="username">Username</label>
                        <input name="username" type="text" id="username" class="form-control">
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password" class="form-control">
                    </div>
                    <span class="error"><?php echo $_SESSION['loginError']; ?></span>

                    <div class="form-field">
                        <button type="submit" name="Submit" value="Login" id="login_btn"
                                class="btn btn-default btn-block submit">Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/wallfly.js"></script>

<script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
<script src="js/index.js"></script>

<?php
$signupuser = new SignUpValidUser();
$signupuser->enterNewUser($validForm, $userName, $password, $userType, $email, $firstName, $lastName);
?>


</body>


</html>
