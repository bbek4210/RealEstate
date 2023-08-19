<?php
session_start();

// Checking if the user is logged in
if (!isset($_SESSION['email'])) {
    // User is not logged in, redirecting to the login page
    header('Location: login_sign.php');
    exit();
}

// Retrieving user details from the session
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




        .button-container {
            margin-left: 500px;

        }

        .logout-button,
        .edit-button {

            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;


        }



        .logout-button:hover,
        .edit-button:hover {
            background-color: #4caf50;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            -webkit-transform: scale(1.05);
            -webkit-transition: transform 0.2s ease-in-out;
        }

        .your-property-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .your-property-button:hover {
            background-color: #4caf50;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>

<body>
    <div>
        <header>
            <nav>
                <img src="logo.png" alt="Dream Ghar Logo" />
                <ul style="display: flex; justify-content: flex-end">
                    <li><a href="realestate.php" id="hover">Home</a></li>
                    <li>
                        <a href="submitproperty.php" id="hover">Submit Property</a>
                    </li>

                    <li><a href="about.html" id="hover">About</a></li>
                    <li><a href="contactpage1.php" id="hover">Contact</a></li>
                    <?php if (!empty($firstname) && !empty($lastname)) : ?>
                        <li style="color: #007bff;font-weight: 700;">



                            <?php echo $firstname . ' ' . $lastname; ?>


                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <main>
            <section>
                <h2>User Profile</h2>
                <?php if (!empty($firstname) && !empty($lastname)) : ?>
                    <p>Welcome, <?php echo $firstname . ' ' . $lastname; ?>!
                    <div class="button-container">
                        <a href="editprofile.php" class="edit-button">Edit Your Profile</a>
                        <a href="logout.php" class="logout-button">Logout</a>
                        <a href="your_listed_property.php" class="your-property-button">Your Listed Property</a>

                    </div>
                    </p>

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