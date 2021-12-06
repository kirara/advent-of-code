<?php
  $file = explode(',', trim(file_get_contents('06.txt')));
  $fish = array_replace(array_fill_keys(range(0,8), 0), array_count_values($file));

  for ($d = 0; $d < 256; $d++) {
    $birth = array_shift($fish);
    $fish[6] += $birth;
    $fish[8] = $birth;
  }

  echo array_sum($fish) . "\n";
