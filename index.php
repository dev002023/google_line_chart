<?php 
$key = "demo";
$url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBM&apikey=".$key;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result,true);
// echo "<pre>";
// print_r($result['Time Series (Daily)']);

if(isset($result['Time Series (Daily)'])){
        
?>


<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title></title>
     <link rel="stylesheet" href="">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'CLOSE', 'LOW', 'OPEN', 'HIGH'],

          <?php foreach ($result['Time Series (Daily)'] as $key => $value) { ?>

          ['<?php echo $key; ?>', <?php echo $value['4. close']; ?>, <?php echo $value['3. low']; ?>, <?php echo $value['1. open']; ?>, <?php echo $value['2. high']; ?>],

          <?php     } ?>
        ]);

        var options = {
          title: 'Stock Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 100%; height: 500px"></div>

       <?php 
     }else{
     echo "Something is wrong";
        }
 ?>
  </body>
</html>
