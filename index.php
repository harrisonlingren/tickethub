<?php
  include('includes/header.php');
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3>Home</h3>
      </div>
    </div>
    <div class="row action-call">
      <div class="col s12 m4">
        <div class="card-panel">
          <i class="material-icons large">movie</i>
          <a href="movies.php"><h4>Now Playing</h4></a>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card-panel">
          <i class="material-icons large">watch_later</i>
          <a href="showtimes.php"><h4>Showtimes</h4></a>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card-panel">
          <i class="material-icons large">info</i>
          <a href="showtimes.php"><h4>About Us</h4></a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
  include('includes/footer.php');
?>
