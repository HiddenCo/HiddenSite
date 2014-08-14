<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    @yield('metatag')
    @yield('style')
</head>

<body class="">
<div class="navbar navbar-default navbar-static-top">
    <style>
        .body{padding-top:70px}
    </style>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://listerr.co">
                <img src="https://listerr.co/images/Listerr-Logo-No-Slogan-sm.png" height="25px">
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active">
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/system/about">About Us</a>
                </li>
                <?php if(!Session::has('user_id')) {?>
                <li>
                    <a href="<?php echo URL::to('/')?>/pricing">Pricing</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/user/register">Register</a>
                </li>
                <?php }?>
                <?php if(Session::has('user_id')) {?>
                    <li>
                        <a href="<?php echo URL::to('/')?>/user">Members Area</a>
                    </li>
                <?php } ?>
                <li>
                    <?php if(!Session::has('user_id')) {?>
                        <a href="<?php echo URL::to('/')?>/user/login">Login</a>
                    <?php } else {?>
                        <a style="color: red;" href="<?php echo URL::to('/')?>/user/logout">Logout</a>
                    <?php }?>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="content_wapper">
    @yield('content')
</div>
@yield('script')
</body>
</html>