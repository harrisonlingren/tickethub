<?php
  include('includes/header.php');
  include('includes/check_account.php');
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3><?php echo $welcome_header ?></h3>
      </div>
    </div>

    <div class="row action-call">
      <div class="col s12 m6 ">
        <div class="card-panel">
          <a href="my_orders.php">
            <i class="material-icons large orange-text accent-2">receipt</i>
            <h4 class="grey-text">View my orders</h4>
          </a>
        </div>
      </div>
      <div class="col s12 m6 ">
        <div class="card-panel">
          <a href="my-info.php">
            <i class="material-icons large orange-text accent-2">person</i>
            <h4 class="grey-text">Update account</h4>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
