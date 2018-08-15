<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP MVC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/styles.css" />

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>

</head>
<body>

<div class="container">
    <div class="row">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($current_user): ?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $current_user->name; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile/view"><i class="icon-cog"></i> Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="/login"><i class="icon-off"></i> Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div id="sidebar" class="well sidebar-nav">
                <h5><small><b>MAIN</b></small></h5>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="/posts">Posts</a></li>
                    <li><a href="/posts/add-new">Add Post</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/posts">Posts</a></li>
            </ol>
            <!-- Content Here -->
            <?php echo $flash; ?>

            <?php include $view; ?>

            <?php //print("<pre>".print_r($current_user,true)."</pre>"); ?>
        </div>
    </div>
</div>

</body>
</html>