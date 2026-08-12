<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
</head>

<body>

<h2>Student Registration Form</h2>

<?php

// PHP VALIDATION LOGIC

$studentName = "";
$username = "";
$email = "";
$phone = "";
$age = "";
$password = "";
$confirmPassword = "";
$studentID = "";
$website = "";
$dob = "";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ---1. FULL NAME-----
    

    if (empty($_POST["studentName"])) {
        $errors["studentName"] = "Full Name is required";
    } else {
        $studentName = $_POST["studentName"];

        // Rule 1
        if (!preg_match("/^[a-zA-Z ]*$/", $studentName)) {
            $errors["studentName"] = "Full Name may contain only letters and spaces";
        }
        // Rule 2
        elseif (strlen($studentName) < 3) {
            $errors["studentName"] = "Full Name must contain at least 3 characters";
        }
        // Rule 3
        elseif (strlen($studentName) > 50) {
            $errors["studentName"] = "Full Name must not exceed 50 characters";
        }
    }


    // ---2. USERNAME----
   
    if (empty($_POST["username"])) {
        $errors["username"] = "Username is required";
    } else {
        $username = $_POST["username"];

        // Rule 4
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $errors["username"] =
                "Username may contain only letters, numbers and underscore";
        }
        // Rule 5
        elseif (strlen($username) < 5 || strlen($username) > 15) {
            $errors["username"] =
                "Username must be between 5 and 15 characters";
        }
        // Rule 6
        elseif (!preg_match("/^[a-zA-Z]/", $username)) {
            $errors["username"] =
                "Username must start with an alphabetic character";
        }
    }


    // ---3. EMAIL---
    

    if (empty($_POST["email"])) {
        $errors["email"] = "Email Address is required";
    } else {
        $email = $_POST["email"];

        // Rule 7
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email address";
        }
        // Rule 8
        elseif (!preg_match("/\.(com|org|edu)$/i", $email)) {
            $errors["email"] =
                "Email Address must end with .com, .org or .edu";
        }
    }


    //---- 4. PHONE NUMBER-----
    
    if (empty($_POST["phone"])) {
        $errors["phone"] = "Phone Number is required";
    } else {
        $phone = $_POST["phone"];

        // Rule 9
        if (!preg_match("/^[0-9]+$/", $phone)) {
            $errors["phone"] = "Phone Number must contain digits only";
        }
        // Rule 10
        elseif (strlen($phone) != 11) {
            $errors["phone"] = "Phone Number must contain exactly 11 digits";
        }
        // Rule 11 - checked separately
        elseif (substr($phone, 0, 2) != "01") {
            $errors["phone"] = "Phone Number must start with 01";
        }
    }


    // ---5. AGE----
   

    if (empty($_POST["age"])) {
        $errors["age"] = "Age is required";
    } else {
        $age = $_POST["age"];

        // Rule 12 - numeric check first
        if (!is_numeric($age)) {
            $errors["age"] = "Age must contain a numeric value";
        }
        // Rule 13 - range check after numeric check
        elseif ($age < 18 || $age > 30) {
            $errors["age"] = "Age must be between 18 and 30";
        }
    }


    //--- 6. PASSWORD---
    

    if (empty($_POST["password"])) {
        $errors["password"] = "Password is required";
    } else {
        $password = $_POST["password"];

        // Rule 14
        if (strlen($password) < 8) {
            $errors["password"] =
                "Password must contain at least 8 characters";
        }
        // Rule 15
        elseif (!preg_match("/[A-Z]/", $password)) {
            $errors["password"] =
                "Password must contain at least one uppercase letter";
        }
        // Rule 16
        elseif (!preg_match("/[0-9]/", $password)) {
            $errors["password"] =
                "Password must contain at least one numeric digit";
        }
        // Rule 17
        elseif (!preg_match("/[@#$%]/", $password)) {
            $errors["password"] =
                "Password must contain at least one of @, #, $ or %";
        }
    }


    //--- 7. CONFIRM PASSWORD----
   

    if (empty($_POST["confirmPassword"])) {
        $errors["confirmPassword"] = "Confirm Password is required";
    } else {
        $confirmPassword = $_POST["confirmPassword"];

        // Rule 18
        if ($confirmPassword !== $password) {
            $errors["confirmPassword"] =
                "Confirm Password must exactly match Password";
        }
    }


    
    // --- 8. STUDENT ID---- 
    

    if (empty($_POST["studentID"])) {
        $errors["studentID"] = "Student ID is required";
    } else {
        $studentID = $_POST["studentID"];

        // Rule 19
        if (!preg_match("/^[0-9]{2}-[0-9]{5}-[0-9]$/", $studentID)) {
            $errors["studentID"] =
                "Student ID must follow the format XX-XXXXX-X";
        }
    }


    // --- 9. PERSONAL WEBSITE----
    

    if (empty($_POST["website"])) {
        $errors["website"] = "Personal Website is required";
    } else {
        $website = $_POST["website"];

        // Rule 20
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $errors["website"] = "Enter a valid website URL";
        }
        elseif (
            strpos($website, "http://") !== 0 &&
            strpos($website, "https://") !== 0
        ) {
            $errors["website"] =
                "Website must begin with http:// or https://";
        }
    }


    // --- 10. DATE OF BIRTH----
   

    if (empty($_POST["dob"])) {
        $errors["dob"] = "Date of Birth is required";
    } else {
        $dob = $_POST["dob"];
    }
}

?>

<form method="post" action="">

    Full Name:
    <input type="text" name="studentName"
           value="<?php echo htmlspecialchars($studentName); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["studentName"]))
            echo $errors["studentName"];
        ?>
    </span>

    <br><br>


    Username:
    <input type="text" name="username"
           value="<?php echo htmlspecialchars($username); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["username"]))
            echo $errors["username"];
        ?>
    </span>

    <br><br>


    Email Address:
    <input type="text" name="email"
           value="<?php echo htmlspecialchars($email); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["email"]))
            echo $errors["email"];
        ?>
    </span>

    <br><br>


    Phone Number:
    <input type="text" name="phone"
           value="<?php echo htmlspecialchars($phone); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["phone"]))
            echo $errors["phone"];
        ?>
    </span>

    <br><br>


    Age:
    <input type="text" name="age"
           value="<?php echo htmlspecialchars($age); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["age"]))
            echo $errors["age"];
        ?>
    </span>

    <br><br>


    Password:
    <input type="password" name="password">

    <span style="color:red">
        * <?php
        if (isset($errors["password"]))
            echo $errors["password"];
        ?>
    </span>

    <br><br>


    Confirm Password:
    <input type="password" name="confirmPassword">

    <span style="color:red">
        * <?php
        if (isset($errors["confirmPassword"]))
            echo $errors["confirmPassword"];
        ?>
    </span>

    <br><br>


    Student ID:
    <input type="text" name="studentID"
           value="<?php echo htmlspecialchars($studentID); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["studentID"]))
            echo $errors["studentID"];
        ?>
    </span>

    <br><br>


    Personal Website:
    <input type="text" name="website"
           value="<?php echo htmlspecialchars($website); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["website"]))
            echo $errors["website"];
        ?>
    </span>

    <br><br>


    Date of Birth:
    <input type="date" name="dob"
           value="<?php echo htmlspecialchars($dob); ?>">

    <span style="color:red">
        * <?php
        if (isset($errors["dob"]))
            echo $errors["dob"];
        ?>
    </span>

    <br><br>


    <input type="submit" name="submit" value="Register">

</form>


<?php

// --- SUCCESS MESSAGE----



if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {

    echo "<h3>Registration Successful!</h3>";

    echo "Full Name: " . htmlspecialchars($studentName) . "<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Student ID: " . htmlspecialchars($studentID) . "<br>";
    echo "Email Address: " . htmlspecialchars($email) . "<br>";
}

?>



</body>
</html>