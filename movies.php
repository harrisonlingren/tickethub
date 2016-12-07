<?php
  include('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['q']) {
    $flag = TRUE;
    $query = $_GET['q'];
  } else {
    $flag = FALSE;
    // echo 'No search!';
  }
?>

<div class="fixed-action-btn toolbar">
  <a class="btn-floating btn-large orange accent-2">
    <i class="large material-icons">search</i>
  </a>
  <ul>
    <li class="waves-effect waves-light">
    <form method="GET" action="movies.php">
      <input id="search" name="q" type="search" placeholder="Enter a movie title!" required>
      <label for="search"><i class="material-icons">search</i></label>
      <i class="material-icons">close</i>
    </form>
    </li>
  </ul>
</div>

<main>
  <div class="container">
    <form method="GET" action="showtimes.php" id="moviePicker">
      <div class="row">

      <?php
        $img_base = 'https://image.tmdb.org/t/p/w500';

        if ($flag) {
          $movies_query = 'SELECT movies.id, title, summary, release_date, genre, genre_extra, rating, backdrop_url FROM movies
                          WHERE title LIKE "%' . $query . '%"
                          ORDER BY release_date DESC';

          echo '  <div class="col s12">
              <h4>Results for "' . $query .'"</h4>
            </div>
          </div>

          <div class="row">' . "\n";
        } else {
          $movies_query = 'SELECT movies.id, title, summary, release_date, genre, genre_extra, rating, backdrop_url
                          FROM movies ORDER BY release_date DESC';
        }

        $exec_q = mysqli_query($dbc, $movies_query);
        $count = 0;

        if($exec_q) {
          while($movie = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
            $genres = $movie['genre'];
            if($movie['genre_extra']) {
              $genres .= ', ' . $movie['genre_extra'];
            }

            if(strlen($movie['summary']) > 115) {
              $summary = substr($movie['summary'], 0, 112) . '...';
            } else {
              $summary = $movie['summary'];
            }

            /*if($count % 3 == 0) {
              echo '</div><div class="row">' . "\n";
            }*/

            echo '<div class="col s12 m6 l4">
              <div class="card medium">
                <div class="card-image">
                  <img src="' . $img_base . $movie['backdrop_url'] . '" />
                  <span class="card-title"><h5>' . $movie['title'] . '</h5></span>
                </div>
                <div class="card-content">
                  <b>' . date('F j, Y', strtotime($movie['release_date'])) . '<br />
                  ' . $movie['rating'] . ' | ' . $genres . '</b>
                  <p>' . $summary . '</p>
                </div>
                <div class="card-action waves-effect" onclick="' . "goToMovie('" . $movie['id'] . "')" . '">
                  <a>Tickets</a>
                </div>
              </div>
            </div>' . "\n";
            $count += 1;
          }
        }
      ?>
      </div>
      <input type="hidden" value="" name="movieId" id="movieId" />
    </form>
  </div>
</main>

<script>
  function goToMovie(id) {
    $('#movieId').val(id);
    $('#moviePicker').submit();
  }
</script>

<?php
  include('includes/footer.php');
?>
