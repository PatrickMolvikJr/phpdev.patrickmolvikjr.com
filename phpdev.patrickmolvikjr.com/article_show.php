<?php
  $title = "Show Article";
  include 'templates/header.php';
  include 'templates/functions.php';

  $article_id = $_GET["id"];
  $db = db_connect();

  $sql = "SELECT * FROM articles WHERE article_id=$article_id";


  //echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );
  list( $article_id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row();
  $detail = <<<END_OF_DETAIL

<br />
 <div class="links-btn-container">
    <div>
    <p><a href="/articles.php">See All Articles</a></p>
    </div>
    <div>
    <p><a href="/article_new.php">Create New Article</a></p>
    </div>
  </div>
<h1>Newest Article</h1>
 
  <h2>$title</h2>
    <p>By: $author</p>
    <p>Published: $published_date</p>  
    <p>$article_text</p>

END_OF_DETAIL;


  echo $detail; //REMEMBER TO DO THIS!!!!!!!!!!!!
  include 'templates/footer.php';

