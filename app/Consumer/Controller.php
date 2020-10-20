<?php
require('Connection.php');
class Controller{

    /*
    Debe ser llamado luego de convertir el video
    Busca en la base de datos que almacena la información de los videos
    Con el fin de encontrar un video igual y ahorrar espacio
    */
    public function findSum($md5SUM)
    {
        $conn = new Connection();
        $connection = $conn->conn();

        $query = "SELECT id, path_of_downloads FROM videos WHERE md5sum ='$md5SUM' LIMIT 1";

        $result = mysqli_query($connection,$query);

        mysqli_close($connection);
        $response= mysqli_fetch_row($result);
        return $response;

    }

    public function updateLink($video, $symbolic_link)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query = "UPDATE links SET symbolic_link = '$symbolic_link', proccesed = true  WHERE id = '$video->id'";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);

    }
    public function saveVideo($md5SUM, $path)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query="INSERT INTO videos (md5sum, path_of_downloads) VALUES ('$md5SUM','$path');";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
    }


}