<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("select  * from author join publish using (author_id) join paper using (paper_id) 
                          where citation >= ? and citation<= ?");

    $start = $_GET['start_cite'];
    $end = $_GET['end_cite'];

    $stmt->bind_param("ss", $start, $end);    
    
    $stmt->execute();
  
    $result = $stmt->get_result();
    $data ="";
    $append = "TRUE";
    $auth = array(); 

    $i = (int)0;

    if($result->num_rows > 0)
    {
      $total = (int)$result -> num_rows;
      $data .= "<div class='post-preview'><ul>";
      while($row = $result->fetch_assoc())
      {
        if (!empty($row['author_id'])){
            $auth[$row['author_id']."$$".$row['fname']." ".$row['lname']] = $row['citation'];
        }
        if ($i == $total-1){
          foreach ($auth as $key => $value) {
            $arr = explode ("$$", $key);
            $data .= "<li><a href =about_author.php?author_id=".$arr[0].">".$arr[1]."</a> - (".$value.")</li>";
          }
        }
        $i++;
      }
      $data .= "</ul></div>";
    }
    echo $data;
  ?>