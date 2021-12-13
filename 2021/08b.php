<?php
  $match = [
    2 => [1],
    3 => [7],
    4 => [4],
    5 => [2, 3, 5],
    6 => [0, 6, 9],
    7 => [8],
  ];

  $file = file_get_contents('08.txt');
  $entries = preg_split('/\r?\n/', trim($file));
  $entries = array_map(function($row) use ($match) {
    preg_match_all('/[a-g]+/', $row, $patterns);
    $patterns = array_map(function($pattern) {
      $pattern = str_split($pattern);
      sort($pattern);
      return implode('', $pattern);
    }, $patterns[0]);

    $result = array_slice($patterns, 10);
    $patterns = array_slice($patterns, 0, 10);
  
    $dict = [];
    foreach ($match as $len => $digits) {
      $dict += array_fill_keys($digits, array_values(preg_grep("/^[a-g]{{$len}}$/", $patterns)));
    }
    print_r($dict);
    foreach ($dict as $digit => &$patterns) {
      if (count($patterns) === 1) continue;
      $c = strlen($patterns[0]);
      $p = $dict[1][0];
      $patterns = array_values(preg_grep("/[$p].*[$p]/", $patterns, !in_array($digit, [0,1,3,4,7,8,9])));
      $p = $dict[4][0];
      $patterns = array_values(preg_grep("/[$p].*[$p].*[$p]/", $patterns, !in_array($digit, [0,3,4,5,6,8,9])));
      $patterns = array_values(preg_grep("/[$p].*[$p].*[$p].*[$p]/", $patterns, !in_array($digit, [4,8,9])));
    }

    ksort($dict);
    $dict = array_flip(array_column($dict, 0));
    return (implode('', array_map(fn($v) => $dict[$v], $result)));
  }, $entries);

  echo array_sum($entries) . "\n";