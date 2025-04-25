<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new vehicle
    if (isset($_POST['add_vehicle'])) {
        $vehicleID = mysqli_real_escape_string($conn, $_POST['vehicleID']);
        $vehicleType = mysqli_real_escape_string($conn, $_POST['vehicleType']);
        $batchID = mysqli_real_escape_string($conn, $_POST['batchID']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        
        $sql = "INSERT INTO transportation_vehicles (vehicle_id, vehicle_type, batch_id, location) 
                VALUES ('$vehicleID', '$vehicleType', '$batchID', '$location')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Vehicle added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding vehicle: " . mysqli_error($conn) . "');</script>";
        }
    }
    
    // Update vehicle
    if (isset($_POST['update_vehicle'])) {
        $vehicleID = mysqli_real_escape_string($conn, $_POST['editVehicleID']);
        $vehicleType = mysqli_real_escape_string($conn, $_POST['editVehicleType']);
        $batchID = mysqli_real_escape_string($conn, $_POST['editBatchID']);
        $location = mysqli_real_escape_string($conn, $_POST['editLocation']);
        
        $sql = "UPDATE transportation_vehicles 
                SET vehicle_type='$vehicleType', batch_id='$batchID', location='$location' 
                WHERE vehicle_id='$vehicleID'";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Vehicle updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating vehicle: " . mysqli_error($conn) . "');</script>";
        }
    }
    
    // Delete vehicle
    if (isset($_POST['delete_vehicle'])) {
        $vehicleID = mysqli_real_escape_string($conn, $_POST['deleteVehicleID']);
        
        $sql = "DELETE FROM transportation_vehicles WHERE vehicle_id='$vehicleID'";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Vehicle deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting vehicle: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Fetch all vehicles
$sql = "SELECT * FROM transportation_vehicles";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Banglar Krishi - Transportation Tracking</title>
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

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.min.css" />
    
    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .tracking-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .tracking-status {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            position: relative;
        }
        
        .status-point {
            position: relative;
            z-index: 2;
            width: 60px;
            text-align: center;
        }
        
        .status-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #F2F2F2;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
        
        .status-active .status-icon {
            background-color: #5CB85C;
            color: white;
        }
        
        .status-complete .status-icon {
            background-color: #5CB85C;
            color: white;
        }
        
        .status-line {
            position: absolute;
            top: 25px;
            left: 5%;
            width: 90%;
            height: 3px;
            background-color: #F2F2F2;
            z-index: 1;
        }
        
        .status-progress {
            position: absolute;
            top: 25px;
            left: 5%;
            height: 3px;
            background-color: #5CB85C;
            z-index: 1;
            transition: width 0.5s ease;
        }
        
        .shipment-detail {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .detail-box {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            background-color: #F8F9FA;
            border-radius: 5px;
            margin: 5px;
        }
        
        .track-search {
            display: flex;
            margin-bottom: 20px;
        }
        
        .track-search input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }
        
        .track-search button {
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        
        .vehicle-list {
            margin-top: 30px;
        }
        
        .vehicle-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .vehicle-item:hover {
            background-color: #f5f5f5;
            transform: translateY(-2px);
        }
        
        .vehicle-item.active {
            border-color: var(--primary);
            background-color: rgba(34, 149, 151, 0.1);
        }
        
        .delivery-info {
            background-color: #F8F9FA;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .tracking-status {
                overflow-x: auto;
                justify-content: flex-start;
                padding-bottom: 15px;
            }
            
            .status-point {
                min-width: 100px;
            }
        }
        
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
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i>
                    <h2 class="mb-0">+012 345 6789</h2>
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
    <div class="container-fluid bg-primary py-5 bg-hero-transportation mb-5">
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
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase">Transportation</h6>
                <h1 class="display-5">Track Your Shipment</h1>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="tracking-box">
                        <div class="track-search">
                            <input type="text" id="trackingNumber" placeholder="Enter Tracking Number" value="BK-78945612">
                            <button onclick="searchShipment()">Track</button>
                        </div>
                        
                        <div class="shipment-detail">
                            <div class="detail-box">
                                <h6 class="text-muted">Shipment ID</h6>
                                <h5>BK-78945612</h5>
                            </div>
                            <div class="detail-box">
                                <h6 class="text-muted">Origin</h6>
                                <h5>Dhaka Farm</h5>
                            </div>
                            <div class="detail-box">
                                <h6 class="text-muted">Destination</h6>
                                <h5>Chittagong Market</h5>
                            </div>
                            <div class="detail-box">
                                <h6 class="text-muted">Status</h6>
                                <h5 class="text-success">In Transit</h5>
                            </div>
                        </div>
                        
                        <div class="tracking-status">
                            <div class="status-line"></div>
                            <div class="status-progress" id="statusProgress"></div>
                            
                            <div class="status-point status-complete">
                                <div class="status-icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <p>Picked Up</p>
                                <small>April 15 08:30</small>
                            </div>
                            
                            <div class="status-point status-complete">
                                <div class="status-icon">
                                    <i class="fas fa-warehouse"></i>
                                </div>
                                <p>Processing</p>
                                <small>April 15 12:45</small>
                            </div>
                            
                            <div class="status-point status-active">
                                <div class="status-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <p>In Transit</p>
                                <small>April 16 09:15</small>
                            </div>
                            
                            <div class="status-point">
                                <div class="status-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <p>At Market</p>
                                <small>Pending</small>
                            </div>
                            
                            <div class="status-point">
                                <div class="status-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p>Delivered</p>
                                <small>Pending</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-8">
                    <div class="tracking-box">
                        <h4 class="mb-4">Live Location Tracking</h4>
                        <div id="map"></div>
                        
                        <div class="delivery-info mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Current Location:</strong> <span id="currentLocation">Tangail District</span></p>
                                    <p><strong>Distance Traveled:</strong> <span id="distanceTraveled">78 km</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Estimated Arrival:</strong> <span id="estimatedArrival">April 17, 2025 - 14:30</span></p>
                                    <p><strong>Remaining Distance:</strong> <span id="remainingDistance">142 km</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="tracking-box">
                        <h4 class="mb-4">Fleet Vehicles</h4>
                        <p>Select a vehicle to view its current status and location.</p>
                        
                        <div class="vehicle-list">
                            <div class="vehicle-item active" onclick="selectVehicle(1)">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5>Truck #T-1234</h5>
                                        <p class="mb-0">Rice</p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success">On Route</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vehicle-item" onclick="selectVehicle(2)">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5>Truck #T-5678</h5>
                                        <p class="mb-0">Tomatoes</p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-warning">Loading</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vehicle-item" onclick="selectVehicle(3)">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5>Van #V-7890</h5>
                                        <p class="mb-0">Carrots</p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-info">Returning</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Shipment Details</h5>
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td>Driver</td>
                                        <td>Mohammad Rahman</td>
                                    </tr>
                                    <tr>
                                        <td>Products</td>
                                        <td>Rice (500kg), Potatoes (300kg), Tomatoes (200kg)</td>
                                    </tr>
                                    <tr>
                                        <td>Temperature</td>
                                        <td>18°C (Controlled)</td>
                                    </tr>
                                    <tr>
                                        <td>Last Update</td>
                                        <td>10 minutes ago</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tracking System End -->

    <!-- Transportation Tracking Table Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-5 text-center">
                    <h1 class="display-5">Transportation Tracking</h1>
                    <p class="fs-5 text-muted">Monitor the real-time status of all vehicles in your supply chain</p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <input type="text" id="transportTableSearch" class="form-control" placeholder="Search transportation records...">
            </div>
        </div>

        <!-- Add New Vehicle Button -->
        <div class="row mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                    <i class="fas fa-plus"></i> Add New Vehicle
                </button>
            </div>
        </div>

        <!-- Transportation Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="transportationTable">
                <thead class="table-primary">
                    <tr>
                        <th>Vehicle ID</th>
                        <th>Vehicle Type</th>
                        <th>Batch ID</th>
                        <th>Location</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['vehicle_id'] . "</td>";
                            echo "<td>" . $row['vehicle_type'] . "</td>";
                            echo "<td>" . $row['batch_id'] . "</td>";
                            echo "<td>" . $row['location'] . "</td>";
                            echo "<td class='actions-column'>
                                <button class='btn btn-warning btn-sm' onclick='editVehicle(\"" . $row['vehicle_id'] . "\", \"" . $row['vehicle_type'] . "\", \"" . $row['batch_id'] . "\", \"" . $row['location'] . "\")'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button class='btn btn-danger btn-sm' onclick='confirmDelete(\"" . $row['vehicle_id'] . "\")'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No vehicles found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Vehicle Modal -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addVehicleModalLabel">Add New Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" id="addVehicleForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="vehicleID" class="form-label">Vehicle ID</label>
                            <input type="text" class="form-control" id="vehicleID" name="vehicleID" placeholder="e.g. TRK-1001" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-control" id="vehicleType" name="vehicleType" required>
                                <option value="">Select Vehicle Type</option>
                                <option value="Truck">Truck</option>
                                <option value="Van">Van</option>
                                <option value="Pickup">Pickup</option>
                                <option value="Mini Truck">Mini Truck</option>
                                <option value="Refrigerated Van">Refrigerated Van</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="batchID" class="form-label">Batch ID</label>
                            <input type="text" class="form-control" id="batchID" name="batchID" placeholder="e.g. BCH-5432" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="e.g. Dhaka Distribution Center" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_vehicle" class="btn btn-primary">Add Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Vehicle Modal -->
    <div class="modal fade" id="editVehicleModal" tabindex="-1" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" id="editVehicleForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editVehicleID" class="form-label">Vehicle ID</label>
                            <input type="text" class="form-control" id="editVehicleID" name="editVehicleID" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-control" id="editVehicleType" name="editVehicleType" required>
                                <option value="Truck">Truck</option>
                                <option value="Van">Van</option>
                                <option value="Pickup">Pickup</option>
                                <option value="Mini Truck">Mini Truck</option>
                                <option value="Refrigerated Van">Refrigerated Van</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editBatchID" class="form-label">Batch ID</label>
                            <input type="text" class="form-control" id="editBatchID" name="editBatchID" required>
                        </div>
                        <div class="mb-3">
                            <label for="editLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="editLocation" name="editLocation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_vehicle" class="btn btn-warning">Update Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" id="deleteVehicleForm">
                    <div class="modal-body">
                        <p>Are you sure you want to delete vehicle <strong id="deleteVehicleIDText"></strong>?</p>
                        <p>This action cannot be undone.</p>
                        <input type="hidden" id="deleteVehicleID" name="deleteVehicleID">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_vehicle" class="btn btn-danger">Delete</button>
                    </div>
                </form>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal End -->

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
    
    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Function to search shipment
        function searchShipment() {
            const trackingNumber = document.getElementById('trackingNumber').value;
            alert('Searching for shipment: ' + trackingNumber);
            // Here you would typically make an AJAX call to your backend to get shipment details
        }
        
        // Function to select vehicle
        function selectVehicle(vehicleId) {
            // Remove active class from all vehicle items
            document.querySelectorAll('.vehicle-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to the selected vehicle
            document.querySelectorAll('.vehicle-item')[vehicleId - 1].classList.add('active');
            
            // Update map marker and information based on selected vehicle
            updateMapForVehicle(vehicleId);
        }
        
        // Function to update map for selected vehicle
        function updateMapForVehicle(vehicleId) {
            // Clear existing markers
            if (markers) {
                markers.forEach(marker => map.removeLayer(marker));
            }
            
            // Add new marker based on vehicle
            let position;
            let popupContent;
            
            switch(vehicleId) {
                case 1:
                    position = [24.2513, 89.9167]; // Tangail
                    popupContent = "<b>Truck #T-1234</b><br>Status: On Route<br>Driver: Mohammad Rahman";
                    document.getElementById('currentLocation').textContent = "Tangail District";
                    document.getElementById('distanceTraveled').textContent = "78 km";
                    document.getElementById('estimatedArrival').textContent = "April 17, 2025 - 14:30";
                    document.getElementById('remainingDistance').textContent = "142 km";
                    break;
                case 2:
                    position = [23.7104, 90.4074]; // Dhaka
                    popupContent = "<b>Truck #T-5678</b><br>Status: Loading<br>Driver: Kamal Hossain";
                    document.getElementById('currentLocation').textContent = "Dhaka Central Depot";
                    document.getElementById('distanceTraveled').textContent = "0 km";
                    document.getElementById('estimatedArrival').textContent = "April 18, 2025 - 10:15";
                    document.getElementById('remainingDistance').textContent = "220 km";
                    break;
                case 3:
                    position = [22.8456, 91.4156]; // Near Chittagong
                    popupContent = "<b>Van #V-7890</b><br>Status: Returning<br>Driver: Abdul Karim";
                    document.getElementById('currentLocation').textContent = "Feni District";
                    document.getElementById('distanceTraveled').textContent = "185 km";
                    document.getElementById('estimatedArrival').textContent = "Completed";
                    document.getElementById('remainingDistance').textContent = "35 km (to Depot)";
                    break;
                default:
                    position = [24.2513, 89.9167]; // Default
                    popupContent = "Unknown Vehicle";
            }
            
            // Add marker and adjust map view
            let newMarker = L.marker(position).addTo(map)
                .bindPopup(popupContent)
                .openPopup();
                
            markers.push(newMarker);
            map.setView(position, 9);
        }
        
        // Initialize map
        let map = L.map('map').setView([24.2513, 89.9167], 8);
        let markers = [];
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Define the route
        const routePoints = [
            [23.7104, 90.4074], // Dhaka
            [24.0083, 90.1111], // Manikganj
            [24.2513, 89.9167], // Tangail (current location)
            [24.7471, 90.4203], // Mymensingh
            [22.3569, 91.7832]  // Chittagong
        ];
        
        // Create polyline for the route
        let route = L.polyline(routePoints, {color: 'blue', weight: 3}).addTo(map);
        
        // Add markers for start and end points
        L.marker([23.7104, 90.4074]).addTo(map)
            .bindPopup("<b>Origin</b><br>Dhaka Farm")
            .openPopup();
            
        L.marker([22.3569, 91.7832]).addTo(map)
            .bindPopup("<b>Destination</b><br>Chittagong Market");
            
        // Add current location marker
        let currentMarker = L.marker([24.2513, 89.9167]).addTo(map)
            .bindPopup("<b>Truck #T-1234</b><br>Status: On Route<br>Driver: Mohammad Rahman")
            .openPopup();
            
        markers.push(currentMarker);
        
        // Set the progress bar
        document.getElementById('statusProgress').style.width = '50%';
        
        // Function to edit vehicle
        function editVehicle(vehicleID, vehicleType, batchID, location) {
            document.getElementById('editVehicleID').value = vehicleID;
            document.getElementById('editVehicleType').value = vehicleType;
            document.getElementById('editBatchID').value = batchID;
            document.getElementById('editLocation').value = location;
            
            // Show the edit modal
            var editModal = new bootstrap.Modal(document.getElementById('editVehicleModal'));
            editModal.show();
        }
        
        // Function to confirm delete
        function confirmDelete(vehicleID) {
            document.getElementById('deleteVehicleID').value = vehicleID;
            document.getElementById('deleteVehicleIDText').textContent = vehicleID;
            
            // Show the confirm delete modal
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteModal.show();
        }
        
        // Search function for transportation table
        document.getElementById('transportTableSearch').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var table = document.getElementById('transportationTable');
            var rows = table.getElementsByTagName('tr');
            
            for (var i = 1; i < rows.length; i++) {
                var showRow = false;
                var cells = rows[i].getElementsByTagName('td');
                
                for (var j = 0; j < cells.length - 1; j++) {
                    if (cells[j].textContent.toLowerCase().indexOf(input) > -1) {
                        showRow = true;
                        break;
                    }
                }
                
                rows[i].style.display = showRow ? '' : 'none';
            }
        });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
