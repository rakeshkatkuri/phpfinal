<?php 
    define("server_name", "127.0.0.1");
	define("db_name", "issue_tracker");
	define("user_name", "root");
	define("db_pswd", "");
    $mysqli = mysqli_connect(server_name, user_name, db_pswd, db_name);
	
    if (!$mysqli) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
	
    if (!function_exists("dateForm2DB")) {
        function dateForm2DB($frm_date)
        {
            $frm_date = explode("/", $frm_date);
            if (!empty($frm_date[0]) && !empty($frm_date[1]) && !empty($frm_date[2])) {
                return $frm_date[2] . "-" . $frm_date[1] . "-" . $frm_date[0];
            } else {
                return "";
            }
        }
    }
	
	function GetPDOConnection(){		
		$conn = new PDO("mysql:host=localhost;dbname=issue_tracker", "sw516_agent", "sw516_agent-1");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $conn;
	}
?>