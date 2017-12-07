<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("SELECT * FROM paper");
    $stmt->execute();
  
    $result = $stmt->get_result();

    $data ="";

    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
          $data .= "<div class='post-preview'>
                        <a href='about_paper.php?paper_id=".$row['paper_id']."'>
                            <h2 class='post-title'>".$row['title']."</h2>
                            <h5 class='post-subtitle'>".$row['abstract']."</h3>
                        </a>
                    </div><hr>";
      }
    }
    echo rtrim($data,"<hr>");
  ?>