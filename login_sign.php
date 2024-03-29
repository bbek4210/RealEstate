<?php

// Initializing  the email exists flag
$emailExists = false;


$host = "localhost";
$username = "root";
$password = "";
$dbname = "dreamghar";

// Creating connection
$conn = new mysqli($host, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['signup_submit'])) {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $gender = $_POST['gender'];
  $address =  $_POST['address'];

  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($password === $confirmPassword) {
    // Checking if the email already exists in the database
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_query);

    if ($result) {
      if ($result->num_rows > 0) {
        // Email already exists, set the flag
        $emailExists = true;
      } else {

        // Inserting data into the database
        $sql = "INSERT INTO users (firstname, lastname, email, gender, password, address) VALUES ('$firstname', '$lastname', '$email', '$gender', '$password', '$address')";

        if ($conn->query($sql) === TRUE) {
          // Redirecting to signupsucess.html
          header("Location: signupsucess.html");
          exit;
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    } else {
      echo "Error executing query: " . $conn->error;
    }
  } else {
    echo "Error: Passwords do not match.";
  }
}

$conn->close();
?>


<html>

<head>
  <title>Dream Ghar - Property Listing</title>
  <link href="logincss.css?<?= filemtime("logincss.css") ?>" rel="stylesheet" type="text/css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />


  <link rel="icon" href="#" type="image/x-icon" />
  <link rel="shortcut icon" href="#" type="image/x-icon" />
</head>

<body>
  <div>
    <header>
      <nav>
        <a href="login_sign.php"><img src="logo.png" alt="Dream Ghar Logo" /></a>
        <ul style="display: flex; justify-content: flex-end">
          <li><a href="realestate.php" id="hover">Home</a></li>

          <li><a href="about.html" id="hover">About</a></li>

        </ul>
      </nav>
    </header>
    <main>
      <section id="login-form">
        <h1><b>Login to your account</b></h1>
        <form action="login.php" method="POST">
          <div>
            <label for="email" style=" color: #007bff; font-weight: bolder;"> Email :</label>
            <input type="email" id="email" name="email" required placeholder="Email" />
          </div>
          <div>
            <label for="password" style="color: #007bff;font-weight: bolder;">Password :</label>
            <input type="password" id="password" name="password" required placeholder=" Password" />
          </div>
          <button type="submit">Login</button>
        </form>

        <p style="color: black;">
          Don't have an account yet? <br><a href="#" id="signup-link"><b>Sign up now</b></a>.
        </p>

      </section>

      <section id="signup-form">
        <h1><b>Create a New Account</b></h1>
        <form action="login_sign.php" method="post" onsubmit="return validateForm()">

          <div>
            <label for="firstname" style=" color: #007bff; font-weight: bolder;"> First Name:</label>
            <input type="text" id="firstname" name="firstname" required placeholder="Enter Your First Name" />
            <span id="firstname_error" class="error_message"></span>
          </div>
          <div>
            <label for="lastname" style=" color: #007bff; font-weight: bolder;"> Last Name:</label>
            <input type="text" id="lastname" name="lastname" required placeholder="Enter Your Last Name" />
            <span id="lastname_error" class="error_message"></span>
          </div>




          <div style="color: darkgreen;">
            <input type="radio" name="gender" value="male" required /> Male
            <input type="radio" name="gender" value="female" /> Female
            <input type="radio" name="gender" value="others" /> Others
          </div>

          <div>
            <label for="address" style=" color: #007bff; font-weight: bolder;"> Address:</label>
            <input type="text" name="address" id="address" placeholder="Enter Your Address" pattern="^(?=.*[a-zA-Z])[\w\s]+$" />
          </div>

          <div>
            <label for="email" style=" color: #007bff; font-weight: bolder;"> Email :</label>
            <input type="email" id="signup_email" name="email" required placeholder="Enter Your Email" />
            <span id="email_error" class="error_message">
              <?php
              // Showing the error message if email exists and the form has been submitted
              if ($emailExists) {
                echo "Error: The email address is already in use. Please choose a different email.";
              }
              ?>
            </span>
          </div>
          <div>
            <label for="password" style="color: #007bff; font-weight: bolder;">Password:</label>
            <input type="password" id="signup_password" name="password" required minlength="8" placeholder="Enter Your Password" />
          </div>


          <div>
            <label for="confirm_password" style=" color: #007bff; font-weight: bolder;"> Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm Your Password" />
          </div>

          <span id="error_message" style="color: black; display: none;">Error: Passwords do not match.</span>


          <button name="signup_submit" type="submit">Sign up</button>

        </form>
        <p style="color: black;">
          Already have an account?<br /><a href="#" id="login-link"><b>Login here</b></a>.
        </p>
      </section>


    </main>

    <footer>
      <p class="credit">&copy; DreamGhar-Property Listing</p>
    </footer>
    <script src="login.js"></script>
  </div>
  <script>
    function validateForm() {
      var firstName = document.getElementById("firstname").value.trim();
      var lastName = document.getElementById("lastname").value.trim();
      var errorMessage = document.getElementById("error_message");
      var password = document.getElementById("signup_password").value.trim();
      var confirmPassword = document.getElementById("confirm_password").value.trim();
      var emailInput = document.getElementById("signup_email").value.trim();

      // Checking if the email field is empty
      if (emailInput === "") {
        errorMessage.innerText = "Error: Please enter your email.";
        errorMessage.style.display = "block";
        return false;
      }


      if (!isNaN(firstName)) {
        document.getElementById("firstname_error").innerText = "Only letters are allowed.";
        return false;
      } else {
        document.getElementById("firstname_error").innerText = "";
      }

      if (!isNaN(lastName)) {
        document.getElementById("lastname_error").innerText = "Only letters are allowed.";
        return false;
      } else {
        document.getElementById("lastname_error").innerText = "";
      }

      if (password !== confirmPassword) {
        errorMessage.innerText = "Error: Passwords do not match.";
        errorMessage.style.display = "block";
        return false;
      } else {
        errorMessage.style.display = "none";
      }

      // The passwords match, form submission can proceed
      return true;
    }


    // Clearing the error message when the page loads
    window.addEventListener("DOMContentLoaded", function() {
      var errorMessage = document.getElementById("error_message");
      errorMessage.style.display = "none";
    });
  </script>


</body>

</html>