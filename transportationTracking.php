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
        
        $sql = "INSERT INTO transportation_vehicles (vehicle_id, vehicle_type, batchID, location) 
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
                SET vehicle_type='$vehicleType', batchID='$batchID', location='$location' 
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

// Fetch all vehicles with proper ORDER BY
$sql = "SELECT * FROM transportation_vehicles ORDER BY updated_at DESC";
$result = mysqli_query($conn, $sql);

// Get all available batch IDs for autocomplete
$batchQuery = "SELECT batchID FROM crop_batch ORDER BY batchID ASC";
$batchResult = mysqli_query($conn, $batchQuery);
$batchOptions = [];

if (mysqli_num_rows($batchResult) > 0) {
    while ($batch = mysqli_fetch_assoc($batchResult)) {
        $batchOptions[] = $batch['batchID'];
    }
}
$batchOptionsJSON = json_encode($batchOptions);
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

    <!-- jQuery UI CSS for autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
        
        /* UI improvements for table */
        #transportationTable {
            border-collapse: collapse;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
        }
        
        #transportationTable thead th {
            background: linear-gradient(to bottom, #6c757d, #5a6268);
            color: white;
            font-weight: 500;
            text-align: center;
        }
        
        #transportationTable tbody tr:hover {
            background-color: rgba(34, 149, 151, 0.1);
        }
        
        .actions-column {
            width: 120px;
            text-align: center;
        }
        
        /* Autocomplete styling */
        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 9999 !important;
        }
        
        .ui-menu-item {
            padding: 5px 10px;
            cursor: pointer;
        }
        
        .ui-state-active, 
        .ui-widget-content .ui-state-active {
            background-color: #5CB85C !important;
            border-color: #5CB85C !important;
            color: white !important;
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
                    <h2 class="mb-0">01794017804</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="home.php" class="navbar-brand ms-lg-5 d-flex align-items-center">
                        <img src="img/Logo.png" alt="Banglar Krishi Logo" class="me-3" style="height: 90px; width: auto;">
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
                <a href="transportationTracking.php" class="nav-item nav-link active px-3">Transportation Tracking</a>
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
                        <th>Last Updated</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $updated = date('M d, Y H:i', strtotime($row['updated_at']));
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['vehicle_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['vehicle_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['batchID']); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                <td><?php echo $updated; ?></td>
                                <td>
                                    <button class='btn btn-warning btn-sm' onclick='editVehicle(
                                        "<?php echo htmlspecialchars($row['vehicle_id']); ?>",
                                        "<?php echo htmlspecialchars($row['vehicle_type']); ?>",
                                        "<?php echo htmlspecialchars($row['batchID']); ?>",
                                        "<?php echo htmlspecialchars($row['location']); ?>"
                                    )'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm' onclick='confirmDelete("<?php echo htmlspecialchars($row['vehicle_id']); ?>")'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No vehicles found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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
                                <input type="text" class="form-control" id="batchID" name="batchID" placeholder="e.g. B0001" required>
                                <small class="text-muted">Start typing to see available batch IDs</small>
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


        <!-- Delete Vehicle Modal -->
        <div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteVehicleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteVehicleModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this vehicle? This action cannot be undone.</p>
                    </div>
                    <form method="POST" action="" id="deleteVehicleForm">
                        <input type="hidden" id="deleteVehicleID" name="deleteVehicleID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="delete_vehicle" class="btn btn-danger">Delete Vehicle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Transportation Tracking Table End -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        // Batch ID Autocomplete
        var availableBatches = <?php echo $batchOptionsJSON; ?>;
        
        $(function() {
            $("#batchID, #editBatchID").autocomplete({
                source: availableBatches,
                minLength: 1
            });
        });
        
        // Table Search Function
        $(document).ready(function() {
            $("#transportTableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#transportationTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
            
            // Initialize the progress bar
            updateProgress();
            
            // Initialize map
            initMap();
        });
        
        // Edit Vehicle Function
        function editVehicle(vehicleID, vehicleType, batchID, location) {
            $('#editVehicleID').val(vehicleID);
            $('#editVehicleType').val(vehicleType);
            $('#editBatchID').val(batchID);
            $('#editLocation').val(location);
            $('#editVehicleModal').modal('show');
        }
        
        // Confirm Delete Function
        function confirmDelete(vehicleID) {
            $('#deleteVehicleID').val(vehicleID);
            $('#deleteVehicleModal').modal('show');
        }
        
        // Update Progress Bar
        function updateProgress() {
            // Calculate progress percentage based on current status (2 out of 5 steps completed)
            const progressPercentage = 50;
            document.getElementById('statusProgress').style.width = progressPercentage + '%';
        }
        
        // Search Shipment Function
        function searchShipment() {
            const trackingNumber = document.getElementById('trackingNumber').value;
            // In a real application, this would make an AJAX call to get shipment data
            alert("Searching for shipment: " + trackingNumber);
        }
        
        // Select Vehicle Function
        function selectVehicle(id) {
            // Remove active class from all vehicles
            document.querySelectorAll('.vehicle-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to selected vehicle
            document.querySelectorAll('.vehicle-item')[id-1].classList.add('active');
            
            // Update map markers based on selected vehicle
            updateMap(id);
        }
        
        // Initialize Map
        function initMap() {
            // Create map centered on Bangladesh
            window.map = L.map('map').setView([23.8103, 90.4125], 7);
            
            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(window.map);
            
            // Set initial vehicle marker
            updateMap(1);
        }
        
        // Update Map based on selected vehicle
        function updateMap(vehicleID) {
            // Clear existing markers
            if (window.currentMarker) {
                window.map.removeLayer(window.currentMarker);
            }
            
            // Example coordinates for different vehicles
            const vehicleCoordinates = [
                [23.7985, 90.3185], // Dhaka
                [24.0950, 90.0097], // Tangail
                [22.3567, 91.7832]  // Chittagong
            ];
            
            const vehicleInfo = [
                "Truck #T-1234 (Rice) - Dhaka",
                "Truck #T-5678 (Tomatoes) - Tangail",
                "Van #V-7890 (Carrots) - Chittagong"
            ];
            
            const index = vehicleID - 1;
            
            // Create custom icon
            const vehicleIcon = L.divIcon({
                html: '<i class="fas fa-truck fa-2x" style="color: #5CB85C;"></i>',
                iconSize: [20, 20],
                className: 'vehicle-marker'
            });
            
            // Add marker for the selected vehicle
            window.currentMarker = L.marker(vehicleCoordinates[index], {icon: vehicleIcon})
                .addTo(window.map)
                .bindPopup(vehicleInfo[index])
                .openPopup();
            
            // Update location details
            const locations = ["Dhaka City", "Tangail District", "Chittagong City"];
            const distances = ["0 km", "78 km", "264 km"];
            const remaining = ["220 km", "142 km", "0 km"];
            const arrivals = ["April 17, 14:30", "April 17, 14:30", "Already arrived"];
            
            document.getElementById('currentLocation').textContent = locations[index];
            document.getElementById('distanceTraveled').textContent = distances[index];
            document.getElementById('remainingDistance').textContent = remaining[index];
            document.getElementById('estimatedArrival').textContent = arrivals[index];
            
            // Center map on selected vehicle
            window.map.setView(vehicleCoordinates[index], 8);
        }
    </script>
</body>
</html>