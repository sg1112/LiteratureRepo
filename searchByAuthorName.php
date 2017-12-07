<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $search_text = $_GET['search_keyword'];
    
    $stmt = $conn->prepare("select * from author join publish using (author_id) join paper using (paper_id) where fname=?");
    
    $stmt->bind_param("s", $search_text);
    
    $stmt->execute();
  
    $result = $stmt->get_result();

    $data ="";
    $append = "TRUE";
    $paper = array();
    $i = (int)0;
    
    if($result->num_rows > 0)
    {
      $total = (int)$result -> num_rows;
      while($row = $result->fetch_assoc())
      {
        if ($append === "TRUE"){
          $data .= "<div class='post-preview'>
                  <h2 class='section-heading'>".$row['fname']." ";
        
          if (empty($row['mname'])){
            $data .= $row['lname']."</h2>";
          }
          else{
            if (strlen($row['mname']) == 1){
              $data .= $row['mname'].". ".$row['lname']."</h2>";
            }
            else{
              $data .= $row['mname']." ".$row['lname']."</h2>";
            }
          }

          $data .= "<p><b>Email: </b>".$row['email']."</p>";
          $data .= "<p><b>Affiliation: </b>".$row['affiliations']."</p>";
          if (!empty($row['citation'] > 1)){
              $data .= "<p><b>Citations: </b>".$row['citation']."</p>";
          }
          $data .= "</div>";
          $append = "False"; 
        }
        if (!empty($row['paper_id'])){
          $paper[$row['paper_id']] = $row['title'];
        }
        if ($i == $total-1){
          $data .= "<b> Papers Published : </b> <ul>";
          foreach ($paper as $key => $value) {
            $data .= "<li><a href =about_paper.php?paper_id=".$key.">".$value."</a></li>";
          }
          $data .= "</ul>";
        }
        $i++;
      }
    }
    echo $data;
?>