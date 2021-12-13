<?php
  [$coords, $instructions] = explode("\n\n", trim(file_get_contents('13.txt')));

  $coords = explode("\n", $coords);
  foreach ($coords as $row) {
    [$x, $y] = explode(',', $row);
    $mx = max($mx ?? 0, $x);
    $my = max($my ?? 0, $y);
    $map[$y][$x] = true;
  }
  
  preg_match_all('/([xy])=(\d+)/', $instructions, $folds);
  $folds = array_map(null, ...(array_slice($folds, 1)));

  foreach ($folds as [$axis, $pos]) {
    if ($axis == 'y') {
      $w = $my - $pos;
      for ($y = $pos - $w; $y < $pos; $y++) {
        for ($x = 0; $x <= $mx; $x++) {
          if (!empty($map[$y][$x]) | !empty($map[$my-$y][$x])) $map[$y][$x] = true;
        }
      }
      $my = $w-1;
    } else {
      $w = $mx - $pos;
      for ($y = 0; $y <= $my; $y++) {
        for ($x = $pos - $w; $x < $pos; $x++) {
          if (!empty($map[$y][$x]) | !empty($map[$y][$mx-$x])) $map[$y][$x] = true;
        }
      }
      $mx = $w-1;
    }
  }

  for ($y = 0; $y <= $my; $y++) {
    for ($x = 0; $x <= $mx; $x++) {
      echo !empty($map[$y][$x]) ? '#' : '.';
    }
    echo "\n";
  }