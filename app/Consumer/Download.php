<?php
$original_path="downloads/audio.mp4";
$user_directory=public_path("storage/videos/audio.mp4");
  $command = ('ln -s '. '../../app/Consumer/'.escapeshellarg($original_path).' '. escapeshellarg($user_directory));
    
  $descriptorspec = array(
      0 => array("pipe", "r"), // stdin
      1 => array("pipe", "w"), // stdout
      2 => array("pipe", "w"), // stderr
  );
  $process = proc_open($command, $descriptorspec, $pipes);
  $stdout = stream_get_contents($pipes[1]);
  fclose($pipes[1]);
  $stderr = stream_get_contents($pipes[2]);
  fclose($pipes[2]);
  $ret = proc_close($process);
  $data = json_encode(array('status' => $ret, 'errors' => $stderr, 'output' => $stdout,
      'command' => $command));
  // echo $data;