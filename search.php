<?php

$que = $_GET["q"];

$connectionAuxiliary = new mysqli('remotemysql.com', 'feCGU0aVFb', 'W63Q8qmNUW');
$sql = "SELECT * FROM feCGU0aVFb.`collectted_data`   WHERE   `collectted_data`.name LIKE '$que'";
//$sql = "SELECT * FROM TGOhJ1gk0h.`collectted_data`";
$result = $connectionAuxiliary->query($sql);
//print($connectionAuxiliary->query($sql));
$display_string = null;
$display_string = "<table class='table table-bordered table-striped'>";
$display_string .= "<tr>";
$display_string .= "<th>Name</th>";
$display_string .= "<th>Email</th>";
$display_string .= "<th>Password</th>";
$display_string .= "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $display_string .= "<tr>";
        $display_string .= "<td>$row[name]</td>";
        $display_string .= "<td>$row[email]</td>";
        $display_string .= "<td>$row[password]</td>";
        $display_string .= "</tr>";
        //echo "name: " . $row["name"] . " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    }
} else {
    echo "0 results";
}

$display_string .= "</table>";
echo $display_string;
