<?php
// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieving form data
  $name = $_POST["Name"];
  $email = $_POST["email"];
  $userPassword = $_POST["password"];




  $host = "localhost";
  $username = "root";
  $dbPassword = "";
  $dbname = "dreamghar";

  // Creating a connection
  $conn = new mysqli($host, $username, $dbPassword, $dbname);

  // Checking the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Inserting data into the database
  $sql = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$userPassword')";

  if ($conn->query($sql) === TRUE) {
    header("Location: adminsignsucess.html");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Closing the connection
  $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>register_admin</title>
  <link rel="stylesheet" href="registeradmin.css">
</head>

<body>
  <section id="signup-form">
    <h1><b>Add New Admin</b></h1>
    <form action="registeradmin.php" method="post">
      <div>
        <label for="Name" style="color: #007bff; font-weight: bolder">Name:</label>
        <input type="text" id="Name" name="Name" required placeholder="Enter Your  Name" />
        <span id="firstname_error" class="error_message"></span>
      </div>

      <div>
        <label for="email" style="color: #007bff; font-weight: bolder">Email :</label>
        <input type="email" id="signup_email" name="email" required placeholder="Enter Your Email" />
        <span id="email_error" class="error_message"> </span>
      </div>
      <div>
        <label for="password" style="color: #007bff; font-weight: bolder">Password:</label>
        <input type="password" id="signup_password" name="password" required placeholder="Enter Your Password" />
      </div>

      <button name="signup_submit" type="submit">Sign up</button>
    </form>
    <p style="color: black">
      Already have an account?<br /><a href="adminlogin.html" id="login-link"><b>Login here</b></a>.
    </p>
  </section>

  <footer>
    <p class="credit">&copy; DreamGhar-Property Listing</p>
  </footer>
</body>

</html>