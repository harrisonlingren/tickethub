<?php include('includes/header.php');
  function CheckLoginInDB($email, $password, $dbc) {
    $pwdmd5 = md5($password);
    $q = "SELECT id, email, password FROM users
          WHERE email='$email' and password='$pwdmd5'";

    //echo $q;

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

  if (!$logged_in) {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['email'] !== null) && ($_POST['password'] !== null)) {
      $email = $_POST['email'];
      $pass = $_POST['password'];

      $trial = CheckLoginInDB($email, $pass, $dbc);
      echo "<h3>Logged in! Redirecting...</h3>";

      if ($trial) {
        $q = "SELECT id FROM users WHERE email='$email'";
        $exec_q = mysqli_query($dbc, $q) or die('Could not look up user information; ' . mysqli_error($dbc));
        $user = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
        $_SESSION['userID'] = $user['id'];

        //$logged_in = true;

        // handle redirect
        if (isset($_GET['redirect'])) {
          $newPath = 'https://blue.butler.edu/~hlingren/CME419/tickethub/' . $_GET['redirect'] . '.php';
        } else {
          $newPath = 'https://blue.butler.edu/~hlingren/CME419/tickethub';
        } echo "<script>window.location = '$newPath';</script>";

      } else {
        $message = 'Incorrect email or password!';
        echo "<script>Materialize.toast('$message', 4000)</script>";
      }
    }
  } else {
    echo '<h3>Already logged in! Redirecting...</h3>';
    echo "<script>window.location = 'http://blue.butler.edu/~hlingren/CME419/tickethub'</script>";
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
            <button class="btn orange accent-2 waves-effect waves-light center-div" type="submit">Login</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</main>

<?php include('includes/footer.php'); ?>
