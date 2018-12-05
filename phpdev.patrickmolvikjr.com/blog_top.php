<?php
  $title = "Newest Blog";
  include 'templates/header.php';
  include 'templates/functions.php';

  $db = db_connect();

  $sql = "SELECT * FROM blogs ORDER BY date_posted DESC LIMIT 1";


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
<h1>Newest Blog</h1>
 
  <h2>$blog_title</h2>
    <p>By: $blog_author</p>
    <p>Posted: $date_posted</p>
    <p>$blog_text</p>

END_OF_DETAIL;


  echo $detail; //REMEMBER TO DO THIS!!!!!!!!!!!!
  include 'templates/footer.php';