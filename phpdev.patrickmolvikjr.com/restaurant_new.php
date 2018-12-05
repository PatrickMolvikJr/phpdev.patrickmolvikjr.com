<?php
  ob_start();

  include 'templates/header.php';
  include 'templates/functions.php';

  //New items are not created yet, have to use POST
  $submit = $_POST["submit"];

  $db = db_connect();

  $name = mysqli_real_escape_string($db, $_POST["name"]);
  $location = mysqli_real_escape_string($db, $_POST["location"]);
  $priceRangeLow = mysqli_real_escape_string($db, $_POST["priceRangeLow"]);
  $priceRangeHigh = mysqli_real_escape_string($db, $_POST["priceRangeHigh"]);
  $tags = mysqli_real_escape_string($db, $_POST["tags"]);

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

  if( ! $found_error ){
    //insert data  into db
    $sql = "INSERT INTO `restaurants` (`id`, `name`, `location`, `priceRangeLow`, `priceRangeHigh`, `tags`, `modifiedAt`, `createdAt`) VALUES (NULL, '$name', '$location', '$priceRangeLow', '$priceRangeHigh', '$tags', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    echo "SQL: $sql <br />";
    $result = $db->query($sql);
    ob_clean();
    echo "Updated Database";

  }

  $form = <<<END_OF_FORM

  <br />
  <a href="/restaurants.php">See All Restaurants</a>

  <h1>Create a New Restaurant</h1>
  
    <form method="POST" action="/restaurant_new.php">
      
      NAME: <input type="text" name="name" value="$name"><span style="color:red">$name_error</span><br />
      LOCATION: <input type="text" name="location" value="$location"><span style="color:red">$location_error</span><br />
      PRICE RANGE LOW: <input type="text" name="priceRangeLow" value="$priceRangeLow"><br />
      PRICE RANGE HIGH: <input type="text" name="priceRangeHigh" value="$priceRangeHigh"><br />
      TAGS: <input type="text" name="tags" value="$tags"><br />

      <input type="submit" name="submit" value="Create Restaurant">

    </form>
  

END_OF_FORM;

  echo $form;

  include 'templates/footer.php';

  ob_end_flush();
