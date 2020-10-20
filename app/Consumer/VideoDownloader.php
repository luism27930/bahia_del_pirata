<?php
require_once './VideoConverter.php';
use Illuminate\Support\Facades\Storage; #videos in local disk
// // avi
// // mov 
// // mp4 
// // ogg 
// // mkv 

//  $link_id = '25';
//  $url = 'https://www.youtube.com/watch?v=bQL2FsHe7G4';
//  $path = 'Downloads/'. $link_id.'.%(ext)s';
//  $command = ('youtube-dl '. escapeshellarg($url).' -f 18 -o '. escapeshellarg($path));
    
// $descriptorspec = array(
//     0 => array("pipe", "r"), // stdin
//     1 => array("pipe", "w"), // stdout
//     2 => array("pipe", "w"), // stderr
// );
// $process = proc_open($command, $descriptorspec, $pipes);
// $stdout = stream_get_contents($pipes[1]);
// fclose($pipes[1]);
// $stderr = stream_get_contents($pipes[2]);
// fclose($pipes[2]);
// $ret = proc_close($process);
// $data = json_encode(array('status' => $ret, 'errors' => $stderr,
//     'url_orginal' => $url, 'output' => $stdout,
//     'command' => $command));
// // echo $data;

// $path = 'Downloads/'.$link_id.'.mp4';

// $Download = new VideoConverter;
// // $this->$Download->convert($video->id,$path,$video->format);

// $md5sum = md5_file($path);

class VideoDownloader{

    public function download($video)
    {
        
        $path = 'Downloads/'. $video->id.'.%(ext)s';
        $command = ('youtube-dl '. escapeshellarg($video->link).' -f 18 -o '. escapeshellarg($path));
        
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
            array('status' => $ret, 'errors' => $stderr,
                    'url_orginal' => $video->link, 'output' => $stdout,
                    'command' => $command
            )
        );
       // echo $data;
    
        #Ruta del archivo
        $path = 'Downloads/'.$video->id.'.mp4';

        #Obtener suma para comparar en DB
        $md5sum = md5_file($path);


        #Convertirlo después de validar sumatoria
        if ($video->format != 'mp4') {
            $Download = new VideoConverter;
            $Download->convert($video->id,$path,$video->format);
            unlink($path);
        }else{
            
        }


        #Directorio del usuario con el nombre del archivo de enlace simbílico en laravel
        $user_directory = public_path('storage/videos/'.$video->id.'.'.$video->format);
    


    }


}