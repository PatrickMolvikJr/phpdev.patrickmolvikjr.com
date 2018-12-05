<?php
  /**
   * Created by PhpStorm.
   * User: pmolv
   * Date: 10/23/2017
   * Time: 3:27 PM
   */
session_start();
include 'templates/header.php';
include 'templates/functions.php';
  $db = db_connect();

  $id = mysqli_real_escape_string($db, $_GET["id"]);

  $sql = "SELECT AVG(rating) FROM reviews WHERE restaurantIDFK=$id";

  $avg_rating = 0;
  $result = $db->query( $sql );
  if($result){
    $avg_rating = $result->fetch_row()[0];
  }
  $stars = str_repeat('<img src="/images/A_Red_Star.png" height="25" width="25" />', $avg_rating);


  $sql = "SELECT * FROM restaurants WHERE id=$id";


  //echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );
  list( $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row();


  $detail = <<<END_OF_DETAIL

<br />
<a href="/restaurants.php">See All Restaurants</a>

<h1>Restaurant</h1>
  <p>Average Rating: $stars</p>
  <h2>$name</h2>
    <p>$location</p>
    <p>$priceRangeLow</p>  
    <p>$priceRangeHigh</p>
    <p>$tags</p>
    <p>$modifiedAt</p>
    <p>$createdAt</p>
    <a href="/restaurant_edit.php?id=$id">Edit This Restaurant</a>
    <br />
END_OF_DETAIL;


  echo $detail; //REMEMBER TO DO THIS!!!!!!!!!!!!

  $sql = "SELECT * FROM reviews WHERE restaurantIDFK=$id";
  echo '<br />';

  //echo $sql;
  $result = $db->query( $sql );
  while (list( $review_id, $author, $review, $rating, $created_at, $restaurantIDFK) = $result->fetch_row()){
    $stars = str_repeat('<img src="/images/A_Red_Star.png" height="25" width="25" />', $rating);
    $review_text =<<< END_OF_REVIEW
    
    <div class="review-box">
    <p>$created_at</p>
    <span>$stars</span> 
    <p>$author says: </p>
    <p>$review</p>
    </div>
    <br />
   
END_OF_REVIEW;
    echo $review_text;
  }
  $review_form =<<<END_OF_FORM
  <form method="post" action="/restaurants_new_review.php">
    Author: <input type="text" name="author"><br />
    Review: <br /><textarea name="reviewText"></textarea><br />
    Rating: <input type="number" name="rating" max="5" min="1"><br />
    <input type="hidden" name="restaurantIDFK" value="$id"><br />
    <input type="submit" name="submit" value="Post Review">
  </form>
END_OF_FORM;

  echo $review_form;

  echo "<a href='/emailrestaurant.php?id=$id'>Email Restaurant Details</a>";

  include 'templates/footer.php';

