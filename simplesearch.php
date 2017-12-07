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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.standalone.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css" />

  <!-- Custom styles for this template -->
  <link rel="stylesheet" type="text/css" href="css/index.css" /> 


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>
<script src="js/index.js"></script>

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
  <header class="masthead" style="background-image: url('img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto ">
          <div class="page-heading">
            <h1>Explore Me</h1>
            <span class="subheading">This is what you can do.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="mx-auto" style="width: 100%;">
          <ul  class="nav nav-tabs">
            <li class="active">
              <a  href="#1a" data-toggle="tab">Authors</a>
            </li>
            <li><a href="#2a" data-toggle="tab">Keyword</a>
            </li>
            <li><a href="#3a" data-toggle="tab">Domain</a>
            </li>
            <li><a href="#4a" data-toggle="tab">Date</a>
            </li>
            <li><a href="#5a" data-toggle="tab">Citation</a>
            </li>
          </ul>
          <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
              <h3>Please select the Authors name</h3>
              <select class="selectpicker" id="author-search" data-live-search="true">
                <?php  include 'author.php' ?>
              </select>
              <div id="author-result">
              </div>
            </div>

            <div class="tab-pane" id="2a">
              <h3>Please enter the Keyword (like Multimodality,inference,Markov)</h3>
              <?php  include 'keywords.php' ?>
              <!-- <input type="text" id="keyword_text"  name="keyword"><br> -->
              <input type="button" id="keyword_submit" value="Submit">
              <div id="keyword-result">
              </div>
            </div>

            <div class="tab-pane" id="3a">
              <h3>Please enter the Domain (like Mining,Information,computation)</h3>
              <input type="text" id="domain_text"  name="keyword"><br>
              <input type="button" id="domain_submit" value="Submit">
              <div id="domain-result">
              </div>
            </div>

            <div class="tab-pane" id="4a">
              <h3>Please select the Date Range</h3>
              <div id="date_range" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                <span></span> <b class="caret"></b>
              </div>
              <div id="date-result"> </div>
            </div>

            <div class="tab-pane" id="5a">
              <h3>Please enter the Citations</h3>
              Filter by citation interval: <b> <br> 10</b>
              <input id="start_cite" type="text" class="span2" value="" data-slider-min="50"  data-slider-handle="custom"
              data-slider-max="128000" data-slider-step="5" data-slider-value="[100,9500]"/> <b> 128000</b>
              <input type="button" id="cite_submit" value="Submit">
              <div id="cite-result"> </div>
            </div>
          </div>
        </div>
      </article>
      <hr>
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
