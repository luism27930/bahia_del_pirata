<?php
require_once './Connection.php';
class Controller{

    /*
    Debe ser llamado luego de convertir el video
    Busca en la base de datos que almacena la información de los videos
    Con el fin de encontrar un video igual y ahorrar espacio
    */
    public function findSum($md5SUM)
    {
        $conn = new Connection;
        $connection = $conn->conn();

        $query = 'SELECT id, path_of_downloads FROM videos WHERE md5sum ='.$md5SUM.' LIMIT 1' ;

        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
        return $result;

    }

    public function updateLink($video, $md5SUM, $path, $symbolic_link)
    {
        $conn = new Connection;
        $connection = $conn->conn();

        $query = 'UPDATE links SET md5sum = '. $md5SUM.', path_of_downloads = '. $path .', symbolic_link = '. $symbolic_link .', proccesed = true  WHERE id = '.$video->id;

        $result = mysqli_query($connection,$query);
        if(!$result) 
        {
            echo "No se ha podido realizar la query";
        }
        mysqli_close($connection);

    }


}