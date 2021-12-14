<?php
  $file = trim(file_get_contents('14.txt'));
  [$template, $rules] = explode("\n\n", $file);
  
  $rules = explode("\n", $rules);
  foreach ($rules as &$rule) $rule = explode(' -> ', $rule);
  $keys = array_column($rules, 0);
  $vals = array_column($rules, 1);
  $rules = array_combine($keys, $vals);

  $pairs = $empty = array_fill_keys($keys, 0);
  for ($i = 0; $i < strlen($template)-1; $i++) {
    $pairs[substr($template, $i, 2)]++;
  }

  $step = 40;
  while ($step--) {
    $new = $empty;
    foreach ($pairs as $p => $cnt) {
      $new[$p[0] . $rules[$p]] += $cnt;
      $new[$rules[$p] . $p[1]] += $cnt;
    }
    $pairs = $new;
  }

  $chars = array_fill_keys($vals, 0);
  foreach ($pairs as $p => $cnt) {
    $chars[$p[0]] += $cnt;
  }
  $chars[$template[-1]]++;

  rsort($chars);
  $top = $chars[0];
  $bot = end($chars);
  echo $top - $bot . "\n";
