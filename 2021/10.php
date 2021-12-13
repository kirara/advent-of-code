<?php
  $file = file('10.txt');

  $match = [
    '(' => ')',
    '[' => ']',
    '{' => '}',
    '<' => '>',
  ];

  $points = [
    ')' => 3,
    ']' => 57,
    '}' => 1197,
    '>' => 25137,
  ];

  $scores = [];
  foreach ($file as $k => $row) {
    $left = [];
    foreach (str_split(trim($row)) as $c) {
      if (in_array($c, array_keys($match))) array_unshift($left, $match[$c]);
      elseif ($c !== $left[0]) { $scores[$k] = $points[$c]; break; }
      else array_shift($left);
    }
  }

  echo array_sum($scores) . "\n";