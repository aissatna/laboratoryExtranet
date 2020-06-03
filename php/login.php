<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" type="text/css" href="../libs/css/style.css">
</head>
<body id="login-page">
<?php
ob_start();
require_once('../includes/load.php');
//if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4"></div>
            <div  class="col-xs-12 col-sm-4 col-md-4 form-container">
                    <div class="text-center">
                        <h1>Welcome</h1>
                        <p>Sign in to start your session</p>
                    </div>
                    <!--    <?php //echo display_msg($msg); ?>    -->
                <form method="post" action="auth.php">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" name= "password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-login">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4"></div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../libs/js/script.js"></script>
</body>
</html>