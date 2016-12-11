<?php
  include('incluides/header.php');
  include('includes/check_account.php');

  // determine origin:
  //  if POST, retrieve order data from submission, create order record, and reduce ticket count
  if ( $_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['showID']) && isset($_POST['tickets']) ) {
    $showID = $_POST['showID'];
    $tickets = $_POST['tickets'];
    $check_edit = $_POST['checkEdit'];

    // find amount of tickets available before new order / edit
    $get_available_tix = "SELECT available_seats FROM showings where showtimes.id = $showID";
    $exec_q = mysqli_query($dbc, $get_available_tix);
    if ($exec_q) {
      $availableTixA = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $availableTix = $availableTixA['tickets'];
    }

    // check if editing, and create query and change in open tickets accordingly
    if ($check_edit == 1) {
      // find amount of tickets from original order
      $get_original_tix = "SELECT tickets FROM orders where orders.showing_id = $showID";
      $exec_q = mysqli_query($dbc, $get_original_tix);
      if ($exec_q) {
        $originalTixA = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
        $originalTix = $originalTixA['tickets'];
      }

      $order_q = "UPDATE orders SET tickets='$tickets'";
      $amountTixChanged = (((int) $originalTix) - ((int)($tickets)));
    } else {
      $order_q = "INSERT INTO orders (showing_id, tickets, user_id) VALUES ('$showID', '$tickets', '$userID')";
      $amountTixChanged = (int) $tickets;
    }

    // create / update order
    $exec_q = mysqli_query($dbc, $order_q);
    if (!$exec_q) {
      echo "Not today, sorry. Error was here: $order_q";
    }

    // update total tickets for showing
    $update_tix = "UPDATE showtimes SET tickets='$amountTixChanged' WHERE showtimes.id='$showID'";
    $exec_q = mysqli_query($dbc, $update_tix);
    if (!$exec_q) {
      echo "Not today, sorry. Error was here: $update_tix";
    }


  // if GET (edit), retrieve ID of order to be edited and load values into form. Specify whether editing or creating via hidden flag.
  } else if (isset($_GET['edit'])) {
    $orderID = $_GET['edit'];
    $flag = true;

    $get_order_q = "SELECT orders.id, tickets, showing_id FROM orders WHERE orders.id = '$orderID' and orders.user_id = '$userID'";
    $count = count(mysqli_fetch_array($exec_q, MYSQLI_ASSOC));
    echo $get_order_q;
    if ($exec_q) {
      $order = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $showID = $order['showing_id'];
      echo "<br />Grabbed showing ID: " . $order['showing_id'] . "<br />";
    } else {
      echo "\n<h5>Order #$orderID not found for user #$userID. \nQuery used: $get_order_q</h5> \nRecords found: $count";
    }

  // if GET (showing), retrieve showing ID to fill in showing field
  }

?>
