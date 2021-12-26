<?php
    include "./includes/inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login - End to End Encrption of Short Message Service (SMS) using Elliptic Curve Cryptography</title>
</head>
<body bgcolor="#bed5e8">

    <div class="login-header">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="My logo"> SMS Encryption</a>
        </div>
    </div>

    <div class="login-container pad">
        <div class="box">
            <h1>Hello <br/>Welcome to SMS Encrption</h1>
            <p>Empower Every Enterprise to Connect Global users Efficiently and Achieve more</p>
            <div class="bullet">
                <div class="bullet-box">
                    <img src="images/1.png" alt="">
                    <p>Reach your customers through multiple channels</p>
                </div>
                <div class="bullet-box">
                    <img src="images/2.png" alt="">
                    <p>More product integration solutions</p>
                </div>
                <div class="bullet-box">
                    <img src="images/3.png" alt="">
                    <p>1 to 1 exclusive service</p>
                </div>
                <div class="bullet-box">
                    <img src="images/4.png" alt="">
                    <p>Low price and high touch rate</p>
                </div>
                <div class="bullet-box">
                    <img src="images/5.png" alt="">
                    <p>Established service providers, quality assurance</p>
                </div>
            </div>
        </div>
        <div class="box background">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="signUp">
                <h1>SignUp</h1>
                <div class="fields">
                    <h2>Fullname</h2>
                    <input type="text" name="fullname" class="form-control" placeholder="Enter your fullname" required>
                </div>
                <div class="fields">
                    <h2>Username</h2>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="fields">
                    <h2>Password</h2>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                </div>
                <div class="fields">
                    <h2>Confirm Password</h2>
                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm password">
                </div>
                <div class="fields">
                    <button name="signup" class="btn-log">Sign Up</button>
                </div>
                <p>Already have an account? <a href="login.php">Login here.</a></p> 

                <?php
                    if(isset($_POST['signup'])){                    
                        
                        $query = "INSERT INTO `tbl_client`(`fullname`, `username`, `password`) VALUES (?,?,?)";
                        $response = $conn->signup($query);
                        echo $response;                      
                    }
                    
                ?>
            </form>

        </div>
    </div>
    
</body>
</html>