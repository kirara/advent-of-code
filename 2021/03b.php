<?php
  $file = array_map(fn($a) => str_split(trim($a)), file('03t.txt'));

  function find_rating(array $report, bool $bit) {
    $n = 0;
    while (count($report) > 1) {
      $rowcnt = count($report);
      $ones = array_sum(array_column($report, $n));
      $keep = (($rowcnt - $ones <= $ones) xor !$bit);
      $report = array_filter($report, fn($v) => $v[$n] == $keep);
      $n++;
    }
    return implode('', current($report));
  }

  $gamma = find_rating($file, 1);
  $epsilon = find_rating($file, 0);

  echo bindec($gamma) * bindec($epsilon) . "\n";
