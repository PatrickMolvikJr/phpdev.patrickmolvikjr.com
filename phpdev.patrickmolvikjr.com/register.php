<?php
  ob_start();
  session_start();
  $title = "Login/Logout";
  include 'templates/header.php';
  include 'templates/functions.php';

  $db = db_connect();

  $submit = $_POST["submit"];

  /**
   * @param $email
   * @param $name
   */

  if (!empty($submit)) {

    $name = mysqli_real_escape_string($db, $_POST["name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST["passwordConfirm"]);

    if ($password == $passwordConfirm) {

      $sql = "SELECT email FROM users WHERE email='$email'";
      $result = $db->query($sql);

      if ($result->num_rows == 0) {

        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users ( id, email, name, password ) VALUES (null, '$email', '$name', '$encryptedPassword')";

        $result = $db->query($sql);
        echo $sql . "<br />";

        set_login($email, $name);

        ob_clean();
        header("Location: /");

      } else {
        $error_msg = "Username already exists... try again!";
      }

    } else {
      $error_msg .= "<br />Passwords do not match!";
    }

  }

  $reg_form = <<<END_OF_FORM


  <h1>Register</h1>
  
  <p class="error_message">$error_msg</p>
  
  <form method="post" action="register.php" >
  
    <p>Please Enter your Name: </p>
    <input type="text" name="name" value="$name"><br />
  
    <p>Please Enter your Email Address:</p>
    <input type="email" name="email" value="$email"><br />
  
    <p>Please Enter your Password:</p>
    <input type="password" name="password" ><br />
  
    <p>Please Enter your Password again:</p>
    <input type="password" name="passwordConfirm" ><br />
  
  
    <input type="submit" name="submit" value="Login">
  
  </form>

END_OF_FORM;

  echo $reg_form;


  include 'templates/footer.php';

  ob_end_flush();


