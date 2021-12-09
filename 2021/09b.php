<?php
  $file = trim(file_get_contents('09.txt'));
  $map = explode("\n", $file);
  $rowcnt = count($map);
  $colcnt = strlen($map[0]);
  foreach ($map as &$row) $row = array_merge([9], str_split($row), [9]);
  $map = array_merge([array_fill(0, count($map[0]), 9)], $map, [array_fill(0, count($map[0]), 9)]);

  $bn = 0;
  $basin = $basins = [];
  for ($y = 0; $y < $rowcnt+2; $y++) {
    for ($x = 0; $x < $colcnt+2; $x++) {
      if ($map[$y][$x] != 9) { 
        $up = "$x|" . ($y-1);
        $basin[] = "$x|$y";
        if (isset($basins[$up])) {
          $merge[$basins[$up]] ??= [];
          $merge[$basins[$up]][] = $bn;
        }
      } elseif (!empty($basin)) {
        $basins += array_fill_keys(array_unique($basin), $bn);
        $basin = [];
        $bn++;
      } 
    }
  }

  $basins = array_reduce(array_keys($basins), function ($r, $k) use (&$basins) {
    $r[$basins[$k]] ??= [];
    $r[$basins[$k]][] = $k;
    return $r;
  }, []);

  foreach ($merge as $k => $arr) {
    if (count($arr) === 1 && !isset($mergeup[$k])) {
      $mergedown[$k] = $arr[0];
    } else foreach ($arr as $v) {
      $mergeup[$v] = $k;
    }
  }
  krsort($mergeup);

  foreach ($mergedown + $mergeup as $k => $v) {
    $basins[$v] = array_merge($basins[$v], $basins[$k]);
    unset($basins[$k]);
  }

  $basins = array_map(fn($arr) => count($arr), $basins);
  rsort($basins);
  echo array_product(array_slice($basins, 0, 3)) . "\n";
  