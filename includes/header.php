<?php
  //include('error_report.php');
  include('db_connect.php');
  include('showtime.php');
  include('error_report.php');

  // start a session
  session_start();

  // check if logged in and set flag
  if ( isset($_SESSION['userID']) ) {
    $logged_in = true;
  } else {
    $logged_in = false;
  }
?>

<html>
  <head>
    <script src="js/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/materialize.min.js"></script>
    <link rel="stylesheet" href="css/materialize.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <meta name="viewport" content="width=device-width">
    <title>TicketHub</title>
  </head>
  <body>
    <header>
      <div class="navbar-fixed">
        <nav>
         <div class="nav-wrapper">
           <div class="col s12">
             <a href="index.php" class="brand-logo">TicketHub</a>
             <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
             <ul id="nav-mobile" class="right hide-on-med-and-down">
               <li><a href="movies.php">Movies</a></li>
               <li><a href="showtimes.php">Showtimes</a></li>
               <li><a href="about.php">About</a></li>
               <?php
                if ($logged_in) {
                  echo '<li><a href="account.php">Account</a></li>';
                  echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                  echo '<li><a href="login.php">Login</a></li>';
                  echo '<li><a href="signup.php">Sign Up</a></li>';
                }
               ?>
               <li><form method="GET" action="movies.php">
                <div class="input-field">
                  <input id="search" name="q" type="search" required>
                  <label for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>
              </form></li>
             </ul>
           </div>
           <ul class="side-nav" id="mobile-menu">
             <li><h5>TicketHub</h5></li>
             <li><a class="waves-effect" href="movies.php">Movies</a></li>
             <li><a class="waves-effect" href="showtimes.php">Showtimes</a></li>
             <li><a class="waves-effect" href="about.php">About</a></li>
             <hr />
             <?php
              if ($logged_in) {
                echo '<li><a href="account.php" class="waves-effect">Account</a></li>';
                echo '<li><a href="logout.php" class="waves-effect">Logout</a></li>';
              } else {
                echo '<li><a href="login.php" class="waves-effect">Login</a></li>';
                echo '<li><a href="signup.php" class="waves-effect">Sign Up</a></li>';
              }
             ?>
           </ul>
         </div>
       </nav>
      </div>
    </header>

    <?php
      $MOVIE_TITLES = array();
      $get_query = 'SELECT movies.id, title, summary, release_date, genre, genre_extra, rating, backdrop_url
                      FROM movies ORDER BY movies.id';
      $exec_q = mysqli_query($dbc, $get_query);
      if ($exec_q) {
        while ($movie = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
          $MOVIE_TITLES[$movie['id']] = $movie['title'];
        }
      }
    ?>
