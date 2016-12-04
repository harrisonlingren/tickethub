<?php
  include('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['search']) {
    $flag = TRUE;
    $query = $_GET['search'];
  } else {
    $flag = FALSE;
    // echo 'Looks like you came here on your own. Hello!';
    echo 'No search!';
  }
?>

<main>
  <div class="container">
    <form method="GET" action="showtimes.php" id="moviePicker">
      <div class="row">
        <div class="col s12">
          <h4>Results for "<?php echo $query; ?>"</h4>
        </div>

      <?php
        $img_base = 'https://image.tmdb.org/t/p/w500';

        if ($flag) {
          $movies_query = 'SELECT movies.id, title, summary, release_date, genre, genre_extra, rating, backdrop_url FROM movies
                          WHERE title LIKE "%' . $query . '%"
                          ORDER BY release_date DESC';
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

            if(strlen($movie['summary']) > 150) {
              $summary = substr($movie['summary'], 0, 147) . '...';
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
                  <b>' . $movie['rating'] . ' | ' . $genres . '</b>
                  <p>' . $summary . '</p>
                </div>
                <div class="card-action waves-effect">
                  <a href="#" onclick="' . "goToMovie('" . $movie['id'] . "')" . '">Tickets</a>
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
