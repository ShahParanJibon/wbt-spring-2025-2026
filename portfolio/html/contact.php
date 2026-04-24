<?php
$NameErr = $EmailErr = $genderErr = "";
$fname = $lname = $email = $gender = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
        $NameErr = "First Name is required";
    } else {
        $fname = cleanInput($_POST["fname"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $NameErr = "Only letters and white space allowed";
        }
    }
    $lname = cleanInput($_POST["lname"] ?? "");

    if (empty($_POST["email"])) {
        $EmailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $EmailErr = "Invalid email format";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = cleanInput($_POST["gender"]);
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
    <h1>Contact Me</h1>

    <form method="post">
    <fieldset>

        <table>

            <tr>
                <td><label for="fname">First Name:</label></td>
                <td>
                    <input type="text" name="fname">
                    <span style="color:red;"><?php echo $NameErr; ?></span>
                </td>
            </tr>

            <tr>
                <td><label for="lname">Last Name:</label></td>
                <td>
                    <input type="text" name="lname">
                </td>
            </tr>

            <tr>
                <td><label>Gender:</label></td>
                <td>
                    <input type="radio" name="gender" value="male"> Male
                    <input type="radio" name="gender" value="female"> Female
                    <br>
                    <span style="color:red;"><?php echo $genderErr; ?></span>
                </td>
            </tr>

            <tr>
                <td><label for="email">Email:</label></td>
                <td>
                    <input type="email" name="email">
                    <span style="color:red;"><?php echo $EmailErr; ?></span>
                </td>
            </tr>

            <tr>
                <td><label for="company">Company:</label></td>
                <td><input type="text" name="company"></td>
            </tr>

            <tr>
                <td><label>Reason of Contact:</label></td>
                <td>
                    <input type="checkbox" name="reason[]" value="project"> Projects
                    <input type="checkbox" name="reason[]" value="thesis"> Thesis
                    <input type="checkbox" name="reason[]" value="job"> Job
                </td>
            </tr>

            <tr>
                <td><label>Topics:</label></td>
                <td>
                    <input type="checkbox" name="topics[]" value="web development"> Web Development
                    <input type="checkbox" name="topics[]" value="Mobile Development"> Mobile Development
                    <input type="checkbox" name="topics[]" value="AI/ML Development"> AI/ML Development
                </td>
            </tr>

            <tr>
                <td><label for="date">Consultation Date:</label></td>
                <td><input type="date" name="date"></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit">
                    <input type="reset">
                </td>
            </tr>

        </table>

    </fieldset>
    </form>

    <a href="../index.html">Back to Home</a>
</body>

</html>