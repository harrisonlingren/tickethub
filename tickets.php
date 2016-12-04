<?php
  include('includes/header.php');

  

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo 'Movie ID from previous page: ' . $_POST['movieId'];
  } else {
    echo 'Looks like you came here on your own. Hello!';
  }
?>
