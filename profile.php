<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['userID'];

// Fetch user data
$sql = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_assoc($result);

// Handle profile update
if (isset($_POST['update_profile'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);

    $updateSql = "UPDATE user SET phone='$phone', dob='$dob' WHERE userID='$userID'";
    
    if (mysqli_query($conn, $updateSql)) {
        $success_message = "Profile updated successfully!";
        // Refresh user data
        $result = mysqli_query($conn, $sql);
        $userData = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Error updating profile: " . mysqli_error($conn);
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Verify current password
    $checkSql = "SELECT password FROM user WHERE userID='$userID'";
    $checkResult = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($checkResult);
    
    if ($row['password'] == $current_password) {
        if ($new_password == $confirm_password) {
            $updatePasswordSql = "UPDATE user SET password='$new_password', c_password='$new_password' WHERE userID='$userID'";
            
            if (mysqli_query($conn, $updatePasswordSql)) {
                $password_success = "Password changed successfully!";
            } else {
                $password_error = "Error changing password: " . mysqli_error($conn);
            }
        } else {
            $password_error = "New password and confirm password do not match!";
        }
    } else {
        $password_error = "Current password is incorrect!";
    }
}

// Handle account deletion
if (isset($_POST['delete_account'])) {
    $deleteSql = "DELETE FROM user WHERE userID='$userID'";
    
    if (mysqli_query($conn, $deleteSql)) {
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        $delete_error = "Error deleting account: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile - Banglar Krishi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap + Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Your CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .logout-btn {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .profile-container {
            max-width: 700px;
            margin: 60px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 40px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #34AD54;
        }

        .profile-header h2 {
            margin: 0;
            font-size: 1.8rem;
            color: #34AD54;
        }

        .profile-details {
            margin-top: 20px;
        }

        .profile-details h5 {
            color: #555;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .profile-details p {
            margin-bottom: 20px;
            font-size: 1rem;
            color: #333;
        }

        .edit-btn {
            background-color: #FF9933;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: #e6851d;
        }
        
        .password-btn {
            background-color: #34AD54;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .password-btn:hover {
            background-color: #2a8d44;
        }
        
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #bd2130;
        }

        .modal-header {
            background-color: #34AD54;
            color: white;
        }
        
        .modal-header.password-header {
            background-color: #34AD54;
        }
        
        .modal-header.delete-header {
            background-color: #dc3545;
        }

        .navbar-nav .nav-link, 
        .navbar-nav .dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-width: 150px;
            text-align: center;
        }

        .navbar-nav .dropdown-menu .dropdown-item {
            text-align: center;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: orange;
            color: white;
        }

        @media (max-width: 576px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-header img {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>

<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5 py-3 align-items-center">
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-start">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i>
                <h2 class="mb-0">019 091 091 91</h2>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="d-flex align-items-center justify-content-center">
                <a href="home.php" class="navbar-brand ms-lg-5">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">বাংলার </span>কৃষি</h1>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-end">
                <a class="btn btn-success btn-square rounded-circle logout-btn" href="logout.php" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
    <a href="home.php" class="navbar-brand d-flex d-lg-none">
        <h1 class="m-0 display-4 text-secondary"><span class="text-white">Banglar</span>Krishi</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0 d-flex align-items-center text-center">
            <a href="home.php" class="nav-item nav-link px-3">Home</a>
            <a href="gradingCriteria.php" class="nav-item nav-link px-3">Grading Criteria</a>
            <a href="qualityReport.php" class="nav-item nav-link px-3">Inspector Report</a>
            <a href="qualityTrendAnalysis.php" class="nav-item nav-link px-3">Quality Trend</a>
            <a href="transportationTracking.php" class="nav-item nav-link px-3">Transportation Tracking</a>
            <a href="trackingOfGradedProducts.php" class="nav-item nav-link px-3">Graded Product Tracking</a>
            <a href="packagingTrackingSystem.php" class="nav-item nav-link px-3">Packaging Tracking</a>
            
            <div class="nav-item dropdown px-3">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">More</a>
                <div class="dropdown-menu text-center">
                    <a href="service.php" class="dropdown-item">Service</a>
                    <a href="contact.php" class="dropdown-item">Contact Us</a>
                    <a href="about.php" class="dropdown-item">About</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->


<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 bg-hero mb-5">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">User Profile</h1>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Profile Section -->
<div class="container">
    <!-- Alert Messages -->
    <?php if(isset($success_message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($password_success)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $password_success; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($password_error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $password_error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($delete_error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $delete_error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="profile-container">
        <div class="profile-header">
            <img src="img/default-profile.jpg" alt="User Profile Picture">
            <div>
                <h2><?php echo $userData['name']; ?></h2>
                <p class="text-muted"><?php echo $userData['email']; ?></p>
            </div>
        </div>

        <div class="profile-details">
            <h5>📞 Mobile Number</h5>
            <p><?php echo $userData['phone']; ?></p>

            <h5>🎂 Date of Birth</h5>
            <p><?php echo date('d F Y', strtotime($userData['dob'])); ?></p>
        </div>

        <div class="text-center mt-4">
            <button class="edit-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fas fa-edit me-2"></i>Edit Profile
            </button>
            <button class="password-btn ms-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                <i class="fas fa-key me-2"></i>Change Password
            </button>
            <button class="delete-btn ms-2" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                <i class="fas fa-trash-alt me-2"></i>Delete Account
            </button>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $userData['phone']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $userData['dob']; ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header password-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="change_password" class="btn btn-success">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header delete-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete your account? This action cannot be undone.</p>
                <form method="post" action="">
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_account" class="btn btn-danger ms-2">Yes, Delete My Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<div class="container-fluid bg-footer bg-primary text-white mt-5">
    <!-- Footer content remains the same as in the original template -->
</div>
<div class="container-fluid bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">Banglar Krishi</a>. All Rights Reserved.</p>
    </div>
</div>
<!-- Footer End -->

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>