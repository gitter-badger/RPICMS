<?php 
  #######################
  # flush browser cache #
  #######################
  header("Cache-Control: no-cache, must-revalidate, no-store");
  ##########################
  # include required files #
  ##########################
  $error = "0";
  $empty = empty($_GET["id"]);
  if (!$empty){
    $id = $_GET["id"];
  }
  include('../../core/config/variables.config.php');

  ################
  # lang support #
  ################
  function getBrowserLangs() {  
    $langs[0] = $langs[1] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);  
    $langs[0] = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);  
    foreach($langs[0] as $l) {  
      $q = explode(';', $l);  
      $lang = substr($q[0], 0, 2);  
      $q = (isset($q[1])) ? (float)substr($q[1], 2) : 1;  
      $result[$lang] = $q;   
    }  
    if(isset($result) && is_array($result)) {  
      arsort($result, SORT_NUMERIC);    
      return $result;  
    }   
      return $result[$langs[1]] = 1;    
  }  

    $langs = getBrowserLangs();  
    foreach($langs as $prio => $lang) {  
      if($lang = 'de') {  
        include('lang/de-DE.php');  
        break;  
      } elseif($lang = 'en') {  
        include('lang/en-US.php');  
        break;   
      }   
       // AND SO ON .................  
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
    <link rel="icon" href="../../core/libs/theme_engine/BootStrap/favicon.ico">
    
    <?php
    echo "<title>$blog_name</title>";
    ?>

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

    <script type="text/javascript">
      function Go(select) {
        var wert = select.options[select.selectedIndex].value;
        if (wert == "leer") {
          select.form.reset();
          parent.frames["unten"].focus();
          return;
        } else {
          if (wert == "ende") {
            top.location.href = parent.frames[1].location.href;
          } else {
            parent.frames["unten"].location.href = wert;
           select.form.reset();
          parent.frames["unten"].focus();
          }
        }
        alert(wert);
      }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php
          echo '<a class="navbar-brand" href="index.php">'.$blog_name.'</a>';
          ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" action="../../core/backend/admin/user/login_check.php" method="post">
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
        $x = 1;
        if ($empty){
          $id = 1;
          include('../../core/backend/blog/posts.php');
          while ($x < $post_id_clean+1){
            include('../../core/config/connect.db.inc.php');
            echo "
              <h1>
                <a href='index.php?id=$id' rel='bookmark'> $post_title </a>
              </h1>
              <div>
                <h4>
                  <span class='theauthor'><a href='#' rel='author'>$post_author</a></span> | 
                  <time>$post_date</time> | 
                  <span class='thecategory'><a href='#' rel='category tag'>$post_categrory</a></span></br>
                </h4>
              </div>
              <div>
                <p>
                  $post_text_short</br>
                </p>
              </div>
              <p>
                <a class='btn btn-primary btn-lg' href='index.php?id=$id' role='button'>$name_more &raquo;</a>
              </p>
            ";
            $x = $x+1;
            $id = $id+1;
            next_id();
          }
        }else{
            include('../../core/backend/blog/posts.php');
            echo "
              <h1>
                <a href='index.php?id=$id' rel='bookmark'> $post_title </a>
              </h1>
              <div>
                <h4>
                  <span class='theauthor'><a href='#' rel='author'>$post_author</a></span> | 
                  <time>$post_date</time> | 
                  <span class='thecategory'><a href='#' rel='category tag'>$post_categrory</a></span></br>
                </h4>
              </div>
              <div>
                <p>
                  $post_text</br>
                </p>
              </div>
            ";
        }
      ?>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?php
          echo '
            <div class="col-md-4">
              <h2>'.$name_themes.'</h2>
              <form action=".">
                <p><select size="1" name="Auswahl" onchange="Go(this);" width="100%"">
                  <option value="leer" selected="selected">[ bitte auswählen! ]</option>
                  <option value="leer">------------------------</option>
                  <option value="../jumbotron">Jumbotron</option>
                  <option value="../accentbox">Accentbox</option>
                  <option value="../parkzone">ParkZone</option>
                  <option value="../zResponsiv">zResponsiv</option>
                  <option value="ende">Beenden</option>
                </select></p>
              </form>
              <p><a class="btn btn-default" href="#" role="button">'.$name_details.' &raquo;</a></p>
            </div>
            <div class="col-md-4">
              <h2>'.$name_archiv.'</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">'.$name_details.' &raquo;</a></p>
            </div>
            <div class="col-md-4">
              <h2>'.$name_meta.'</h2>
              <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
              <p><a class="btn btn-default" href="#" role="button">'.$name_details.' &raquo;</a></p>
          ';
          ?>
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
