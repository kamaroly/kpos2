
<?php
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
$this->output->set_header("Pragma: public");


foreach($data as $label=>$value)
{
    	$graph_data[] = "['".(string)$label."',". (float)$value."]";
}
$div_id=str_replace(" ","_",$title);
?>

<style>
#chartArea{background:red;}
#chart_div{background-color:white;}</style>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="<?php echo base_url();?>js/googlechart.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string','Rep');
        data.addColumn('number','Assigned Leads');
        data.addRows([
   
          <?php echo implode(",", $graph_data); ?>
               ]);

        // Set chart options
        var options = {'title':'<?php echo $title;?>'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_pie<?=$div_id?>'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div_pie<?=$div_id?>"></div>
  </body>
</html>