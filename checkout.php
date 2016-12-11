<?php
  include('includes/header.php');
  include('includes/check_account.php');
?>

<main>
  <div class="container">
    <h3>Checkout</h3>
    <div class="row card-panel">
      <div class="col s12">
        <h4>Thank you!</h4>
        <p>Your order has been placed for the following movies:</p>
      </div>
      <div class="col s12">
        <ul class="collection">
          <?php
            if (isset($_SESSION['cart'])) {
              $order_queries = array();

              $count = 0;
              foreach ($_SESSION['cart'] as $item) {
                $showID = $item[0];
                $qty = $item[1];

                $details_q = "SELECT movies.title, showings.time, showings.date FROM showings
                              LEFT JOIN movies ON movies.id = showings.movie_id
                              WHERE showings.id = $showID";
                $exec_q = mysqli_query($dbc, $details_q);
                if ($exec_q) {

                  // check to make sure there are enough available seats
                  $available_amount = "SELECT showings.available_seats, showings.id FROM showings WHERE showings.id = $showID";
                  //echo $available_amount;
                  if ($qty <= $available_amount['available_seats']) {
                    $results = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
                    $showdate = date('D, F j', strtotime($results['date']));
                    $showtime = date('g:i a', strtotime($results['time']));
                    echo '
                    <li class="collection-item">
                      <div>
                        <b>Movie</b>: ' . $results['title'] . '<br /><b>Date</b>: ' . $showdate . ', ' . $showtime . '<br /><b>Tickets</b>: ' . $item[1] . '
                      </div>
                    </li>';

                    $new_order = "INSERT INTO orders (user_id, showing_id, tickets) VALUES ('$userID', '$showID', '$qty')";
                    $update_seats = "UPDATE showings SET available_seats = available_seats - $qty WHERE id = $showID";

                    $exec_q = mysqli_query($dbc, $new_order);
                    $error = false;
                    if (!$exec_q) {
                      $error = true;
                      echo "Issue with query: " . $new_order . "<br />";
                    } else {
                      //echo "Executing: " . $new_order . "<br />";
                      array_splice($_SESSION['cart'], $count, 1);
                    }

                    $exec_q = mysqli_query($dbc, $update_seats);
                    $error = false;
                    if (!$exec_q) {
                      $error = true;
                      echo "Issue with query: " . $update_seats . "<br />";
                    } else {
                      //echo "Executing: " . $update_seats . "<br />";
                    }

                  } else {
                    echo '
                    <li class="collection-item">
                      <div>
                        ERROR: Not enough seats available for:<br /><b>' . $results['title'] . '</b> on ' . $showdate . ' at ' . $showtime . '
                      </div>
                    </li>';
                  }
                } else {
                  echo '<li class="collection-item">Could not fetch details for item: $item[0]</li>';
                }
                $count += 1;
              }

              foreach ($order_queries as $query) {
                $exec_q = mysqli_query($dbc, $query);
                $error = false;
                if (!$exec_q) {
                  $error = true;
                  echo "Issue with query: " . $query . "<br />";
                } else {
                  echo "Executing: " . $query . "<br />";
                }
              }

            } else {
              echo "<h5>There's nothing in your cart! Add some movies and try again.</h5>";
            }
          ?>
          <li class="collection-item">
            <div class="row">
              <div class="col s12">
                <a href="movies.php"><button class="btn orange accent-2 waves-effect waves-light center-div">Continue Shopping</button></a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</main>
