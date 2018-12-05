<?php
  $title = "Articles";
  include 'templates/header.php';
  include 'templates/functions.php';

  $id = $_GET["id"];

  $db = db_connect();



  $msg = $_GET["msg"];

  $perPage = empty($_GET["perPage"]) ? 10 : $_GET["perPage"];

  $page = empty($_GET["page"]) ? 1 : $_GET["page"];

  $startRecord = ($page - 1) * $perPage;

  $sql = "SELECT count(id) FROM blogs";
  $result = $db->query( $sql );
  $numRecords = $result->fetch_row()[0];

  $sql = " SELECT * FROM blogs LIMIT $perPage OFFSET $startRecord";


  $result = $db->query( $sql );
  $prevPage = $page - 1;
  if( $prevPage <= 0 ) {
    $prevPage = 1;
  }

  $prevLink = "<a href='/blogs.php?perPage=$perPage&page=$prevPage'>Prev</a>";

  $nextPage = $page + 1;
  if( $nextPage > ($numRecords / $perPage) + 1){
    $nextPage = $page;
  }

  $nextLink = "<a href='/blogs.php?perPage=$perPage&page=$nextPage'>Next</a>";

  $tableBlog = <<<END_OF_TABLE

  <h1>Blogs</h1>

  <p>$msg</p><br />

    <div>
    <p><a href="/blog_new.php">Create New Blog</a></p>
    </div>
  <div class="links-btn-container">
    <div>
    <p>$prevLink</p>
    </div>
    <div>
    <p>$nextLink</p>
    </div>
  </div>
  
  <table>
    <tr>
      <th>Blog Title</th>
      <th>Author</th>
      <th>Date Posted</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr> 

END_OF_TABLE;

  echo $tableBlog;
  while(list( $id, $blog_title, $blog_author, $date_posted, $blog_text) = $result->fetch_row()){
    echo "<tr>
            <td><a href=\"/blog_show.php?id=$id\">$blog_title</a></td>
            <td>$blog_author</td>
            <td>$date_posted</td>
            <td><a href=\"/blog_edit.php?id=$id\">Edit</a></td>
            <td><a href=\"/blog_delete.php?id=$id\">Delete</a></td>
          </tr>";
  }
  echo "</table>";


  include 'templates/footer.php';