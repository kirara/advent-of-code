<?php
  $file = trim(file_get_contents('14.txt'));
  [$template, $rules] = explode("\n\n", $file);
  
  $rules = explode("\n", $rules);
  foreach ($rules as &$rule) $rule = explode(' -> ', $rule);
  $vals = array_column($rules, 1);
  $rules = array_combine(array_column($rules, 0), $vals);
  
  $chars = array_count_values(str_split($template));
  $chars += array_fill_keys($vals, 0);

  $step = 10;
  while ($step--) {
    $pairs = [];
    for ($i = 0; $i < strlen($template); $i++) {
      $pairs[] = substr($template, $i, 2);
    }
    $end = array_pop($pairs);
    
    $template = '';
    foreach ($pairs as $p) {
      foreach ($rules as $a => $b) {
        if ($p === $a) {
          $template .= "$a[0]$b";
          $chars[$b]++;
          break;
        }
      }
    }
    $template .= $end;
  }

  rsort($chars);
  $top = $chars[0];
  $bot = end($chars);
  echo $top - $bot . "\n";
