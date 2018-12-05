<?php
  $title = "Edit Article";
  ob_start();

  include 'templates/header.php';
  include 'templates/functions.php';


  $id = $_GET["id"];

  $submit = $_POST["submit"];

  $db = db_connect();


  if(empty($submit)){
    //get data from the database

    $sql = "SELECT * FROM articles WHERE article_id=$id";


    //echo $sql;    //echo for debugging select statement

    $result = $db->query( $sql );
    list( $article_id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row();
    echo "<br />";
  } else {
    //get data from posted form
    $title = $_POST["title"];
    $author = $_POST["author"];
    $article_text = $_POST["article_text"];
    $published_date = $_POST["published_date"];

    $modifiedAt = date_create();
    $modifiedAt = $modifiedAt->format("Y-m-d H:i:s");

    //error checking
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
    if( ! $found_error ) {
      //execute when no errors are found
      $sql = "UPDATE articles SET title='$title', author='$author', article_text='$article_text', published_date='$published_date', modified_at='$modified_at' WHERE article_id='$id'";
      echo "SQL: $sql <br />";
      $result = $db->query($sql);
      echo "Updated Database";
      ob_clean();
      header("Location: /article_show.php?id=$id");
    }
  }

  $form = <<<END_OF_FORM

  <br />
  <a href="/articles.php">See All Articles</a>

  <h1>Edit Article</h1>
  
    <form method="POST" action="/article_edit.php?id=$id">
      
      Title: <input type="text" name="title" value="$title"><span style="color:red">$title_error</span><br />
      Author: <input type="text" name="author" value="$author"><span style="color:red">$author_error</span><br />
      Article Text: <input type="text" name="article_text" value="$article_text"><span style="color:red">$article_text_error</span><br />
      Published Date: <input type="text" name="published_date" value="$published_date"><span style="color:red">$published_date_error_error</span><br />


      <input type="hidden" article_id="$id">

      <input type="submit" name="submit" value="Save Changes">

    </form>
  

END_OF_FORM;

  echo $form;

  include 'templates/footer.php';

  ob_end_flush();
