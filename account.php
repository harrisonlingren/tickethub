<?php include('includes/header.php');
  if (!$logged_in) {
    echo '<script>window.location = "https://blue.butler.edu/~hlingren/CME419/tickethub/login.php";</script>';
  } else {
    $userID = $_SESSION['userID'];
    $user_q = "SELECT firstname, lastname, email FROM users WHERE users.id = ''$userID'";

    $exec_q = mysqli_query($dbc, $user_q);
    if ($exec_q) {
      $infodata = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $firstname = $infodata['firstname'];
      $lastname = $infodata['lastname'];
      $email = $infodata['email'];

      $welcome_header = "Welcome, $firstname!";
    } else {
      echo "<h3>Error: Cannot access account information. Please try again.</h3>
      <script>/*window.location = 'https://blue.butler.edu/~hlingren/CME419/tickethub';*/</script>";
      $welcome_header = "";
    }
  }
?>


<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3><?php echo $welcome_header ?></h3>;
      </div>
    </div>

    <div class="row">

      <div class="card-panel col s12 m6 l4">
        So many account options
      </div>

      <div class="card-panel col s12 m6 l4">
        Oh yeah
      </div>

      <div class="card-panel col s12 m6 l4">
        Real cool
      </div>

      <div class="card-panel col s12 m6 l4">
        Very robust
      </div>

      <div class="card-panel col s12 m6 l4">
        Another one!
      </div>



    </div>
  </div>
</main>



<?php include('includes/footer.php'); ?>
