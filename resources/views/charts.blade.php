<html>
<head>
    <title>Dynamic Column Chart in Codeigniter using Ajax</title>
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
 <div class="container">
  <br />
  <h3 align="center">Dynamic Column Chart in Codeigniter using Ajax</h3>
  <br />
  <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">Month Wise Profit Data</h3>
                    </div>
                    <div class="col-md-3">
                        <select name="year" id="year" class="form-control">
                            <option value="">Select Year</option>
                        @foreach($year_list as $row)
                        {{ $row }}
                        {{-- echo '<option value="'.$row["year"].'">'.$row["year"].'</option>'; --}}
                        @endforeach
                        {{-- 
                            foreach($year_list->result_array() as $row)
                                {
                                 echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                                } --}}
                        
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart_area" style="width: 1000px; height: 620px;"></div>
            </div>
        </div>
 </div>
</body>
</html>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages:['corechart', 'bar']});
google.charts.setOnLoadCallback();

// function load_monthwise_data(year, title)
// {
//     var temp_title = title + ' ' + year;
//     $.ajax({
//         url:"<?php echo base_url(); ?>dynamic_chart/fetch_data",
//         method:"POST",
//         data:{year:year},
//         dataType:"JSON",
//         success:function(data)
//         {
//             drawMonthwiseChart(data, temp_title);
//         }
//     })
// }

function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Profit');

    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var profit = parseFloat($.trim(jsonData.profit));
        data.addRows([[month, profit]]);
    });

    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Months"
        },
        vAxis: {
            title: 'Profit'
        },
        chartArea:{width:'80%',height:'85%'}
    }

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));

    chart.draw(data, options);
}

</script>

<script>
    
$(document).ready(function(){
    $('#year').change(function(){
        var year = $(this).val();
        if(year != '')
        {
            load_monthwise_data(year, 'Month Wise Profit Data For');
        }
    });
});

</script>

