

<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Coffee Addict | Contact</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="coffee-addicted-icon.ico" type="image/x-icon">
	<body id="body">
		
				<?php	require('header.php')	?>
			
				
            <div class="about contacts" id="main">
				<h1>Our Contacts</h1>
				<div id="form">
	        	<form action="message.php" method="post" accept-charset="utf-8">
        			<label for="your_email">Enter Your Email:<input id="your_email" type="email" name="your_email" required placeholder="e.g: example@gmail.com"></label>
        			<br><br>
        			<label for="subject">Enter your subject:<input id="subject" type="text"  name="subject" required placeholder="Enter your email-title"></label><br><br>
        			
					</label>
					<label for="message">
					Enter Your Message:
					<textarea name="message" id="message" placeholder="Enter your message here">

					</textarea>
        			</label>
        			
        			<button type="submit">Submit</button><br><br>
        		</form>	
	        </div>	      						
			</div>								
						
			<?php    require('footer.php');   ?>
		</div>		
	</body>
</html>