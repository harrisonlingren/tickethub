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
          $addDate = $date['date'];
          echo $addDate . "<br />";
          array_push(
            $dates,
            date('Y-m-d', strtotime($addDate))
          );
        }
      }

      //print_r($dates);

    // build tabs to navigate between days
    ?><div class="row">
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
      $date1 = $dates[0]; $date2 = $dates[6];

      //print_r($dates);

      $times_query = "SELECT showings.id, movie_id, showings.time, theater_id,
      available_seats FROM showings
      WHERE showings.date between '$date1' and '$date2'";

      if($flag) {
         $times_query .= " AND movie_id = $movie";
      }
      $times_query .= "  ORDER BY showings.time ASC";

      echo $times_query;

      $results = array();
      $exec_q = mysqli_query($dbc, $times_query);
      if($exec_q) {

        // init results array with results
        while($time = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
          array_push($results, $time);
        }

        // iterate through cached rows, add showtime array for each movie and add showings into each movie array
        $movies = array();
        foreach ($results as $time) {
          $mov = $time['movie_id'];
          $dat = $time['date'];
          $tim = $time['time'];
          $formatted_time = $dat . ' ' . $tim;
          $the = $time['theater_id'];
          $sea = $time['available_seats'];
          $showID = $time['id'];

          if( !array_key_exists($mov, $movies)) {
            $movies[$mov] = array();
          }
          array_push($movies[$mov], new Showtime($formatted_time, $the, $sea, $showID));
        } //print_r($movies);

        // build arrays for each set of showings and save to session
        $dailyshowings = array();
        if (!isset($_SESSION['showings'])) {
          $_SESSION['showings'] = array();
        }

        for ($i=1; $i<=7; $i++) {
          $dailyshowings[$i] = array_filter($movies, function($showing) {
            return ($showing['date'] == $dates[$i-1]);
          });

          if (!isset($_SESSION['showings'][$i])) {
            $_SESSION['showings'][$i] = array();
          }

          $_SESSION['showings'][$i] = $dailyshowings[$i];
        }

        for ($i=1; $i<=7; $i++) {
          echo '<div id=day' . $i . '>';
          foreach ($dailyshowings[$i] as $title => $showing) {
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
                    <i class="material-icons">keyboard_arrow_right</i>
                  </a>
                </div>
              </li>';
            }
            echo '
            </ul>';
          }
          echo '
          </div>';
        }

      } else {
        echo "No showtimes found!";
      }
    ?>
  </div>
</main>

<?php include('includes/footer.php'); ?>
