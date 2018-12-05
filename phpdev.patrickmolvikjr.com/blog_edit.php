<?php
  $title = "Edit Blog";
  ob_start();

  include 'templates/header.php';
  include 'templates/functions.php';


  $id = $_GET["id"];

  $submit = $_POST["submit"];

  $db = db_connect();


  if(empty($submit)){
    //get data from the database

    $sql = "SELECT * FROM blogs WHERE id=$id";


    //echo $sql;    //echo for debugging select statement

    $result = $db->query( $sql );
    list( $id, $blog_title, $blog_author, $date_posted, $blog_text) = $result->fetch_row();
    echo "<br />";
  } else {
    //get data from posted form
    $blog_title = $_POST["blog_title"];
    $blog_author = $_POST["blog_author"];
    $blog_text = $_POST["blog_text"];

    if(empty($blog_title) && $submit == true){
      $blog_title_error = "Title is required";
      $found_error = true;
    }
    if(empty($blog_author) && $submit == true){
      $blog_author_error = "Author Name is required";
      $found_error = true;
    }
    if(empty($blog_text) && $submit == true){
      $blog_text_error = "Blog Text is required";
      $found_error = true;
    }

    if( $found_error == false && $submit == true){

      $sql = "UPDATE blogs SET blog_title='$blog_title', blog_author='$blog_author', blog_text='$blog_text' WHERE id='$id'";

      $result = $db->query($sql);

      echo "Updated Database";

    }

  }

  $form = <<<END_OF_FORM

  <br />
  <a href="/blogs.php">See All Blogs</a>

  <h1>Edit Blogs</h1>
  
    <form method="POST" action="/blog_edit.php?id=$id">
      
      Title: <input type="text" name="blog_title" value="$blog_title"><span style="color:red">$blog_title_error</span><br />
      Author: <input type="text" name="blog_author" value="$blog_author"><span style="color:red">$blog_author_error</span><br />
      Blog Text: <input type="text" name="blog_text" value="$blog_text"><span style="color:red">$blog_text_error</span><br />

      <input type="hidden" id="$id">

      <input type="submit" name="submit" value="Save Changes">

    </form>
  

END_OF_FORM;

  echo $form;

  include 'templates/footer.php';

  ob_end_flush();
