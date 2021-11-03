<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.5.3-dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>

    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php

    include "./conection.php";


    // define variables and set to empty values
    $nameErr = $emailErr = $passwordErr = "";
    $name = $email = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        $password = test_input($_POST["password"]);

        $sql = "INSERT INTO feCGU0aVFb.`collectted_data` (name, email, password)
                       VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


    <h2>PHP Form Validation Example</h2>
    <p><span class="error">* required field</span></p>
    <div class="row">
        <div class="col-sm">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                Name: <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
                <br><br>
                E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
                <span class="error">* <?php echo $emailErr; ?></span>
                <br><br>
                Password: <input type="password" name="password" value="<?php echo $password; ?>">
                <br><br>
                <input type="submit" class="btn btn-success" name="submit" value="Submit">
                <input type="button" class="btn btn-primary" name="show" value="Show all records" onclick="displayData()">

            </form>
        </div>

        <div class="col-sm">
            <form>
                SEARCH FOR NAME: <input type="text" name="search" value="" placeholder="Your input here">
                <input type="button" class="btn btn-primary" name="button-search" value="Search" onclick="searchData()">
                <div id="ajaxDiv">

                </div>
            </form>
        </div>

        <div class="col-sm">

            <?php
            echo "<h2>Your Input:</h2>";
            echo $name;
            echo "<br>";
            echo $email;
            echo "<br>";
            echo $password;
            ?>


        </div>

    </div>

    <div id="ajaxDiv1" class="container"> </div>

    <script>
        function searchData() {
            var ajaxRequest; // The variable that makes Ajax possible!

            try {
                // Opera 8.0+, Firefox, Safari
                ajaxRequest = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }
            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var ajaxDisplay = document.getElementById('ajaxDiv');
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
                }
            }

            console.log("aici cautara")

            // Now get the value from user and pass it to
            // server script.
            let str = document.getElementsByName("search")[0].value;
            console.log(str);
            ajaxRequest.open("GET", "search.php?q=" + str, true);
            //ajaxRequest.open("GET", "search.php", true);
            ajaxRequest.send(str);
        }

        function displayData() {
            var ajaxRequest1; // The variable that makes Ajax possible!

            try {
                // Opera 8.0+, Firefox, Safari
                ajaxRequest1 = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    ajaxRequest1 = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajaxRequest1 = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }

            // Create a function that will receive data 
            // sent from the server and will update
            // div section in the same page.

            ajaxRequest1.onreadystatechange = function() {
                if (ajaxRequest1.readyState == 4) {
                    var ajaxDisplay1 = document.getElementById('ajaxDiv1');
                    ajaxDisplay1.innerHTML = ajaxRequest1.responseText;
                }
            }

            console.log("aici afisarea")

            // Now get the value from user and pass it to
            // server script.

            ajaxRequest1.open("GET", "display.php", true);
            ajaxRequest1.send(null);
        }

        function deleteData(id) {
            var ajaxRequest2; // The variable that makes Ajax possible!

            try {
                // Opera 8.0+, Firefox, Safari
                ajaxRequest2 = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    ajaxRequest2 = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajaxRequest2 = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }

            // Create a function that will receive data 
            // sent from the server and will update
            // div section in the same page.

            ajaxRequest2.onreadystatechange = function() {
                if (ajaxRequest2.readyState == 4) {
                    //document.getElementById('ajaxDiv1').innerHTML = "";
                    displayData();
                }
            }

            console.log("aici stergerea")

            // Now get the value from user and pass it to
            // server script.

            ajaxRequest2.open("POST", "delete.php", true);
            ajaxRequest2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajaxRequest2.send('id=' + id);
        }

        function modifyData(id) {
            var ajaxRequest3; // The variable that makes Ajax possible!

            try {
                // Opera 8.0+, Firefox, Safari
                ajaxRequest3 = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    ajaxRequest3 = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajaxRequest3 = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }

            // Create a function that will receive data 
            // sent from the server and will update
            // div section in the same page.

            ajaxRequest3.onreadystatechange = function() {
                if (ajaxRequest3.readyState == 4) {
                    //document.getElementById('ajaxDiv1').innerHTML = "";
                    //...
                    displayData();
                }
            }

            console.log("aici modificarea+salvare")

            // Now get the value from user and pass it to
            // server script.

            ajaxRequest3.open("POST", "modify.php", true);
            ajaxRequest3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            let stringChange = document.getElementsByName('for-modify')[id - 1].value;
            console.log(stringChange);
            ajaxRequest3.send('id=' + id + '&message=' + stringChange);
        }

        function showDialog(id) {
            document.getElementsByName('form-for-modify')[id - 1].style.display = 'block';
            console.log("am ajuns la showDialog()");
        }

        //-->
    </script>

</body>

</html>