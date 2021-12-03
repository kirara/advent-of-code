<?php
  $file = array_map(fn ($a) => str_split(trim($a)), file('03.txt'));
  $rowcnt = count($file);
  $bits = array_reduce($file, fn($a, $b) => array_map(fn(...$args) => array_sum($args), $a, $b), array());
  $gamma = implode('', array_map(fn($a) => (int) ($rowcnt - $a < $a), $bits));
  $epsilon = strtr($gamma, '01', '10');
  echo bindec($gamma) * bindec($epsilon) . "\n";
