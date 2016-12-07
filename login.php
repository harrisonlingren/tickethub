<?php
  include('includes/header.php');

  function CheckLoginInDB($email, $password, $dbc) {
    $pwdmd5 = md5($password);
    $q = "SELECT id, email, password FROM users
          WHERE email='$email' and password='$pwdmd5'";

    echo $q;

    $exec_q = mysqli_query($dbc, $q);

    if($exec_q) {
      $result = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $id = $result['id'];
    } else {
      echo 'nope...';
      return null;
    }
    return $id;
  }

  if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['email'] !== null) && ($_POST['password'] !== null)) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $trial = CheckLoginInDB($email, $pass, $dbc);
    echo "Login result: " . $trial;

    if ($trial) {
      $q = "SELECT id FROM users WHERE email='$email'";

      echo $q;

      $exec_q = mysqli_query($q, $dbc);
      $user = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $_SESSION['user'] = $user;
    } else {
      echo '<h1>LE FAIL!</h1>';
      echo md5($pass);
      $message = 'Incorrect email or password!';
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
