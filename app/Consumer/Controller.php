<?php
require('Connection.php');
class Controller{

    /**
     * Busca un link que coincida con el formato 
     */
    
    public function findLinkAndFormat($video)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query = "SELECT id, path_of_downloads FROM videos WHERE format ='$video->format' AND link ='$video->link' LIMIT 1";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
        $response = mysqli_fetch_row($result);
        return $response;

    }
    /**
     * Si no se encuentra el link con el formato, busca solo el link
     */
    public function findLink($video)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query = "SELECT id, path_of_downloads FROM videos WHERE link = '$video->link' LIMIT 1";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
        $response= mysqli_fetch_row($result);
        return $response;

    }
    /**
     * Actualizar el link del cvideo
     */
    public function updateLink($video, $symbolic_link)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query = "UPDATE links SET symbolic_link = '$symbolic_link', success = 'true'  WHERE id = '$video->id'";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
    }
    public function inProccess($video)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query = "UPDATE links SET success = 'inProcess'  WHERE id = '$video->id'";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
    }

    public function linkError($link_id)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query = "UPDATE links SET success = 'false'  WHERE id = '$link_id'";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
    }

    public function saveVideo($video, $path)
    {
        $conn = new Connection();
        $connection = $conn->conn();
        $query="INSERT INTO videos (link, path_of_downloads, format) VALUES ('$video->link','$path', '$video->format');";
        $result = mysqli_query($connection,$query);
        mysqli_close($connection);
    }

}


