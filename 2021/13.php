<?php
  [$coords, $instructions] = explode("\n\n", trim(file_get_contents('13.txt')));

  $coords = explode("\n", $coords);
  $map = array_fill_keys($coords, true);

  $t = array_flip(['x', 'y']);
  $folds = explode("\n", $instructions);
  foreach ($folds as &$fold) {
    $fold = explode('=', $fold);
    $fold[0] = $t[$fold[0][-1]];
  }

  foreach ($folds as [$axis, $pos]) {
    foreach ($map as $coords => $unused) {
      $coord = explode(',', $coords);
      if ($coord[$axis] < $pos) continue;
      unset($map[$coords]);
      $coord[$axis] = $pos - ($coord[$axis] - $pos);
      $map[implode(',', $coord)] = true;
    }
    break;
  }

  echo array_sum(array_values($map)) . "\n";