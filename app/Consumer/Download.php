<?php
// $original_path="Downloads/3.mp4";
// $user_directory="../../../app/../storage/app/videos/5.mp4";
// $command = ('ln -s '. '../../../app/Consumer/'.escapeshellarg($original_path).' '. escapeshellarg($user_directory));
// #ln -s ../../../app/Consumer/Downloads/2.avi ../../../app/../storage/app/videos/link.avi
//   $descriptorspec = array(
//       0 => array("pipe", "r"), // stdin
//       1 => array("pipe", "w"), // stdout
//       2 => array("pipe", "w"), // stderr
//   );
//   $process = proc_open($command, $descriptorspec, $pipes);
//   $stdout = stream_get_contents($pipes[1]);
//   fclose($pipes[1]);
//   $stderr = stream_get_contents($pipes[2]);
//   fclose($pipes[2]);
//   $ret = proc_close($process);
//   $data = json_encode(array('status' => $ret, 'errors' => $stderr, 'output' => $stdout,
//       'command' => $command));
//   echo $command;

$link = 'https://www.youtube.com/watch?v=g9-t7vq-Z8M&ab_channel=Bizarrap';

$path = 'Downloads/Prueba.mp4';
$command = ('youtube-dl ' . escapeshellarg($link) . ' -f 18 -o ' . escapeshellarg($path));

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
$data = json_encode(
    array(
        'status' => $ret, 'errors' => $stderr,
        'url_orginal' => $video->link, 'output' => $stdout,
        'command' => $command
    )
);
echo $data;