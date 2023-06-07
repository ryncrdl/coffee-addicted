<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Coffee Addict | Products</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="coffee-addicted-icon.ico" type="image/x-icon">
		<script src="./js/main.js"></script>     
	</head>
	<body>
		<div id="body">
			<?php	require('header.php')	?>

			<div id="main">
				<br>
				<h2>Menu</h2>
				<div class="container-menu">
				
				<?php
// Include db.php file
require_once('db.php');

$connect = getConnection();

$query = 'SELECT id, Coffee_name, Coffee_Type, Price,  image FROM coffee_list';
$result = mysqli_query($connect, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $coffee_name = $row['Coffee_name'];
        $coffee_type = $row['Coffee_Type'];
        $price = $row['Price'];
        $image = $row['image'];

        // Display the data
        echo "<form class='menu' action='checkout.php' method='POST'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($image) . "' alt='Image'>";
        echo "<h3>$coffee_name</h3>";
        echo "<p id='coffee-type'>$coffee_type</p>";
        echo "<p id='price'>₱$price.00</p>";
        echo 
        "<div id='quantity'>
            <a class='subsQuantity' data-id='$id'>-</a>
            <input type='text' value='0' readonly id='qty-$id' name='qty-$id'>
            <a class='addQuantity' data-id='$id'>+</a>
        </div>";
        echo "<button type='submit' id='btn_order'>Order now</button>";
        echo "</form>";
    }

} else {
    echo "No data found.";
}
?>

			
				</div>					
			</div>
			
	        <br><br>
			<?php require('footer.php');  ?>
		</div>   
		
	</body>
</html>