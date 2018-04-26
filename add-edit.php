<?php
	session_start();
	require_once('func.php');
	require_once('connectivity.php');
	
	$stmt = '';
	$standard_statement = "select * from issues";
	$field='id';
	$sort='ASC';
	
	if(isset($_GET['sorting']))
	{
		if($_GET['sorting']=='DESC')
		{
			$sort='ASC';
		}
		else
		{
			$sort='DESC';
		}
	
		if($_GET['field']=='id')
		{
		   @$field = "id"; 
		}
		elseif($_GET['field']=='issue_type')
		{
		   @$field = "issue_type";
		}
		elseif($_GET['field']=='issue_description')
		{
		   @$field="issue_description";
		}
		elseif($_GET['field']=='issue_status')
		{
		   @$field="issue_status";
		}
		elseif($_GET['field']='identified_by')
		{
		   @$field="identified_by";
		}
		elseif($_GET['field']=='identified_date')
		{
		   @$field="identified_date";
		}
		elseif($_GET['field']=='priority')
		{
		   @$field="priority";
		}
		elseif($_GET['field']=='solution')
		{
		   @$field="solution";
		}
		elseif($_GET['field']=='attachment')
		{
		   @$field="filename";
		}
		$stmt = "SELECT id,issue_type,issue_description,issue_status,identified_by,identified_date,priority,solution,filename,created_on,created_by,modified_on,modified_by FROM issues ORDER BY $field $sort";
		$stmt = mysqli_query($mysqli, $stmt);
	}
	elseif(isset($_POST['issuetype'])){
		$issuetype	= $_POST['issuetype'];
		if (!$issuetype) {
			$stmt = $standard_statement;
			$stmt = mysqli_query($mysqli, $stmt);
		}else{
			$stmt = sel_issue_type_filter($issuetype);
		}
		
	}elseif(isset($_POST['issuestatus'])){
		$issuestatus	= $_POST['issuestatus'];
		if (!$issuestatus) {
			$stmt = $standard_statement;
			$stmt = mysqli_query($mysqli, $stmt);
		}
		$stmt = sel_issue_status_filter($issuestatus);
	}
	elseif(isset($_POST['fromdate']) && isset($_POST['todate'])){	
		$fromdate = date("Y-m-d", strtotime($_POST['fromdate']));
		$todate = date("Y-m-d", strtotime($_POST['todate']));
		if (!$fromdate || !$todate) {
			$stmt = $standard_statement;
			$stmt = mysqli_query($mysqli, $stmt);		
		}
		$stmt = sel_issue_du_by_filter($fromdate,$todate);
	}else{
		$stmt = $standard_statement;
		$stmt = mysqli_query($mysqli, $stmt);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>add /edit issues table</title>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
			
		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<style type="text/css">
			.row{
				padding: 10px 0px;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid" style="text-align:center">
			<div class="row">
				<div class="col-xs-12" style="font-weight:bolder">
					<img src="Fairfield_University.svg.png" height='70px'/>
					<h1> PHP CLASS ASSIGNMENT</h1>
				</div>
			</div>
			<div class="col-xs-12" style="height:70px;background-color:skyblue;text-align:center;"> 
				<h2>Display Issues</h2>
			</div>
		</div>	  
		<div class="container-fluid" style="margin-top:20px;">				
			<div class="row">
				<div class="col-xs-2">			  
					<a href="add.html" class="btn btn-success" id="add">Add Issue</a>  
				</div>
				<div class="col-xs-10">
					<form id="frmFilter" method="post" class="form-inline pull-right" action="add-edit.php">
						<div class="form-group">
							<label for="fromdate">From Date:</label>
							<input type="date" name="fromdate" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="todate">To Date:</label>
							<input type="date" name="todate" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="issueFilter">Status:</label>
							<select name="issuestatus" class="form-control" id="issueFilter">
								<option value="">Issue status</option>
								<option value="1">saved</option>
								<option value="2">approved</option>
								<option value="3">rejected</option>
							</select>
						</div>
						<div class="form-group">
							<label for="typeFilter">Type:</label>
							<select name="issuetype" class="form-control" id="typeFilter">
								<option value="">Issue Type</option>
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</div>
						<div class="form-group"> 
							<div class="col-sm-12">
								<input type="submit" class="btn btn-primary" value="Submit" />
							</div>
						</div>
					</form>
				</div>							
			</div>
		</div>	  
		<div class="container-fluid" style="text-align:center;">			
			<!-- Display the available  table data here-->
			<table class="table table-bordered">
				<tr class="info">
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=id">Id</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=issue_type">issue_type</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=issue_description">issue_description</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=issue_status">issue_status</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=identified_by">identified_by</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=identified_date">identified_date</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=priority">priority</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=solution">solution</a></th>
					<th><a href="add-edit.php?sorting=<?php echo $sort; ?>&field=attachment">attachment</a></th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>			
				<?php
					while ($row = $stmt->fetch_assoc())
					{	
						$id=$row['id'];	
						$file = explode('/', $row['filename']);
						$attachment = empty($row['filename']) ? "" : "<a href='" . $row['filename'] . "' target='_blank'>" . array_pop($file) . "</a>";
						echo "<tr><td>".$row['id']."</td>";
						echo "<td>".$row['issue_type']."</td>";
						echo "<td>".$row['issue_description']."</td>";
						echo "<td>".$row['issue_status']."</td>";
						echo "<td>".$row['identified_by']."</td>";
						echo "<td>".$row['identified_date']."</td>";
						echo "<td>".$row['priority']."</td>";
						echo "<td>".$row['solution']."</td>";
						echo "<td>".$attachment."</td>";
						echo "<td> <a href='edit.php?id=$id' class='btn btn-info' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a></td>";
						echo "<td> <a href='deletecontrol.php?id=$id' class='btn btn-info' role='button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Delete</a></td>";

						echo "</tr>";
					}
				?>
			</table>
		</div>
		<div class="container-fluid" style="text-align:center;">	
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<div class="col-xs-12" style="height:50px;background-color:skyblue;text-align:center;"> 
				<h4>Created By Rakesh Katkuri and Sudheer </h4>
			</div>
		</div>	
	</body>
</html>