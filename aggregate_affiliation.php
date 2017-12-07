<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("select count(paper_id) as c, affiliations from paper join publish using (paper_id) join author using (author_id) group by affiliations;");
    $stmt->execute();
    $result = $stmt->get_result();

    $csv = "id,value". PHP_EOL;

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
          $csv .= $row['affiliations'].",".$row['c']. PHP_EOL;
      }
    }
    echo ($csv);
  ?>