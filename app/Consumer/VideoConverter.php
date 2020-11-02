<?php
class VideoConverter {
    /** 
     * $link_id es requerido para nombrar el archivo,
     * de esta forma cuando un usuario desee descargar,
     * podrá accederlo facilmente, además, se creará 
     * un link relativo a este.
     * 
     * 
     */
    public function convert($link_id, $original_path, $format)
    {
        $newPath = 'Downloads/'.$link_id.'.'.$format;
        $command = ('ffmpeg -i '. escapeshellarg($original_path).' '. escapeshellarg($newPath));
    
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
        $data = json_encode(array('status' => $ret, 'errors' => $stderr,
            'url_orginal' => $newPath, 'output' => $stdout,
            'command' => $command));
        
        return $newPath;

    }


}