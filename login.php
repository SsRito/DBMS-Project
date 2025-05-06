<?php
session_start(); // Start session to store user data
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Check if email exists in the database
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 0) {
        // Email doesn't exist
        echo json_encode(['status' => 'error', 'message' => 'Email does not exist. Please sign up.']);
        exit;
    } else {
        // Email exists, now verify password
        $row = mysqli_fetch_assoc($result);
        
        if ($row['password'] == $password) { // In production, use password_verify() instead
            // Password matches, login successful
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            
            echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
            exit;
        } else {
            // Password incorrect
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password. Please try again.']);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Banglar Krishi - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Firebase JS SDKs -->
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth-compat.js"></script>
    
    <style>
        :root {
            --primary-color: #34AD54;
            --accent-color: #FF9933;
            --dark-color: #333333;
            --light-color: #F8F9FA;
            --transition-speed: 0.4s;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body, html {
            height: 100%;
            margin: 0;
            overflow-x: hidden;
            background-color: var(--light-color);
        }
        
        .login-container {
            height: 100vh;
            display: flex;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .image-section {
            position: relative;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: width var(--transition-speed) ease;
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(52, 173, 84, 0.3);
            z-index: 1;
        }
        
        .image-carousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            transition: transform 1.5s ease-in-out;
        }
        
        .carousel-image {
            width: 100%;
            height: 100%;
            flex-shrink: 0;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        
        .image-text {
            position: absolute;
            bottom: 50px;
            left: 50px;
            color: white;
            z-index: 2;
            max-width: 80%;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
        }
        
        .image-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        .image-text p {
            font-size: 1.1rem;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .login-form-section {
            width: 50%;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: white;
            transition: width var(--transition-speed) ease, transform var(--transition-speed) ease;
        }
        
        .logo {
            margin-bottom: 40px;
            text-align: center;
            transform: translateY(-20px);
            opacity: 0;
            animation: fadeInDown 0.8s forwards 0.2s;
        }
        
        .logo h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards;
        }
        
        .form-group:nth-child(2) {
            animation-delay: 0.3s;
        }
        
        .form-group:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        .form-group:nth-child(4) {
            animation-delay: 0.5s;
        }
        
        .form-group:nth-child(5) {
            animation-delay: 0.6s;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 173, 84, 0.2);
            outline: none;
        }
        
        .form-label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        
        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: 0;
            left: 15px;
            font-size: 12px;
            background-color: white;
            padding: 0 5px;
            color: var(--primary-color);
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards 0.7s;
        }
        
        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards 0.8s;
        }
        
        .btn-login:hover {
            background-color: #2d9649;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 173, 84, 0.3);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards 0.9s;
        }
        
        .divider-line {
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }
        
        .divider-text {
            padding: 0 15px;
            color: #999;
            font-size: 14px;
        }
        
        .google-btn {
            width: 100%;
            padding: 12px;
            background-color: white;
            color: var(--dark-color);
            border: 1px solid #ddd;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards 1s;
        }
        
        .google-btn:hover {
            background-color: #f8f8f8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .google-btn i {
            color: #DB4437;
            margin-right: 10px;
            font-size: 18px;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: var(--dark-color);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s forwards 1.1s;
        }
        
        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .signup-link a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }
        
        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }
            
            .image-section {
                width: 100%;
                height: 300px;
            }
            
            .login-form-section {
                width: 100%;
                padding: 40px 30px;
            }
            
            .image-text {
                left: 30px;
                bottom: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .image-section {
                height: 200px;
            }
            
            .login-form-section {
                padding: 30px 20px;
            }
            
            .image-text h2 {
                font-size: 1.8rem;
            }
            
            .image-text p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Half - Image Carousel -->
        <div class="image-section">
            <div class="image-overlay"></div>
            <div class="image-carousel">
                <div class="carousel-image" style="background-image: url('img/farm-1.jpg');"></div>
                <div class="carousel-image" style="background-image: url('img/farm-2.jpg');"></div>
                <div class="carousel-image" style="background-image: url('img/Home.jpg');"></div>
            </div>
            <div class="image-text">
                <h2>Welcome to Banglar Krishi</h2>
                <p>Supporting farmers and agriculture professionals across Bangladesh</p>
            </div>
        </div>
        
        <!-- Right Half - Login Form -->
        <div class="login-form-section">
            <div class="logo">
                <img src="img/Logo.png" alt="Banglar Krishi Logo" class="me-3" style="height: 90px; width: auto;">
                <h1><span>বাংলার</span> কৃষি</h1>
            </div>
            
            <form id="loginForm">
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                    <label for="email" class="form-label">Email Address</label>
                </div>
                
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                </div>
                
                <div class="forgot-password">
                    <a href="forgotPass.php">Forgot Password?</a>
                </div>
                
                <button type="submit" class="btn-login">Log In</button>
                
                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">OR</div>
                    <div class="divider-line"></div>
                </div>
                
                <button type="button" class="google-btn" onclick="signInWithGoogle()">
                    <i class="fab fa-google"></i> Sign in with Google
                </button>
                
                <div class="signup-link">
                    Don't have an account? <a href="signup.php">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyCNdo145dac1zYohEHs10P7xvLyd0TILds",
            authDomain: "banglar-krishi-4410c.firebaseapp.com",
            projectId: "banglar-krishi-4410c",
            storageBucket: "banglar-krishi-4410c.firebasestorage.app",
            messagingSenderId: "819309676260",
            appId: "1:819309676260:web:b6f4fc9e59afc80ff34ef1",
            measurementId: "G-5E3YTJNHD1"
        };
        
        firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();
        
        // Google Sign-In
        function signInWithGoogle() {
            const provider = new firebase.auth.GoogleAuthProvider();
            auth.signInWithPopup(provider)
                .then((result) => {
                    const user = result.user;
                    // For now, just redirect to home page
                    alert("Welcome, " + user.displayName + "!");
                    window.location.href = "home.php";
                })
                .catch((error) => {
                    console.error("Google Sign-In Error:", error.message);
                    alert("Google Sign-In failed: " + error.message);
                });
        }
        
        // Form Submission
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevents the default form submission
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Add a loading state to the button
            const loginBtn = document.querySelector('.btn-login');
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
            loginBtn.disabled = true;
            
            // Send data to server using fetch API
            fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Redirect to home page on successful login
                    window.location.href = "home.php";
                } else {
                    // Show error message
                    alert(data.message);
                    // Reset button
                    loginBtn.innerHTML = 'Log In';
                    loginBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred during login. Please try again.');
                // Reset button
                loginBtn.innerHTML = 'Log In';
                loginBtn.disabled = false;
            });
        });
        
        // Image Carousel Animation
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('.image-carousel');
            const images = document.querySelectorAll('.carousel-image');
            const imageText = document.querySelector('.image-text');
            let currentIndex = 0;
            
            // Show image text with animation
            setTimeout(() => {
                imageText.style.opacity = '1';
                imageText.style.transform = 'translateY(0)';
            }, 1000);
            
            // Start carousel
            if (images.length > 1) {
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % images.length;
                    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                    
                    // Reset and apply text animation
                    imageText.style.opacity = '0';
                    imageText.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        imageText.style.opacity = '1';
                        imageText.style.transform = 'translateY(0)';
                    }, 500);
                    
                }, 5000);
            }
        });
    </script>
</body>
</html>