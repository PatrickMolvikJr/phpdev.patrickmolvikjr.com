<?php
  $title = "Create Article";
  ob_start();

  include 'templates/header.php';
  include 'templates/functions.php';

  //New items are not created yet, have to use POST
  $submit = $_POST["submit"];

  $db = db_connect();

  $title = $_POST["title"];
  $author = $_POST["author"];
  $article_text = $_POST["article_text"];
  $published_date = $_POST["published_date"];
  $modifiedAt = date_create();
  $modifiedAt = $modifiedAt->format("Y-m-d H:i:s");

  //error checking
  $title_error = "";
  $author_error = "";
  $article_text_error = "";
  $published_date_error = "";

  $found_error = false;
  if(empty($title)){
    $title_error = "Title is required";
    $found_error = true;
  }
  if(empty($author)){
    $author_error = "Author Name is required";
    $found_error = true;
  }
  if(empty($article_text)){
    $article_text_error = "Author Name is required";
    $found_error = true;
  }
  if(empty($published_date)){
    $published_date_error = "Published Date is required";
    $found_error = true;
  }

  if( $found_error == false ){
    //insert data  into db
    $sql = "INSERT INTO `articles` (`article_id`, `title`, `author`, `article_text`, `published_date`, `modified_at`, `created_at`) VALUES (NULL,'$title', '$author', '$article_text', '$published_date', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    //echo "SQL: $sql <br />";
    $result = $db->query($sql);
    //ob_clean();
    echo "Updated Database";

  }

  $form = <<<END_OF_FORM

  <br />
  <a href="/articles.php">See All Articles</a>

  <h1>Create a New Article</h1>
  
    <form method="POST" action="/article_new.php">
      
      Title: <input type="text" name="title"><span style="color:red">$title_error</span><br />
      Author: <input type="text" name="author"><span style="color:red">$author_error</span><br />
      Article Text: <input type="text" name="article_text"><span style="color:red">$article_text_error</span><br />
      Publish Date: <input type="text" name="published_date"><span style="color:red">$published_date_error</span><br />

      <input type="submit" name="submit" value="Create Article">


    </form>
  

END_OF_FORM;

  echo $form;

  include 'templates/footer.php';

  ob_end_flush();
