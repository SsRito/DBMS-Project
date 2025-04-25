<?php
include "database.php";

// Initialize variables
$updateId = "";
$productName = "";
$batchNumber = "";
$packDate = "";
$location = "";
$message = "";

// Create operation
if(isset($_POST['create'])) {
    $productName = $_POST['productName'];
    $batchNumber = $_POST['batchNumber'];
    $packDate = $_POST['packDate'];
    $location = $_POST['location'];
    
    $sql = "INSERT INTO packaging_tracking (product_name, batch_number, pack_date, location) 
            VALUES ('$productName', '$batchNumber', '$packDate', '$location')";
    
    if(mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>Package tracking record created successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

// Read operation - Fetch all records with error handling
$result = mysqli_query($conn, "SELECT * FROM packaging_tracking ORDER BY id DESC");
if($result === false) {
    $message .= "<div class='alert alert-danger'>Error fetching records: " . mysqli_error($conn) . "</div>";
    $result = null; // Set to null so we can check it later
}

// Update - Get record for update
if(isset($_GET['edit'])) {
    $updateId = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM packaging_tracking WHERE id=$updateId");
    
    if($edit_query && mysqli_num_rows($edit_query) == 1) {
        $edit_row = mysqli_fetch_assoc($edit_query);
        $productName = $edit_row['product_name'];
        $batchNumber = $edit_row['batch_number'];
        $packDate = $edit_row['pack_date'];
        $location = $edit_row['location'];
    }
}

// Update operation
if(isset($_POST['update'])) {
    $updateId = $_POST['updateId'];
    $productName = $_POST['productName'];
    $batchNumber = $_POST['batchNumber'];
    $packDate = $_POST['packDate'];
    $location = $_POST['location'];
    
    $sql = "UPDATE packaging_tracking SET 
            product_name='$productName', 
            batch_number='$batchNumber', 
            pack_date='$packDate', 
            location='$location' 
            WHERE id=$updateId";
    
    if(mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>Package tracking record updated successfully!</div>";
        // Reset form fields after update
        $updateId = "";
        $productName = "";
        $batchNumber = "";
        $packDate = "";
        $location = "";
    } else {
        $message = "<div class='alert alert-danger'>Error updating record: " . mysqli_error($conn) . "</div>";
    }
}

// Delete operation
if(isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    
    $sql = "DELETE FROM packaging_tracking WHERE id=$deleteId";
    
    if(mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>Package tracking record deleted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error deleting record: " . mysqli_error($conn) . "</div>";
    }
    
    // Redirect to avoid resubmission
    header("Location: packagingTrackingSystem.php");
    exit();
}

// Check if table exists
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'packaging_tracking'");
if(mysqli_num_rows($table_check) == 0) {
    // Table doesn't exist, create it
    $create_table_sql = "CREATE TABLE packaging_tracking (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(255) NOT NULL,
        batch_number VARCHAR(50) NOT NULL,
        pack_date DATE NOT NULL,
        location VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if(mysqli_query($conn, $create_table_sql)) {
        $message .= "<div class='alert alert-info'>Table 'packaging_tracking' created successfully!</div>";
    } else {
        $message .= "<div class='alert alert-danger'>Error creating table: " . mysqli_error($conn) . "</div>";
    }
    
    // Try the query again
    $result = mysqli_query($conn, "SELECT * FROM packaging_tracking ORDER BY id DESC");
    if($result === false) {
        $message .= "<div class='alert alert-danger'>Error fetching records: " . mysqli_error($conn) . "</div>";
        $result = null;
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
        
        .action-btns {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
    <meta charset="utf-8">
    <title>Banglar Krishi - Organic Farm Website</title>
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
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <div class="container-fluid bg-primary py-5 bg-hero-packageTrack mb-5">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-1 text-white mb-0"></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Tracking System Start -->
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2 class="text-primary">Packaging Tracking System</h2>
            <p class="text-muted">Enter packaging details to track and report agricultural product movements.</p>
        </div>
        
        <!-- Display message -->
        <?php echo $message; ?>
        
        <!-- CRUD Form -->
        <form method="post" action="" class="bg-light p-4 rounded shadow-sm">
            <input type="hidden" name="updateId" value="<?php echo $updateId; ?>">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Product Name" name="productName" value="<?php echo $productName; ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Batch Number" name="batchNumber" value="<?php echo $batchNumber; ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="packDate" value="<?php echo $packDate; ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Packaging Location" name="location" value="<?php echo $location; ?>" required>
                </div>
                <div class="col-12 text-end">
                    <?php if($updateId == ""): ?>
                        <!-- Create Button -->
                        <button type="submit" name="create" class="btn btn-success px-4">
                            <i class="fas fa-plus-circle"></i> Create Package Record
                        </button>
                    <?php else: ?>
                        <!-- Update Button -->
                        <button type="submit" name="update" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Update Package Record
                        </button>
                        <!-- Cancel Button -->
                        <a href="packagingTrackingSystem.php" class="btn btn-secondary px-4">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="mt-5">
            <h4 class="text-secondary mb-3">Packaging Summary by Location</h4>
            <canvas id="locationChart" height="100"></canvas>

            <h4 class="text-secondary mb-3 mt-4">Tracking Report</h4>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" id="reportTable">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Batch No.</th>
                            <th>Packaging Date</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($result && mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['batch_number'] . "</td>";
                                echo "<td>" . $row['pack_date'] . "</td>";
                                echo "<td>" . $row['location'] . "</td>";
                                echo "<td class='action-btns'>";
                                echo "<a href='packagingTrackingSystem.php?edit=" . $row['id'] . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i> Edit</a>";
                                echo "<a href='packagingTrackingSystem.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'><i class='fas fa-trash-alt'></i> Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Tracking System End -->

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

    <!-- Chart JS Setup -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('locationChart').getContext('2d');
        
        // Process data for the chart
        const locationData = {};
        <?php
        if($conn) {
            $chartQuery = mysqli_query($conn, "SELECT location, COUNT(*) as count FROM packaging_tracking GROUP BY location");
            if($chartQuery) {
                while($chartRow = mysqli_fetch_assoc($chartQuery)) {
                    echo "locationData['" . $chartRow['location'] . "'] = " . $chartRow['count'] . ";";
                }
            }
        }
        ?>
        
        const labels = Object.keys(locationData);
        const data = Object.values(locationData);
        
        const locationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Packages by Location',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>