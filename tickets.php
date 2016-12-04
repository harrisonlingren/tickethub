<?php
  include('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flag = TRUE;
    $movie = $_POST['movieId'];
    echo 'Movie ID from previous page: ' . $movie;
  } else {
    $flag = FALSE;
    echo 'Looks like you came here on your own. Hello!';
  }
?>

<div class="container">
  <ul class="collection with-header">
    <li class="collection-header"><h4>Available Showtimes</h4></li>
    <?php
      // if an ID was posted through, list showtimes for that movie.
      // otherwise, list all showtimes by date
      $times_query = "SELECT showings.date, showings.time, theater_id, available_seats FROM showings";

      if($flag) {
         $times_query .= "WHERE movie_id = $movie";
      }

      $exec_q = mysqli_query($dbc, $times_query);
      if($exec_q) {
        while($time = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
          echo '<li class="collection-item">
            <span class="title">' . $time['time'] . '</span>
            <p>' . $time['date'] . ', ' . $time['date'] . '<br />
            Open seats: ' . $time['available_seats'] . '
            </p>
            <a href="#" class="secondary-content">
              <i class="material-icons">keyboard arrow right</i>
            </a>
          </li>' . "\n";
        }
      }
    ?>
  </div>

</div>

<?php
  include('../includes/footer.php');
?>
