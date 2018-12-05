<?php
  /**
   * Created by PhpStorm.
   * User: pmolv
   * Date: 11/10/2017
   * Time: 1:06 PM
   */

  include "templates/functions.php";
  if( $rating < 1 ){
    $rating = 1;
  }
  if( $rating > 1){
    $rating = 5;
  }
  $blogIDFK = $_POST["blogIDFK"];
  $comment_author = $_POST["comment_author"];
  $comment_text = $_POST["comment_text"];
  $rating = $_POST["rating"];

  $db = db_connect();

  $sql = "INSERT INTO comments (comment_id, comment_author, comment_text, rating, blogIDFK, created_date)
                      VALUES (null, '$comment_author', '$comment_text', '$rating','$blogIDFK', NOW())";


  $result = $db->query($sql);
  header("Location: /blog_show.php?id=$blogIDFK");
  //echo $sql;