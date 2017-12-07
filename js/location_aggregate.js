function plot_pie(newData) {
    // Define size & radius of donut pie chart
  var width = 450,
    height = 800,
    radius = Math.min(width, height) / 2.5;

  // Define arc colours
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
  
  var svg4 = d3.select("#loc_svg");
  var svg5 = svg4
    .append("g")
    .attr("transform", "translate(" + radius + "," + radius + ")");

  var svgText = svg4
    .append("g")
    .attr("transform", "translate(" + radius + "," + radius + ")");

  // Define inner circle
  svg5.append("circle")
    .attr("cx", 0)
    .attr("cy", 0)
    .attr("r", 100)
    .attr("fill", "#fff");

  // Calculate SVG paths and fill in the colours
  var g = svg5.selectAll(".arc")
    .data(pie(newData))
    .enter().append("g")
    .attr("class", "arc");

  g.append("path")
    .attr("d", arc)
    .attr("fill", function(d, i) {
      return colour(i);
    });

  var textG = svg5.selectAll(".labels")
    .data(pie(newData))
    .enter().append("g")
    .attr("class", "labels");

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
  
  var legendG = svg4.selectAll(".legend")
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
  }

$( document ).ready(function() {
  console.log("shweta")
  var newData = "";

  request = $.ajax({
  type: "GET",
  url: "aggregate_location.php",
  dataType: "text",
  success: function(msg){
    newData = msg;
    plot_pie(msg);
    }
  });   
});
