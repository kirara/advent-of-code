<?php
   $file = trim(file_get_contents('07.txt'));
   $crabs = explode(',', $file);

   for ($i = min($crabs); $i <= max($crabs); $i++) {
   	 $fuelcost[$i] = array_sum(array_map(fn($hpos) => abs($hpos - $i), $crabs));
   }

   echo min($fuelcost) . "\n";