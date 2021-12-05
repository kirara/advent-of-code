<?php
  $file = file_get_contents('05.txt');
  preg_match_all('/(\d+),(\d+) -> (\d+),(\d+)\r?\n/', $file, $matches, PREG_SET_ORDER);

  $minx = $miny = PHP_INT_MAX;
  $maxx = $maxy = 0;
  foreach ($matches as $match) {
    list( , $x1, $y1, $x2, $y2) = $match;
    $dx = ($x2 - $x1) <=> 0;
    $dy = ($y2 - $y1) <=> 0;
    if ($dx !== 0 && $dy !== 0) continue;
    $minx = min($minx, $x1, $x2);
    $miny = min($miny, $y1, $y2);
    $maxx = max($maxx, $x1, $x2);
    $maxy = max($maxy, $y1, $y2);
    $lines[] = compact('x1', 'y1', 'x2', 'y2', 'dx', 'dy');
  }

  foreach($lines as $line) {
    extract($line);
    for ($x = $x1, $y = $y1; $x != $x2 + $dx || $y != $y2 + $dy; $x += $dx, $y += $dy) {
      $plot[$y][$x] = ($plot[$y][$x] ?? 0) + 1;
    }
  }

  echo array_sum(array_map(fn($row) => array_reduce($row, fn($r, $v) => $r += $v > 1), $plot)) . "\n";
  
   /*****************
    * PLOT PRINTING *
    *****************/
   // $f = fopen('05o.txt', 'w');
   // for ($y = $miny; $y < $maxy; $y++) {
   //   for ($x = $minx; $x < $maxx; $x++) {
   //     fwrite($f, $plot[$y][$x] ?? '.');
   //   }
   //   fwrite($f, "\n");
   // }
