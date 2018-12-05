<?php
  ob_start();

  include 'templates/header.php';
  include 'templates/functions.php';


  $id = $_GET["id"];

  $submit = $_POST["submit"];

  $db = db_connect();


  if(empty($submit)){
  //get data from the database

  $sql = "SELECT * FROM restaurants WHERE id=$id";


  echo $sql;    //echo for debugging select statement

  $result = $db->query( $sql );
  list( $id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row();
  echo "<br />";
  echo $name;
  } else {
    //get data from posted form
    $name = $_POST["name"];
    $location = $_POST["location"];
    $priceRangeLow = $_POST["priceRangeLow"];
    $priceRangeHigh = $_POST["priceRangeHigh"];
    $tags = $_POST["tags"];

    $modifiedAt = date_create();
    $modifiedAt = $modifiedAt->format("Y-m-d H:i:s");

    //error checking
    $found_error = false;
    if(empty($name)){
      $name_error = "Name is required";
      $found_error = true;
    }
    if(empty($location)){
      $location_error = "Location is required";
      $found_error = true;
    }
    if( ! $found_error ) {
      //execute when no errors are found
      $sql = "UPDATE restaurants SET name='$name', location='$location', priceRangeLow='$priceRangeLow', priceRangeHigh='$priceRangeHigh', tags='$tags', modifiedAt='$modifiedAt' WHERE id='$id'";
      echo "SQL: $sql <br />";
      $result = $db->query($sql);
      echo "Updated Database";
      ob_clean();
      header("Location: /restaurant.php?id=$id");
    }
  }

  $form = <<<END_OF_FORM

  <br />
  <a href="/restaurants.php">See All Restaurants</a>

  <h1>Edit Restaurant</h1>
  
    <form method="POST" action="/restaurant_edit.php?id=$id">
      
      NAME: <input type="text" name="name" value="$name"><span style="color:red">$name_error</span><br />
      LOCATION: <input type="text" name="location" value="$location"><span style="color:red">$location_error</span><br />
      PRICE RANGE LOW: <input type="text" name="priceRangeLow" value="$priceRangeLow"><br />
      PRICE RANGE HIGH: <input type="text" name="priceRangeHigh" value="$priceRangeHigh"><br />
      TAGS: <input type="text" name="tags" value="$tags"><br />

      <input type="hidden" id="$id">

      <input type="submit" name="submit" value="Save Changes">

    </form>
  

END_OF_FORM;

  echo $form;

  include 'templates/footer.php';

  ob_end_flush();
