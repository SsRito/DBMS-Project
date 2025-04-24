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
    background-color: #28a745
    border-color #28a745;
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
            <p>Enter your product ID to check grading, packaging, and transportation status.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="tracking-box">
                    <form id="trackingForm">
                        <div class="input-group mb-3">
                            <input type="text" id="productId" class="form-control" placeholder="Enter Product ID" required>
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

<!-- Update the product tracking with map section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="text-primary">Track Product Location</h2>
            <p class="text-muted">Enter the product ID to view its warehouse location(s).</p>
        </div>
        <div class="row g-4 align-items-stretch">
            <!-- Map Area (Initially Hidden) -->
            <div class="col-lg-6 d-none" id="mapContainer">
                <div class="tracking-box p-0">
                    <div id="map" style="height: 400px; width: 100%;" class="rounded border"></div>
                </div>
            </div>
            <!-- Input + Results -->
            <div class="col-lg-6">
                <div class="tracking-box">
                    <form id="mapTrackingForm" class="mb-3">
                        <input type="text" id="mapProductId" class="form-control" placeholder="Enter Product ID (e.g. AGRI123)" required>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Track Product</button>
                    </form>
                    <div id="mapResult" class="bg-light p-3 rounded shadow-sm d-none">
                        <h5>Product Location Info</h5>
                        <ul id="warehouseList" class="mb-0"></ul>
                    </div>
                    <div id="notFoundMessage" class="alert alert-warning d-none mt-3">
                        No warehouse found for this Product ID.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let map;
    let markers = [];

    const productWarehouseMap = {
        "AGRI123": [
            { name: "Dhaka Central Warehouse", lat: 23.8120, lng: 90.4044 },
            { name: "Chattogram Hub", lat: 22.3569, lng: 91.7832 }
        ],
        "AGRI456": [
            { name: "Dhaka Central Warehouse", lat: 23.8120, lng: 90.4044 }
        ]
    };

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 23.8103, lng: 90.4125 },
            zoom: 7
        });
    }

    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    document.getElementById("mapTrackingForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const productId = document.getElementById("mapProductId").value.trim().toUpperCase();
        const mapContainer = document.getElementById("mapContainer");
        const resultsBox = document.getElementById("mapResult");
        const list = document.getElementById("warehouseList");
        const notFound = document.getElementById("notFoundMessage");

        clearMarkers();
        list.innerHTML = '';
        resultsBox.classList.add("d-none");
        notFound.classList.add("d-none");
        mapContainer.classList.add("d-none");

        const warehouses = productWarehouseMap[productId];

        if (warehouses) {
            mapContainer.classList.remove("d-none");
            warehouses.forEach(location => {
                const marker = new google.maps.Marker({
                    position: { lat: location.lat, lng: location.lng },
                    map,
                    title: location.name
                });
                const infoWindow = new google.maps.InfoWindow({
                    content: `<strong>${location.name}</strong>`
                });
                marker.addListener("click", () => infoWindow.open(map, marker));
                markers.push(marker);
                list.innerHTML += `<li>${location.name}</li>`;
            });
            resultsBox.classList.remove("d-none");
            map.setCenter({ lat: warehouses[0].lat, lng: warehouses[0].lng });
            map.setZoom(8);
        } else {
            notFound.classList.remove("d-none");
        }
    });
</script>

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
            const productId = document.getElementById("productId").value.trim();
            const resultBox = document.getElementById("trackingResult");
            const statusText = document.getElementById("statusText");
            const updateText = document.getElementById("updateText");
    
            // Simulate a lookup (replace this with real API call)
            if (productId === "AGRI123") {
                statusText.textContent = "Graded and Ready for Packaging";
                updateText.textContent = "2025-04-18 10:15 AM";
            } else if (productId === "AGRI456") {
                statusText.textContent = "In Transit to Distribution Center";
                updateText.textContent = "2025-04-17 03:42 PM";
            } else {
                statusText.textContent = "Product ID not found. Please check again.";
                updateText.textContent = "--";
            }
    
            resultBox.classList.remove("d-none");
        });
    </script>

<!-- Google Maps Script -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
</script>
</body>
</html>