<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    $search_text = "(".$_GET['search_keyword'].")";
    
    $stmt = $conn->prepare("select * from paper join text_keyword using (paper_id) 
                            join keywords using (keyword_id) where keyword_id in ".$search_text." ;");
    
    //$stmt -> bind_param("s", $search_text);
    
    
    $stmt->execute();
    
    
    $result = $stmt->get_result();
    $data = "";
    $i = (int)0;
    $paper = array();

    if($result->num_rows > 0)
    {
      $total = (int)$result -> num_rows;
      while($row = $result->fetch_assoc())
      {
        if (!empty($row['paper_id'])){
          $paper[$row['paper_id']] = $row['title'];
        }
        if ($i == $total-1){
          $data .=  "<div class='post-preview' id='asso_paper'>
                      Paper Associated :
                      <ul>";
          foreach ($paper as $key => $value) {
            $data .= "<li><a href =about_paper.php?paper_id=".$key.">".$value."</a></li>";
          }
          $data .= "</ul></div>";
        }
        $i++;
      }
    }
    echo $data;
  ?>