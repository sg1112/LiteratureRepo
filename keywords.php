<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("select * FROM keywords");
    $stmt->execute();
  
    $result = $stmt->get_result();

    $data = "";

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $data .= "<div><input class ='key' type='checkbox' id=".$row['keyword_id']." name=".$row['term']." value=".$row['keyword_id'].">
                  <label for=".$row['keyword_id'].">".$row['term']."</label></div>";
      }
    }
    echo $data;
  ?>