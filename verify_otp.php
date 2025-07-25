<?php
session_start();
include("connection.php");

if ($_POST) {
    $entered_otp = $_POST['otp'];
    if ($entered_otp == $_SESSION['otp']) {
        // OTP verified, save user data to DB
        $data = $_SESSION['signup_data'];

        $database->query("INSERT INTO patient (pemail, pname, ppassword, paddress, pnic, pdob, ptel) VALUES 
            ('{$data['email']}', '{$data['name']}', '{$data['newpassword']}', '{$data['address']}', '{$data['nic']}', '{$data['dob']}', '{$data['tele']}')");

        $database->query("INSERT INTO webuser VALUES ('{$data['email']}', 'p')");

        // Set session variables
        $_SESSION["user"] = $data['email'];
        $_SESSION["usertype"] = "p";
        $_SESSION["username"] = $data['name'];

        // Clear OTP session data
        unset($_SESSION['otp']);
        unset($_SESSION['signup_data']);

        // Redirect to patient dashboard
        header("Location: patient/index.php");
        exit();
    } else {
        echo "Invalid OTP! Try again.";
    }
}
?>

<form method="POST">
    <label>Enter OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Verify</button>
</form>
