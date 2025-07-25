<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Sign Up</title>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set max date for DOB field to prevent future dates
            let today = new Date().toISOString().split("T")[0];
            document.getElementById("dob").setAttribute("max", today);
        });
    </script>
</head>
<body>
<?php

session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"] = $date;

// Initialize variables to retain form data
$fname = $lname = $address = $nic = $dob = "";
$fnameError = $lnameError = $nicError = $dobError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];

    $isValid = true;

    // Validate first and last names (only letters allowed)
    if (!preg_match('/^[a-zA-Z]+$/', $fname)) {
        $fnameError = "First name must contain only letters.";
        $isValid = false;
    }
    if (!preg_match('/^[a-zA-Z]+$/', $lname)) {
        $lnameError = "Last name must contain only letters.";
        $isValid = false;
    }

    // Validate NIC (exactly 12 digits)
    if (!preg_match('/^\d{12}$/', $nic)) {
        $nicError = "NIC must be exactly 12 digits.";
        $isValid = false;
    }

    // Validate DOB (should not be in the future)
    if ($dob > $date) {
        $dobError = "Date of Birth cannot be in the future.";
        $isValid = false;
    } 

    if ($isValid) {
        $_SESSION["personal"] = array(
            'fname' => $fname,
            'lname' => $lname,
            'address' => $address,
            'nic' => $nic,
            'dob' => $dob
        );

        header("location: create-account.php");
        exit();
    }
}
?>

<center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">Add Your Personal Details to Continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST">
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Name: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" value="<?php echo htmlspecialchars($fname); ?>" required>
                    <span class="error"><?php echo $fnameError; ?></span>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" value="<?php echo htmlspecialchars($lname); ?>" required>
                    <span class="error"><?php echo $lnameError; ?></span>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Address: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="address" class="input-text" placeholder="Address" value="<?php echo htmlspecialchars($address); ?>" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="nic" class="form-label">NIC: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="nic" class="input-text" placeholder="Aadhar Number" value="<?php echo htmlspecialchars($nic); ?>" required>
                    <span class="error"><?php echo $nicError; ?></span>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="dob" class="form-label">Date of Birth: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" id="dob" name="dob" class="input-text" value="<?php echo htmlspecialchars($dob); ?>" required>
                    <span class="error"><?php echo $dobError; ?></span>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                </td>
                <td>
                    <input type="submit" value="Next" class="login-btn btn-primary btn">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>
            </form>
        </table>
    </div>
</center>

<style>
    .error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }
</style>

</body>
</html>
