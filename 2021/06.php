<?php
  $file = trim(file_get_contents('06.txt'));
  $fish = explode(',', $file);

  for ($d = 0; $d < 80; $d++) {
    $birth = 0;
    foreach($fish as &$f) {
      if ($f != 0) $f--;
      else {
        $f = 6;
      	$birth++;
      }
    }
    $fish = array_merge($fish, array_fill(0, $birth, 8));
  }

  echo count($fish) . "\n";
