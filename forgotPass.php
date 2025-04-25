<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Banglar Krishi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: url('../img/forgot.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .forgot-container {
            max-width: 500px;
            margin: 80px auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            padding: 40px 30px;
        }

        .forgot-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .forgot-title h2 {
            font-weight: 700;
            color: #34AD54;
        }

        .forgot-form input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
        }

        .forgot-form input:focus {
            outline: none;
            border-color: #34AD54;
        }

        .reset-btn {
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

        .reset-btn:hover {
            background-color: #2d9649;
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
            font-size: 0.95rem;
        }

        .back-to-login a {
            color: #34AD54;
            font-weight: 600;
            text-decoration: none;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="forgot-container">
        <div class="forgot-title">
            <h2>Reset Password</h2>
        </div>

        <form class="forgot-form" id="resetForm">
            <input type="email" placeholder="email" id="email" required>
            <input type="password" placeholder="New Password" id="newPassword" required>
            <input type="password" placeholder="Confirm Password" id="confirmPassword" required>

            <button type="submit" class="reset-btn">Confirm</button>
        </form>

        <div class="back-to-login">
            Remember your password? <a href="login.php">Log in</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("resetForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const newPass = document.getElementById("newPassword").value;
            const confirmPass = document.getElementById("confirmPassword").value;

            if (newPass !== confirmPass) {
                alert("Passwords do not match!");
                return;
            }

            alert("Password successfully reset! Redirecting to login...");
            window.location.href = "login.php";
        });
    </script>

</body>
</html>
