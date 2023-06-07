<?php
session_start();

// variable for error message
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // include db.php file
    require_once('db.php');
	$connect = getConnection();
    $student_number = $_POST['student_number'];
    $student_name = $_POST['student_name'];
    $course = $_POST['course'];
    $contact_number = $_POST['contact_number'];
    $student_email = $_POST['student_email'];
    $student_username = $_POST['student_username'];
    $student_password = $_POST['password'];
    $confpassword = $_POST['confpassword'];

    if ($student_password != $confpassword) {
        $message = 'Password must equal Confirm Password';
    } else {
        $query = "SELECT * FROM users WHERE Student_username = '{$student_username}'";
        $result = executeQuery($connect, $query);

        if (mysqli_num_rows($result) == 0) {
            $student_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "INSERT INTO users (Student_Number, Student_Name, Course, Contact_Number, Student_email, Student_username, Student_password) VALUES ('{$student_number}', '{$student_name}', '{$course}', '{$contact_number}', '{$student_email}', '{$student_username}', '{$student_password}')";

            $result = executeQuery($connect, $query);

            if (!$result) {
                // die("Could not execute this query");
				die("Data: {$query}");
            } else {
                $_SESSION['username'] = $student_username;

                header('Location: login.php');
                exit();
            }

        } else {
            $message = 'This username is already occupied! Choose another.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Coffee Addict | Sign up</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="coffee-addicted-icon.ico" type="image/x-icon">
	</head>
	<body>
		<div id="body">
			<div id="header">
				<div class="container-title">
				<a href="index.php"><img id="mainlogo" src="img/logo.png" alt="Online Cafe Logo" width="80" height="80"/></a>
				<h1 id="title">Online Cafe </h1>
				</div>
				<div class="container-nav">
                <span id="btn-nav-open">&#8801;</span>
				<ul id="navlinks">
                    <span id="btn-nav-close">X</span>
                    <li><a  href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="order.php">Order List</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="login.php">Log in</a></li>
                    <li class="last"><a href="signup.php">Sign up</a></li>
                </ul>
				</div>
			</div>			
			<div id="form">
				<?php if (isset($message)): ?>
					<?php	echo "<p id=\"error_message\">".$message."</p>";	?>
				<?php endif; ?>
	        	<h1>Sign Up</h1>
	        	<form action="signup.php" method="post" accept-charset="utf-8">
        			<label for="student_number">Student Number:<input id="student_number" type="text" name="student_number" required placeholder="Enter student number"></label>
        			<br><br>
        			<label for="student_name">Student Name:<input id="student_name" type="text"  name="student_name" required placeholder="Enter student name"></label><br><br>
        			<label for="course">Course:
					<select id="course"  name="course" required>
						<option value="">Select Course</option>
						<option value="BSIT">BSIT</option>
						<option value="BSCpE">BSCpE</option>
						<option value="BEEd-GEN">BEEd-GEN</option>
						<option value="BSE">BSE</option>
					</select>
					</label><br><br>
        			<label for="contact_number">Contact Number:<input id="contact_number" type="text" name="contact_number" required placeholder="Enter contact number"></label><br><br>
        			<label for="student_email">Student Email: <input id="student_email" type="email" name="student_email" required placeholder="Enter student email"></label><br><br>
        			<label for="student_username">Student Username: <input id="student_username" type="text" name="student_username" required placeholder="Enter student username"><br><br>
        			<label for="password">Password <input id="password" type="password" name="password" required placeholder="Enter Password"><br><br>
        			<label for="confpassword">Confirm Password <input id="confpassword" type="password" name="confpassword" required placeholder="Enter confirm password"><br><br>
        			<button type="submit">Submit</button><br><br>
        		</form>	
	        </div>	        
			<?php   require('footer.php');    ?>

            <script src="js/nav.js"></script>
    	</div>		
	</body>
</html>