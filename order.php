<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Coffee Addict | Order List</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="coffee-addicted-icon.ico" type="image/x-icon">
		 
	</head>
	<body>
		<div id="body">
			
				<?php	require('header.php')	?>
		
			<div id="main">
				<div id="last_order">
					<h2>Your Last Order</h2>
					<div class="list_order">			
                                                <?php
					
                            require_once('db.php');
                            $connect = getConnection();

                            // Retrieve the submitted student number from the session
                            if (isset($_SESSION['Student_Number'])) {
                                $studentNumber = $_SESSION['Student_Number'];

                                // Retrieve user orders from the database
                                $ordersQuery = "SELECT * FROM orders WHERE Student_number = '$studentNumber'";
                                $ordersResult = executeQuery($connect, $ordersQuery);

                                if (mysqli_num_rows($ordersResult) > 0) {
                                    // Store the user orders in an array
                                    $orders = array();
                                    while ($orderData = mysqli_fetch_assoc($ordersResult)) {
                                        $coffeeName = $orderData['Order'];
                                        $quantity = $orderData['Quantity'];
                                        $total = $orderData['Total'];
                                        $status = $orderData['Status'];

                                        $order = array(
                                            'coffeeName' => $coffeeName,
                                            'quantity' => $quantity,
                                            'total' => $total,
                                            'status' => $status
                                        );

                                        $orders[] = $order;
                                    }

                                    // Reverse the array of orders
                                    $reversedOrders = array_reverse($orders);

                                    // Display the user orders
                                    foreach ($reversedOrders as $order) {
                                        $coffeeName = $order['coffeeName'];
                                        $quantity = $order['quantity'];
                                        $total = $order['total'];
                                        $status = $order['status'];

                                        echo "<div id='customer_order'>";
                                        echo "<p class='order_title'>$coffeeName</p>";
                                        echo "<p class='order_quantity'>Quantity: $quantity</p>";
                                        echo "<p class='order_total'>Total: $total</p>";
                                        echo "<p class='order_status'>Status: $status</p>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p style='width: max-content;'>You don't have any order <a href='products.php'>Order now.</a></p>";
                                }

                                mysqli_close($connect);
                            } else {
                                echo "<p>You need to login first. <a href='login.php'>Login.</a></p>";
                            }
                        ?>
			
					</div>
				</div>				
					
			</div>
			<?php   require('footer.php');    ?>
		</div>	
	</body>
</html>