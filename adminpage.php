<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Admin Panel - DreamGhar</title>
  <link rel="stylesheet" href="realestate.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    section {
      margin: 20px;
      padding: 20px;
      border: 1px solid #ddd;
    }

    label,
    select {
      margin-right: 10px;
    }

    button {
      margin-top: 10px;
    }
  </style>
  <script src="https://kit.fontawesome.com/f835eee1c5.js" crossorigin="anonymous"></script>
</head>

<body>
  <div>
    <header>
      <!-- ... Your navigation code ... -->
      <nav>
        <img src="logo.png" alt="Dream Ghar Logo" />
        <ul style="display: flex; justify-content: flex-end">

          <li>
            <a href="Registeradmin.php
            " id="hover">Register Admin</a>
          </li>

          <?php
          session_start();
          if (isset($_SESSION['name'])) {
            // User is logged in
            $fullname = $_SESSION['name'];

            echo '<li style="color:#007bff;"id="hover"><span class="profile-icon"><i class="fa-solid fa-user"></i></span> ' . $fullname  .  '</li>';
          } else {
            // User is not logged in
            echo '<li><a href="adminlogin.html" id="hover">Login</a></li>';
          }
          ?>
          <li><a href="adminlogin.html" id="hover">Logout</a></li>

      </nav>
    </header>
    <main>
      <section id="user-management" style="width: 100%;">
        <h2>User Management</h2>
        <?php

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dreamghar";

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Retrieving user information from the database
        $query = "SELECT * FROM users";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          echo '<table>
                  <tr>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>last Name</th>
                    <th>Address</th>
                   
                    <th>Delete</th>
                  </tr>';
          while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['firstname'] . '</td>
                    <td>' . $row['lastname'] . '</td>
                    <td>' . $row['address'] . '</td>
                   
                    <td><a href="admindeleteuser.php?email=' . urlencode($row['email']) . '"><button type="submit"><i class="fas fa-trash-alt"></i></a></td>

                  </tr>';
          }
          echo '</table>';
        } else {
          echo 'No users found.';
        }

        $conn->close();
        ?>
      </section>


      <section id="post-management" style="width: 100%;">
        <h2>Post Management</h2>

        <table style="width: 100%;">
          <tr>
            <th>PID</th>
            <th>Property Name</th>
            <th>Posted by</th>
            <th>Phone.No</th>

            <th>Pic</th>
            <th>Delete</th>
          </tr>
          <?php
          $host = "localhost";
          $username = "root";
          $password = "";
          $dbname = "dreamghar";

          $conn = new mysqli($host, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Fetching properties from the database
          $sql = "SELECT pid, property_name, author,number,pimage FROM property";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


              echo '<tr>
<td>' . $row['pid'] . '</td>
<td>' . $row['property_name'] . '</td>
<td>' . $row['author'] . '</td>
<td>' . $row['number'] . '</td>

<td>';

              if (!empty($row['pimage'])) {
                echo '<img src="admin/property/' . $row['pimage'] . '" alt="Property Image" style="max-width: 150px; height: auto;">';
              } else {
                echo 'Image not available';
              }


              echo '</td>
<td style="vertical-align: middle;">
  <form method="POST" action="delete-post.php">
    <input type="hidden" name="post-id" value="' . $row['pid'] . '">
    <button type="submit"><i class="fas fa-trash-alt"></i></button>
  </form>
</td>
</tr>';
            }
          } else {
            echo '<tr><td colspan="4">No properties found</td></tr>';
          }

          $conn->close();
          ?>
        </table>
      </section>



    </main>

  </div>



</body>

</html>