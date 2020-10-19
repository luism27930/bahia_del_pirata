<?php
$url = 'https://www.youtube.com/watch?v=bQL2FsHe7G4';
$template = 'downloads\%(id)s.%(ext)s';
$string = ('youtube-dl ' . escapeshellarg($url) . ' -f 18 -o ' .
    escapeshellarg($template));

$descriptorspec = array(
    0 => array("pipe", "r"), // stdin
    1 => array("pipe", "w"), // stdout
    2 => array("pipe", "w"), // stderr
);
$process = proc_open($string, $descriptorspec, $pipes);
$stdout = stream_get_contents($pipes[1]);
fclose($pipes[1]);
$stderr = stream_get_contents($pipes[2]);
fclose($pipes[2]);
$ret = proc_close($process);
echo json_encode(array('status' => $ret, 'errors' => $stderr,
    'url_orginal' => $url, 'output' => $stdout,
    'command' => $string));