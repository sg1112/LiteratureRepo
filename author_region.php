<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $table = "<div class='table-responsive'>  <table class='table'><th>Author Name</th><th>Affiliation</th><th>Citiation</th>";
    
    $stmt = $conn->prepare("select count(author_id),paper_id from paper join publish using (paper_id) join author using(author_id) group by paper_id;");
    $stmt->execute();
    $result = $stmt->get_result();
    

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
          $table .= "<tr><td>".$row['fname']." ".$row['lname']."</td><td>".$row['affiliations']."</td><td>".$row['citation']."</td></tr>";
      }
    }
    
    $table .= "</table></div>";
    echo $table;
  ?>