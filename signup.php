<?php include('includes/header.php');

if ($logged_in) {
  echo '<h3>Already logged in! Redirecting...</h3>';
  echo "<script>window.location = '//blue.butler.edu/~hlingren/CME419/tickethub/account.php';</script>";
} else {

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $pass = $_POST['pass'];
    $pwdmd5 = encryptIt($pass);

    $addinfo_q = "INSERT INTO users (email, password, firstname, lastname) VALUES ('$email', '$pwdmd5', '$firstname', '$lastname')";

    $exec_q = mysqli_query($dbc, $addinfo_q);
    if (!$exec_q) {
      echo "Not today, sorry. Error was here: $addinfo_q";
    }
  }
}

?>

  <main>
  <div class="container">

    <div class="row">
      <div class="col s12 m10 l8 offset-m1 offset-l2">
        <h3>Sign up for a TicketHub account</h3>
      </div>
    </div>

    <div class="row card-panel">
      <form action="signup.php" method="POST">

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="firstname" name="firstname" type="text" class="validate">
            <label for="firstname">First Name</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="lastname" name="lastname" type="text" class="validate" >
            <label for="lastname">Last Name</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="email" type="email" name="email" class="validate" >
            <label for="email">Email</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="password" type="password" name="pass" class="validate" >
            <label for="password">Password</label>
          </div>
        </div>

        <div class="row">
          <div class="col s4 offset-s4">
            <button class="btn orange accent-2 waves-effect waves-light center-div" type="submit">Sign Up</button>
          </div>
        </div>

      </form>
    </div>

  </div>
</main>

<?php include('includes/footer.php'); ?>
