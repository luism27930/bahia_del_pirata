<?php
require_once './VideoConverter.php';
require_once './Controller.php';
require_once './SymbolicLink.php';
use Illuminate\Support\Facades\Storage; #videos in local disk

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
            $path_of_converted_video = $Download->convert($video->id,$path,$video->format);
            unlink($path);// Eliminamos el video descargado
            $md5sum = md5_file($path_of_converted_video);

            $controller = new Controller;
            $response = $controller->findSum($md5sum);

            if($response){
                #Directorio del usuario con el nombre del archivo de enlace simbílico en laravel
                   $user_directory = public_path('storage/videos/'.$video->id.'.'.$video->format);
                   unlink($path_of_converted_video);
                   $path_of_converted_video=$response->path_of_downloads;
                   $SymbolicLink=new SymbolicLink;
                   $SymbolicLink->create($user_directory,$path_of_converted_video);
            }else{
                $SymbolicLink=new SymbolicLink;
                $SymbolicLink->create($user_directory,$path_of_converted_video);
                $controller->saveVideo($md5sum, $path_of_converted_video);
                $controller->updateLink($video, $user_directory);
            }
        }else{

        }
    }


}