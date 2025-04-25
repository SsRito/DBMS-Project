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
    <meta charset="utf-8">
    <title>Banglar Krishi - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Firebase JS SDKs -->
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth-compat.js"></script>

    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
        
        .login-container {
            height: 100vh;
            display: flex;
        }
        
        .login-image {
            width: 50%;
            background: url(../img/login-bg.jpg) center center no-repeat;
            background-size: cover;
        }
        
        .login-form-container {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 5%;
        }
        
        .website-name {
            margin-bottom: 40px;
            text-align: center;
        }
        
        .website-name h1 {
            font-size: 2.5rem;
            color: #34AD54;
        }
        
        .website-name span {
            color: #FF9933;
        }
        
        .login-form {
            width: 100%;
        }
        
        .login-form input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .login-form input:focus {
            outline: none;
            border-color: #34AD54;
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: #34AD54;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #34AD54;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }
        
        .login-btn:hover {
            background-color: #2d9649;
        }
        
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }
        
        .divider:before, .divider:after {
            content: "";
            position: absolute;
            height: 1px;
            background-color: #ddd;
            top: 50%;
            width: 45%;
        }
        
        .divider:before {
            left: 0;
        }
        
        .divider:after {
            right: 0;
        }
        
        .google-btn {
            width: 100%;
            padding: 12px;
            background-color: #fff;
            color: #757575;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .google-btn:hover {
            background-color: #f1f1f1;
        }
        
        .google-btn i {
            color: #DB4437;
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        @media (max-width: 768px) {
            .login-image {
                display: none;
            }
            
            .login-form-container {
                width: 100%;
            }
        }

        .signup-link {
        font-size: 0.95rem;
        color: #333;
        }

        .signup-link a {
        color: #34AD54;
        text-decoration: none;
        font-weight: 600;
        }

        .signup-link a:hover {
        text-decoration: underline;
        }

        
        .login-image {
        width: 50%;
        background: url(../img/Home.jpg) center center no-repeat;
        background-size: cover;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Half - Image -->
        <div class="login-image"></div>
        
        <!-- Right Half - Login Form -->
        <div class="login-form-container">
            <div class="website-name">
                <h1><span>বাংলার</span> কৃষি</h1>
            </div>
            
            <form class="login-form" id="loginForm">
                <input type="email" placeholder="Email" class="form-control" required>
                <input type="password" placeholder="Password" class="form-control" required>
            
                <div class="forgot-password">
                    <a href="forgotPass.php">Forgot Password?</a>
                </div>
            
                <button type="submit" class="login-btn">Log In</button>
            
                <div class="divider">OR</div>
            
                <button type="button" class="google-btn" onclick="signInWithGoogle()">
                    <i class="fab fa-google"></i> Sign in with Google
                </button>

                <div class="already-account" style="text-align: center;">
                    Don't have an account? <a href="signup.php">Sign up</a>
                </div>

            </form>
            
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevents the default form submission
    
            // Example: You can put your actual login logic here
            const email = document.querySelector('input[type="email"]').value;
            const password = document.querySelector('input[type="password"]').value;
    
            // Dummy credentials
        const dummyEmail = "ritomister@gmail.com";
        const dummyPassword = "1234";

        // Check if credentials match
        if (email === dummyEmail && password === dummyPassword) {
            // Redirect to index.html
            window.location.href = "index.html";
        } else {
            alert("Invalid email or password. Try using:\nEmail: test@banglarkrishi.com\nPassword: pass1234");
        }
        });
    </script>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const firebaseConfig = {
          apiKey: "AIzaSyCNdo145dac1zYohEHs10P7xvLyd0TILds",
          authDomain: "banglar-krishi-4410c.firebaseapp.com",
          projectId: "banglar-krishi-4410c",
          storageBucket: "banglar-krishi-4410c.firebasestorage.app",
          messagingSenderId: "819309676260",
          appId: "1:819309676260:web:b6f4fc9e59afc80ff34ef1",
          measurementId: "G-5E3YTJNHD1"
        };
      
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();
      
        function signInWithGoogle() {
          const provider = new firebase.auth.GoogleAuthProvider();
          auth.signInWithPopup(provider)
            .then((result) => {
              const user = result.user;
              alert("Welcome, " + user.displayName + "!");
              window.location.href = "index.html"; // redirect to home
            })
            .catch((error) => {
              console.error("Google Sign-In Error:", error.message);
              alert("Google Sign-In failed: " + error.message);
            });
        }
      </script>
      
    

</body>

</html>