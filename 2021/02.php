<?php
   $file = file('02.txt');
   $pos = $dep = 0;
   foreach ($file as $row) {
     [$dir, $val] = sscanf($row, '%s %i');
     [$pos, $dep] = match ($dir) {
        'up'      => [$pos, $dep - $val],
        'down'    => [$pos, $dep + $val],
        'forward' => [$pos + $val, $dep],
     };
   }
   echo "pos: $pos; dep: $dep; result: " . ($pos * $dep) . "\n";