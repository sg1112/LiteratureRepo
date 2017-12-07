<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("select title, count(author_id) as c from paper join publish using (paper_id) group by paper_id");
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
          $data []= array('Letter' => $row['title'] ,'Freq' => $row['c']);
      }
    }
    echo json_encode($data);
  ?>