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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>User Profile</title>
    <link rel="stylesheet" href="realestate.css" />
    <script src="https://kit.fontawesome.com/f835eee1c5.js" crossorigin="anonymous"></script>
    <style>
        .profile-icon {
            font-size: 20px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div>
        <header>
            <nav>
                <img src="logo.png" alt="Dream Ghar Logo" />
                <ul style="display: flex; justify-content: flex-end">
                    <li>
                        <a href="submitproperty.php" id="hover">Submit Property</a>
                    </li>
                    <li><a href="about.html" id="hover">About</a></li>
                    <li><a href="contactpage1.html" id="hover">Contact</a></li>
                    <?php if (!empty($firstname) && !empty($lastname)) : ?>
                        <li>
                            <i class="fas fa-user profile-icon"></i><?php echo $firstname . ' ' . $lastname; ?>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <main>
            <section>
                <h2>User Profile</h2>
                <?php if (!empty($firstname) && !empty($lastname)) : ?>
                    <p>Welcome, <?php echo $firstname . ' ' . $lastname; ?>!</p>
                    <!-- Add more content here to display user information -->
                <?php endif; ?>
            </section>
        </main>

        <footer>
            <p>&copy; DreamGhar-Property Listing</p>
        </footer>
    </div>
    <script src="realestate.js"></script>
</body>

</html>