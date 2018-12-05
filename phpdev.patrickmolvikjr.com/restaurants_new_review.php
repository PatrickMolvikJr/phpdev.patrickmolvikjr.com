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
  $restaurantIDFK = $_POST["restaurantIDFK"];
  $author = $_POST["author"];
  $reviewText = $_POST["reviewText"];
  $rating = $_POST["rating"];

  //echo $restaurantIDFK;
  //echo $author;
  //echo $reviewText;
  //echo $rating;
  $db = db_connect();

  $sql = "INSERT INTO reviews (id, author, review, rating, created_at, restaurantIDFK)
                      VALUES (null, '$author', '$reviewText', '$rating', NOW(), $restaurantIDFK)";


  $result = $db->query($sql);
  header("Location: /restaurant.php?id=$restaurantIDFK");
  //echo $sql;