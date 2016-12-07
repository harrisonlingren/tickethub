<?php
include('db_connect.php');

if (!isset($_SESSION['userID'])) {
  echo '<script>window.location = "https://blue.butler.edu/~hlingren/CME419/tickethub/login.php";</script>';
} else {
  $userID = $_SESSION['userID'];
  $user_q = "SELECT firstname, lastname, email FROM users WHERE users.id = '$userID'";

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
