<?php
  $file = file('10.txt');

  $match = [
    '(' => ')',
    '[' => ']',
    '{' => '}',
    '<' => '>',
  ];

  $points = [
    ')' => 1,
    ']' => 2,
    '}' => 3,
    '>' => 4,
  ];

  $scores = [];
  foreach ($file as $k => $row) {
    $left = [];
    $corrupt = false;
    foreach (str_split(trim($row)) as $c) {
      if (in_array($c, array_keys($match))) array_unshift($left, $match[$c]);
      elseif ($c !== $left[0]) { $corrupt = true; break; }
      else array_shift($left);
    }
    if (!$corrupt) $scores[$k] = array_reduce(array_map(fn($v) => $points[$v], $left), fn($r, $v) => $r = $r*5 + $v);
  }

  sort($scores);
  echo $scores[(count($scores)-1)/2] . "\n";
