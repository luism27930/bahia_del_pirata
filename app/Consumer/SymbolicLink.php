<?php
class SymbolicLink {
    /** 
     *$user_directory es el destino 
     *$original_path es el directorio donde se encuentra el video
     * Antes del directorio originar debemos pensar cuantos dirctorios
     * deberá pasar el $user_directory para llegar al actual
     */
    public function create($user_directory, $original_path)
    {   # Downloads/'.$link_id.'.'.$format
        #../../storage/app/videos/' . $video->id . '.' . $video->format;
        $command = ('ln -s '. '../../../app/Consumer/'.escapeshellarg($original_path).' '. escapeshellarg($user_directory));
        #ln -s ../../../app/Consumer/Downloads/5.avi ../../storage/app/videos/hatacuandonono.avi
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


    }


}