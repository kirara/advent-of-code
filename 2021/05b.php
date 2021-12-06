<?php
  $file = file_get_contents('05.txt');
  preg_match_all('/(\d+),(\d+) -> (\d+),(\d+)\r?\n/', $file, $lines, PREG_SET_ORDER);

  $minx = $miny = PHP_INT_MAX;
  $maxx = $maxy = 0;
  foreach($lines as $line) {
    [ , $x1, $y1, $x2, $y2] = $line;
    $minx = min($minx, $x1, $x2);
    $miny = min($miny, $y1, $y2);
    $maxx = max($maxx, $x1, $x2);
    $maxy = max($maxy, $y1, $y2);
    $dx = ($x2 - $x1) <=> 0;
    $dy = ($y2 - $y1) <=> 0;
    [$x, $y] = [$x1, $y1];
    $cur = [&$x, &$y];
    $end = [$x2 + $dx, $y2 + $dy];
    while ($cur !== $end) {
      $plot[$y][$x] = ($plot[$y][$x] ?? 0) + 1;
      $x += $dx; $y += $dy;
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
