<?php
  // this file is for iterating the recent orders (pagination...?)
  include('includes/header.php');
  include('includes/check_account.php');
?>


<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3>Recent Orders</h3>
      </div>
    </div>

    <ul class="collapsible" data-collapsible="accordion">

      <?php
        // get showings, place into array
        $orders_q = "SELECT orders.id, orders.tickets, showings.theater_id,
                  showings.date, showings.time, movies.title FROM orders
                  LEFT JOIN showings ON orders.showing_id = showings.id
                  LEFT JOIN movies ON showings.movie_id = movies.id
                  WHERE orders.user_id = '$userID'
                  ORDER BY orders.id DESC";

        $exec_q = mysqli_query($dbc, $orders_q);
        if ($exec_q) {
          while ($order = mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) {
            $formatted_time = date('g:i a, n/j/y', strtotime($order['date'] . $order['time']));
            $order_title = 'Order #' . $order['id'] . " - " . $order['title'];
            $order_desc = '<b>' . $order_title . '</b><br />' .
                'Showing date: ' . $formatted_time . '<br />' .
                'Tickets purchased: ' . $order['tickets'];

            echo '
            <li>
              <div class="collapsible-header"><i class="material-icons">receipt</i>' . $order_title . '</div>
              <div class="collapsible-body">
                <p>' . $order_desc . '</p>
                <a class="collapsible-action" href="order.php?edit=' . $order['id'] . '">Edit Order</a>
              </div>
            </li>';
          }
        }
      ?>

    </ul>
  </div>
</main>


<?php include('includes/footer.php'); ?>
