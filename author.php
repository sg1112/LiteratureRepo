<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("SELECT distinct(fname) FROM author");
    $stmt->execute();
  
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
          $selectAuthor .= "<option value='".$row['fname']."'>".$row['fname']."</option>";
      }
    }
    echo $selectAuthor;
  ?>