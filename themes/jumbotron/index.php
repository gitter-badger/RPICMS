<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../core/libs/theme_engine/BootStrap/favicon.ico">

    <title>RPICMS EXAMPLE THEME - Jumbotron Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../../core/libs/theme_engine/BootStrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../core/libs/theme_engine/BootStrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../theme_engine/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <?php 
  ?>



    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">RPICMS EXAMPLE THEME</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" action="../../core/admin/user/login_check.php" method="post">
            <div class="form-group">
              <input type="email" placeholder="Email" class="form-control" name="username" required="required" title="Please insert a valid Email (example@email.com)" x-moz-errormessage="Please insert a valid Email (example@email.com)">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password" required="required">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <?php
            require('../../core/backend/blog/posts.php');
          ?>
          <header>
          <div class="bubble"><a href="#">4</a></div>
            <h2 class="title">
              <?php
                echo "<a href='#' rel='bookmark'> $post_title </a>";
              ?>
            </h2>
            <div class="post-info">
              <?php
                echo "<span class='theauthor'><a href='#' rel='author'>$post_author</a></span>";
                echo "<time>$post_date</time>";
                echo "<span class='thecategory'><a href='#' rel='category tag'>$post_categrory</a></span>";
              ?>
            </div>
          </header><!--.header-->
          <div class="post-content image-caption-format-1">
            <a href="#" rel="nofollow" id="featured-thumbnail">
             
            <div class="featured-thumbnail"><img src="images/2457315858_32ffd98aec_n-150x150.jpg" class="attachment-featured wp-post-image" height="150" width="150"><div>
            </a>
            <?php
              echo "$post_text";
            ?>
          </div>
        <p><a class="btn btn-primary btn-lg" href="http://rpicms.readthedocs.org/de/develop/features/themes.html" role="button">Learn more &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; RpicmsTeam 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../core/libs/theme_engine/BootStrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../core/libs/theme_engine/BootStrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>