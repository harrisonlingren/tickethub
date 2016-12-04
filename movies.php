<?php
  include('includes/header.php');
?>


<?php
  $img_base = 'https://image.tmdb.org/t/p/w500';

  $movies_query = "SELECT movies.id, title, summary, release_date, genre, genre_extra, rating, backdrop_url FROM movies ORDER BY release_date DESC";
  $exec_q = mysqli_query($dbc, $movies_query);

  if($exec_q) {
    while($movie = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
      echo '<div class="card large">
        <div class="card-image">
          <img src="' . $img_base . $movie['backdrop_url'] . '" />
          <span class="card-title">' . $movie['title'] . '</span>
        </div>
        <div class="card-content">
          <h3>' . $movie['rating'] . ' | ' . $movie['genres'] . '</h3>
          <p>' . $movie['summary'] . '</p>
        </div>
        <div class="card-action">
          <a href="#">Tickets</a>
        </div>
      </div>';
    }
  }












  include('includes/footer.php');
?>
