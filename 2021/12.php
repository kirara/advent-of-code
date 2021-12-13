<?php
  $file = explode("\n", trim(file_get_contents('12.txt')));

  $links = [];
  foreach ($file as $row) {
    $cave = explode('-', $row);
    if ($cave[0] === 'end' || $cave[1] === 'start') {
      $cave = array_reverse($cave);
    }
    $links[$cave[0]][] = $cave[1];
    if ($cave[0] !== 'start' && $cave[1] !== 'end') {
      $links[$cave[1]][] = $cave[0];
    }
  }

  $count = 0;
  $paths = [['start']];
  while (!empty($paths)) {
    $path = array_pop($paths);
    $loc = end($path);
    foreach ($links[$loc] as $cave) {
      if ($cave === 'end') { $count++; continue; }
      if (!ctype_lower($cave) || !in_array($cave, $path)) {
        $paths[] = [...$path, $cave];
      }
    }
  }
  
  echo $count . "\n";
