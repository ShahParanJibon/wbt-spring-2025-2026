<?php
$FirstNameErr = $LastNameErr =  $EmailErr = $PasswordErr = $ContactErr = "";
$FirstName = $LastName  = $email = $password = $contact = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // First Name
    if (empty($_POST["FirstName"])) {
        $FirstNameErr = " First Name is required";
    } else {
        $FirstName = cleanInput($_POST["FirstName"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $FirstName)) {
            $FirstNameErr = "Only letters and white space allowed";
        }
    }

    // Last Name
    if (empty($_POST["LastName"])) {
        $LastNameErr = " Last Name is required";
    } else {
    $LastName = cleanInput($_POST["LastName"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $LastName)) {
            $LastNameErr = "Only letters and white space allowed";
        }
    }

    // Contact
if (!empty($_POST["contact"])) {
    $contact = cleanInput($_POST["contact"]);

    if (!preg_match("/^[0-9]+$/", $contact)) {
        $ContactErr = "Only numbers are allowed";
    }
}

    // Email
    if (empty($_POST["Email"])) {
        $EmailErr = "Email is required";
    } else {
        $Email = cleanInput($_POST["Email"]);

        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $EmailErr = "Invalid email format";
        }
    }

    // Password
  if (empty($_POST["password"])) {
    $PasswordErr = "Password is required";
} else {
    $password = cleanInput($_POST["password"]);

    if (strlen($password) < 8) {
        $PasswordErr = "Password must be 8 characters ";
    }

    
}


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>

<body>
    <h1>Sign Up</h1>

    <form method="post">

        <table>

            <tr>
                <td><label for="FirstName">First Name:</label></td>
                <td>
                    <input type="text" name="FirstName">
                    <span style="color:red;"><?php echo $FirstNameErr; ?></span>
                </td>
            </tr>

            <tr>
                <td><label for="LastName">Last Name:</label></td>
                <td>
                    <input type="text" name="LastName">
                    <span style="color:red;"><?php echo $LastNameErr; ?></span>

                </td>
            </tr>

            <tr>
                <td><label for="email">Email:</label></td>
                <td>
                    <input type="text" name="Email">
                    <span style="color:red;"><?php echo $EmailErr; ?></span>
                </td>
            </tr>

            <tr>
                <td><label for="contact">Contact Num:</label></td>
                <td>
                    <input type="text" name="contact">
                    <span style="color:red;"><?php echo $ContactErr; ?></span>
                </td>
            </tr>


              <tr>
                <td><label for="password">Password:</label></td>
                <td>
                    <input type="password" name="password">
                    <span style="color:red;"><?php echo $PasswordErr; ?></span>

                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit">
                    <input type="reset">
                </td>
            </tr>

        </table>

    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" &&
        !$FirstNameErr && !$LastNameErr && !$EmailErr && !$PasswordErr): ?>
        <h3>Submitted values</h3>
        First Name: <?= $FirstName ?><br>
        Last Name: <?= $LastName ?><br>
        Contact Num: <?= $contact ?><br>
        Email: <?= $Email ?><br>
        Password: <?= $password ?><br>
        
    <?php endif; ?>

</body>

</html>