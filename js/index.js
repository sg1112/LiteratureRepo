$( document ).ready(function() {

  $("#start_cite").slider({});
  $(function() {

    var start = moment().subtract(2, 'year');
    var end = moment();

    function cb(start, end) { 
        $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#date_range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'This Year': [moment().startOf('year'), moment()]
        }
    }, cb);

    cb(start, end);
    });
  
var searchRequest = null
$('#author-search').change(function () {
  var name = $(this).find(':selected')[0].value;

  if (searchRequest != null) 
        searchRequest.abort();
        searchRequest = $.ajax({
        type: "GET",
        url: "searchByAuthorName.php",
        data: {
          'search_keyword' : name
        },
        dataType: "text",
        success: function(msg){
          $('#author-result').html(msg);
        }
      }); 
  });
 
 $('#keyword_submit').on('click',function () {
  if ($("#asso_paper").length > 0){
    document.getElementById("asso_paper").innerHTML = "";
  }
  var keys = "";
  $('input.key[type=checkbox]').each(function () {
   if(this.checked){
    keys+=($(this).val())+",";
   }
  });
  
  var key = keys.slice(0, -1);
  
  //var key = $("#keyword_text").val();
  if (searchRequest != null) 
        searchRequest.abort();
        searchRequest = $.ajax({
        type: "GET",
        url: "searchByKeyword.php",
        data: {
          'search_keyword' : key
        },
        dataType: "text",
        success: function(msg){
          $('#keyword-result').html(msg);
        }
      });

  });

 $('#domain_submit').on('click',function () {
  var key = $("#domain_text").val();
  if (searchRequest != null) 
        searchRequest.abort();
        searchRequest = $.ajax({
        type: "GET",
        url: "searchByDomain.php",
        data: {
          'search_keyword' : key
        },
        dataType: "text",
        success: function(msg){
          $('#domain-result').html(msg);
        }
      });
  });
  
  $('#date_range').on('apply.daterangepicker', function(ev, picker) {
      //$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      start =  picker.startDate.format('YYYY-MM-DD')
      end = picker.endDate.format('YYYY-MM-DD')
      if (searchRequest != null) 
        searchRequest.abort();
        searchRequest = $.ajax({
        type: "GET",
        url: "searchByDateRange.php",
        data: {
          'start_date' : start,
          'end_date' : end
        },
        dataType: "text",
        success: function(msg){
          $('#date-result').html(msg);
        }
      });
  });

  $('#cite_submit').on('click',function () {
  console.log($("#start_cite").slider()[0].value);
  var data = $("#start_cite").slider()[0].value;
  var d = data.split(',')
  start = d[0]
  end = d[1]

  if (searchRequest != null) 
        searchRequest.abort();
        searchRequest = $.ajax({
        type: "GET",
        url: "searchByCite.php",
        data: {
          'start_cite' : start,
          'end_cite' : end
        },
        dataType: "text",
        success: function(msg){
          $('#cite-result').html(msg);
        }
      });
  });


  $('#conference-search').siblings().find("input").on('keyup', function(){
    alert('conference-search');
  });


  $('#publication-search').siblings().find("input").on('keyup', function(){
    alert('publication-search');
    });


  });
