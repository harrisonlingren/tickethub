<?php
  // include('error_report.php');
  include('db_connect.php');
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
           <ul id="nav-mobile" class="right hide-on-med-and-down">
             <li><a href="movies.php">Movies</a></li>
             <li><a href="tickets.php">Showtimes</a></li>
             <li><a href="about.php">About</a></li>
             <li><form method="GET" action="movies.php">
              <div class="input-field">
                <input id="search" name="search" type="search" required>
                <label for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form></li>
           </ul>
         </div>
       </nav>
      </div>
    </header>
