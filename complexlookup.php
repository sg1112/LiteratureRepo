<!DOCTYPE html>
<html lang="en">

<head>
  <title>Research Paper Repository</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="js/clean-blog.min.js"></script>
  <script src="js/reference.js"></script>
  <script src="js/affiliation.js"></script>
  <script src="js/auth_per_paper.js"></script>
  <!-- <script src="js/location_aggregate.js"></script> -->
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
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
            <a class="nav-link" href="refernces_used.php">References</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Man must explore, and this is exploration at its greatest</h1>
            <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="mx-auto">
          <ul  class="nav nav-tabs">
            <li class="active"> <a  href="#0a" data-toggle="tab">Paper References</a>
            </li>
            <li class="#1a"><a  href="#1a" data-toggle="tab">Aggregate Max / Min Citation</a>
            </li>
            <li><a href="#2a" data-toggle="tab">Group By Affiliation</a>
            </li>
            <li><a href="#a3a" data-toggle="tab">Average Author Per Paper</a>
            </li>
            <li><a href="#a4a" data-toggle="tab">Conference Groupby Location</a>
            </li>    
          </ul>

          <div class="tab-content clearfix">
            <div class="tab-pane active" id="0a">
              <br> <p> Each dot represents a paper and the edges represents the references.</p>
              <svg  id="ref_svg" width="1120" height="700" font-family="sans-serif" font-size="10" text-anchor="middle"></svg>  
            </div>


            <div class="tab-pane" id="1a">
              <!-- <h3>Aggregate Max / Min Citation</h3> -->
               <br> <?php  include 'aggregate_citation.php' ?>
            </div>

            <div class="tab-pane" id="2a">
              <svg id="affil_svg" width="960" height="600" font-family="sans-serif" font-size="8" text-anchor="middle"></svg>  
            </div>      

            <div class="tab-pane" id="a3a">
            </div>
            <div class="tab-pane" id="a4a">
              <!-- <svg id="loc_svg" width="960" height="600" font-family="sans-serif" font-size="8" text-anchor="middle"></svg>   -->
              <?php include "conf_by_loc.php"; ?> 
            </div> 
          </div>
        </div>

      </div>
    </div>
  </article>

  <hr>
</body>
<footer>
  <div class="container">
    <div class="row">
      <div class="mx-auto">
        <ul class="list-inline text-center">
          <li class="list-inline-item">
            <a href="https://cs.uoregon.edu/">
              <span class="">
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

</html>
