<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}

// Handle Delete Operation
if (isset($_POST['delete_track'])) {
    $trackID = $_POST['delete_track'];
    $delete_sql = "DELETE FROM graded_p_track WHERE trackID = '$trackID'";
    
    if (mysqli_query($conn, $delete_sql)) {
        $success_message = "Record deleted successfully";
    } else {
        $error_message = "Error deleting record: " . mysqli_error($conn);
    }
}

// Handle Add Operation
if (isset($_POST['add_track'])) {
    $trackID = $_POST['trackID'];
    $standardGradeID = $_POST['standardGradeID'];
    $warehouseID = $_POST['warehouseID'];
    $cropGrade = $_POST['cropGrade'];
    $location = $_POST['location'];
    
    $add_sql = "INSERT INTO graded_p_track (trackID, standardGradeID, warehouseID, cropGrade, location) 
                VALUES ('$trackID', '$standardGradeID', '$warehouseID', '$cropGrade', '$location')";
    
    if (mysqli_query($conn, $add_sql)) {
        $success_message = "New record added successfully";
    } else {
        $error_message = "Error adding record: " . mysqli_error($conn);
    }
}

// Handle Update Operation
if (isset($_POST['update_track'])) {
    $trackID = $_POST['edit_trackID'];
    $standardGradeID = $_POST['edit_standardGradeID'];
    $warehouseID = $_POST['edit_warehouseID'];
    $cropGrade = $_POST['edit_cropGrade'];
    $location = $_POST['edit_location'];
    
    $update_sql = "UPDATE graded_p_track SET 
                  standardGradeID = '$standardGradeID',
                  warehouseID = '$warehouseID', 
                  cropGrade = '$cropGrade', 
                  location = '$location' 
                  WHERE trackID = '$trackID'";
    
    if (mysqli_query($conn, $update_sql)) {
        $success_message = "Record updated successfully";
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
    }
}

// Get standard grade options for dropdown
$grade_sql = "SELECT standardGradeID FROM farmer_crop_type_grade";
$grade_result = mysqli_query($conn, $grade_sql);
$grade_options = [];
while ($row = mysqli_fetch_assoc($grade_result)) {
    $grade_options[] = $row['standardGradeID'];
}

// Get warehouse options for dropdown
$warehouse_sql = "SELECT warehouseID, location FROM warehouse";
$warehouse_result = mysqli_query($conn, $warehouse_sql);
$warehouse_options = [];
$warehouse_locations = [];
while ($row = mysqli_fetch_assoc($warehouse_result)) {
    $warehouse_options[$row['warehouseID']] = $row['warehouseID'];
    $warehouse_locations[$row['warehouseID']] = $row['location'];
}

// Get all tracked products
$sql = "SELECT gpt.*, w.location as warehouse_location 
        FROM graded_p_track gpt
        JOIN warehouse w ON gpt.warehouseID = w.warehouseID";
$result = mysqli_query($conn, $sql);
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

        /* Add new styles for table and modal */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .product-table th, .product-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        
        .product-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .product-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .product-table tr:hover {
            background-color: #f1f1f1;
        }
        
        .action-btn {
            margin: 2px;
            padding: 5px 10px;
            font-size: 0.8rem;
        }
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 500px;
            max-width: 90%;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .btn-container {
            margin-top: 20px;
            text-align: right;
        }
        
        #mapDisplay {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            display: none;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* Table styling with transitions */
.product-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.product-table th, .product-table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.product-table th {
    background-color: #28a745;
    font-weight: bold;
    color:rgb(255, 255, 255);
    position: sticky;
    top: 0;
}

.product-table tr {
    transition: background-color 0.3s ease;
}

.product-table tr:nth-child(even) {
    background-color: #f2f7ff;
}

.product-table tr:nth-child(odd) {
    background-color: #ffffff;
}

.product-table tr:hover {
    background-color: #e8f4f8;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
}

.product-table tr:hover td {
    color: #28a745;
}

.product-table td .action-btn {
    opacity: 0.7;
    transition: all 0.3s ease;
    margin: 2px;
    transform: scale(1);
}

.product-table td .action-btn:hover {
    opacity: 1;
    transform: scale(1.1);
}
    </style>
    
    <meta charset="utf-8">
    <title>Banglar Krishi - Graded Product Tracking</title>
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
                <a href="trackingOfGradedProducts.php" class="nav-item nav-link active px-3">Graded Product Tracking</a>
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
    <div class="container-fluid bg-primary py-5 bg-hero-gradedTracking mb-5">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-1 text-white mb-0"></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

     <!-- For the tracking section for customers -->
     <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="mx-auto text-center mb-4" style="max-width: 600px;">
                <h2 class="text-primary">Track Graded Products</h2>
                <p>Enter your Track ID to check grading status and location.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="tracking-box">
                        <form id="trackingForm">
                            <div class="input-group mb-3">
                                <input type="text" id="trackId" class="form-control" placeholder="Enter Track ID" required>
                                <button type="submit" class="btn btn-primary">Track</button>
                            </div>
                        </form>
                        <div id="trackingResult" class="bg-white p-4 shadow-sm rounded d-none">
                            <h5 class="text-success">Tracking Details</h5>
                            <p><strong>Status:</strong> <span id="statusText">Fetching...</span></p>
                            <p><strong>Location:</strong> <span id="locationText">--</span></p>
                            <p><strong>Grade:</strong> <span id="gradeText">--</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tracking Product Management Section -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <h2 class="text-primary">Graded Product Tracking</h2>
                <p>Manage and track graded products throughout the supply chain</p>
            </div>
            
            <?php if(isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if(isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <div class="table-responsive">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Track ID</th>
                            <th>Standard Grade ID</th>
                            <th>Warehouse ID</th>
                            <th>Crop Grade</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['trackID']; ?></td>
                            <td><?php echo $row['standardGradeID']; ?></td>
                            <td><?php echo $row['warehouseID']; ?></td>
                            <td><?php echo $row['cropGrade']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <button class="btn btn-primary action-btn edit-btn" 
                                        data-id="<?php echo $row['trackID']; ?>" 
                                        data-standardgradeid="<?php echo $row['standardGradeID']; ?>" 
                                        data-warehouseid="<?php echo $row['warehouseID']; ?>" 
                                        data-cropgrade="<?php echo $row['cropGrade']; ?>" 
                                        data-location="<?php echo $row['location']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete_track" value="<?php echo $row['trackID']; ?>">
                                    <button type="submit" class="btn btn-danger action-btn delete-btn" 
                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <button class="btn btn-info action-btn locate-btn" 
                                        data-id="<?php echo $row['trackID']; ?>" 
                                        data-location="<?php echo $row['location']; ?>">
                                    <i class="fas fa-map-marker-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="mb-3 text-center">
                <button id="addProductBtn" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
            </div>

            
            <!-- Map Display -->
            <div id="mapDisplay" class="mt-4"></div>
        </div>
    </div>
    

    <!-- Add Product Modal -->
    <div id="addProductModal" class="modal-overlay">
        <div class="modal-content">
            <h4>Add New Graded Product</h4>
            <form id="addProductForm" method="post" action="">
                <div class="form-group">
                    <label for="trackID">Track ID:</label>
                    <input type="text" id="trackID" name="trackID" required>
                </div>
                <div class="form-group">
                    <label for="standardGradeID">Standard Grade ID:</label>
                    <select id="standardGradeID" name="standardGradeID" required>
                        <option value="">Select Standard Grade</option>
                        <?php foreach($grade_options as $grade): ?>
                            <option value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warehouseID">Warehouse ID:</label>
                    <select id="warehouseID" name="warehouseID" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach($warehouse_options as $id => $name): ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cropGrade">Crop Grade:</label>
                    <select id="cropGrade" name="cropGrade" required>
                        <option value="">Select Grade</option>
                        <option value="A">Grade A</option>
                        <option value="B">Grade B</option>
                        <option value="C">Grade C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>
                </div>
                <div class="btn-container">
                    <button type="button" id="cancelAddBtn" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="add_track" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="modal-overlay">
        <div class="modal-content">
            <h4>Edit Graded Product</h4>
            <form id="editProductForm" method="post" action="">
                <input type="hidden" id="edit_trackID" name="edit_trackID">
                <div class="form-group">
                    <label for="edit_standardGradeID">Standard Grade ID:</label>
                    <select id="edit_standardGradeID" name="edit_standardGradeID" required>
                        <option value="">Select Standard Grade</option>
                        <?php foreach($grade_options as $grade): ?>
                            <option value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_warehouseID">Warehouse ID:</label>
                    <select id="edit_warehouseID" name="edit_warehouseID" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach($warehouse_options as $id => $name): ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_cropGrade">Crop Grade:</label>
                    <select id="edit_cropGrade" name="edit_cropGrade" required>
                        <option value="">Select Grade</option>
                        <option value="A">Grade A</option>
                        <option value="B">Grade B</option>
                        <option value="C">Grade C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_location">Location:</label>
                    <input type="text" id="edit_location" name="edit_location" required>
                </div>
                <div class="btn-container">
                    <button type="button" id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="update_track" class="btn btn-primary">Update Product</button>
                </div>
            </form>
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
    
    <script>
        // Map initialization
        let map;
        let markers = [];
        
        function initMap() {
            map = new google.maps.Map(document.getElementById("mapDisplay"), {
                center: { lat: 23.8103, lng: 90.4125 },
                zoom: 7
            });
        }

        // Clear existing markers from map
        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        // Initialize the map when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            // Modal functionality
            const addProductModal = document.getElementById("addProductModal");
            const editProductModal = document.getElementById("editProductModal");
            const addProductBtn = document.getElementById("addProductBtn");
            const cancelAddBtn = document.getElementById("cancelAddBtn");
            const cancelEditBtn = document.getElementById("cancelEditBtn");
            
            // Open Add Product Modal
            addProductBtn.addEventListener("click", function() {
                addProductModal.style.display = "block";
            });
            
            // Close Add Product Modal
            cancelAddBtn.addEventListener("click", function() {
                addProductModal.style.display = "none";
            });
            
            // Close Edit Product Modal
            cancelEditBtn.addEventListener("click", function() {
                editProductModal.style.display = "none";
            });
            
            // Close modals when clicking outside
            window.addEventListener("click", function(event) {
                if (event.target === addProductModal) {
                    addProductModal.style.display = "none";
                }
                if (event.target === editProductModal) {
                    editProductModal.style.display = "none";
                }
            });
            
            // Handle Edit button clicks
            document.querySelectorAll(".edit-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const trackID = this.getAttribute("data-id");
                    const standardGradeID = this.getAttribute("data-standardgradeid");
                    const warehouseID = this.getAttribute("data-warehouseid");
                    const cropGrade = this.getAttribute("data-cropgrade");
                    const location = this.getAttribute("data-location");
                    
                    // Populate edit form
                    document.getElementById("edit_trackID").value = trackID;
                    document.getElementById("edit_standardGradeID").value = standardGradeID;
                    document.getElementById("edit_warehouseID").value = warehouseID;
                    document.getElementById("edit_cropGrade").value = cropGrade;
                    document.getElementById("edit_location").value = location;
                    
                    // Show edit modal
                    document.getElementById("editProductModal").style.display = "block";
                });
            });
            
            // Handle Locate button clicks
            document.querySelectorAll(".locate-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const location = this.getAttribute("data-location");
                    const mapDisplay = document.getElementById("mapDisplay");
                    
                    // Show map if hidden
                    mapDisplay.style.display = "block";
                    
                    // Geocode the location to get coordinates
                    // For demo purposes, using fixed coordinates for Bangladesh locations
                    let coordinates = { lat: 23.8103, lng: 90.4125 }; // Default Dhaka
                    
                    if (location.includes("Dhaka")) {
                        coordinates = { lat: 23.8103, lng: 90.4125 };
                    } else if (location.includes("Chittagong") || location.includes("Chattogram")) {
                        coordinates = { lat: 22.3569, lng: 91.7832 };
                    } else if (location.includes("Rajshahi")) {
                        coordinates = { lat: 24.3745, lng: 88.6042 };
                    } else if (location.includes("Khulna")) {
                        coordinates = { lat: 22.8456, lng: 89.5403 };
                    } else if (location.includes("Sylhet")) {
                        coordinates = { lat: 24.8949, lng: 91.8687 };
                    } else if (location.includes("Barisal") || location.includes("Barishal")) {
                        coordinates = { lat: 22.7010, lng: 90.3535 };
                    } else if (location.includes("Rangpur")) {
                        coordinates = { lat: 25.7439, lng: 89.2752 };
                    } else if (location.includes("Mymensingh")) {
                        coordinates = { lat: 24.7471, lng: 90.4203 };
                    }
                    
                    // Clear existing markers
                    clearMarkers();
                    
                    // Add new marker
                    const marker = new google.maps.Marker({
                        position: coordinates,
                        map: map,
                        title: "Product Location: " + location
                    });
                    
                    markers.push(marker);
                    
                    // Center map on marker
                    map.setCenter(coordinates);
                    map.setZoom(10);
                    
                    // Scroll to map
                    mapDisplay.scrollIntoView({ behavior: 'smooth' });
                });
            });
            
            // Customer tracking form functionality
            const trackingForm = document.getElementById("trackingForm");
            const trackingResult = document.getElementById("trackingResult");
            
            trackingForm.addEventListener("submit", function(e) {
                e.preventDefault();
                
                const trackId = document.getElementById("trackId").value.trim();
                
                if (!trackId) {
                    alert("Please enter a valid Track ID");
                    return;
                }
                
                // In a real implementation, this would make an AJAX request to the server
                // For demo purposes, we'll check against the products in the table
                let found = false;
                
                document.querySelectorAll("#productTableBody tr").forEach(row => {
                    const rowTrackId = row.cells[0].textContent;
                    
                    if (rowTrackId === trackId) {
                        found = true;
                        
                        const grade = row.cells[3].textContent;
                        const location = row.cells[4].textContent;
                        
                        // Update result display
                        document.getElementById("statusText").textContent = "Available";
                        document.getElementById("locationText").textContent = location;
                        document.getElementById("gradeText").textContent = grade;
                        
                        // Show result
                        trackingResult.classList.remove("d-none");
                        
                        // Add location to map
                        const locationBtn = row.querySelector(".locate-btn");
                        if (locationBtn) {
                            // Trigger locate button click to show on map
                            locationBtn.click();
                        }
                    }
                });
                
                if (!found) {
                    document.getElementById("statusText").textContent = "Not Found";
                    document.getElementById("locationText").textContent = "N/A";
                    document.getElementById("gradeText").textContent = "N/A";
                    trackingResult.classList.remove("d-none");
                }
            });
            
            // Warehouse ID change handler to auto-populate location
            document.getElementById("warehouseID").addEventListener("change", function() {
                const warehouseId = this.value;
                const warehouseLocations = <?php echo json_encode($warehouse_locations); ?>;
                
                if (warehouseId && warehouseLocations[warehouseId]) {
                    document.getElementById("location").value = warehouseLocations[warehouseId];
                }
            });
            
            // Same for edit form
            document.getElementById("edit_warehouseID").addEventListener("change", function() {
                const warehouseId = this.value;
                const warehouseLocations = <?php echo json_encode($warehouse_locations); ?>;
                
                if (warehouseId && warehouseLocations[warehouseId]) {
                    document.getElementById("edit_location").value = warehouseLocations[warehouseId];
                }
            });
        });
    </script>
    
    <!-- Google Maps API - Replace YOUR_API_KEY with your actual API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
</body>
</html>
</body>
</html>