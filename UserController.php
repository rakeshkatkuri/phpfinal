<?php
class UserController
{
	
    function Check_User($email)
    {
        $results = array();
        try {
            // Connect to the server and select a database
            $conn = new PDO("mysql:host=localhost;dbname=issue_tracker", 'siddhartha', '123456');
            //$conn = new PDO("mysql:host=localhost;dbname=issue_tracker_fp", 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare the SQL statement and execute it
            $sql = "CALL check_user(:email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            // Save the execution results and return value in an array
            /*while ($row = $stmt->fetch()) {
                array_push($results, $row);
            }*/
            $row = $stmt->fetch();
            $stmt->closeCursor();
            if(!empty($row)){ ?>
                <div class="col-md-12" id="securityQuestions">
                    <div class="form-group"><label>Security Question [Step 2]</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-question-circle"></i> </span>
                            <input type="text" value="<?php echo $row['question'] ?>" class="form-control" readonly />
                            <input type="hidden" name="question_id" value="<?php echo $row['question_id'] ?>" class="form-control" />
                            <input type="hidden" name="user_id" value="<?php echo $row['Id'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group"><label>Answer</label>
						<div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-adn"></i> </span>
							<input type="hidden" value="<?php echo $row['answer'] ?>" class="form-control answer_main" />
							<input type="text" value="" name="answer" class="form-control answer" required />
						</div>
                    </div>
                </div>
            <?php }else{
                echo "<p style='color:red'>Email Id does not exists</p>";
            }

            array_push($results, array("return_value" => $conn->query("select @return_value")->fetchAll()));
            // Close connections
            $stmt = null;
            $conn = null;
        } catch (PDOException $e) {
            array_push($results, array("return_value" => -1, "message" => "Error!: " . $e->getMessage()));
        }
        return $results;
    }

}    // End class UserController