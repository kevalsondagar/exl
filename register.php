<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process form if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO userdata (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head><title>Registration</title><link rel="stylesheet" href="Registration.css"></head>
<body>
    <header>
          <button class="submit" onclick="window.location.href='index.html'">Back to Home</button>
    </header>
  <!-- From Uiverse.io by ammarsaa --> 
<form class="form" method="POST" action="register.php" name="registrationForm">
    <p class="title">Register</p>
    <p class="message">Signup now and get full access to our app. </p>
    <div class="flex">
        <label>
            <input class="input" type="text" name="firstname" required="">
            <span>Firstname</span>
        </label>
        <label>
            <input class="input" type="text" name="lastname" required="">
            <span>Lastname</span>
        </label>
    </div>  
    <label>
        <input class="input" type="email" name="email" required="">
        <span>Email</span>
    </label> 
    <label>
        <input class="input" type="password" name="password" required="">
        <span>Password</span>
    </label>
    <label>
        <input class="input" type="password" name="confirm_password" required="">
        <span>Confirm password</span>
    </label>
   <button class="submit" type="submit"> Submit</button>
    <p class="signin">Already have an acount ? <a href="login.php">Signin</a> </p>
</form>
</body>
</html>
