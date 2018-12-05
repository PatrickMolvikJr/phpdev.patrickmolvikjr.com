<?php
  /**
   * Created by PhpStorm.
   * User: pmolv
   * Date: 11/15/2017
   * Time: 3:38 PM
   */


  session_start();
  ob_start();
  include 'templates/functions.php';

  $db = db_connect();
  $id = mysqli_real_escape_string($db, $_GET["id"]);


  $sql = "SELECT * FROM restaurants WHERE id=$id";


  echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );
  list( $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row();

  echo $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt;



  //email all users with newsletter as true
  $sql = "SELECT * FROM users WHERE newsletter=1";
  $result = $db->query( $sql );

  while(list( $user_id, $user_email, $user_name, $password, $newsletter) = $result->fetch_row()){

  echo $user_id, $user_email, $user_name, $password, $newsletter;

  $message =<<<END_OF_MESSAGE
    
    Hello $user_name,
    Here is the latest restaurant we registered in our Database!
    
    $name
    Location: $location
    Known for their: $tags
    
END_OF_MESSAGE;

  $to = $user_email;
  $subject = "New Restaurant";
  //$message = "Hello PJ";
  $headers = "From: info@phpdev.patrickmolvikjr.com\r\n";
  $headers .= "BBC: pmm@wwdb.com\r\n";

  $sent = mail($to, $subject, $message, $headers);
  echo "Got here $user_email<br />";
  }
  ob_end_clean();
  header("Location: /restaurant.php?id=$id");