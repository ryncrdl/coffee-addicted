<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Coffee Addict | Home</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="coffee-addicted-icon.ico" type="image/x-icon">
	</head>

	<body>
		<div id="body">
			<?php require('header.php') ?>

			<div id="main">
				<br>
				<h2>Announcement / Blogs</h2>		
				<div class="container-blog">
				<?php
				// Include db.php file
				require_once('db.php');
				$connect = getConnection();

				$query = 'SELECT Title, Description, Image FROM announcements';
				$result = executeQuery($connect, $query);

				// Check if there are any rows returned
				if (mysqli_num_rows($result) > 0) {
					// Loop through the rows and display the data
					while ($row = mysqli_fetch_assoc($result)) {
						$title = $row['Title'];
						$description = $row['Description'];
						$imageData = $row['Image'];

						// Display the data
						echo "<div class='blog'>";
						echo "<h3>$title</h3>";
						echo "<p class='read-more-content'>$description</p>";
						echo "<span class='read-more-toggle'>Read More</span>";
						echo "<img src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt='Image'>";
						echo "</div>";

                        
					}

                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var readMoreToggle = document.querySelector('.read-more-toggle');
                            var readMoreContent = document.querySelector('.read-more-content');
                            var linkText = readMoreToggle.textContent.toUpperCase();

                            readMoreToggle.addEventListener('click', function() {
                            readMoreContent.classList.toggle('read-more-show');

                            if (readMoreContent.classList.contains('read-more-show')) {
                                                        readMoreToggle.textContent = 'Read Less';
                            } else {
                                readMoreToggle.textContent = 'Read More';
                                    }
                            });
                        });
                    </script>";
                  
				} else {
					echo "No data found.";
				}
				?>


				</div>
			</div>
			

			<?php   require('footer.php');    ?>
		</div>
		
	</body>
</html>