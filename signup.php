<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $c_password = $_POST['confirm_password'];
    
    // Check if passwords match
    if ($password !== $c_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Generate a random user ID (you might want to use a more sophisticated method)
        $userID = 'U' . rand(100000, 999999);
        
        // Insert user data into database
        $sql = "INSERT INTO user (userID, name, email, password, phone, dob, c_password) 
                VALUES ('$userID', '$name', '$email', '$password', '$phone', '$dob', '$c_password')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Account created successfully!');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banglar Krishi - Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: url('../img/signup-bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .signup-container {
            max-width: 650px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            padding: 40px 30px;
        }

        .signup-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-title h2 {
            font-weight: 700;
            color: #34AD54;
        }

        .signup-form input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
        }

        .signup-form input:focus {
            outline: none;
            border-color: #34AD54;
        }

        .signup-btn {
            width: 100%;
            padding: 12px;
            background-color: #34AD54;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .signup-btn:hover {
            background-color: #2d9649;
        }

        .already-account {
            text-align: center;
            margin-top: 20px;
            font-size: 0.95rem;
        }

        .already-account a {
            color: #34AD54;
            font-weight: 600;
            text-decoration: none;
        }

        .already-account a:hover {
            text-decoration: underline;
        }

        .profile-pic-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .profile-upload {
            margin-bottom: 20px;
        }

        .preview-img {
            max-width: 100px;
            border-radius: 50%;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="signup-container">
        <div class="signup-title">
            <h2>Sign Up to <span style="color: #FF9933;">বাংলার</span> কৃষি</h2>
        </div>

        <form class="signup-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Mobile Number" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirmPassword" required>

            <button type="submit" class="signup-btn">Create Account</button>
        </form>

        <div class="already-account">
            Already have an account? <a href="login.php">Log in</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>