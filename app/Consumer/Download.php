<?php
// 37 - mp4        [1080x1920]
// 46 - webm       [1080x1920]
// 22 - mp4        [720x1280]
// 45 - webm       [720x1280]
// 35 - flv        [480x854]
// 44 - webm       [480x854]
// 34 - flv        [360x640]
// 18 - mp4        [360x640]
// 43 - webm       [360x640]
// 5  - flv        [240x400]
// 17 - mp4        [144x176]

 $link_id = '24';
// $url = 'https://www.youtube.com/watch?v=bQL2FsHe7G4';
//  $template = 'Downloads/'. $link_id.'.%(ext)s';
// $string = ('youtube-dl '. escapeshellarg($url).' -f 18 -o '.
//     escapeshellarg($template));
    
// $descriptorspec = array(
//     0 => array("pipe", "r"), // stdin
//     1 => array("pipe", "w"), // stdout
//     2 => array("pipe", "w"), // stderr
// );
// $process = proc_open($string, $descriptorspec, $pipes);
// $stdout = stream_get_contents($pipes[1]);
// fclose($pipes[1]);
// $stderr = stream_get_contents($pipes[2]);
// fclose($pipes[2]);
// $ret = proc_close($process);
// $data = json_encode(array('status' => $ret, 'errors' => $stderr,
//     'url_orginal' => $url, 'output' => $stdout,
//     'command' => $string));
// echo $data;

// echo ('\n RUTA '.$template.'mp4');
$path = 'Downloads/'.$link_id.'.mp4';
$md5sum = md5_file($path);


// 10368434e472a96a0921dc7e0a4c6b9

// a582f4dfde5389eb0a60f6d0f5048c13

// {"status":0,"errors":"",
//     "url_orginal":"https:\/\/www.youtube.com\/watch?v=bQL2FsHe7G4",
//     "output":"[youtube] bQL2FsHe7G4: Downloading webpage\n[download] Destination: Downloads\/El video m\u00e1s corto del mundo.mp4\n\r[download]   1.8% of 56.98KiB at 46.30KiB\/s ETA 00:01\r[download]   5.3% of 56.98KiB at 133.83KiB\/s ETA 00:00\r[download]  12.3% of 56.98KiB at 309.04KiB\/s ETA 00:00\r[download]  26.3% of 56.98KiB at 653.28KiB\/s ETA 00:00\r[download]  54.4% of 56.98KiB at 529.45KiB\/s ETA 00:00\r[download] 100.0% of 56.98KiB at 660.27KiB\/s ETA 00:00\r[download] 100% of 56.98KiB in 00:00\n",
//     "command":"youtube-dl 'https:\/\/www.youtube.com\/watch?v=bQL2FsHe7G4' -f 18 -o 'Downloads\/%(title)s.%(ext)s'"}