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

    <?php
      // initialize array of upcoming dates
      $dates = array();
      $dates_query = "SELECT DISTINCT showings.date FROM showings ORDER BY showings.date ASC";
      $exec_q = mysqli_query($dbc, $dates_query);
      if ($exec_q) {
        while ($date = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
          array_push($dates, $date['date']);
        }
      }
      // build tabs to navigate between days
    ?>

    <div class="row">
      <div class="col s12">
        <ul class="tabs tabs-fixed-width">
          <?php
            for ($i=1; $i<=7; $i++) {
              echo '<li class="tab" onclick="goToTab(' . $i . ')">
                <a href="#day' . $i . '">' . date('D n/j', strtotime($dates[$i-1])) . '</a>
              </li>';
            }
          ?>
        </ul>
      </div>
    </div>

    <?php
      // if an ID was posted through, list showtimes for that movie for selected date.
      // otherwise, get showtimes for the next 7 days sorted by time
      for ($i=1; $i<=7; $i++) {
        $loop_date = $dates[$i-1];
        $times_query = "SELECT showings.id, movie_id, showings.time, theater_id, available_seats FROM showings WHERE showings.date = '$loop_date'";
        if($flag) {
           $times_query .= " AND movie_id = $movie";
        }
        $times_query .= "  ORDER BY showings.time ASC";

        // echo $times_query;

        $results = array();
        $exec_q = mysqli_query($dbc, $times_query);
        if($exec_q) {
          // load results to memory
          while($time = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
            array_push($results, $time);
          }

          echo '<div id="day' . $i . '">';

          // iterate through cached rows, add array for each movie and add times to movie arrays
          $movies = array();
          foreach ($results as $time) {
            // $curr_movie = $time['movie_id'];

            $mov = $time['movie_id'];
            $dat = $loop_date;
            $tim = $time['time'];
            $formatted_time = $dat . ' ' . $tim;
            $the = $time['theater_id'];
            $sea = $time['available_seats'];
            $showID = $time['id'];

            if( !array_key_exists($mov, $movies)) {
              $movies[$mov] = array();
            }
            array_push($movies[$mov], new Showtime($formatted_time, $the, $sea, $showID));
            //print_r($movies);
          }

          // spit out results for each movie
          foreach ($movies as $title => $showing) {
            echo '

            <h4>' . $MOVIE_TITLES[$title] . '</h4>
            <ul class="collapsible" data-collapsible="expandable">';

            foreach ($showing as $s) {
              echo '
              <li>
                <div class="collapsible-header">' . date('g:i a', strtotime($s->time)) . '</div>
                <div class="collapsible-body">
                  <p>' . date('l, F d', strtotime($s->time)) . '<br />
                  Theater: ' . $s->theater . '<br />
                  Open seats: ' . $s->open_seats . '
                  </p>
                  <a href="order.php?showing=' . $s->ID . '" class="secondary-content">
                    <i class="material-icons large">keyboard_arrow_right</i>
                  </a>
                </div>
              </li>';
            }

            echo '
            </ul>';
          }
          echo '</div>';
        } else {
          echo "No showtimes found!";
        }
      }
    ?>
  </div>
</main>

<?php include('includes/footer.php'); ?>
