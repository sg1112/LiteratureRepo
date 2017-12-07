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
        <div class="mx-auto" style="width:100%;">
         <?php
              include('connection.txt');
              $conn = new mysqli($server, $user, $pass, $dbname, $port);
              if ($conn->connect_errno) {
                echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
              }
    
              $stmt = $conn->prepare("select * from conference  join paper using (conference_id)
                                    left join (select * from conference_domain join domain using (domain_id)) as t
                                    using (conference_id) where conference_id = ? ");
    
              $conference_id = $_GET['conference_id'];

              $stmt->bind_param("s", $conference_id);    
              
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
                    
                    if(!empty($row['term'])){
                        $domain[$row['term']] = 0;
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
                        foreach ($domain as $key => $value) {
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
