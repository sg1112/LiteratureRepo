<!DOCTYPE html>
<html lang="en">
<head>
  <title>Complex Queries</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="css/complex.css" />

  <script src="js/jquery-3.2.1.min.js"></script>
  
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  
  <script src="js/reference.js"></script>
  <script src="js/affiliation.js"></script>
  <script src="js/auth_per_paper.js"></script>
</head>
<body>

  <div class="container">
    <h3>Look through complex Queries: </h3>

    <ul  class="nav nav-tabs">
      <li class="active"> <a  href="#0a" data-toggle="tab">Paper References</a>
      </li>
      <li class="#1a"><a  href="#1a" data-toggle="tab">Aggregate Max / Min Citation</a>
      </li>
      <li><a href="#2a" data-toggle="tab">Group By Affiliation</a>
      </li>
      <li><a href="#a3a" data-toggle="tab">Average Author Per Paper</a>
      </li>
      <li><a href="#4a" data-toggle="tab">Conference Groupby Location</a>
      </li>    
    </ul>

    <div class="tab-content clearfix">
      <div class="tab-pane active" id="0a">
        <p> Each dot represents a paper and the edges represents the references.</p>
          <svg  id="ref_svg" width="1120" height="700" font-family="sans-serif" font-size="10" text-anchor="middle"></svg>  
      </div>

      <div class="tab-pane" id="1a">
        <!-- <h3>Aggregate Max / Min Citation</h3> -->
        <?php  include 'aggregate_citation.php' ?>
      </div>
      
      <div class="tab-pane" id="2a">
        <svg id="affil_svg" width="960" height="600" font-family="sans-serif" font-size="8" text-anchor="middle"></svg>  
      </div>      

      <div class="tab-pane" id="a3a">
      </div>

      <div class="tab-pane" id="4a">
        <h3>Please select the Date Range</h3>
          <div id="date_range" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
          <span></span> <b class="caret"></b>
          </div>
          <div id="date-result"> </div>
      </div>
  </div>
</div>

</div>
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
