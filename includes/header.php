<?php
  include('error_report.php');
  include('db_connect.php');
  include('showtime.php');
?>

<html>
  <head>
    <link rel="stylesheet" href="css/materialize.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <header>
      <div class="navbar-fixed">
        <nav>
         <div class="nav-wrapper">
           <a href="index.php" class="brand-logo">TicketHub</a>
           <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
           <ul id="nav-mobile" class="right hide-on-med-and-down">
             <li><h3 class="brand-logo">TicketHub</h3></li>
             <li><a href="movies.php">Movies</a></li>
             <li><a href="showtimes.php">Showtimes</a></li>
             <li><a href="about.php">About</a></li>
             <li><form method="GET" action="movies.php">
              <div class="input-field">
                <input id="search" name="search" type="search" required>
                <label for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form></li>
           </ul>
           <ul class="side-nav" id="mobile-menu">
             <li><a class="waves-effect" href="movies.php">Movies</a></li>
             <li><a class="waves-effect" href="showtimes.php">Showtimes</a></li>
             <li><a class="waves-effect" href="about.php">About</a></li>
           </ul>
         </div>
       </nav>
      </div>
    </header>
