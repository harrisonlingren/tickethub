<?php
  include('includes/header.php');

  function CheckLoginInDB($email, $password) {
    $pwdmd5 = md5($password);
    $q = "SELECT email, password FROM users
          WHERE email='$email' and password='$pwdmd5'";

    $result = mysqli_query($q, $dbc);

    if(!$result || mysqli_fetch_array($result, MYSQLI_ASSOC) <= 0) {
      return false;
    }
    return true;
  }

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (CheckLoginInDB($email, $pass)) {
      $q = "SELECT id FROM users WHERE email='$email'";
      $exec_q = mysqli_query($q, $dbc);
      $user = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $_SESSION['user'] = $user;
    } else {
      echo '<h1>LE FAIL!</h1>';
      $message = '<span class="red darken-1">Incorect email or password!</span>';
      echo "<script>Materialize.toast('$message', 4000)</script>";
    }
  }
?>

<main>
  <div class="container">

    <div class="row">
      <div class="col s12">
        <h3>Login</h3>
      </div>
    </div>

    <div class="row">
      <form action="login.php" method="POST">
        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input type="email" id="email" name="email" class="validate" />
            <label for="email" data-error="Enter a valid email address">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input type="password" id="password" name="password" />
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn red lighten-1 waves-effect waves-light center-div" type="submit">Login</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</main>

<?php include('includes/footer.php'); ?>
