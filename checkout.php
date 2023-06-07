<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connect = getConnection();

    // Retrieve the submitted student number from the session
    $studentNumber = $_SESSION['Student_Number'];

    // Retrieve additional user data from the database
    $usersQuery = "SELECT * FROM users WHERE Student_Number = '$studentNumber'";
    $usersResult = mysqli_query($connect, $usersQuery);

    if (mysqli_num_rows($usersResult) > 0) {

        while($userData = mysqli_fetch_assoc($usersResult)){
            $studentName = $userData['Student_Name'];
            $studentContact = $userData['Contact_Number'];
            $course = $userData['Course'];
        }
      
        // Calculate the total order amount
        $totalAmount = 0;

        $sql = "SELECT * FROM coffee_list";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $quantity = (int)$_POST['qty-' . $id];

                if ($quantity > 0) {
                    // Calculate the product total based on quantity and price
                    $productTotal = $quantity * $row['Price'];

                    // Add the product total to the overall order amount
                    $totalAmount += $productTotal;

                    // Save the order details to the database
                    $coffeeName = $row['Coffee_name'];
                    $sql = "INSERT INTO orders (`Order`, Quantity, Student_name, Student_number, Student_Contact, Course, Total) 
                            VALUES ('$coffeeName', '$quantity', '$studentName', '$studentNumber', '$studentContact', '$course', '$productTotal')";
                    mysqli_query($connect, $sql);
                }else {
                    echo "<script> 
                            window.alert('Need to set quantity first.') 
                            location.href = 'products.php'
                         </script>";
                }
            }
        }

        // Redirect or display a success message
        if ($totalAmount > 0) {
            header('Location: order.php');
            exit();
        } else {
            echo "No items in the order.";
        }
    } else {
        echo "<script>
                window.alert('You need to login first.');
                location.href = 'login.php';
            </script>";
        // header("Location: login.php");
    }

    mysqli_close($connect);
}

?>
