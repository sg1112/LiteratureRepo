<?php
    include('connection.txt');
    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    
    $stmt = $conn->prepare("select * from conference  join paper using (conference_id)
                                    left join (select * from conference_domain join domain using (domain_id)) as t
                                    using (conference_id) where term like ?");

    $search_text = '%'.$_GET['search_keyword'].'%';
    $stmt->bind_param("s", $search_text);
    $stmt->execute();
  
    $result = $stmt->get_result();
    $data ="";

    $append = "TRUE";
    $paper = array(); 
    $domain = array();
    $keyw = array();
    $conf = array();
    $i = (int)0;

    if($result->num_rows > 0)
    {
      $total = (int)$result -> num_rows;
                
                while($row = $result->fetch_assoc()){
                    if ($append === "TRUE"){
                      $data .= "<div class='post-preview'>
                                <h2 class='section-heading'>".$row['conference_name']."</h2>
                                <p><b>Location: </b>".$row['city']." ".$row['state']." ".$row['country']." </p>
                                <p><b>Dates: </b>".$row['startDate']." to ".$row['endDate']." </p>";
                                
                      $append = "FALSE";
                    }
                    
                    if (!empty($row['paper_id'])){
                      $paper[$row['paper_id']] = $row['title'];
                    }
                    
                    if(!empty($row['domain'])){
                        $domain[$row['domain']] = 0;
                    }
                    
                    
                    if ($i == $total-1){

                      if (sizeof($paper) > 0){
                        $data .= "<br><b> Published Paper : </b><ul>";
                        foreach ($paper as $key => $value) {
                          $data .= "<li><a href=about_paper.php?paper_id=".$key.">".$value."</a></li>";
                        }
                        $data .= "</ul>";
                      }

                      if (sizeof($domain) > 0){
                        $data .= "<p><b> Related Domain : </b>";
                        foreach ($keyw as $key => $value) {
                          $data .= $key.", ";
                        }
                        $data .= "</p>";  
                      }
                      $data .= "</div>";
                    }
                    $i++;
                }
              }
              echo $data;
  ?>