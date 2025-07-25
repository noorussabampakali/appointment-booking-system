<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Login</title>
    
</head>
<body>
    <?php

    //learn from w3schools.com
    //Unset all the server side variables

    session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";
    
    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');

    $_SESSION["date"]=$date;
    

    //import database
    include("connection.php");

    if($_POST){

        $identifier=$_POST['useridentifier'];
        $password=$_POST['userpassword'];
        
        $error='<label for="promter" class="form-label"></label>';

        // First check if the identifier is an email in the webuser table
        $result= $database->query("select * from webuser where email='$identifier'");
        
        if($result->num_rows==1){
            // If it's an email, proceed with the original login flow
            $utype=$result->fetch_assoc()['usertype'];
            
            if ($utype=='p'){
                $checker = $database->query("select * from patient where pemail='$identifier' and ppassword='$password'");
                if ($checker->num_rows==1){
                    $_SESSION['user']=$identifier;
                    $_SESSION['usertype']='p';
                    header('location: patient/index.php');
                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }elseif($utype=='a'){
                $checker = $database->query("select * from admin where aemail='$identifier' and apassword='$password'");
                if ($checker->num_rows==1){
                    $_SESSION['user']=$identifier;
                    $_SESSION['usertype']='a';
                    header('location: admin/index.php');
                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }elseif($utype=='d'){
                $checker = $database->query("select * from doctor where docemail='$identifier' and docpassword='$password'");
                if ($checker->num_rows==1){
                    $_SESSION['user']=$identifier;
                    $_SESSION['usertype']='d';
                    header('location: doctor/index.php');
                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }
        } else {
            // If not found as email, check if it's a patient phone number
            $patient_check = $database->query("select * from patient where ptel='$identifier' and ppassword='$password'");
            
            if ($patient_check->num_rows==1) {
                $patient_data = $patient_check->fetch_assoc();
                $_SESSION['user'] = $patient_data['pemail'];
                $_SESSION['usertype'] = 'p';
                header('location: patient/index.php');
            } else {
                // If not found as patient phone, check if it's a doctor phone number
                $doctor_check = $database->query("select * from doctor where doctel='$identifier' and docpassword='$password'");
                
                if ($doctor_check->num_rows==1) {
                    $doctor_data = $doctor_check->fetch_assoc();
                    $_SESSION['user'] = $doctor_data['docemail'];
                    $_SESSION['usertype'] = 'd';
                    header('location: doctor/index.php');
                } else {
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid credentials. Please check your email/phone and password.</label>';
                }
            }
        }
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>

    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome Back!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login with your details to continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useridentifier" class="form-label">Email or Phone: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="useridentifier" class="input-text" placeholder="Email Address or Phone Number" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                    <br><br><br>
                </td>
            </tr>
                    </form>
        </table>

    </div>
</center>
</body>
</html>