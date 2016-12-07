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
      <div class="col s12 l4">
        <div class="card-panel">
          <a href="movies.php">
            <i class="material-icons large">movie</i>
            <h4 class="grey-text darken-4">Now Playing</h4>
          </a>
        </div>
      </div>
      <div class="col s12 l4">
        <div class="card-panel">
          <a href="showtimes.php">
            <i class="material-icons large">watch_later</i>
            <h4 class="grey-text darken-4">Showtimes</h4>
          </a>
        </div>
      </div>
      <div class="col s12 l4">
        <div class="card-panel">
          <a href="about.php">
            <i class="material-icons large">info</i>
            <h4 class="grey-text darken-4">About Us</h4>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
  include('includes/footer.php');
?>
