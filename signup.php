<?php include('includes/header.php');

if ($logged_in) {
  echo '<h3>Already logged in! Redirecting...</h3>';
  echo "<script>window.location = '//blue.butler.edu/~hlingren/CME419/tickethub/account.php';</script>";
}

?>



<main>
  <div class="row">
    <form class="col s12" action="signup.php" method="POST">
      <div class="row">
        <div class="col s2">
          <i class="material-icons large">person</i>
        </div>
        <div class="input-field col s5">
          <input placeholder="Placeholder" id="firstname" name="firstname" type="text" class="validate">
          <label for="firstname">First Name</label>
        </div>
        <div class="input-field col s5">
          <input id="lastname" name="lastname" type="text" class="validate">
          <label for="lastname">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="col s2">
          <i class="large material-icons">email</i>
        </div>
        <div class="input-field col s10">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="col s2">
          <i class="large material-icons">lock</i>
        </div>
        <div class="input-field col s10">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          This is an inline input field:
          <div class="input-field inline">
            <input id="email" type="email" class="validate">
            <label for="email" data-error="Enter a valid email address">Email</label>
          </div>
        </div>
      </div>
    </form>
  </div>




</main>





<?php include('includes/footer.php'); ?>
