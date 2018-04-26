<?php
session_start();
$old_user=$_SESSION['valid_user'];
unset($_SESSION['valid_user']);

?>
<html>
<body>
<?php
if(empty($old_user))
{
	echo "Logged Out"."<br>";
	
}
else
{
	echo "You are logged in"."<br>";
}

session_destroy();

?>
<a href="login.php">Back to Main Page</a>
</body>
</html>