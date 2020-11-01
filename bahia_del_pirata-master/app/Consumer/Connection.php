
<?php

class Connection {

    public function conn()
    {
        $user = "mysql";
        $pass = "mysql";
        $host = "localhost";
        $db   = "bahia_pirata";
        $port = "3306";
        $connection = mysqli_connect($host, $user, $pass, $db, $port);
        return $connection;
    }

}
