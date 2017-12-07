<?php
  include('connection.txt');
  $conn = new mysqli($server, $user, $pass, $dbname, $port);
  if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }
  
  $nodes = array();
  $stmt = $conn->prepare("select paper_id, conference_id from paper");
  $stmt->execute();

  $result = $stmt->get_result();

  if($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
        $nodes[] = array('id' => $row['paper_id'] ,'group' => $row['conference_id']);
    }
  }

  $jsonn = json_encode($nodes);

  $links = array();
  $stmt = $conn->prepare("select paper_id,reference_id,conference_id from paper join reference using(paper_id);");
  $stmt->execute();
  
  $result = $stmt->get_result();
  
  if($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
        $links  [] = array('source' => $row['paper_id'] ,'target' => $row['reference_id'], 'value' => $row['conference_id']);
    }
  }
  $jsonl = json_encode($links);
  $data = array(
  "nodes" => json_decode($jsonn), 
  "links" => json_decode($jsonl)
  );
  header("Access-Control-Allow-Origin: *");
  echo json_encode($data);  
?>
