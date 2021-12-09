<?php
  $file = trim(file_get_contents('09.txt'));
  $map = explode("\n", $file);
  $rowcnt = count($map);
  $colcnt = strlen($map[0]);
  foreach ($map as &$row) $row = array_merge([9], str_split($row), [9]);
  $map = array_merge([array_fill(0, count($map[0]), 9)], $map, [array_fill(0, count($map[0]), 9)]);

  for ($y = 1; $y < $rowcnt+1; $y++) {
    for ($x = 1; $x < $colcnt+1; $x++) {
      if ($map[$y][$x] < min($map[$y-1][$x], $map[$y][$x+1], $map[$y+1][$x], $map[$y][$x-1])) {
        $low[] = $map[$y][$x]+1;
      }
    }
  }
  
  echo array_sum($low) . "\n";