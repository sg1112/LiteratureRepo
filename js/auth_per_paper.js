$(document).ready(function() {
    var margin = {top: 20, right: 20, bottom: 70, left: 40},
    width = 600 - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom;
// set the ranges
var x = d3.scaleBand().rangeRound([0, width], .05);
var y = d3.scaleLinear().range([height, 0]);
// define the axis
var xAxis = d3.axisBottom().scale(x)
var yAxis = d3.axisLeft().scale(y).ticks(10);
// add the SVG element

var svg3 = d3.select("#a3a").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", 
          "translate(" + margin.left + "," + margin.top + ")");
  
// load the data
d3.json("auth_per_paper.php", function(error, data) {
    data.forEach(function(d) {
        d.Letter = d.Letter;
        d.Freq = +d.Freq;
    });
  
  // scale the range of the data
  x.domain(data.map(function(d) { return d.Letter; }));
  y.domain([0, d3.max(data, function(d) { return d.Freq; })]);
  // add axis
  svg3.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
    .selectAll("text")
      .style("text-anchor", "end")
      .attr("dx", "-.8em")
      .attr("dy", "-.55em")
      .attr("transform", "rotate(-90)" );
  svg3.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 5)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Frequency");
  // Add bar chart
  svg3.selectAll("bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.Letter); })
      .attr("width", x.bandwidth())
      .attr("y", function(d) { return y(d.Freq); })
      .attr("height", function(d) { return height - y(d.Freq); });
});
});