<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Admin Panel - DreamGhar</title>
  <link rel="stylesheet" href="realestate.css" />
</head>

<body>
  <div>
    <header>
      <nav>
        <img src="logo.png" alt="Dream Ghar Logo" />
        <ul style="display: flex; justify-content: flex-end">

          <li>
            <a href="Registeradmin.php
            " id="hover">Register Admin</a>
          </li>
          <li>
            <a href="realestate.php" id="hover">post-management</a>
          </li>
          <li><a href="adminlogin.html" id="hover">Logout</a></li>

      </nav>
    </header>
    <main>
      <section id="user-management">
        <h2>User Management</h2>




        <form id="delete-user-form" method="POST" action="admindeleteuser.php">
          <label for="email">Select Email:</label>
          <select id="email" name="email">
            <?php

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

            // Retrieving user emails from the database
            $query = "SELECT email FROM users";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $email = $row['email'];
                echo '<option value="' . $email . '">' . $email . '</option>';
              }
            }

            $conn->close();
            ?>
          </select>

          <button type="submit">Delete User</button>
        </form>






      </section>

      <section id="post-management">
        <h2>Post Management</h2>



        <form id="delete-post-form" method="POST" action="delete-post.php">
          <label for="post-id"> Select Post ID:</label>
          <select id="post-id" name="post-id">
            <?php

            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dreamghar";

            $conn = new mysqli($host, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Fetching existing post IDs from the database
            $sql = "SELECT pid FROM property";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Output each post ID as an option in the select dropdown
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['pid'] . '">' . $row['pid'] . '</option>';
              }
            } else {
              echo '<option value="" disabled>No posts found</option>';
            }

            $conn->close();
            ?>
          </select>
          <button type="submit">Delete Post</button>
        </form>


      </section>

    </main>
  </div>

</body>

</html>