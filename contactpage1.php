<?php
session_start();


// Checking if the user is authorized
if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
  // User is not authorized, redirecting to the login page
  header('Location: login_sign.php');
  exit();
}


// Initializing the message variable
$message = '';

// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieving form data
  $name = $_POST["Name"];
  $email = $_POST["Email"];
  $message = $_POST["Message"];



  // Connecting to your database 
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dreamghar";

  // Creating a connection
  $conn = new mysqli($host, $username, $password, $dbname);

  // Checking the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Inserting data into the database
  $sql = "INSERT INTO contact_us (name, email, message) VALUES ('$name', '$email', '$message')";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Message sent successfully!";
    // Redirecting to the same page to prevent the form resubmission on refreshing
    header("Location: contactpage1.php");
    exit;
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
  }

  // Closing the connection
  $conn->close();
}

// Checking if there is a success message stored in the session
if (isset($_SESSION['success_message'])) {
  $message = $_SESSION['success_message'];
  // Clearing the success message from the session to prevent it from displaying again on refresh
  unset($_SESSION['success_message']);
}
?>




<!DOCTYPE html>
<html>

<head>
  <title>Contact Us - Dream Ghar</title>
  <link rel="stylesheet" href="contact.css" />

</head>

<body>
  <header>
    <nav>
      <a href="realestate.php"><img src="logo.png" alt="Dream Ghar Logo" /></a>
      <ul>
        <li><a href="realestate.php" id="hover">Home</a></li>

        <li>
          <a href="submitproperty.php" id="hover">Submit Property</a>
        </li>
        <li><a href="about.html" id="hover">About</a></li>

      </ul>
    </nav>
  </header>

  <main>
    <section class="contact-section">
      <h1>Contact Us</h1>
      <p>Please fill out the form below to get in touch with us.</p>


      <form action="contactpage1.php" method="post">
        <input type="text" name="Name" placeholder="Your Name" required />
        <input type="email" name="Email" placeholder="Your Email" required />
        <textarea name="Message" rows="6" placeholder="Your Message"></textarea>
        <button type="submit" class="btn btn2">Submit</button>
        <?php
        if (!empty($message)) {
          // Showing the message only when it's not empty
          echo '<span class="success-msg">' . $message . '</span>';
        }
        ?>
      </form>
      <?php
      if (!empty($message)) {
        // Displaying the success message using JS and hide it after 3 seconds
        echo '<script>
          setTimeout(function() {
            var successMessage = document.querySelector(".success-msg");
            if (successMessage) {
              successMessage.style.display = "none";
            }
          }, 3000);
        </script>';
      }
      ?>

    </section>
  </main>



</body>

</html>