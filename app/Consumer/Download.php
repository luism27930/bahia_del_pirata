<?php
$original_path="Downloads/3.mp4";
$user_directory="../../../app/../storage/app/videos/5.mp4";
$command = ('ln -s '. '../../../app/Consumer/'.escapeshellarg($original_path).' '. escapeshellarg($user_directory));
#ln -s ../../../app/Consumer/Downloads/2.avi ../../../app/../storage/app/videos/link.avi
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
  echo $command;

// require('Connection.php');


//         $conn = new Connection();
//         $connection = $conn->conn();

//         $query = "SELECT id, path_of_downloads FROM videos where id = 10";

//         $result = mysqli_query($connection,$query);
//         mysqli_close($connection);

//         $response= mysqli_fetch_row($result);

        

//         if($response){
//             echo $response[1];
//         }else{

//             echo "Nothing happens!!";
//         }
    

