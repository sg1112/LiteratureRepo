<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("select count(conference_id) as c, country from conference  group by country;");
    $stmt->execute();
    $result = $stmt->get_result();

    $csv = "date close". PHP_EOL;
    $data = array();

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
          $csv .= $row['country']." ".$row['c']. PHP_EOL;
          $data [] = array('emote' => $row['country'], 'count' => $row['c']);
      }
    }
    echo json_encode($data);
  ?>