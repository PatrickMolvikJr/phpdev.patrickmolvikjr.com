<?php
  $title = "Create Blog";
  ob_start();

  include 'templates/header.php';
  include 'templates/functions.php';

  //New items are not created yet, have to use POST
  $submit = $_POST["submit"];

  $db = db_connect();

  $blog_title = $_POST["blog_title"];
  $blog_author = $_POST["blog_author"];
  $blog_text = $_POST["blog_text"];
  $date_posted = date_create();
  $date_posted = $date_posted->format("Y-m-d H:i:s");

  //error checking
  $blog_title_error = "";
  $blog_author_error = "";
  $blog_text_error = "";

  $found_error = false;
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
    //insert data  into db
    $sql = "INSERT INTO `blogs` (`id`, `blog_title`, `blog_author`, `blog_text`, `date_posted`) VALUES (NULL,'$blog_title', '$blog_author', '$blog_text', '$date_posted')";
    //echo "SQL: $sql <br />";
    $result = $db->query($sql);
    //ob_clean();
    echo "Updated Database";

  }

  $form = <<<END_OF_FORM

  <br />
  <a href="/blogs.php">See All Blogs</a>

  <h1>Create a New Blog</h1>
  
    <form method="POST" action="/blog_new.php">
      
      Title: <input type="text" name="blog_title"><span style="color:red">$blog_title_error</span><br />
      Author: <input type="text" name="blog_author"><span style="color:red">$blog_author_error</span><br />
      Article Text: <input type="text" name="blog_text"><span style="color:red">$blog_text_error</span><br />

      <input type="submit" name="submit" value="Create Blog">


    </form>
  

END_OF_FORM;

  echo $form;

  include 'templates/footer.php';

  ob_end_flush();
