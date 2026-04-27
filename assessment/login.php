<?php

$valid_username = "admin";
$valid_password = "12345678";

$usernameErr = "";
$passwordErr = "";
$successMsg = "";

function cleanInput($data) 
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $username = cleanInput($_POST["username"]);
    $password = cleanInput($_POST["password"]);

    if (empty($username)) 
    {
        $usernameErr = "Username is required";
    }
    if (empty($password)) 
    {
        $passwordErr = "Password is required";
    } 
    elseif (strlen($password) < 8) 
    {
        $passwordErr = "Password must be at least 8 characters";
    }
    if (empty($usernameErr) && empty($passwordErr)) 
    {
        if ($username === $valid_username && $password === $valid_password) 
        {
            $successMsg = "Login successful!";
        } 
        else 
        {
            $successMsg = "Invalid username or password!";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">

    Username:<br>
    <input type="text" name="username">
    <span style="color:red;"><?php echo $usernameErr; ?></span>
    <br><br>

    Password:<br>
    <input type="password" name="password">
    <span style="color:red;"><?php echo $passwordErr; ?></span>
    <br><br>

    <input type="submit" value="Login">

</form>

<p><?php echo $successMsg; ?></p>

</body>
</html>