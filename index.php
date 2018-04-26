<?php
    ob_start();
    session_start();
    require 'connectivity.php';
	if(isset($_POST['login'])) { 
		
		$email = $_POST['user'];
        $pwd = $_POST['pass'];
        $search = mysqli_query($mysqli, "SELECT * FROM `users` WHERE (`UserName`='$email' AND `Password`='$pwd')");			
           
		$count = mysqli_num_rows($search);
		if ($count == 1) {
			$user = mysqli_fetch_assoc($search);
			if ($user) {
				header("Location:add-edit.php");
			} else {
				$message = "<div class='alert alert-danger'>Please got ADMIN approval before login</div>";
			}
		} else {
			$message = "<div class='alert alert-danger'>Wrong Details, Please enter correct Details</div>";
		}
	}     
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>login screen</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
<body>
<div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>		
        <form class="form" method="post">
			<div class="result-display"><?php echo !empty($message) ? $message : ''; ?></div>
			<input type="text" id="username" name="user" placeholder="Enter Username" />
			<input type="text" name="pass" placeholder="Enter Password" />
			<div class="row">
				<div class="cell">
					<button type="submit" name="login">Login</button>
				</div>
				<div class="cell">
					<a href="forgotPassword.php" class="btn reset-password">Reset Password</a>
				</div>
			</div>
		</form>
	</div>
</div>
  </body>
</html>
