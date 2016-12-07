<?php include('includes/header.php');

if ($logged_in) {
  echo '<h3>Already logged in! Redirecting...</h3>';
  echo "<script>window.location = '//blue.butler.edu/~hlingren/CME419/tickethub/account.php';</script>";
}

?>

  <main>
  <div class="container">

    <h3>Sign up for a TicketHub account</h3>

    <div class="row">
      <form class="col s12" action="signup.php" method="POST">
        <div class="row">
          <div class="col s1 m2 l3">
            <i class="material-icons large primary-red">person</i>
          </div>
          <div class="input-field col s11 l9 l7">
            <input id="firstname" name="firstname" type="text" class="validate">
            <label for="firstname">First Name</label>
          </div>
        </div>
        <div class="row">
          <div class="col s1 m2 l3">
            <i class="material-icons large primary-red">person</i>
          </div>
          <div class="input-field col s11 m9 l7">
            <input id="lastname" name="lastname" type="text" class="validate">
            <label for="lastname">Last Name</label>
          </div>
        </div>
        <div class="row">
          <div class="col s1 m2 l3">
            <i class="material-icons large primary-red">email</i>
          </div>
          <div class="input-field col s11 m9 l7">
            <input id="email" type="email" class="validate">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="col s1 m2 l3">
            <i class="material-icons large primary-red">lock</i>
          </div>
          <div class="input-field col s11 m9 l7">
            <input id="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn orange accent-2 waves-effect waves-light" type="submit">Sign Up</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
