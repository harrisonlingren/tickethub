<?php
  include('includes/header.php');
  include('includes/footer.php');

  if ($logged_in) {
    session_unset();
    session_destroy();
  }

  header("Location: https://blue.butler.edu/~hlingren/CME419/tickethub");
  die();
?>
