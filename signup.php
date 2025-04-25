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

        <form class="signup-form" id="signupForm">
            <input type="text" placeholder="Full Name" required>
            <input type="email" placeholder="Email" required>
            <input type="tel" placeholder="Mobile Number" required>
            <input type="date" placeholder="Date of Birth" required>
            <input type="password" placeholder="Password" id="password" required>
            <input type="password" placeholder="Confirm Password" id="confirmPassword" required>

            <div class="profile-upload">
                <label class="profile-pic-label">Upload Profile Picture</label>
                <input type="file" accept="image/*" id="profilePic">
                <img id="preview" class="preview-img" src="#" alt="Preview" style="display:none;">
            </div>

            <button type="submit" class="signup-btn">Create Account</button>
        </form>

        <div class="already-account">
            Already have an account? <a href="login.php">Log in</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS for image preview & password match -->
    <script>
        // Profile image preview
        document.getElementById("profilePic").addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById("preview");
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        });

        // Dummy signup logic with password match check
        document.getElementById("signupForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return;
            }

            alert("Account created successfully! (dummy)\nRedirecting to login...");
            window.location.href = "login.html";
        });
    </script>

</body>
</html>
