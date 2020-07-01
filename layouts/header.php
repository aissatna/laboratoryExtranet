<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if (!empty($page_title))
            echo remove_junk($page_title);
        else echo "Stroma-Lab-Inventory"; ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../libs/css/style.css">
    <link rel="stylesheet" href="../libs/bootst-multiselect/dist/css/bootstrap-multiselect.css" type="text/css">

</head>
<body>
<?php if ($session->isUserLoggedIn()): ?>
    <header class="header-page">
        <div class="logo pull-left"><a href="#" onclick="toggleSideBar()"><i class="glyphicon glyphicon-menu-hamburger">
                </i></a> <span>Stroma-Lab-Inventory</span>
        </div>
        <div class="header-content">
            <div class="header-logo-img pull-left">
                <img src="../libs/img/logo.png" alt="logo-image" class="logo-img ">
            </div>
            <div class="pull-right clearfix">
                <ul class="info-menu list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                            <img src="../uploads/no_image.jpg" alt="user-image" class="img-circle img-inline">
                            <span>Admin <i class="caret"></i></span>
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
                                <a href="../php/logout.php">
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
    <div class="sidebar" id="js__sidebar">
        <!-- admin menu -->
        <?php include_once('admin_menu.php'); ?>
    </div>
<?php else:?>
<header class="header-page">
    <div class="logo pull-left">
        <span>Stroma-Lab-Inventory</span>
    </div>
    <div class="header-content">
        <div class="header-logo-img pull-left">
            <img src="../libs/img/logo.png" alt="logo-image" class="logo-img ">
        </div>
        <div class="pull-right clearfix btn-logout">
            <a href="../index.php" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-log-out"></span> Log out
            </a>
        </div>
    </div>
</header>
<?php endif; ?>
<div class="main-page" id="js__main-page">
    <div class="container-fluid">
