<?php
  /**
   * Created by PhpStorm.
   * User: pmolv
   * Date: 10/23/2017
   * Time: 3:27 PM
   */

  include 'templates/functions.php';


  $id = $_GET["id"];

  $db = db_connect();

  $sql = "DELETE FROM restaurants WHERE id=$id";


  //echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );


  //Message that it is deleted
  if( $result ){
    header("Location: /restaurants.php?msg=Restaurant $id successfully deleted");
  } else {
    header("Location: /restaurants.php?msg=Error deleting restaurant ID: $id");
  }