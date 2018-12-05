<?php

  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

  function set_login($email, $name)
  {
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
  }


  function db_connect()
  {
    //Database Object
    $db = new mysqli("mysql.patrickmolvikjr.com", "pjsql", "Azzapower1", "phpdev_patrickmolvikjr");

    //If database connection fails
    if ($db->connect_errno) {
      echo "FAILED TO CONNECT TO DATABASE: (" . $db->connect_errno . ") " . $db->connect_error;
    }
    return $db;
  }

  /**
   * @param $optionsArray
   * @param $selectedOption
   */
  function CreateSelectBox($optionsArray, $selectedOption, $selectBoxName)
  {
    echo "<select name='$selectBoxName'>";
    $count = 0;
    while ($count < count($optionsArray)) {

      echo "<option ";

      if ($selectedOption == $optionsArray[$count]) {
        echo "selected='selected'";
      }

      echo ">";
      echo $optionsArray[$count];
      echo "</option>";

      $count = $count + 1;

    }

    echo "</select>";
  }




