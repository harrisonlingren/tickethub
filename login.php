<?php
  include('includes/header.php');

  function CheckLoginInDB($username,$password) {
    $pwdmd5 = md5($password);
    $qry = "Select name, email from $this->tablename ".
        " where username='$username' and password='$pwdmd5' ".
        " and confirmcode='y'";

    $result = mysql_query($q, $dbc);

    if(!$result || mysql_num_rows($result) <= 0) {
      return false;
    }
    return true;
  }

  if ($_SERVER['REQUEST_METHOD' == "POST"]) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($CheckLoginInDB($email, $pass)) {
      $q = "SELECT id FROM users WHERE email='$email'";
      $exec_q = mysqli_query($q, $dbc);
      $user = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
      $_SESSION['user'] = $user;
    } else {
      $message = '<span class="red darken-1">Incorect email or password!</span>';
      echo "<script>Materialize.toast($message, 4000)</script>";
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
            <label for="password"></label>
          </div>
        </div>
      </form>
    </div>

  </div>
</main>

<?php
  include('includes/footer.php');

  if (!$logged_in) {
    $_SESSION['user'] = $user;
  }

  header("Location: https://blue.butler.edu/~hlingren/CME419/tickethub");
  die();
?>
