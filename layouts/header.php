<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" type="text/css" href="../libs/css/style.css">

</head>
<body>
<header id="header-page">
    <div class="logo pull-left"> Stroma-Lab-Inventory </div>
    <div class="header-content">
        <div class="header-date pull-left">
            <strong><?php echo date("F j, Y, g:i a");?></strong>
        </div>
        <div class="pull-right clearfix" >
            <ul class="info-menu list-inline list-unstyled">
                <li class="profile">
                    <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                        <img src="../uploads/no_image.jpg" alt="user-image" class="img-circle img-inline">
                        <span>UserName <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="#" title="edit account">
                                <i class="glyphicon glyphicon-cog"></i>
                                Settings
                            </a>
                        </li>
                        <li class="last">
                            <a href="#">
                                <i class="glyphicon glyphicon-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>
    <div class="sidebar">
        <!-- admin menu -->
        <?php include_once('admin_menu.php');?>
    </div>
    <div class="page">
    <div class="container-fluid">
        
