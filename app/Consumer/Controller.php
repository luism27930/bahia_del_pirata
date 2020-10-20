<?php
require_once './Connection.php';
class Controller{

    public function findSum($video, $md5SUM)
    {
        $conn = new Connection;
        $connection = $conn->conn();

        $query = "SELECT id, path_of_downloads FROM links WHERE md5sum =".$md5SUM;

        $result = mysqli_query($connection,$query);
        if(!$result) 
        {
            echo "No se ha podido realizar la query";
        }
        mysqli_close($connection);

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