<?php
  /**
  * Jumbotron Theme for RPICMS
  *
  * @author Marcel Radzio <info@nordgedanken.de>
  * @version  1.0dev 1/12/2014 17:16
  */

  ###############################
  # include files from root dir #
  ###############################
  $root_1 = realpath($_SERVER["DOCUMENT_ROOT"]);
  $currentdir = getcwd();
  $root_2 = str_replace($root_1, '', $currentdir);
  $root_3 = explode("/", $root_2);
  if ($root_3[1] == 'core') {
    echo $root_3[1];
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
  }else{
    $root = $root_1 . '/' . $root_3[1];
  }

  #######################
  # flush browser cache #
  #######################
  header("Cache-Control: no-cache, must-revalidate, no-store");

  ###################
  # check variables #
  ###################
  $error = "0";
  $empty_id = empty($_GET["id"]);
  $empty_category = empty($_GET["category"]);
  $empty_author = empty($_GET["author"]);
  if (!$empty_id){
    $id = $_GET["id"];
  }else{
    $id = 1;
  }
  if (!$empty_category){
    $category = $_GET["category"];
  }else{
    $category = "";
  }
  if (!$empty_author){
    $author = $_GET["author"];
  }else{
    $author = "";
  }

  ##########################
  # include required files #
  ##########################
  include($root . '/core/config/variables.config.php');

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
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="../../core/libs/theme_engine/BootStrap/favicon.ico">
    <?php echo "<title>$blog_name</title>";?>

    <!-- Bootstrap core CSS -->
    <script src="../../core/libs/theme_engine/jquery/jquery2.1.3.min.js"></script>
    <link href="../../core/libs/theme_engine/BootStrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="jumbotron.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../core/libs/theme_engine/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../core/libs/theme_engine/bootstrap-social/bootstrap-social.min.css">

    <?php include($root . '/core/backend/admin/modules/html_header.php');?>

    <!--[if lt IE 9]><script src="../../core/libs/theme_engine/BootStrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      function Go (select) {
        var wert = select.options[select.options.selectedIndex].value;
        if (wert == "leer") {
          select.form.reset();
          parent.frames["unten"].focus();
          return;
        } else {
          if (wert == "ende") {
            top.location.href = location.href;
          } else {
            location.href = wert;

          }
        }
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
          <?php echo '<a class="navbar-brand" href="index.php">'.$blog_name.'</a>';?>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
          <div class="navbar-form navbar-right"><?php include($root . '/core/backend/admin/modules/navigation.php');?></div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <?php
          $x = 1;
          if ($empty_id && $empty_category && $empty_author){
            include($root . '/core/backend/blog/posts.php');
            while ($x < $post_id_clean+1){
              include($root . '/core/config/connect.db.inc.php');
              echo "
                <script  type=\"text/javascript\">
                  document.title = \"$blog_name | Home\";
                </script>
                <h1>
                  <a href='index.php?id=$id' rel='bookmark'> $post_title </a>
                </h1>
                <div>
                  <h4>
                    <span class='theauthor'><a href='index.php?author=$post_author' rel='author'>$post_author</a></span> | <time>$post_date</time> | <span class='thecategory'><a href='index.php?category=$post_category' rel='category tag'>$post_category</a></span></br>
                  </h4>
                </div>
                <div>
                  <p>$post_text_short</br></p>
                </div>
                <div>
              ";
              include($root . '/core/backend/admin/modules/post_footer.php');
              echo "
                </div>
                <p>
                  <a class='btn btn-primary btn-lg' href='index.php?id=$id' role='button'>$name_more &raquo;</a>
                </p>
              ";
              $x = $x+1;
              $id = $id+1;
              next_id_only();
            }
          }else{
            if ($category){
              $id = 1;
              include($root . '/core/backend/blog/posts.php');
              while ($x < $category_id_clean+1){
                include($root . '/core/config/connect.db.inc.php');
                if($post_category != $category){
                  $x = $x+1;
                  $id = $id+1;
                  next_id_category();
                }else{
                  echo "
                    <script  type=\"text/javascript\">
                      document.title = \"$blog_name | $post_category\";
                    </script>
                    <h1>
                      <a href='index.php?id=$id' rel='bookmark'> $post_title </a>
                    </h1>
                    <div>
                      <h4>
                        <span class='theauthor'><a href='index.php?author=$post_author' rel='author'>$post_author</a></span> | <time>$post_date</time> | <span class='thecategory'><a href='index.php?category=$post_category' rel='category tag'>$post_category</a></span></br>
                      </h4>
                    </div>
                    <div>
                      <p>$post_text_short</br></p>
                    </div>
                    <div>
                  ";
                  include($root . '/core/backend/admin/modules/post_footer.php');
                  echo "
                    </div>
                    <p>
                      <a class='btn btn-primary btn-lg' href='index.php?id=$id' role='button'>$name_more &raquo;</a>
                    </p>
                  ";
                  $x = $x+1;
                  $id = $id+1;
                  next_id_category();
                }
              }
            }else{
              if ($author){
                $id = 1;
                include($root . '/core/backend/blog/posts.php');
                  while ($x < $author_id_clean+1){
                  include($root . '/core/config/connect.db.inc.php');

                  if($post_author != $author){
                    $x = $x+1;
                    $id = $id+1;
                    next_id_author();
                  }else{
                    echo "
                      <script  type=\"text/javascript\">
                        document.title = \"$blog_name | $post_author\";
                      </script>
                      <h1>
                        <a href='index.php?id=$id' rel='bookmark'> $post_title </a>
                      </h1>
                      <div>
                        <h4>
                          <span class='theauthor'><a href='index.php?author=$post_author' rel='author'>$post_author</a></span> | <time>$post_date</time> | <span class='thecategory'><a href='index.php?category=$post_category' rel='category tag'>$post_category</a></span></br>
                        </h4>
                      </div>
                      <div>
                        <p>$post_text_short</br></p>
                      <div>
                    ";
                    include($root . '/core/backend/admin/modules/post_footer.php');
                    echo "
                      </div>
                      <p>
                        <a class='btn btn-primary btn-lg' href='index.php?id=$id' role='button'>$name_more &raquo;</a>
                      </p>
                    ";
                    $x = $x+1;
                    $id = $id+1;
                    next_id_author();
                  }
                }
              }else{
                include($root . '/core/backend/blog/posts.php');
                echo "
                  <script  type=\"text/javascript\">
                    document.title = \"$blog_name | $post_title\";
                    document.getElementById(\"author\").setAttribute(\"content\", \"$post_author\");
                  </script>
                  <h1>
                    <a href='index.php?id=$id' rel='bookmark'> $post_title </a>
                  </h1>
                  <div>
                    <h4>
                      <span class='theauthor'><a href='index.php?author=$post_author' rel='author'>$post_author</a></span> | <time>$post_date</time> | <span class='thecategory'><a href='index.php?category=$post_category' rel='category tag'>$post_category</a></span></br>
                    </h4>
                  </div>
                  <div>
                    <p>$post_text</br></p>
                  </div>
                  <div>
                ";
                include($root . '/core/backend/admin/modules/post_footer.php');
                echo "
                  </div>
                ";
              }
            }
          }
        ?>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row" style="overflow: hidden; float:left;">
        <?php
          $dirs = scandir($root . "/themes");
          $ausnahmen["1"] = ".htaccess";
          $ausnahmen["2"] = ".";
          $ausnahmen["3"] = "..";
          $dirs = array_diff($dirs, $ausnahmen);

          echo '
            <div class="col-md-4" style="padding-bottom: 1000px; margin-bottom: -1000px; float:left;">
              <h2>'.$name_themes.'</h2>
              <form action=".">
                <p><select size="1" name="Auswahl" onchange="Go(this);" width="100%" class="form-control">
                  <option value="leer" selected="selected">[ bitte auswählen! ]</option>
                  <option value="leer">------------------------</option>
          ';
          foreach($dirs as $dir){
            $dir_name = ucwords($dir);
            echo "
              <option value=\"../$dir\">$dir_name</option>
            ";
          }
          echo '
                  <option value="leer">------------------------</option>
                  <option value="ende">Beenden</option>
                </select></p>
              </form>
              <p><a class="btn btn-default" href="#" role="button" style="position:relative; margin-bottom:0%;">'.$name_details.' &raquo;</a></p>
            </div>
            <div class="col-md-4" style="padding-bottom: 1000px; margin-bottom: -1000px;" float:left;>
              <h2>'.$name_archiv.'</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button" style="position:relative; margin-bottom:0%;">'.$name_details.' &raquo;</a></p>
            </div>
            <div class="col-md-4" style="padding-bottom: 1000px; margin-bottom: -1000px;" float:left;>
              <h2>'.$name_meta.'</h2>
              <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
              <p><a class="btn btn-default" href="#" role="button" style="position:relative; margin-bottom:0%;">'.$name_details.' &raquo;</a></p>
          ';
          ?>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; RpicmsTeam 2014 &amp; 2015</p>
        <?php include($root . '/core/backend/admin/modules/footer.php'); ?>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../core/libs/theme_engine/BootStrap/js/bootstrap.min.js"></script>
    <?php include($root . '/core/backend/admin/modules/script_footer.php'); ?>
  </body>
</html>
