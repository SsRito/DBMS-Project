<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}

// Initialize variables
$editData = null;
$success_message = "";
$error_message = "";

// Handle DELETE operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM farmer_crop_type_grade WHERE standardGradeID = '$id'";
    
    if (mysqli_query($conn, $delete_query)) {
        $success_message = "Record deleted successfully";
    } else {
        $error_message = "Error deleting record: " . mysqli_error($conn);
    }
}

// Handle EDIT operation - first load the data
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_query = "SELECT * FROM farmer_crop_type_grade WHERE standardGradeID = '$id'";
    $result = mysqli_query($conn, $edit_query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $editData = mysqli_fetch_assoc($result);
    }
}

// Handle UPDATE operation
if (isset($_POST['update'])) {
    $id = $_POST['standardGradeID'];
    $quantity = $_POST['quantity'];
    $cropGrade = $_POST['cropGrade'];
    $criteria_size = $_POST['criteria_size'];
    $criteria_shape = $_POST['criteria_shape'];
    $criteria_colour = $_POST['criteria_colour'];
    $criteria_infestation = $_POST['criteria_infestation'];
    $cropTypeID = $_POST['cropTypeID'];
    
    $update_query = "UPDATE farmer_crop_type_grade SET 
                    quantity = '$quantity',
                    cropGrade = '$cropGrade',
                    criteria_size = '$criteria_size',
                    criteria_shape = '$criteria_shape',
                    criteria_colour = '$criteria_colour',
                    criteria_infestation = '$criteria_infestation',
                    cropTypeID = '$cropTypeID'
                    WHERE standardGradeID = '$id'";
    
    if (mysqli_query($conn, $update_query)) {
        $success_message = "Record updated successfully";
        $editData = null; // Reset edit mode
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
    }
}

// Handle ADD operation
if (isset($_POST['add'])) {
    $id = $_POST['standardGradeID'];
    $quantity = $_POST['quantity'];
    $cropGrade = $_POST['cropGrade'];
    $criteria_size = $_POST['criteria_size'];
    $criteria_shape = $_POST['criteria_shape'];
    $criteria_colour = $_POST['criteria_colour'];
    $criteria_infestation = $_POST['criteria_infestation'];
    $cropTypeID = $_POST['cropTypeID'];
    
    // Check if ID already exists
    $check_query = "SELECT standardGradeID FROM farmer_crop_type_grade WHERE standardGradeID = '$id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $error_message = "Error: Grade ID '$id' already exists!";
    } else {
        $insert_query = "INSERT INTO farmer_crop_type_grade 
                         (standardGradeID, quantity, cropGrade, criteria_size, criteria_shape, criteria_colour, criteria_infestation, cropTypeID) 
                         VALUES ('$id', '$quantity', '$cropGrade', '$criteria_size', '$criteria_shape', '$criteria_colour', '$criteria_infestation', '$cropTypeID')";
        
        if (mysqli_query($conn, $insert_query)) {
            $success_message = "Record added successfully";
        } else {
            $error_message = "Error adding record: " . mysqli_error($conn);
        }
    }
}
$sql = "SELECT standardGradeID, quantity, cropGrade, criteria_size, criteria_shape, criteria_colour FROM farmer_crop_type_grade";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Banglar Krishi - Product Grading Management</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
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

        .table-responsive {
            margin-bottom: 25px;
        }

        .actions-column {
            min-width: 150px;
        }

        .alert {
            margin-bottom: 20px;
        }

        .bg-hero-grading {
            background: url('img/grading-banner.jpg') center center no-repeat;
            background-size: cover;
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
                    <a href="index.html" class="navbar-brand ms-lg-5">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">বাংলার </span>কৃষি</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end">
                    <!-- Profile Icon -->
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="profile.php" title="Profile">
                        <i class="fas fa-user"></i>
                    </a>
                    <!-- Logout Icon -->
                    <a class="btn btn-success btn-square rounded-circle logout-btn" href="login.php" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>   
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Banglar</span>Krishi</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0 d-flex align-items-center text-center">
                <a href="index.html" class="nav-item nav-link px-3">Home</a>
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
    <div class="container-fluid bg-primary py-5 bg-hero-grading mb-5">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-1 text-white mb-0"></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Crop Grading Management Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-5 text-center">
                    <h1 class="display-5">Crop Grading Management</h1>
                    <p class="fs-5 text-muted">Manage crop grading standards and parameters</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if($success_message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if($error_message): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif;
?>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <input type="text" id="gradeTableSearch" class="form-control" placeholder="Search grading standards...">
            </div>
        </div>

        <!-- Grading Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="gradingTable">
                <thead class="table-primary">
                    <tr>
                        <th>Standard Grade ID</th>
                        <th>Quantity(Kg)</th>
                        <th>Grade</th>
                        <th>Size</th>
                        <th>Shape</th>
                        <th>Colour</th>
                        <th>Infestation</th>
                        <th>Crop Type ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display existing records or the record being edited
                    $result = $conn->query("SELECT * FROM farmer_crop_type_grade ORDER BY standardGradeID");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($editData && $editData['standardGradeID'] == $row['standardGradeID']) {
                                // Display edit form for this row
                                echo "<tr>
                                    <form method='POST'>
                                        <input type='hidden' name='standardGradeID' value='{$editData['standardGradeID']}'>
                                        <td>{$editData['standardGradeID']}</td>
                                        <td><input type='number' step='0.01' name='quantity' value='{$editData['quantity']}' class='form-control' required></td>
                                        <td>
                                            <select name='cropGrade' class='form-control' required>
                                                <option value='Grade A' " . ($editData['cropGrade'] == 'Grade A' ? 'selected' : '') . ">Grade A</option>
                                                <option value='Grade B' " . ($editData['cropGrade'] == 'Grade B' ? 'selected' : '') . ">Grade B</option>
                                                <option value='Grade C' " . ($editData['cropGrade'] == 'Grade C' ? 'selected' : '') . ">Grade C</option>
                                            </select>
                                        </td>
                                        <td><input type='text' name='criteria_size' value='{$editData['criteria_size']}' class='form-control' required></td>
                                        <td><input type='text' name='criteria_shape' value='{$editData['criteria_shape']}' class='form-control' required></td>
                                        <td><input type='text' name='criteria_colour' value='{$editData['criteria_colour']}' class='form-control' required></td>
                                        <td><input type='text' name='criteria_infestation' value='{$editData['criteria_infestation']}' class='form-control' required></td>
                                        <td>
                                            <select name='cropTypeID' class='form-control' required>";
                                            // Fetch crop types for dropdown
                                            $cropTypes = $conn->query("SELECT cropTypeID, cropType FROM farmer_crop_type");
                                            while ($cropType = $cropTypes->fetch_assoc()) {
                                                $selected = ($editData['cropTypeID'] == $cropType['cropTypeID']) ? 'selected' : '';
                                                echo "<option value='{$cropType['cropTypeID']}' $selected>{$cropType['cropTypeID']} - {$cropType['cropType']}</option>";
                                            }
                                echo "      </select>
                                        </td>
                                        <td class='actions-column'>
                                            <button type='submit' name='update' class='btn btn-success btn-sm'>Save</button>
                                            <a href='farmer_crop_grade.php' class='btn btn-secondary btn-sm'>Cancel</a>
                                        </td>
                                    </form>
                                </tr>";
                            } else {
                                // Display regular row
                                echo "<tr>
                                    <td>{$row['standardGradeID']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['cropGrade']}</td>
                                    <td>{$row['criteria_size']}</td>
                                    <td>{$row['criteria_shape']}</td>
                                    <td>{$row['criteria_colour']}</td>
                                    <td>{$row['criteria_infestation']}</td>
                                    <td>{$row['cropTypeID']}</td>
                                    <td class='actions-column'>
                                        <a href='farmer_crop_grade.php?edit={$row['standardGradeID']}' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='farmer_crop_grade.php?delete={$row['standardGradeID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No grading standards found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Add New Record Form -->
        <div class="card mb-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Grading Standard</h4>
            </div>
            <div class="card-body">
                <form method="POST" class="row g-3">
                    <div class="col-md-4">
                        <label for="standardGradeID" class="form-label">Grade ID</label>
                        <input type="text" name="standardGradeID" class="form-control" placeholder="e.g. SG009" required>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" step="0.01" name="quantity" class="form-control" placeholder="e.g. 5000.00" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cropGrade" class="form-label">Grade</label>
                        <select name="cropGrade" class="form-control" required>
                            <option value="">Select Grade</option>
                            <option value="Grade A">A</option>
                            <option value="Grade B">B</option>
                            <option value="Grade C">C</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="criteria_size" class="form-label">Size</label>
                        <input type="text" name="criteria_size" class="form-control" placeholder="e.g. Large" required>
                    </div>
                    <div class="col-md-3">
                        <label for="criteria_shape" class="form-label">Shape</label>
                        <input type="text" name="criteria_shape" class="form-control" placeholder="e.g. Uniform" required>
                    </div>
                    <div class="col-md-3">
                        <label for="criteria_colour" class="form-label">Colour</label>
                        <input type="text" name="criteria_colour" class="form-control" placeholder="e.g. Red" required>
                    </div>
                    <div class="col-md-3">
                        <label for="criteria_infestation" class="form-label">Infestation</label>
                        <input type="text" name="criteria_infestation" class="form-control" placeholder="e.g. None" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cropTypeID" class="form-label">Crop Type</label>
                        <select name="cropTypeID" class="form-control" required>
                            <option value="">Select Crop Type</option>
                            <?php
                            // Fetch crop types for dropdown
                            $cropTypes = $conn->query("SELECT cropTypeID, cropType FROM farmer_crop_type");
                            while ($cropType = $cropTypes->fetch_assoc()) {
                                echo "<option value='{$cropType['cropTypeID']}'>{$cropType['cropTypeID']} - {$cropType['cropType']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" name="add" class="btn btn-primary">Add New Standard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Crop Grading Management End -->

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


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        // Search Filter for Grading Table
        document.getElementById('gradeTableSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#gradingTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</body>

</html>