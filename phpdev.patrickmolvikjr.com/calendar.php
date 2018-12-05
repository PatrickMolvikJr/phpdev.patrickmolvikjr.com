<?php
  $title = "Calendar";
  include 'templates/header.php';

  $month = $_GET["month"];
  if(empty( $month )) {
    $month = date("n");
    $track_m = $month;
  }

  $year = $_GET["year"];
  if(empty( $year )) {
    $year = date("Y");

  }

  echo date("n/d/y");
  echo "<br />";



  echo "<br/>" . date("w");
  //$month = date("n");

  $firstOfTheMonth = mktime(0, 0, 0, $month, 1, $year);
  $firstDay = date("w", $firstOfTheMonth);

  $prev_month = $month - 1;
  $next_month = $month + 1;


  if($month % 12 == 0 && $month >= 12){
    $track_m = 1;


  } elseif($month % 12 == 0 && $month <= 0) {
    $track_m = 12;


  }



  $lastDay = date('t',strtotime("{$year}-{$track_m}-1"));

  echo "First Day: " . $firstDay;
  echo "<br />" . "Last Day: " . $lastDay;
  $cal_title = date("F Y", mktime(0, 0, 0, $month, 1, $year) );


?>

<h1>Calendar</h1>
<p>This is the Calendar Page</p>

<div class = "head_container">
  <a class="button" href="http://phpdev.patrickmolvikjr.com/calendar.php?month=<?php $track_m -= 1; echo $prev_month ?>year=<?php echo $year?>">Prev</a>

  <h1 class = "month_h1"><?php echo $cal_title ?></h1>

  <a  class="button" href="http://phpdev.patrickmolvikjr.com/calendar.php?month=<?php $track_m += 1; echo $next_month ?>year=<?php echo $year?>">Next</a>
</div>

<table>
  <tr>
    <td>Sunday</td>
    <td>Monday</td>
    <td>Tuesday</td>
    <td>Wednesday</td>
    <td>Thursday</td>
    <td>Friday</td>
    <td>Saturday</td>
  </tr>
  <tr>
    <?php
      while( $firstDay > 0 ) {

        echo '<td>-</td>';
        $firstDay -= 1;

      }
      $firstDay = date("w", $firstOfTheMonth);
      $count = 7 - $firstDay;
      $day = 1;
      while($count > 0) {
        echo '<td>' . $day . '</td>';
        $count -= 1;
        $day += 1;
      }

    ?>
  </tr>
  <tr>
    <?php
      $dayOfWeek = 0;
      while($day <= $lastDay) {

        if ($dayOfWeek % 7 == 0) {
          echo "<tr>";
        }
        echo "<td>" . $day . "</td>";
        $day += 1;
        $dayOfWeek += 1;
        if ($dayOfWeek % 7 == 0) {
          $dayOfWeek = 0;
          echo "</tr>";
        }
      }

      $remainingDays = 7 - $dayOfWeek;

      while($remainingDays > 0) {
        echo "<td>-</td>";
        $remainingDays -= 1;
      }

    ?>
  </tr>
</table>

<?php

include 'templates/footer.php';
?>
