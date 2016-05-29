<!--/**
 * Created by PhpStorm.
 * User: Ammar
 * Date: 5/28/2016
 * Time: 8:12 AM
 */-->
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <title>ALCM - Alumni Linkage and Chat Module</title>
        <link href="<?php echo base_url() ?>asserts/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>asserts/css/style.css" rel="stylesheet">

    </head>
    <body class="home">

        <!-- Preloader
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
         
        <!-- HEADER -->
        <header class="header">
            <div class="container">
                <div class="col-xs-3">
                    <a href="<?php echo base_url() . 'User/Index' ?>" class="logo">ALCM</a>
                </div>
                <div class="col-xs-9">
                    <!-- Mainmenu -->
                    <nav class="navbar mainmenu">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                            <button type="button" class="pclose" data-toggle="collapse" data-target="#navbar-collapse"></button>
                            <ul class="nav navbar-nav pull-right">
                                <li class="dropdown">
                                    <a href="<?php echo base_url() . 'User/Index' ?>" >Home</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo base_url() . 'User/UpdateProfile' ?>" >Update Profile</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo base_url() . 'User/Chat' ?>" >Chat</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo base_url() . 'User/logout' ?>">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- /.mainmenu -->
                </div>
            </div>
        </header>
        <!-- /.header -->
