<?php
class SymbolicLink {
    /** 
     *$user_directory es el destino 
     *$original_path es el directorio donde se encuentra el video
     * Antes del directorio originar debemos pensar cuantos dirctorios
     * deberá pasar el $user_directory para llegar al actual
     */
    public function create($user_directory, $original_path)
    {  
        $command = ('ln ' .escapeshellarg($original_path).' '. escapeshellarg($user_directory));

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