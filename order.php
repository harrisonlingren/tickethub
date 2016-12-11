<?php
  include('includes/header.php');
  include('includes/check_account.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['time'])) {
    $newTime = $_POST['time'];
    $newTickets = $_POST['tickets'];
    $orderID = $_POST['order'];
    $date = $_POST['date'];

    $get_order = "SELECT orders.showing_id, orders.tickets FROM orders
                     WHERE orders.id = $orderID";
    $exec_q = mysqli_query($dbc, $get_order);
    if ($exec_q) {$result = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);} else { echo "Query failed: " . $get_order;}

    $oldShowtime = $result['showing_id'];
    $oldTickets = $result['tickets'];
    $update_q1 = "UPDATE showings SET available_seats = available_seats + $oldTickets WHERE id = $oldShowtime";
    $exec_q = mysqli_query($dbc, $update_q1);
    if (!$exec_q) {echo "Query failed: " . $update_q1 . "<br />";}

    $get_new_showtime = "SELECT showings.id FROM showings WHERE date = '$date' and time = '$newTime' and available_seats > 0";
    //echo $get_new_showtime;
    $exec_q = mysqli_query($dbc, $get_new_showtime);
    if ($exec_q) {
      while ($result = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
        $newShowtime = $result['id'];
      }
    } else { echo "Query failed: " . $get_new_showtime;}

    $update_q2 = "UPDATE showings SET available_seats = available_seats - $newTickets WHERE id = $newShowtime";
    $exec_q = mysqli_query($dbc, $update_q2);
    if (!$exec_q) {echo "Query failed: " . $update_q2 . "<br />";}

    $update_q3 = "UPDATE orders SET orders.showing_id = $newShowtime, orders.tickets = $newTickets WHERE id = $orderID";
    $exec_q = mysqli_query($dbc, $update_q3);
    if (!$exec_q) {echo "Query failed: " . $update_q3 . "<br />";}
  }

  if (isset($_GET['edit'])) {
    $orderID = $_GET['edit'];

    $order_details = "SELECT orders.tickets FROM orders WHERE orders.id = $orderID";
    $exec_q = mysqli_query($dbc, $order_details);
    if ($exec_q) {$result = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);} else { echo "Query failed: " . $order_details;}

    $oldTickets = $result['tickets'];

  } else {
    echo '<script>location.href("//blue.butler.edu/~hlingren/CME419/tickethub/my_orders.php");</script>';
  }
?>

<main>
  <div class="container">

    <div class="row">
      <h4>Edit Order #<?php echo $orderID ?></h4>
    </div>

    <div class="row card-panel">
      <form action="order.php" method="POST">
        <input type="hidden" name="order" value="<?php echo $orderID; ?>" />
        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <p>Choose a showing time:</p>
            <select name="time" class= "browser-default" id="time">
              <option value="Choose a time..." disabled selected></option>
              <?php
                // get showing id for order
                $times_q1 = "SELECT orders.showing_id FROM orders WHERE orders.id = $orderID";
                echo $times_q1;
                $exec_q = mysqli_query($dbc, $times_q1);
                if ($exec_q) {$result = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);} else { echo "Query failed: " . $times_q1;}

                // get movie and date for showing
                $times_q2 = "SELECT showings.movie_id, showings.date FROM showings WHERE showings.id = " . $result['showing_id'];
                echo $times_q2;
                $exec_q = mysqli_query($dbc, $times_q2);
                if ($exec_q) {$result = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);} else { echo "Query failed: " . $times_q2;}
                $date = $result['date'];

                // get other times for movie on that day
                $times_q3 = "SELECT showings.time, showings.theater_id FROM showings WHERE showings.movie_id = " . $result['movie_id'] . " AND showings.date = '" . $result['date'] . "'";
                echo $times_q3;
                $exec_q = mysqli_query($dbc, $times_q3);
                if ($exec_q) {
                  while($time = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
                    echo '
                    <option value="' . $time['time'] . '">
                      ' . date('g:i a', strtotime($time['time']) ) . ', Theater #' . $time['theater_id'] . '
                    </option>
                    ';
                  }
                } else { echo "Query failed: " . $times_q3;}
              ?>
            </select>
            <input type="hidden" name="date" value="<?php echo $date; ?>" />
          </div>
          <div class="row">
            <div class="input-field col s12 m6 offset-m3">
              <input required type="number" name="tickets" id="tickets" value="<?php echo $oldTickets ?>" />
              <label for="tickets">Tickets amount</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn orange accent-2 waves-effect waves-light center-div" type="submit">Update Order</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</main>
