<?php
  $title = "Articles";
  include 'templates/header.php';
  include 'templates/functions.php';

  $article_id = $_GET["article_id"];

  $db = db_connect();



  $msg = $_GET["msg"];

  $perPage = empty($_GET["perPage"]) ? 10 : $_GET["perPage"];

  $page = empty($_GET["page"]) ? 1 : $_GET["page"];

  $startRecord = ($page - 1) * $perPage;

  $sql = "SELECT count(article_id) FROM articles";
  $result = $db->query( $sql );
  $numRecords = $result->fetch_row()[0];

  $sql = " SELECT * FROM articles LIMIT $perPage OFFSET $startRecord";


  $result = $db->query( $sql );
  $prevPage = $page - 1;
  if( $prevPage <= 0 ) {
    $prevPage = 1;
  }

  $prevLink = "<a href='/articles.php?perPage=$perPage&page=$prevPage'>Prev</a>";

  $nextPage = $page + 1;
  if( $nextPage > ($numRecords / $perPage) + 1){
    $nextPage = $page;
  }

  $nextLink = "<a href='/articles.php?perPage=$perPage&page=$nextPage'>Next</a>";

  $tableArticle = <<<END_OF_TABLE

  <h1>Articles</h1>

  <p>$msg</p><br />

    <div>
    <p><a href="/article_new.php">Create New Article</a></p>
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
      <th>Article Title</th>
      <th>Author</th>
      <th>Published Date</th>
    </tr> 

END_OF_TABLE;

  echo $tableArticle;
  while(list( $article_id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row()){
    echo "<tr>
            <td>$title</td>
            <td>$author</td>
            <td>$published_date</td>
            <td><a href=\"/article_edit.php?id=$article_id\">Edit</td>
            <td><a href=\"/article_show.php?id=$article_id\">Show</td>
            <td><a href=\"/article_delete.php?id=$article_id\">Delete</td>
          </tr>";
  }
  echo "</table>";


  include 'templates/footer.php';

