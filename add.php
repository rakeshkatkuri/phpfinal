<?php
	require_once('connectivity.php');
//we get details here.
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
		$sql = "insert into issues(issue_type,issue_description,issue_status,identified_by,identified_date,priority,solution,filename,created_on,created_by,modified_on,modified_by) VALUES ('$issuetype','$issuedescription','$issuestatus','$identifiedby','$identifieddate','$priority','$solution','$filename','$createdon','$createdby','$modifiedon','$modifiedby')";
	else 
		$sql = "insert into issues(issue_type,issue_description,issue_status,identified_by,identified_date,priority,solution,filename,created_on,created_by,modified_on,modified_by) VALUES ('$issuetype','$issuedescription','$issuestatus','$identifiedby','$identifieddate','$priority','$solution','','$createdon','$createdby','$modifiedon','$modifiedby')";
	
	if (mysqli_query($mysqli, $sql)) {
		mysqli_close($mysqli);
		header("location:add-edit.php");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	}

//handle attachment end coding
?>
