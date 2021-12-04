<?php
  $file = file_get_contents('04.txt');
  [$nums, $boards] = preg_split('/[\r\n]+/', $file, 2);
  $nums = explode(',', $nums);
  [$row, ] = preg_split('/[\r\n]/', trim($boards), 2);
  $size = count(preg_split('/\s+/', $row));
  $boards = array_map(fn($board) => preg_split('/\s+/', trim($board)), preg_split('/\n\n|\r\n{2}/', trim($boards)));
  $colmarks = $rowmarks = array_fill(0, count($boards), array_fill(0, $size, 0));
  
  foreach ($nums as $num) {
    foreach($boards as $idx => &$board) {
      if (false !== ($pos = array_search($num, $board))) {
        $board[$pos] = null;
        $col = $pos % $size;
        $row = ($pos - $col) / $size;
        if (++$colmarks[$idx][$col] === $size || ++$rowmarks[$idx][$row] === $size) {
          die('Result: ' . array_sum($board) . ' * ' . $num . " = " . array_sum($board) * $num . PHP_EOL);
        }
      }
    }
  }