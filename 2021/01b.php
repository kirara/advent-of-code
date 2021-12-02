<?php
  $file = file('01.txt');
  $n = 0;
  $rows = [];
  foreach ($file as $row) {
    array_push($rows, $row);
    if (count($rows) === 4) {
      array_shift($rows);
      $sum = array_sum($rows);
      $n += ($sum > $lsum);
    }
    $lsum = $sum ?? array_sum($rows);
  }
  echo $n . "\n";