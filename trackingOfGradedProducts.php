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
        }
        
        .product-table th, .product-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        
        .product-table th {
            background-color: #f2f2f2;
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
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="profile.html" title="Profile">
                        <i class="fas fa-user"></i>
                    </a>
                    <!-- Logout Icon -->
                    <a class="btn btn-success btn-square rounded-circle logout-btn" href="login.html" title="Logout">
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
                <a href="qualityReport.html" class="nav-item nav-link px-3">Inspector Report</a>
                <a href="qualityTrendAnalysis.html" class="nav-item nav-link px-3">Quality Trend</a>
                <a href="transportationTracking.html" class="nav-item nav-link px-3">Transportation Tracking</a>
                <a href="trackingOfGradedProducts.html" class="nav-item nav-link px-3">Graded Product Tracking</a>
                <a href="packagingTrackingSystem.html" class="nav-item nav-link px-3">Packaging Tracking</a>
                
                <div class="nav-item dropdown px-3">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">More</a>
                    <div class="dropdown-menu text-center">
                        <a href="service.html" class="dropdown-item">Service</a>
                        <a href="contact.html" class="dropdown-item">Contact Us</a>
                        <a href="about.html" class="dropdown-item">About</a>
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

<!-- For the first tracking section -->
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
                            <input type="text" id="trackId" class="form-control" placeholder="Enter Product ID" required>
                            <button type="submit" class="btn btn-primary">Track</button>
                        </div>
                    </form>
                    <div id="trackingResult" class="bg-white p-4 shadow-sm rounded d-none">
                        <h5 class="text-success">Tracking Details</h5>
                        <p><strong>Status:</strong> <span id="statusText">Fetching...</span></p>
                        <p><strong>Last Updated:</strong> <span id="updateText">--</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- For the warehouse location section -->
<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="text-primary">Live Warehouse Location & Info</h2>
        <p class="text-muted">Track warehouse locations and get updated operational details.</p>
    </div>
    <div class="row g-4 align-items-stretch">
        <!-- Map -->
        <div class="col-lg-6">
            <div class="tracking-box p-0 overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.1127498548625!2d90.40439467579405!3d23.81202998643144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7965cb9fbd3%3A0x4ea14f91a96cb3e7!2sFarmers%20Market%20Dhaka!5e0!3m2!1sen!2sbd!4v1684212173468!5m2!1sen!2sbd"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- Details -->
        <div class="col-lg-6">
            <div class="warehouse-box">
                <h5>📍 Dhaka Central Warehouse</h5>
                <p><strong>Status:</strong> Active</p>
                <p><strong>Storage Capacity:</strong> 80% full</p>
                <p><strong>Supervisor:</strong> Mr. Karim</p>
                <p><strong>Phone:</strong> +880 1234 567 890</p>
                <hr>
                <h5>📍 Chattogram Distribution Hub</h5>
                <p><strong>Status:</strong> Under Maintenance</p>
                <p><strong>Storage Capacity:</strong> 50% full</p>
                <p><strong>Supervisor:</strong> Ms. Jahanara</p>
                <p><strong>Phone:</strong> +880 1987 654 321</p>
            </div>
        </div>
    </div>
</div>

<!-- NEW SECTION: Graded Products Table -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-end">
                <button id="addProductBtn" class="btn btn-success"><i class="fas fa-plus"></i> Add New Product</button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4 shadow-sm rounded">
                    <div class="table-responsive">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>Track ID</th>
                                    <th>Batch ID</th>
                                    <th>Crop Grade</th>
                                    <th>Quantity</th>
                                    <th>Warehouse ID</th>
                                    <th>Warehouse Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                <!-- Sample data, to be populated dynamically -->
                                <tr>
                                    <td>TRK-001</td>
                                    <td>BCH-5642</td>
                                    <td>A+</td>
                                    <td>500 kg</td>
                                    <td>WH-001</td>
                                    <td>Dhaka Central Warehouse</td>
                                    <td>
                                        <button class="btn btn-primary action-btn edit-btn" data-id="TRK-001"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger action-btn delete-btn" data-id="TRK-001"><i class="fas fa-trash"></i></button>
                                        <button class="btn btn-info action-btn locate-btn" data-id="TRK-001" data-lat="23.8120" data-lng="90.4044"><i class="fas fa-map-marker-alt"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TRK-002</td>
                                    <td>BCH-5643</td>
                                    <td>B</td>
                                    <td>350 kg</td>
                                    <td>WH-002</td>
                                    <td>Chattogram Distribution Hub</td>
                                    <td>
                                        <button class="btn btn-primary action-btn edit-btn" data-id="TRK-002"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger action-btn delete-btn" data-id="TRK-002"><i class="fas fa-trash"></i></button>
                                        <button class="btn btn-info action-btn locate-btn" data-id="TRK-002" data-lat="22.3569" data-lng="91.7832"><i class="fas fa-map-marker-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map for showing locations -->
        <div class="row mt-4">
            <div class="col-12">
                <div id="mapDisplay" class="rounded border" style="height: 400px; width: 100%; display: none;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div id="addProductModal" class="modal-overlay">
    <div class="modal-content">
        <h4 class="mb-4">Add New Product</h4>
        <form id="addProductForm">
            <div class="form-group">
                <label for="trackId">Track ID</label>
                <input type="text" id="trackId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="batchId">Batch ID</label>
                <input type="text" id="batchId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cropGrade">Crop Grade</label>
                <select id="cropGrade" class="form-control">
                    <option value="A+">A+</option>
                    <option value="A">A</option>
                    <option value="B+">B+</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" id="quantity" class="form-control" placeholder="e.g. 500 kg" required>
            </div>
            <div class="form-group">
                <label for="warehouseId">Warehouse ID</label>
                <input type="text" id="warehouseId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="warehouseLocation">Warehouse Location</label>
                <select id="warehouseLocation" class="form-control">
                    <option value="Dhaka Central Warehouse">Dhaka Central Warehouse</option>
                    <option value="Chattogram Distribution Hub">Chattogram Distribution Hub</option>
                </select>
            </div>
            <div class="btn-container">
                <button type="button" id="cancelAddBtn" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product Modal -->
<div id="editProductModal" class="modal-overlay">
    <div class="modal-content">
        <h4 class="mb-4">Edit Product</h4>
        <form id="editProductForm">
            <input type="hidden" id="editTrackId">
            <div class="form-group">
                <label for="editBatchId">Batch ID</label>
                <input type="text" id="editBatchId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editCropGrade">Crop Grade</label>
                <select id="editCropGrade" class="form-control">
                    <option value="A+">A+</option>
                    <option value="A">A</option>
                    <option value="B+">B+</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <div class="form-group">
                <label for="editQuantity">Quantity</label>
                <input type="text" id="editQuantity" class="form-control" placeholder="e.g. 500 kg" required>
            </div>
            <div class="form-group">
                <label for="editWarehouseId">Warehouse ID</label>
                <input type="text" id="editWarehouseId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editWarehouseLocation">Warehouse Location</label>
                <select id="editWarehouseLocation" class="form-control">
                    <option value="Dhaka Central Warehouse">Dhaka Central Warehouse</option>
                    <option value="Chattogram Distribution Hub">Chattogram Distribution Hub</option>
                </select>
            </div>
            <div class="btn-container">
                <button type="button" id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
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
        document.getElementById("trackingForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const trackId = document.getElementById("trackId").value.trim();
            const resultBox = document.getElementById("trackingResult");
            const statusText = document.getElementById("statusText");
            const updateText = document.getElementById("updateText");
    
            // Simulate a lookup (replace this with real API call)
            if (trackId === "AGRI123") {
                statusText.textContent = "Graded and Ready for Packaging";
                updateText.textContent = "2025-04-18 10:15 AM";
            } else if (trackId === "AGRI456") {
                statusText.textContent = "In Transit to Distribution Center";
                updateText.textContent = "2025-04-17 03:42 PM";
            } else {
                statusText.textContent = "Product ID not found. Please check again.";
                updateText.textContent = "--";
            }
    
            resultBox.classList.remove("d-none");
        });
    </script>

<script>
    // Map initialization
    let map;
    let markers = [];
    let warehouseLocations = {
        "Dhaka Central Warehouse": { lat: 23.8120, lng: 90.4044 },
        "Chattogram Distribution Hub": { lat: 22.3569, lng: 91.7832 }
    };

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
        
        // Add Product Form Submission
        document.getElementById("addProductForm").addEventListener("submit", function(e) {
            e.preventDefault();
            
            const trackId = document.getElementById("trackId").value;
            const batchId = document.getElementById("batchId").value;
            const cropGrade = document.getElementById("cropGrade").value;
            const quantity = document.getElementById("quantity").value;
            const warehouseId = document.getElementById("warehouseId").value;
            const warehouseLocation = document.getElementById("warehouseLocation").value;
            
            // Create table row
            const tableBody = document.getElementById("productTableBody");
            const newRow = tableBody.insertRow();
            
            newRow.innerHTML = `
                <td>${trackId}</td>
                <td>${batchId}</td>
                <td>${cropGrade}</td>
                <td>${quantity}</td>
                <td>${warehouseId}</td>
                <td>${warehouseLocation}</td>
                <td>
                    <button class="btn btn-primary action-btn edit-btn" data-id="${trackId}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger action-btn delete-btn" data-id="${trackId}"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-info action-btn locate-btn" data-id="${trackId}" 
                            data-lat="${warehouseLocations[warehouseLocation].lat}" 
                            data-lng="${warehouseLocations[warehouseLocation].lng}">
                        <i class="fas fa-map-marker-alt"></i>
                    </button>
                </td>
            `;
            
            // Reset form and close modal
            document.getElementById("addProductForm").reset();
            addProductModal.style.display = "none";
            
            // Reinitialize event listeners for the new buttons
            initActionButtons();
        });
        
        // Edit Product Form Submission
        document.getElementById("editProductForm").addEventListener("submit", function(e) {
            e.preventDefault();
            
            const trackId = document.getElementById("editTrackId").value;
            const batchId = document.getElementById("editBatchId").value;
            const cropGrade = document.getElementById("editCropGrade").value;
            const quantity = document.getElementById("editQuantity").value;
            const warehouseId = document.getElementById("editWarehouseId").value;
            const warehouseLocation = document.getElementById("editWarehouseLocation").value;
            
            // Find and update the row
            const rows = document.querySelectorAll("#productTableBody tr");
            rows.forEach(row => {
                if (row.cells[0].textContent === trackId) {
                    row.cells[1].textContent = batchId;
                    row.cells[2].textContent = cropGrade;
                    row.cells[3].textContent = quantity;
                    row.cells[4].textContent = warehouseId;
                    row.cells[5].textContent = warehouseLocation;
                    
                    // Update locate button with new coordinates
                    const locateBtn = row.querySelector(".locate-btn");
                    locateBtn.setAttribute("data-lat", warehouseLocations[warehouseLocation].lat);
                    locateBtn.setAttribute("data-lng", warehouseLocations[warehouseLocation].lng);
                }
            });
            
            // Close modal
            editProductModal.style.display = "none";
        });
        
        // Initialize action buttons for existing rows
        initActionButtons();
    });
    
    function initActionButtons() {
        // Handle Edit button clicks
        document.querySelectorAll(".edit-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const trackId = this.getAttribute("data-id");
                const row = this.closest("tr");
                
                // Populate edit form
                document.getElementById("editTrackId").value = trackId;
                document.getElementById("editBatchId").value = row.cells[1].textContent;
                document.getElementById("editCropGrade").value = row.cells[2].textContent;
                document.getElementById("editQuantity").value = row.cells[3].textContent;
                document.getElementById("editWarehouseId").value = row.cells[4].textContent;
                document.getElementById("editWarehouseLocation").value = row.cells[5].textContent;
                
                // Show edit modal
                document.getElementById("editProductModal").style.display = "block";
            });
        });
        
        // Handle Delete button clicks
        document.querySelectorAll(".delete-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                if (confirm("Are you sure you want to delete this product?")) {
                    this.closest("tr").remove();
                }
            });
        });
        
        // Handle Locate button clicks
        document.querySelectorAll(".locate-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const lat = parseFloat(this.getAttribute("data-lat"));
                const lng = parseFloat(this.getAttribute("data-lng"));
                const mapDisplay = document.getElementById("mapDisplay");
                
                // Show map if hidden
                mapDisplay.style.display = "block";
                
                // Center map on location and add marker
                map.setCenter({ lat, lng });
                map.setZoom(14);
                
                // Clear existing markers
                clearMarkers();
                
                // Add new marker
                const marker = new google.maps.Marker({
                    position: { lat, lng },
                    map: map,
                    title: this.closest("tr").cells[5].textContent
                });
                
                markers.push(marker);
                
                // Scroll to map
                mapDisplay.scrollIntoView({ behavior: 'smooth' });
            });
        });
    }
</script>

<!-- Google Maps Script -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
</script>
</body>
</html>