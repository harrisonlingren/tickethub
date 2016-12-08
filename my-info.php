<?php
  include('includes/header.php');
  include('includes/check_account.php');

  $userID = $_SESSION['userID'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $pass = $_POST['pass'];
    $pwdmd5 = encryptIt($pass);

    $updateinfo_q = "UPDATE users SET email='$email', password='$pwdmd5', firstname='$firstname', lastname='$lastname' WHERE users.id = '$userID'";

    $exec_q = mysqli_query($dbc, $updateinfo_q);
    if (!$exec_q) {
      echo "Not today, sorry. Error was here: $updateinfo_q";
    }
  }

  $userinfo_q = "SELECT firstname, lastname, email, password FROM users WHERE users.id = '$userID'";
  $exec_q = mysqli_query($dbc, $userinfo_q);
  if ($exec_q) {
    $userinfo = mysqli_fetch_array($exec_q, MYSQLI_ASSOC);
  } else {
    echo "Not today, sorry. Error was here: $userinfo_q";
  }

?>

<main>
  <div class="container">

    <div class="row">
      <div class="col s12">
        <h3>Update Account Information</h3>
      </div>
    </div>

    <div class="row card-panel">
      <form action="my-info.php" method="POST">

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="firstname" name="firstname" type="text" class="validate" value="<?php echo $userinfo['firstname']; ?>">
            <label for="firstname">First Name</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="lastname" name="lastname" type="text" class="validate" value="<?php echo $userinfo['lastname']; ?>">
            <label for="lastname">Last Name</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="email" type="email" name="email" class="validate" value="<?php echo $userinfo['email']; ?>">
            <label for="email">Email</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m10 l8 offset-m1 offset-l2">
            <input id="password" type="password" name="pass" class="validate" value="<?php echo decryptIt($userinfo['password']); ?>">
            <label for="password">Password</label>
          </div>
        </div>

        <div class="row">
          <div class="col s4 offset-s4">
            <button class="btn orange accent-2 waves-effect waves-light center-div" type="submit">Update Account Info</button>
          </div>
        </div>

      </form>
    </div>

  </div>
</main>


<?php include('includes/footer.php'); ?>
