<?php
session_start();
if (!function_exists('logout')) {
    function logout() {
        // Clear all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect the user to the login page or any other desired page
        header('Location: login.php');
        exit();
    }
}


// Check if the logout button is clicked
if (isset($_GET['logout'])) {
  logout();
}
?>

<span id="btn-nav-open">&#8801;</span>
<ul id="navlinks">
<span id="btn-nav-close">X</span>
<li><a  href="index.php">Home</a></li>
<li><a href="products.php">Products</a></li>
<li><a href="order.php">Order List</a></li>
<li><a href="about.php">About Us</a></li>
<li><a href="contact.php">Contact Us</a></li>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Display the logout button
    echo '<a href="?logout=true" id="btn_logout">Logout</a>';
} else {
    echo '<li><a href="login.php">Log in</a></li>';
    echo '<li class="last"><a href="signup.php">Sign up</a></li>';
}
?>
</ul>


<?php
if(isset($_SESSION['username'])){
    $student_username = $_SESSION['username'];
    echo "<p id='current-user'>current user: <span id='name-user'>$student_username</span></p>";
}
?>   
<script src="js/nav.js"></script>
