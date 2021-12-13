<?php
  $file = explode("\n", trim(file_get_contents('11.txt')));
  $map = array_map(fn($r) => str_split($r), $file);
  $dr = [-1,-1,-1, 0, 0, 1, 1, 1];
  $dc = [-1, 0, 1,-1, 1,-1, 0, 1];

  $cnt = 0;
  $flash = 0;
  $boom = [];
  while (count(array_merge(...$boom)) < 100) {
    $cnt++;
    $iter = 0;
    $boom = [];
    foreach ($map as $r => &$row) {
      foreach ($row as $c => &$cell) {
        if (++$cell > 9) {
          $cell = 0;
          $flash++;
          $boom[$iter][] = [$r, $c];
        }
      }
    }
    
    while (!empty($boom[$iter])) {
      $iter++;
      $boom[$iter] = [];
      $boomall = array_merge(...$boom);
      foreach ($boom[$iter-1] as [$r, $c]) {
        foreach (range(0, 7) as $i) {
          $coord = [$r+$dr[$i], $c+$dc[$i]];
          if (!in_array($coord[0], range(0, 9)) || !in_array($coord[1], range(0, 9)) 
            || in_array($coord, $boomall) || in_array($coord, $boom[$iter])) continue;
          $cell = &$map[$coord[0]][$coord[1]];
          if (++$cell > 9) {
            $cell = 0;
            $flash++;
            $boom[$iter][] = $coord;
          }
        }
      }
    }
  }
  
  echo "Steps: $cnt" . "\n";
  echo "Flashes: $flash" . "\n";
  