<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Research Paper Repository</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="simplesearch.php">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="complexlookup.php">Analysis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="refernces.php">References</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/2-15.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>About Me</h1>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="mx-auto">
         <?php
              include('connection.txt');
              $conn = new mysqli($server, $user, $pass, $dbname, $port);
              if ($conn->connect_errno) {
                echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
              }
    
              $stmt = $conn->prepare("select * from paper p left join conference using (conference_id) left join 
                  (select * from publish join author using (author_id) ) as  t using (paper_id)
                  left join reference using(paper_id) left join reference_url using(paper_id) 
                  left join (select * from text_keyword join keywords using(keyword_id)) as t2  using (paper_id)  where paper_id = ? ");

              $stmt1 = $conn->prepare("select title from paper where paper_id = ? LIMIT 1");
  
              $paper_id = $_GET['paper_id'];

              $stmt->bind_param("s", $paper_id);    
              
              $stmt->execute();
            
              $result = $stmt->get_result();

              $data ="";

              $append = "TRUE";
              $auth = array(); 
              $ref = array();
              $keyw = array();
              $conf = array();
              $ref_url = array();

              $i = (int)0;

              if($result->num_rows > 0)
              {
                $total = (int)$result -> num_rows;
                
                while($row = $result->fetch_assoc()){
                    if ($append === "TRUE"){
                      $data .= "<div class='post-preview'>
                                <h2 class='section-heading'>".$row['title']."</h2>
                                <p><b>Abstract: </b>".$row['abstract']."</p>
                                <a href = ".$row['url']."><b>Ref URL: </b>".$row['url']."</a>
                                <br><b>Authors: </b>";
                      $append = "FALSE";
                    }
                    
                    if (!empty($row['author_id'])){
                      $auth[$row['author_id']."$$".$row['fname']." ".$row['lname']] = 0;
                    }
                    
                    if(!empty($row['reference_id'])){
                      $stmt1->bind_param("s", $row['reference_id']);    
                      $stmt1->execute();            
                      $res = $stmt1->get_result();
                      if($res->num_rows > 0)
                      {
                        while($r = $res->fetch_assoc()){   
                          $ref[$row['reference_id']] = $r['title'];
                        }
                      }
                    }
                    
                    if (!empty($row['term'])){
                      $keyw[$row['term']] = 0;
                    }

                    if (!empty($row['conference_id'])){
                      $conf[$row['conference_id']] = $row['conference_name'];
                    }

                    if (!empty($row['reference_url_id'])){
                      $ref_url[$row['reference_url_id']] = $row['reference_url'];
                    }

                    if ($i == $total-1){
                      
                      foreach ($auth as $key => $value) {
                        $arr = explode ("$$", $key);
                        $data .= "<br><a href =about_author.php?author_id=".$arr[0].">".$arr[1]."</a>";
                      }
                      
                      if (sizeof($ref) > 0){
                        $data .= "<br><b> Reference : </b><ul>";
                        foreach ($ref as $key => $value) {
                          $data .= "<li><a href=about_paper.php?paper_id=".$key.">".$value."</a></li>";
                        }
                        $data .= "</ul>";
                      }
                      if (sizeof($ref_url) > 0){
                        $data .= "<br><b> Other References : </b>";
                        foreach ($ref_url as $key => $value) {
                          $data .= "<a href=".$key.">".$value."</a><br>";
                        }
                      }

                      if (sizeof($keyw) > 0){
                        $data .= "<p><b> Keywords : </b>";
                        foreach ($keyw as $key => $value) {
                          $data .= $key.", ";
                        }
                        $data .= "</p>";  
                      }

                      if (sizeof($conf) > 0){
                        $data .= "<br><b> Conference : </b>";
                        foreach ($conf as $key => $value) {
                          $data .= "<a href=about_conference.php?conference_id=".$key.">".$value."</a><br>";
                        }
                        $data .= "</p>";  
                      }

                      $data .= "<p><b>Content: </b>".$row['content']."</p></div>";
                    }
                    $i++;
                }
              }
              echo $data;
          ?>
        </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="https://cs.uoregon.edu/">
                  <span class="fa-stack fa-lg ">
                    <i class="custom_footer" ></i>
                  </span>
                </a>
              </li>
              
            </ul>
            <p class="copyright text-muted">Copyright &copy; Your Website 2017</p>
          </div>
        </div>
      </div>
    </footer>

  </body>

</html>
