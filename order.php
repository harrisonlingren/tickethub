<?php
  include('includes/header.php');
  include('includes/check_account.php');

  if (isset($_GET['showing'])) {
    $flag = false;
    $showID = $_GET['showing'];
  } else {
    echo "<br /><h5>No appropriate handler was determined.</h5><p>" . print_r($_GET) . "</p><p> " . print_r($_POST) . "</p>";
  }

  echo "<p>" . print_r($_GET) . "</p><p> " . print_r($_POST) . "</p>";
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3>Order tickets</h3>
      </div>
    </div>

    <div class="row card-panel">
      <form action="order.php" method="POST">

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="showID" name="showID" type="text" value="<?php echo $showID ?>" />
            <input name="checkEdit" type="hidden" value=" <?php if($flag) {echo 1;} else {echo 0;} ?>"
            <label for="showID">Selected showtime:</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="tickets" name="tickets" type="text" required value="<?php if($flag) {echo $order['tickets'];} ?>">
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
