<?php
  $file = file('01.txt');
  $n = 0;
  $lrow = PHP_INT_MAX;
  foreach ($file as $row) {
    $n += ($row > $lrow);
    $lrow = $row;
  }
  echo $n . "\n";
