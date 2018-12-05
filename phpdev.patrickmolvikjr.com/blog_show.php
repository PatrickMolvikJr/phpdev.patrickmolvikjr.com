<?php
  $title = "Show Blog";
  include 'templates/header.php';
  include 'templates/functions.php';

  $id = $_GET["id"];
  $db = db_connect();

  $sql = "SELECT AVG(rating) FROM comments WHERE blogIDFK=$id";

  $avg_rating = 0;
  $result = $db->query( $sql );
  if($result){
    $avg_rating = $result->fetch_row()[0];
  }
  $stars = str_repeat('<img src="/images/A_Red_Star.png" height="25" width="25" />', $avg_rating);


  $sql = "SELECT * FROM blogs WHERE id=$id";

  //echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );
  list( $blog_id, $blog_title, $blog_author, $date_posted, $blog_text) = $result->fetch_row();

  $detail = <<<END_OF_DETAIL

<br />
 <div class="links-btn-container">
    <div>
    <p><a href="/blogs.php">See All Blogs</a></p>
    </div>
    <div>
    <p><a href="/blog_new.php">Create New Blog</a></p>
    </div>
  </div>
 
   <p>Average Rating: $stars</p>
 
  <h2>$blog_title</h2>
    <p>By: $blog_author</p>
    <p>Published: $date_posted</p>  
    <p>$blog_text</p>

END_OF_DETAIL;


  echo $detail;

  //Comments

  $sql = "SELECT * FROM comments WHERE blogIDFK=$id";
  echo '<br />';

  $result = $db->query( $sql );
  while (list( $comment_id, $comment_author, $comment_text, $rating, $blogIDFK, $created_date) = $result->fetch_row()){
    $stars = str_repeat('<img src="/images/A_Red_Star.png" height="25" width="25" />', $rating);

    $created_date = date("Y-m-d", strtotime($created_date));
    //echo $created_date;

    $time_past = time_elapsed_string($created_date);

    $comment_container =<<< END_OF_REVIEW
    
    <div class="review-box">
    <p>$time_past</p>
    <span>$stars</span> 
    <p>$comment_author says: </p>
    <p>$comment_text</p>
    </div>
    <br />
   
END_OF_REVIEW;
    echo $comment_container;
  }
  $comment_form =<<<END_OF_FORM
  <form method="post" action="/blogs_new_review.php">
    Author: <input type="text" name="comment_author"><br />
    Review: <br /><textarea name="comment_text"></textarea><br />
    Rating: <input type="number" name="rating" max="5" min="1"><br />
    <input type="hidden" name="blogIDFK" value="$blog_id"><br />
    <input type="submit" name="submit" value="Post Comment">
  </form>
END_OF_FORM;

  echo $comment_form;
  include 'templates/footer.php';

