<?php
	require_once('connectivity.php');

	$id= $_POST['id'];
	$issuetype= $_POST['issuetype'];
	$issuedescription = $_POST['issuedescription'];
	$issuestatus= $_POST['issuestatus'];
	$identifiedby =$_POST['identifiedby'];
	$identifieddate = $_POST['identifieddate'];
	$priority = $_POST['priority'];
	$solution =$_POST['solution'];
	$createdon = date("Y-m-d");
	$createdby = 1;
	$modifiedon = date("Y-m-d");
	$modifiedby = 1;
	
	// Handle attachment	
	$filepath= "uploads/";
	$filename = $filepath . basename( $_FILES["file"]["name"]);
	$uploadOk=1;
	
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $filename))
		$sql = " UPDATE issues SET issue_type='$issuetype', issue_description='$issuedescription', issue_status='$issuestatus', identified_by='$identifiedby',  identified_date = '$identifieddate', priority='$priority', solution='$solution', filename='$filename', created_on='$createdon', created_by='$createdby', modified_on='$modifiedon', modified_by='$modifiedby' WHERE id='$id' ";
	else 
		$sql = " UPDATE issues SET issue_type='$issuetype', issue_description='$issuedescription', issue_status='$issuestatus', identified_by='$identifiedby',  identified_date = '$identifieddate', priority='$priority', solution='$solution', created_on='$createdon', created_by='$createdby', modified_on='$modifiedon', modified_by='$modifiedby' WHERE id='$id' ";
	
	mysqli_query($mysqli, $sql);
	if (mysqli_query($mysqli, $sql)) {	
		mysqli_close($mysqli);
		header("location:add-edit.php");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	}
?>