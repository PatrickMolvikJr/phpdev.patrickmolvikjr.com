<?php
  $title = "Restaurants";

  session_start();
  include 'templates/header.php';
  include 'templates/functions.php';

  $id = $_GET["id"];

  $db = db_connect();

  $msg = $_GET["msg"];



  $perPage = empty($_GET["perPage"]) ? 10 : $_GET["perPage"];

  $page = empty($_GET["page"]) ? 1 : $_GET["page"];

  $startRecord = ($page - 1) * $perPage;

  $sql = "SELECT count(id) FROM restaurants";
  $result = $db->query( $sql );
  $numRecords = $result->fetch_row()[0];

  $sql = " SELECT * FROM restaurants LIMIT $perPage OFFSET $startRecord";


  //echo $sql;    //echo for debugging select statement
  //echo  '<br />';

  $result = $db->query( $sql );  //this is a result object from query command

  echo $_SESSION["Dave"] . "<br />" . $_SESSION["username"] . "<br />";

  $prevPage = $page - 1;
  if( $prevPage <= 0 ) {
    $prevPage = 1;
  }

  $prevLink = "<a href='/restaurants.php?perPage=$perPage&page=$prevPage'>Prev</a>";

  $nextPage = $page + 1;
  if( $nextPage > ($numRecords / $perPage) + 1){
    $nextPage = $page;
  }

  $nextLink = "<a href='/restaurants.php?perPage=$perPage&page=$nextPage'>Next</a>";
  //echo $prevLink;
  //echo "<br />";
  //echo $nextLink;
  //print_r( $result );
  //echo  '<br />';
 // echo "Number of rows: " . $result->fetch_row()[0]; //Primary Key of first row
  //echo  '<br />';
 // echo "Number of rows: " . $result->fetch_row(); //Prints 'array'
/*
  list( $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row();
  echo $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt;

  echo  '<br />';

  list( $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row();
  echo $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt;

  echo  '<br />';

  if ($result->fetch_row())
    echo "True";
  else
    echo "False";
  */

  // HEREDOC

  $tableRestaurant = <<<END_OF_TABLE

  <h1>Restaurants</h1>

  <p>$msg</p><br />

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
      <th>ID</th>
      <th>NAME</th>
      <th>LOCATION</th>
      <th>PRICE RANGE LOW</th>
      <th>PRICE RANGE HIGH</th>
      <th>TAGS</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr> 

END_OF_TABLE;

  echo $tableRestaurant;
  while(list( $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row()){
    echo "<tr>
            <td>$id</td>
            <td><a href=\"/restaurant.php?id=$id\">$name</a></td>
            <td>$location</td>
            <td>$priceRangeLow</td>
            <td>$priceRangeHigh</td>
            <td>$tags</td>
            <td><a href=\"/restaurant_edit.php?id=$id\">Edit</a>\n<a href=\"/restaurant_delete.php?id=$id\">Delete</a></td>
            <td><a href=\"/emailrestaurant.php?id=$id\">Email Details</a></td>
          </tr>";
  }
  echo "</table>";

?>
<?php
  include 'templates/footer.php';
?>

