  <?php

    $servername = "localhost";
    $username = "jaredlincenberg";
    $password = "SIIKIOWI";
    $databasename = "minerDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  ?>