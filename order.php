<?php
  include('includes/header.php');
  include('includes/check_account.php');

  if (isset($_GET['edit'])) {
    $orderID = $_GET['edit'];
    $flag = true;

    $get_order_q = "SELECT orders.id, tickets, showing_id FROM orders WHERE orders.id = '$orderID' and orders.user_id = '$userID'";
    if ($exec_q && count(mysqli_fetch_array($exec_q, MYSQLI_ASSOC)) > 0) {
      $order = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $showID = $order['showing_id'];
    } else {
      echo "<h5>Order #$orderID not found for user #$userID. \nQuery used: $get_order_q</h5>";
    }
  } else if (isset($_GET['showing'])) {
    $flag = false;
    $showID = $_GET['showing'];
  }
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3>Order tickets</h3>
      </div>
    </div>

    <div class="row card-panel">
      <form action="account_info.php" method="POST">

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="show" type="text" disabled value="Showtime: <?php echo $showID ?>" />
            <label for="show">Selected showtime:</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="tickets" name="tickets" type="text" value="<?php if($flag) {echo $order['tickets'];} ?>">
            <label for="tickets">Ticket quantity</label>
          </div>
        </div>


        <div class="row">
          <div class="col s4 offset-s4">
            <button class="btn orange accent-2 waves-effect waves-light center-div" type="submit">Submit Order</button>
          </div>
        </div>

      </form>
    </div>




  </div>
</main>


<?php include('includes/footer.php'); ?>
