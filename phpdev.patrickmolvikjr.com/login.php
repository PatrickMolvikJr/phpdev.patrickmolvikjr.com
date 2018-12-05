<?php
  ob_start();
  session_start();
  $title = "Login/Logout";
  include 'templates/header.php';
  include 'templates/functions.php';

  $db = db_connect();

  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  $submit = $_POST["password"];

 // $password = password_hash($password, PASSWORD_DEFAULT);

  if( ! empty($submit)) {

    $sql = "SELECT * FROM users WHERE email='$email'"; // AND password='$password'";
    $result = $db->query($sql);
    list($id, $email, $name, $encrypted_password) = $result->fetch_row();

    if (password_verify($password, $encrypted_password)) {
      echo "You are registered";
      set_login($email, $name);

      //Redirect to Top Page
      ob_clean();
      header("Location: /");
    } else {
      $_SESSION["email"] = "";
      $error_msg = "Unknown Credentials - Please try again.";

    }
  }

  echo "$id : $email, $name, $password ";


  $login_form = <<<END_OF_FORM


  <h1>Login</h1>
  
  <p class="error_message">$error_msg</p>
  
  <form method="post" action="login.php" >
    <p>Please Enter your Email Address:</p>
    <input type="email" name="email" value="$email"><br />
  
    <p>Please Enter your Password:</p>
    <input type="password" name="password" ><br />
  
  
  
    <input type="submit" name="submit" value="Login">
  
  </form>

END_OF_FORM;

  echo $login_form;


  include 'templates/footer.php';

  ob_end_flush();

?>
