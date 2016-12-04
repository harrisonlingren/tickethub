<?php
  include('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['movieId']) {
    $flag = TRUE;
    $movie = $_GET['movieId'];
    // echo 'Movie ID from previous page: ' . $movie;
  } else {
    $flag = FALSE;
    // echo 'Looks like you came here on your own. Hello!';
  }
?>

<main>
  <div class="container">
    <h3>Available Showtimes</h3>
    <div class="collapsible" data-collapsible="accordian">

    <?php
      // if an ID was posted through, list showtimes for that movie.
      // otherwise, list all showtimes by date
      $times_query = "SELECT movie_id, showings.date, showings.time, theater_id, available_seats FROM showings ORDER BY showings.time ASC";

      if($flag) {
         $times_query .= " WHERE movie_id = $movie";
      }

      $results = array();
      $exec_q = mysqli_query($dbc, $times_query);
      if($exec_q) {
        // load results to memory
        while($time = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
          array_push($results, $time);
        }

        $movies = array();

        // iterate through cached rows, add array for each movie and add times to movie arrays
        foreach ($results as $time) {
          // $curr_movie = $time['movie_id'];

          $mov = $time['movie_id'];
          $dat = $time['date'];
          $tim = $time['time'];
          $formatted_time = $dat . ' ' . $tim;
          $the = $time['theater_id'];
          $sea = $time['available_seats'];

          if( !array_key_exists($mov, $movies)) {
            $movies[$mov] = new Movie($mov, array(), $the, $sea);
          }
          $movies[$mov]->addTime($formatted_time);
          //print_r($movies);
        }

        // spit out results for each movie
        foreach ($movies as $showing) {
          echo '
              <div class="collapsible-header"><h4>' . $showing->movie . '</h4></div>
              <div class="collapsible-body">
                <div class="collapsible" data-collapsible="expandable">' . "\n";

          foreach ($showing->times as $time) {
            echo '<div class="collapsible-header">' . date('g:i a', strtotime($time)) . '</div>
              <div class="collapsible-body">
                <p>' . date('l, F d', strtotime($time)) . '<br />
                Open seats: ' . $showing->open_seats . '
                </p>
                <a href="#" class="secondary-content">
                  <i class="material-icons">keyboard_arrow_right</i>
                </a>
              </div>' . "\n";
          }

          echo '            </div>
          </div>' . "\n";
        }
      } else {
        echo "No showtimes found!";
      }

      /*

      */


    ?>
    </ul>
  </div>
</main>

<?php
  include('includes/footer.php');
?>
