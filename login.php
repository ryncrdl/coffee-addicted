<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit();
}

// Variable for error message
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include db.php file
    require_once('db.php');
    $connect = getConnection();

    // Sanitize and validate username input
    $student_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

    if (!$student_username) {
        die("Invalid username");
    }

    $query = "SELECT * FROM users WHERE Student_username = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('s', $student_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Could not execute this query");
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['Student_Number'] = $row['Student_Number'];
            $passwordStored = $row['Student_password'];
        }

        // Sanitize and validate password input
        $passwordEntered = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!$passwordEntered) {
            die("Invalid password");
        }

        if (password_verify($passwordEntered, $passwordStored)) {
            $_SESSION['username'] = $student_username;
            $_SESSION['loggedin'] = true;

            header('Location: index.php');
            exit();
        } else {
            $message = 'Incorrect Password.';
        }
    } else {
        $message = 'Username not found. Please first <a href="signup.php">register</a>.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Coffee Addict | Login</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="coffee-addicted-icon.ico" type="image/x-icon">
	</head>
	<body>
		<div id="body">
		
		<div id="header">
            <div class="container-title">
    <a href="index.php"><img id="mainlogo" src="./img/logo.png" alt="Online Cafe Logo" width="80" height="80"/></a>
    <h1 id="title">Coffee Addict</h1>
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
				
	        	<h1>Log in</h1>
	        	<form action="login.php" method="post" accept-charset="utf-8">
        			<label for="username">Username <input id="username" type="text" name="username" required placeholder="Enter you username"></label><br><br>
        			<label for="password">Password <input id="password" type="password" name="password" required placeholder="Enter your password"></label><br><br>
        			<?php if (isset($message)): ?>
					<?php	echo "<p id=\"error_message\">".$message."</p>"; ?>
				    <?php endif; ?>
                    <button type="submit">Submit</button><br><br>
        		</form>	
	        </div>	        
			<?php    require('footer.php');   ?>
    	</div>		
        <script src="js/nav.js"></script>
	</body>
</html>