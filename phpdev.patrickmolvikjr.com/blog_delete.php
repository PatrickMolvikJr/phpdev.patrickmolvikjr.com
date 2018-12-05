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

  $sql = "DELETE FROM blogs WHERE id=$id";


  //echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );


  //Message that it is deleted
  if( $result ){
    header("Location: /blogs.php?msg=Blog $id successfully deleted");
  } else {
    header("Location: /blogs.php?msg=Error deleting blog ID: $id");
  }