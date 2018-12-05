<?php

  //$title = "Test";
  include 'templates/functions.php';
  include 'templates/header.php';
  /*
    $days_old = ( $age * 365 ) . "days old";
    echo $days_old;

    echo $days_old;

    if ( $age < 21 ) {
      echo $age * 365;
    } else {
      echo "Your age is: $age", "Another String";
      echo "Your age is: " . $age . "<br/>";
    }


    $count = 0;

   while ($count < 10) {
      echo $count;
      echo "<br/>";
      $count = $count + 1;
    }

    echo "<h1>Hello</h1>";

    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $num3 = $_GET['num3'];

  $name = $_GET['name'];  #Query String

  $num1 = $_POST['num1']; #Posted Form
  $num2 = $_POST['num2'];
  $num3 = $_POST['num3'];
  $sum = $num1 + $num2 + $num3;
  echo "Name: $name<br/>";
  echo "Num1: $num1 Num2: $num2<br/>";
  echo "The sum of all numbers is $sum<br/>";


  //mysql -u pjsql -p -h mysqldev.patrickmolvikjr.com phpdev_patrickmolvikjr

  echo "here is the answer" . (-11 % 12);
  */

// //
 // $found_error = false;
 // if(empty($name)){
 //   $name_error = "Name is required";
 //   $found_error = true;
 // }
 // if(empty($location)){
 //   $location_error = "Location is required";
 //   $found_error = true;
 // }
  $try = '2013-05-01 00:22:35';
  echo time_elapsed_string($try);

  include 'templates/footer.php';
?>
