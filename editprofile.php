<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // User is not logged in, redirect to the login page
    header('Location: login.html');
    exit();
}

// Retrieve user details from the session
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

// Database connection code
// Replace the placeholders with your actual database credentials
$host = "localhost"; // host name
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave blank if you haven't set one)
$dbname = "dreamghar"; // name of the database you want to connect to

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $newFirstname = $_POST['firstname'];
    $newLastname = $_POST['lastname'];
    $newPassword = $_POST['password'];

    // Update the user's name and password in the database
    $email = $_SESSION['email'];

    // Prepare the SQL statement
    $sql = "UPDATE users SET firstname = ?, lastname = ?, password = ? WHERE email = ?";

    // Prepare the statement and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $newFirstname, $newLastname, $newPassword, $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Update the session variables with the new values
        $_SESSION['firstname'] = $newFirstname;
        $_SESSION['lastname'] = $newLastname;

        // Redirect to the user profile page
        header('Location:profile.php');
        exit();
    } else {
        // Error occurred while updating the user details
        $error = 'Failed to update user details.';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Edit Profile</title>
    <link rel="stylesheet" href="realestate.css" />
    <style>
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #ccc;
            font-size: 1rem;
            width: 300px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #4caf50;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            margin: 0;


            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(255, 255, 255, 0.8);

        }



        form {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 1rem;
            border: 10px;
            border-color: #f7f9f9;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #f7f9f9;
        }
    </style>
</head>

<body>
    <div>
        <header>
            <nav>
                <!-- Your navigation menu -->
                <img src="logo.png" alt="Dream Ghar Logo" />
                <ul style="display: flex; justify-content: flex-end">
                    <li><a href="realestate.php" id="hover">Home</a></li>
                    <li>
                        <a href="submitproperty.php" id="hover">Submit Property</a>
                    </li>

                    <li><a href="about.html" id="hover">About</a></li>
                    <li><a href="contactpage1.html" id="hover">Contact</a></li>
                    <?php if (!empty($firstname) && !empty($lastname)) : ?>
                        <li>
                            <!-- <i class="fas fa-user profile-icon"></i><?php echo $firstname . ' ' . $lastname; ?>
                            <a href="editprofile.php" class="edit-button">Edit</a>
                            <a href="logout.php" class="logout-button">Logout</a> -->
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            </nav>
        </header>

        <main>
            <section>
                <h2>Edit Profile</h2>
                <?php if (isset($error)) : ?>
                    <p><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST" action="">
                    <div>
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" required placeholder="enter new first name">
                    </div>
                    <div>
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" required placeholder="enter new last name">
                    </div>
                    <div>
                        <label for="password">New Password:</label>
                        <input type="password" id="password" name="password" required placeholder="enter  new password">
                    </div>
                    <div>
                        <button type="submit">Save Changes</button>
                    </div>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; DreamGhar-Property Listing</p>
        </footer>
    </div>
</body>

</html>