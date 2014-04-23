<?php
    session_start();
    $username=isset($_POST['username'])?$_POST['username']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";
    // Authentification
    $loginError=false;
    if ($username=="admin"&&$password=="admin"){
        $_SESSION=array();
        $_SESSION['id']="admin";
    } else if (isset($_POST)){
        $loginError=true;
    }
    if (isset($_SESSION['id'])&&$_SESSION['id']=="admin"){
        header("Location: home/index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Front End Package Manager</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style='margin-top:200px'>

    <div class="container">

      <form class="form-signin" role="form" method='POST'>
        <h2 class="form-signin-heading">Front End Package Manager</h2>
        <input type="text" class="form-control" name='username' placeholder="Username" required autofocus>
        <input type="password" class="form-control" name='password' placeholder="Password" required>
        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <script type="text/javascript">
    if (<?php echo $loginError ?>){
      toastr.options.positionClass="toast-top-full-width";
      toastr.error("Login Failed...Please try again");
    }
    </script>
  </body>
</html>
