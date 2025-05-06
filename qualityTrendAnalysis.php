<?php
include "database.php";

// We need to know the actual table structure
$tableName = "grading_details"; 

// Check if form is submitted for various operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle CREATE operation
    if (isset($_POST['create'])) {
        // Properly escape user input to prevent SQL injection
        $pastProblem = $conn->real_escape_string($_POST['pastProblem']);
        $presentSituation = $conn->real_escape_string($_POST['presentSituation']);
        $changes = $conn->real_escape_string($_POST['changes']);
        
        // Insert query without id references
        $sql = "INSERT INTO $tableName (past_problem, present_situation, changes) 
                VALUES ('$pastProblem', '$presentSituation', '$changes')";
        
        if ($conn->query($sql) === TRUE) {
            $success = "Record created successfully";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
    
    // Handle UPDATE operation - using content-based identification
    if (isset($_POST['update']) && isset($_POST['record_identifier'])) {
        // Use past_problem as identifier but from a hidden field containing the original value
        $identifier = $conn->real_escape_string($_POST['record_identifier']);
        
        // Properly escape user input
        $pastProblem = $conn->real_escape_string($_POST['pastProblem']);
        $presentSituation = $conn->real_escape_string($_POST['presentSituation']);
        $changes = $conn->real_escape_string($_POST['changes']);
        
        // Update using the original past_problem value to identify the record
        $sql = "UPDATE $tableName SET 
                past_problem='$pastProblem', 
                present_situation='$presentSituation', 
                changes='$changes' 
                WHERE past_problem='$identifier'";
        
        if ($conn->query($sql) === TRUE) {
            $success = "Record updated successfully";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
    
    // Handle DELETE operation
    if (isset($_POST['delete']) && isset($_POST['record_identifier'])) {
        // Use past_problem as identifier
        $identifier = $conn->real_escape_string($_POST['record_identifier']);
        
        // Delete using past_problem value to identify the record
        $sql = "DELETE FROM $tableName WHERE past_problem='$identifier'";
        
        if ($conn->query($sql) === TRUE) {
            $success = "Record deleted successfully";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}

// Get record to edit - using content-based identification
$editRow = null;
if (isset($_GET['edit'])) {
    $identifier = $conn->real_escape_string($_GET['edit']);
    $result = $conn->query("SELECT * FROM $tableName WHERE past_problem='$identifier'");
    if ($result && $result->num_rows > 0) {
        $editRow = $result->fetch_assoc();
    }
}

// Fetch all records
$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);

// Let's determine the column names from the first row if available
$columnNames = [
    'past_problem' => 'Past Problems',
    'present_situation' => 'Present Situation',
    'changes' => 'Changes/Pattern Recognition'
];

// To dynamically get column names (optional, but useful)
if ($result && $result->num_rows > 0) {
    $firstRow = $result->fetch_assoc();
    $result->data_seek(0); // Reset pointer to beginning
    
    // Update column names based on what's actually in the database
    $columnNames = [];
    foreach ($firstRow as $key => $value) {
        // Create a user-friendly display name from the column name
        $displayName = ucwords(str_replace('_', ' ', $key));
        $columnNames[$key] = $displayName;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .logout-btn {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #dc3545 !important; /* Red on hover */
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
        
        /* Add styles for CRUD buttons */
        .btn-action {
            margin-right: 5px;
        }
        
        .crud-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
    <meta charset="utf-8">
    <title>FarmFresh - Organic Farm Website</title>
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
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i>
                    <h2 class="mb-0">01794017804</h2>
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
                    <!-- Profile Icon -->
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="profile.php" title="Profile">
                        <i class="fas fa-user"></i>
                    </a>
                    <!-- Logout Icon -->
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
<div class="container-fluid bg-primary py-5 bg-hero-trend mb-5">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1 text-white mb-0"></h1>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Database Debug Information - Remove in production -->
<?php if(isset($error)): ?>
<div class="container mt-3">
    <div class="alert alert-info">
        <h5>Table Structure Information</h5>
        <p>If you're seeing column errors, please verify your table structure. You can run this SQL command in phpMyAdmin:</p>
        <code>DESCRIBE <?php echo $tableName; ?>;</code>
        <p class="mt-3">Then modify the column names in this code to match your actual table columns.</p>
    </div>
</div>
<?php endif; ?>

<!-- CRUD Form Section Start -->
<div class="container my-5">
    <?php if(isset($success)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="crud-form">
        <h3 class="mb-4"><?php echo $editRow ? 'Update Record' : 'Add New Record'; ?></h3>
        <form method="post" action="">
            <?php if($editRow): ?>
                <input type="hidden" name="record_identifier" value="<?php echo htmlspecialchars($editRow['past_problem']); ?>">
            <?php endif; ?>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="pastProblem" class="form-label">Past Problems</label>
                    <textarea class="form-control" id="pastProblem" name="pastProblem" rows="3" required><?php 
                        echo $editRow ? htmlspecialchars($editRow['past_problem'] ?? '') : ''; 
                    ?></textarea>
                </div>
                <div class="col-md-4">
                    <label for="presentSituation" class="form-label">Present Situation</label>
                    <textarea class="form-control" id="presentSituation" name="presentSituation" rows="3" required><?php 
                        echo $editRow ? htmlspecialchars($editRow['present_situation'] ?? '') : ''; 
                    ?></textarea>
                </div>
                <div class="col-md-4">
                    <label for="changes" class="form-label">Changes/Pattern Recognition</label>
                    <textarea class="form-control" id="changes" name="changes" rows="3" required><?php 
                        echo $editRow ? htmlspecialchars($editRow['changes'] ?? '') : ''; 
                    ?></textarea>
                </div>
            </div>
            
            <div class="text-center">
                <?php if($editRow): ?>
                    <button type="submit" name="update" class="btn btn-warning">Update Record</button>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                    <button type="submit" name="create" class="btn btn-success">Add Record</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<!-- CRUD Form Section End -->

<!-- Table Section Start -->
<div class="container my-5">
    <h2 class="text-center mb-4">Grading, Packaging & Transportation Details</h2>
    <div class="text-end mb-3">
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus-circle"></i> Add New Record
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <?php foreach ($columnNames as $displayName): ?>
                        <th><?php echo htmlspecialchars($displayName); ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($columnNames as $column => $displayName) {
                            echo "<td>" . htmlspecialchars($row[$column] ?? '') . "</td>";
                        }
                        echo "<td class='text-center'>
                                <a href='" . $_SERVER['PHP_SELF'] . "?edit=" . urlencode($row["past_problem"]) . "' class='btn btn-warning btn-sm btn-action'>
                                    <i class='fas fa-edit'></i> Edit
                                </a>
                                <button type='button' class='btn btn-danger btn-sm btn-action' data-bs-toggle='modal' data-bs-target='#deleteModal" . md5($row["past_problem"]) . "'>
                                    <i class='fas fa-trash'></i> Delete
                                </button>
                                
                                <!-- Delete Modal -->
                                <div class='modal fade' id='deleteModal" . md5($row["past_problem"]) . "' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='deleteModalLabel'>Confirm Delete</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                Are you sure you want to delete this record?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                <form method='post' action=''>
                                                    <input type='hidden' name='record_identifier' value='" . htmlspecialchars($row["past_problem"]) . "'>
                                                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    // If no records found, display sample data or empty message
                    echo "<tr>";
                    echo "<td><b>Lack of Infrastructure:</b> Absence of proper grading centers or quality control labs.</td>";
                    echo "<td>Increase in government and private sector-run grading centers, especially near major markets. Still inadequate in remote areas.</td>";
                    echo "<td>Digital transformation is slowly penetrating agriculture, especially in export-oriented or industrialized farming sectors.</td>";
                    echo "<td class='text-center'>
                            <button type='button' class='btn btn-warning btn-sm btn-action' disabled>
                                <i class='fas fa-edit'></i> Edit
                            </button>
                            <button type='button' class='btn btn-danger btn-sm btn-action' disabled>
                                <i class='fas fa-trash'></i> Delete
                            </button>
                          </td>";
                    echo "</tr>";
                    // Add more sample rows as needed
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Table Section End -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="modalPastProblem" class="form-label">Past Problems</label>
                            <textarea class="form-control" id="modalPastProblem" name="pastProblem" rows="3" required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="modalPresentSituation" class="form-label">Present Situation</label>
                            <textarea class="form-control" id="modalPresentSituation" name="presentSituation" rows="3" required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="modalChanges" class="form-label">Changes/Pattern Recognition</label>
                            <textarea class="form-control" id="modalChanges" name="changes" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="create" class="btn btn-success">Add Record</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
</body>

</html>