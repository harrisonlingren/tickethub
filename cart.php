<?php
  include('includes/header.php');
  include('includes/check_account.php');

  // if GET (showing), retrieve showing ID to fill in showing field
  if (isset($_GET['showing'])) {
    $flag = true;
    $showID = $_GET['showing'];
    $ticketsQty = $_POST['ticketsQty'];

    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }

    array_push($_SESSION['cart'], array($showID, $ticketsQty));

    $selected_time_query = "SELECT movies.title, showings.time, showings.date FROM showings
                            LEFT JOIN movies ON movies.id = showings.movie_id
                            WHERE showings.id = $showID";
    $exec_q = mysqli_query($dbc, $selected_time_query);
    if ($exec_q) {
      $results = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
    }
  } else if (isset($_GET['remove'])) {
    $flag = false;
    $removeID = $_GET['remove'];
    array_splice($_SESSION['cart'], $removeID, 1);
    echo "removed element $removeID";
  } else {$flag = false;}
  //echo "<p>" . print_r($_GET) . "</p><p> " . print_r($_POST) . "</p>";
?>

<main>
  <div class="container">
    <div class="row">
      <?php
        if ($flag) {
          echo "<h5>The following was added to your cart:</h5>";
          //echo $selected_time_query;
          $showdate = date('l, F j', strtotime($results['date']));
          $showtime = date('g:i a', strtotime($results['time']));
          $movie = $results['title'];
          echo "<p>
            <b>$ticketsQty</b> tickets for <b>$movie</b> on <b>$showdate</b> at <b>$showtime</b>
          </p>";
        }
      ?>
    </div>
    <div class="row">
      <ul class="collection with-header">
        <li class="collection-header">
          <h4>Shopping Cart</h4>
        </li>
        <?php
          $count = 0;
          foreach ($_SESSION['cart'] as $item) {
            $selected_time_query = "SELECT movies.title, showings.time, showings.date FROM showings
                                    LEFT JOIN movies ON movies.id = showings.movie_id
                                    WHERE showings.id = " . $item[0];
            $exec_q = mysqli_query($dbc, $selected_time_query);
            if ($exec_q) {
              $results = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
              $showdate = date('D, F j', strtotime($results['date']));
              $showtime = date('g:i a', strtotime($results['time']));

              echo '
              <li class="collection-item">
                <div>
                  <a class="secondary-content" href="cart.php?remove=' . $count . '"><i class="material-icons">delete</i></a>
                  <b>Movie</b>: ' . $results['title'] . '<br /><b>Date</b>: ' . $showdate . ', ' . $showtime . '<br /><b>Tickets</b>: ' . $item[1] . '

                </div>
              </li>';
            } else {
              echo "<h4>Could not fetch details for item: $item[0]</h4>";
            }
            $count += 1;
          }
        ?>
        <li class="collection-item">
          <div class="row">
            <div class="col s6 m4 l2 offset-m2 offset-l4">
              <a href="movies.php"><button class="btn orange accent-2 waves-effect waves-light center-div">Add More</button></a>
            </div>
            <div class="col s6 m4 l2">
              <a href="checkout.php"><button class="btn orange accent-2 waves-effect waves-light center-div">Checkout</button></a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</main>


<?php include('includes/footer.php'); ?>
