<?php
	require_once('connectivity.php');
	$attributes = "";
	
		$id =$_GET['id'];
		$q = "SELECT * FROM issues where id='$id' ";

		$result=mysqli_query($mysqli, $q);
		
		while($row=mysqli_fetch_array($result))
		{
			$issuetype= $row['issue_type'];
			$issuedescription = $row['issue_description'];
			$issuestatus= $row['issue_status'];
			$identifiedby =$row['identified_by'];
			$identifieddate = $row['identified_date'];
			$priority = $row['priority'];
			$solution =$row['solution'];	
			$filename = $row['filename'];
			$file = explode('/', $filename);
			$attachment = empty($filename) ? "" : "<a href='" . $filename . "' target='_blank'>" . array_pop($file) . "</a>";
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
	
	<!--	  code for validation-->
	<script type="text/javascript">
		 function onSubmit(){
		 
		 if(document.getElementById("form-control2").value== "")
		 {
		 	document.getElementById("demo").value="Enter valid type ";
			 
		 
		 }
			 else if(document.getElementById("form-control3").value== "")
		 {
		 	document.getElementById("demo").value="Enter valid value  ";
			 
		 
		 }
			 
			 else if(document.getElementById("form-control4").value== "")
		 {
		 	document.getElementById("demo").value="Enter valid value  ";
			 
		 
		 }
			 else if(document.getElementById("form-control5").value== "")
		 {
		 	document.getElementById("demo").value="Enter valid value  ";
			 
		 
		 }
			 
			 else if(document.getElementById("form-control6").value== "")
		 {
		 	document.getElementById("demo").value="Enter valid value  ";
			 
		 
		 }
			 else if(document.getElementById("form-control7").value== "")
		 {
		 	document.getElementById("demo").value="Enter valid value  ";
			 
		 
		 }		
			 else {
			 
				 document.getElementById("formid").submit();
			 
			 }
		 
		 
		 }
		 
		 function ShowFileControl(){
			$('#tbxFileUpload').show();
		 }
	  </script>
  </head>
  <body>	
	<div class="container">
		<div class="col-xs-12" style="text-align:center">
			<div id="demo"></div>
		</div>
	</div>
    <div class="col-xs-12" style="text-align:center" >
	  <b><img src="Fairfield_University.svg.png"  height ='70px'/>
		<h1> PHP CLASS ASSIGNMENT</h1>
	  </b>
	  <div class="col-sm-12" style="height:90px;background-color:skyblue"> 
		<h2>Update Issues</h2>
		</div>
	  </div>
	  
	  <div class="col-xs-10" style="text-align:center;">
	  <br />
<!--		  div class for add button-->
		  <div class="col-xs-12" style="text-align:right;"> 
			  
			<a href="add-edit.php"><button type="button" class="btn btn-primary" id="add">View</button> </a>   
			 <a href="add.html"><button type="button" class="btn btn-primary" id="add">Add</button> </a>  
		  
		  </div>
<!--		 Display the available  table data here-->
		  <div class="col-xs-12" style="height:30px;"></div>
		  <div class="col-xs-12">  
		  	<form id="formid" method="post" action="editcontrol.php" enctype="multipart/form-data">
		  	<table class="table table-bordered">
  <tr class="info">
	<tr><td> Issue Type</td> <td> <input type="text" name="issuetype" class="form-control" value="<?php echo $issuetype; ?>" id="form-control2" <?php echo $attributes ?> /> </td>  </tr>			
	<tr><td>Issue Description</td> <td> <textarea class="form-control" name="issuedescription" value="<?php echo $issuedescription; ?>" id="form-control3"><?php echo $issuedescription; ?></textarea> </td>  </tr>			
	<tr><td> Issue Status</td> <td> <input type="text" name="issuestatus" class="form-control" value="<?php echo $issuestatus; ?>" id="form-control4">  </td>  </tr>
		<tr><td> Identified By</td> 
				<td> <input type="text" name="identifiedby" class="form-control" value="<?php echo $identifiedby; ?>" id="form-control5"> </td></tr>
				<tr><td>identified Date</td> <td><input type="text" name="identifieddate" class="form-control" value="<?php echo $identifieddate; ?>" id="form-control6"> </td></tr>
	  <tr><td>Priority</td> <td> <input type="text" name="priority" class="form-control" value="<?php echo $priority; ?>" id="form-control7">  </td>  </tr>
	  <tr><td>Solution</td> <td> <input type="text" name="solution" class="form-control" value="<?php echo $solution; ?>" id="form-control8">  </td>  </tr>	  
	  <tr><td>Attachment:</td><td align="left"><?php echo $attachment; ?><div id="btnChangeFile" class="btn btn-warning" style="margin-left:25px;" onclick="ShowFileControl();">Change File</div><div id="tbxFileUpload" style="display:none"><input type="file" name="file" /></div></td></tr>
	  <tr><td><button type="submit" class="btn btn-default" onclick="onSubmit();">Update</button></td> <td> <button type="reset" class="btn btn-default">Cancel</button> </td></tr>
		</table>
				<input id="id" name="id" type="hidden" value="<?php echo $id; ?>"/>
				</form>
			  
		  </div>
		  
	  </div>  
  
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<div class="col-sm-12" style="height:50px;background-color:skyblue;text-align:center;"> 
		<h4>Created By Rakesh Katkuri and Sudheer </h4>
	</div>
	 
  </body>
</html>