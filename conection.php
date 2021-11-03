<?php
    // Create connection
    $conn = new mysqli('remotemysql.com', 'feCGU0aVFb', 'W63Q8qmNUW');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully<br>";
