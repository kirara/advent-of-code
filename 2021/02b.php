<?php
   $file = file('02.txt');
   $pos = $dep = $aim = 0;
   foreach ($file as $row) {
     [$dir, $val] = sscanf($row, '%s %i');
     [$pos, $dep, $aim] = match ($dir) {
        'up'      => [$pos, $dep, $aim - $val],
        'down'    => [$pos, $dep, $aim + $val],
        'forward' => [$pos + $val, $dep + $val * $aim, $aim],
     };
   }
   echo "pos: $pos; dep: $dep; result: " . ($pos * $dep) . "\n";