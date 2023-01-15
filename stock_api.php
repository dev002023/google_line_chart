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
</head>
<body>
	
        <div class="container">
        	<div class="table_container table-responsive p-5 shadow-sm">
        		<table class="table table-bordered">
        			<thead class="">
        				<tr>
        					<th>Date</th>
        					<th>OPEN</th>
        					<th>HIGH</th>
        					<th>LOW</th>
        					<th>CLOSE</th>
        					<th>VOLUME</th>
        				</tr>
        			</thead>
        			<?php foreach ($result['Time Series (Daily)'] as $key => $value) { ?>
        			<tbody >
        				<tr>
        					<td><?php echo $key; ?></td>
        					<td><?php echo $value['1. open']; ?></td>
        					<td class="text-success">+ <?php echo $value['2. high']; ?></td>
        					<td class="text-danger">- <?php echo $value['3. low']; ?></td>
        					<td class="text-primary"><?php echo $value['4. close']; ?></td>
        					<td><?php echo $value['5. volume']; ?></td>
        				</tr>
        			</tbody>
        			<?php 	} ?>
        		</table>
        	</div>
        </div>

   <?php 
     }else{
    	echo "Something is wrong";
        }
 ?>

 </body>
</html>
