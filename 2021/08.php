<?php
  $file = file_get_contents('08.txt');
  $rows = preg_split('/\r?\n/', trim($file));
  $digits = array_map(function($row) {
    preg_match_all('/[a-g]+/', $row, $matches);
    $matches = array_slice($matches[0], 10);
    return array_reduce($matches, fn($r, $m) =>
      $r += (in_array(strlen($m), [2,3,4,7]))
    );
  }, $rows);

  echo array_sum($digits) . "\n";
