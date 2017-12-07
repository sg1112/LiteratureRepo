<!DOCTYPE html>
<html>

<head>
  <!--<script data-require="d3@3.5.3" data-semver="3.5.3" src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.js"></script> -->
  <script src="https://d3js.org/d3.v4.min.js"></script>
</head>

<body>
  <script>
    var newData = <?php include "aggregate_location.php"?>;

    // Define size & radius of donut pie chart
    var width = 450,
      height = 800,
      radius = Math.min(width, height) / 2.5;

    // Define arc colours
    /*var colour = d3.scale.category20();*/
    var colour = d3.scaleOrdinal(d3.schemeCategory10);
    

    // Define arc ranges
    var arcText = d3.scaleBand()
    .rangeRound([0, width])
    .padding(.1);

    // Determine size of arcs
    var arc = d3.arc()
      .innerRadius(radius - 130)
      .outerRadius(radius - 10);

    // Create the donut pie chart layout
    var pie = d3.pie()
      .value(function(d) {
        return d.count;
      })
      .sort(null);

    // Append SVG attributes and append g to the SVG
    var mySvg = d3.select('#a4a').append("svg")
      .attr("width", width)
      .attr("height", height);

    var svg = mySvg
      .append("g")
      .attr("transform", "translate(" + radius + "," + radius + ")");

    var svgText = mySvg
      .append("g")
      .attr("transform", "translate(" + radius + "," + radius + ")");

    // Define inner circle
    svg.append("circle")
      .attr("cx", 0)
      .attr("cy", 0)
      .attr("r", 100)
      .attr("fill", "#fff");

    // Calculate SVG paths and fill in the colours
    var g = svg.selectAll(".arc")
      .data(pie(newData))
      .enter().append("g")
      .attr("class", "arc");

    // Append the path to each g
    g.append("path")
      .attr("d", arc)
      //.attr("data-legend", function(d, i){ return parseInt(newData[i].count) + ' ' + newData[i].emote; })
      .attr("fill", function(d, i) {
        return colour(i);
      });

    var textG = svg.selectAll(".labels")
      .data(pie(newData))
      .enter().append("g")
      .attr("class", "labels");

    // Append text labels to each arc
    textG.append("text")
      .attr("transform", function(d) {
        return "translate(" + arc.centroid(d) + ")";
      })
      .attr("dy", ".35em")
      .style("text-anchor", "middle")
      .attr("fill", "#fff")
      .text(function(d, i) {
        return d.data.count > 0 ? d.data.emote : '';
      });
    
    var legendG = mySvg.selectAll(".legend")
      .data(pie(newData))
      .enter().append("g")
      .attr("transform", function(d,i){
        return "translate(" + (width - 110) + "," + (i * 15 + 20) + ")";
      })
      .attr("class", "legend");   
    
    legendG.append("rect")
      .attr("width", 10)
      .attr("height", 10)
      .attr("fill", function(d, i) {
        return colour(i);
      });
    
    legendG.append("text")
      .text(function(d){
        return d.value + "  " + d.data.emote;
      })
      .style("font-size", 12)
      .attr("y", 10)
      .attr("x", 11);
    
    
  </script>
</body>

</html>