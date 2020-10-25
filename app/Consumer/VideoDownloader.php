<?php

require('VideoConverter.php');
require('Controller.php');
require('SymbolicLink.php');

class VideoDownloader
{

    public function download($video)
    {
        #Directorio del usuario con el nombre del archivo de enlace simbólico en laravel
        $user_directory = '../../storage/app/videos/' . $video->id . '.' . $video->format;
        $symbolic_link = $video->id . '.' . $video->format;
        $SymbolicLink = new SymbolicLink();
        $controller = new Controller();
        $Converter = new VideoConverter();

        #Validar si existe el link con el formato
        $response = $controller->findLinkAndFormat($video);
 
        if ($response) {
            echo "Hay uno igual \n";
            #actualizamos la ruta nuevamente con la ruta del video exitente
            $path_of_converted_video = $response[1];
            $SymbolicLink->create($user_directory, $path_of_converted_video);
            $this->updateLink($video, $symbolic_link);
        }else {

            $response = $controller->findLink($video);
            if ($response) {
                echo "Hay un link igual \n";
                #Convertimos el video al formato deseado
                $path_of_converted_video = $response[1];
                $path_of_converted_video = $Converter->convert($video->id, $path_of_converted_video, $video->format);
                $SymbolicLink->create($user_directory, $path_of_converted_video);
                $this->updateLink($video, $symbolic_link);
            } else {
                #Descarga 
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
                $path_of_converted_video = '';
                // validar si existe la ruta(el video se pudo descargar)
                if (file_exists($path)) {
                    if ($video->format != 'mp4') {
                        $path_of_converted_video = $Converter->convert($video->id, $path, $video->format);
                        unlink($path); // Eliminamos el video descargado en mp4 por defecto

                    } else {

                        $path_of_converted_video = $path;
                    }

                    $SymbolicLink->create($user_directory, $path_of_converted_video);
                    $controller->saveVideo($video, $path_of_converted_video);
                    $this->updateLink($video, $symbolic_link);
                } else {

                    //En caso de error en la descarga
                    $controller = new Controller();
                    $controller->linkError($video->id);

                }
            }
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
