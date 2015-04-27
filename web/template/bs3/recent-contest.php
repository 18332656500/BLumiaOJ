<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME?></title>  
    <?php 
		include("template/$OJ_TEMPLATE/css.php");
		header("Access-Control-Allow-Origin：http://contests.acmicpc.info");
	?>	    

</head>

<body>
	<div class="container">
	<?php include("template/$OJ_TEMPLATE/nav.php");?>	    
	<!-- Main component class="jumbotron"-->
	<div>
	<center>
		<table width=100% align=center>
			<thead class=toprow>
				<tr>
					<th class="column-1">OJ</th>
					<th class="column-2">Name</th>
					<th class="column-3">Start Time</th>
					<th class="column-4">Week</th>
					<th class="column-5">Access</th>
				</tr>
			</thead>
			<tbody id="insert">
<?php foreach($rows as $row) { ?>
	<tr>
		<td><?php echo $row['oj'];?></td>
		<td><a id="name_<?php echo$row['id']?>" href="<?php echo$row['link']?>" target="_blank"><?php echo$row['name']?></a></td>
		<td><?php echo$row['start_time']?></td>
		<td><?php echo$row['week']?></td>
		<td><?php echo$row['access']?></td>
	</tr>
<?php } ?>
			</tbody>
		<table>
	</center>
	</div ><!-- /center -->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
  </body>
</html>
