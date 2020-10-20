<?php

require('VideoConverter.php');
require('Controller.php');
require('SymbolicLink.php');

class VideoDownloader
{

    public function download($video)
    {


        $path = 'Downloads/' . $video->id . '.%(ext)s';
        $command = ('youtube-dl ' . escapeshellarg($video->link) . ' -f 18 -o ' . escapeshellarg($path));

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
        // echo $data;

        #Ruta del archivo
        $path = 'Downloads/' . $video->id . '.mp4';

        // validar si existe la ruta(el video se pudo descargar)
        if (file_exists($path)) {
            #Obtener suma para comparar en DB
            $md5sum = md5_file($path);
            #Convertirlo después de validar sumatoria
            if ($video->format != 'mp4') {
                $Download = new VideoConverter();
                $path_of_converted_video = $Download->convert($video->id, $path, $video->format);
                unlink($path); // Eliminamos el video descargado en mp4 por defecto
                $md5sum = md5_file($path_of_converted_video);
            } else {

                $path_of_converted_video = $path;
            }
            $controller = new Controller();
            $response = $controller->findSum($md5sum);

            #Directorio del usuario con el nombre del archivo de enlace simbólico en laravel
            $user_directory = '../../storage/app/videos/' . $video->id . '.' . $video->format;
            $symbolic_link = $video->id . '.' . $video->format;
            $SymbolicLink = new SymbolicLink();

            #Si hay un video igual
            if ($response) {
                echo "Hay uno igual  ";
                unlink($path_of_converted_video);
                #actualizamos la ruta nuevamente con la ruta del video exitente
                $path_of_converted_video = $response[1];

                $SymbolicLink->create($user_directory, $path_of_converted_video);

                $this->updateLink($video, $symbolic_link);
            } else {
                $SymbolicLink->create($user_directory, $path_of_converted_video);
                $controller->saveVideo($md5sum, $path_of_converted_video);

                $this->updateLink($video, $symbolic_link);
            }
        }else{
        
            /**
            *Llamar al controller e indicar en un campo de tabla de links, que el video no
            *pudo ser descargado con ese video al saber que no pudo ser descargado podríamos
            *dar la opción de editarlo solo en caso de que ul nuevo campo en la tabla 
            *links "success" = false
            */    

        }
    }
    #Directorio que el usuario debe tener para llegar a laravel y poder descargar
    public function updateLink($video, $symbolic_link)
    {
        $controller = new Controller();
        $symbolic_link = $video->id . '.' . $video->format;
        $controller->updateLink($video, $symbolic_link);
    }
}
