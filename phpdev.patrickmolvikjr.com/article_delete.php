<?php

  include 'templates/functions.php';


  $id = $_GET["id"];

  $db = db_connect();

  $sql = "DELETE FROM articles WHERE article_id=$id";


  //echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );


  //Message that it is deleted
  if( $result ){
    header("Location: /articles.php?msg=Article $id successfully deleted");
  } else {
    header("Location: /articles.php?msg=Error deleting article ID: $id");
  }