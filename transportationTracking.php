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
    background-color: #28a745
    border-color #28a745;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    }

.logout-btn:hover {
    background-color: #dc3545 !important; /* Red on hover */
    border-color: #dc3545 !important;

    .navbar-nav .nav-link, 
    .navbar-nav .dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-width: 150px;
        text-align: center;
    }
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
                <a href="gradingCriteria.html" class="nav-item nav-link px-3">Grading Criteria</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
    <script>
        // Initialize map
        const map = L.map('map').setView([23.8103, 90.4125], 8); // Center on Bangladesh
        
        // Add tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Define origin, destination and current location
        const origin = [23.8103, 90.4125]; // Dhaka
        const destination = [22.3569, 91.7832]; // Chittagong
        const currentPosition = [24.0078, 89.7500]; // Tangail (example current position)
        
        // Add markers for origin and destination
        const originMarker = L.marker(origin).addTo(map)
            .bindPopup('Origin: Dhaka Farm')
            .openPopup();
            
        const destinationMarker = L.marker(destination).addTo(map)
            .bindPopup('Destination: Chittagong Market');
        
        // Add current position marker with custom icon
        const truckIcon = L.icon({
            iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/images/marker-icon.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/images/marker-shadow.png',
            shadowSize: [41, 41]
        });
        
        const currentMarker = L.marker(currentPosition, {icon: truckIcon}).addTo(map)
            .bindPopup('Current Location: Truck #T-1234');
        
        // Draw the route line
        const routePoints = [
            origin,
            [23.9908, 90.2501], // Savar
            [24.0078, 89.7500], // Tangail (current position)
            [24.3752, 88.9746], // Natore
            [24.3636, 88.6241], // Rajshahi
            [23.1669, 89.2167], // Jessore
            destination
        ];
        
        // Split into completed route and remaining route
        const completedRoute = routePoints.slice(0, 3); // Up to current position
        const remainingRoute = routePoints.slice(2); // From current position to destination
        
        // Draw completed route in green
        const completedPath = L.polyline(completedRoute, {
            color: '#5CB85C',
            weight: 5,
            opacity: 0.7
        }).addTo(map);
        
        // Draw remaining route in gray
        const remainingPath = L.polyline(remainingRoute, {
            color: '#999',
            weight: 5,
            dashArray: '10, 10',
            opacity: 0.7
        }).addTo(map);
        
        // Set the status progress bar width
        document.getElementById('statusProgress').style.width = '50%'; // 50% complete (in transit)
        
        // Function to search for a shipment
        function searchShipment() {
            const trackingNumber = document.getElementById('trackingNumber').value;
            if (trackingNumber) {
                // In a real application, you would fetch the shipment data from a server here
                alert('Tracking information found for: ' + trackingNumber);
                // For now we just keep displaying the demo data
            } else {
                alert('Please enter a tracking number');
            }
        }
        
        // Function to select a vehicle
        function selectVehicle(vehicleId) {
            // Remove active class from all vehicles
            document.querySelectorAll('.vehicle-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to selected vehicle
            document.querySelectorAll('.vehicle-item')[vehicleId - 1].classList.add('active');
            
            // In a real application, you would fetch the vehicle data and update the map
            if (vehicleId === 1) {
                // Current demo truck
                currentMarker.setLatLng(currentPosition);
                map.panTo(currentPosition);
                document.getElementById('currentLocation').textContent = 'Tangail District';
                document.getElementById('distanceTraveled').textContent = '78 km';
                document.getElementById('remainingDistance').textContent = '142 km';
                document.getElementById('estimatedArrival').textContent = 'April 17, 2025 - 14:30';
            } else if (vehicleId === 2) {
                // Another truck at different location
                const newPosition = [23.9908, 90.2501]; // Savar
                currentMarker.setLatLng(newPosition);
                map.panTo(newPosition);
                document.getElementById('currentLocation').textContent = 'Savar, Dhaka';
                document.getElementById('distanceTraveled').textContent = '25 km';
                document.getElementById('remainingDistance').textContent = '195 km';
                document.getElementById('estimatedArrival').textContent = 'April 18, 2025 - 08:15';
            } else if (vehicleId === 3) {
                // Another truck at different location
                const newPosition = [23.1669, 89.2167]; // Jessore
                currentMarker.setLatLng(newPosition);
                map.panTo(newPosition);
                document.getElementById('currentLocation').textContent = 'Jessore District';
                document.getElementById('distanceTraveled').textContent = '180 km';
                document.getElementById('remainingDistance').textContent = '40 km';
                document.getElementById('estimatedArrival').textContent = 'April 16, 2025 - 18:45';
            }
        }
        
        // Demo live updates simulation
        let movingForward = true;
        const simulateMovement = () => {
            // Get current position
            const pos = currentMarker.getLatLng();
            
            // Add small random movement
            let newLat, newLng;
            if (movingForward) {
                // Move towards Rajshahi
                newLat = pos.lat + (Math.random() * 0.002);
                newLng = pos.lng - (Math.random() * 0.003);
                
                // If reached Rajshahi area, start moving towards Jessore
                if (newLng < 89.0) {
                    movingForward = false;
                }
            } else {
                // Move towards Jessore
                newLat = pos.lat - (Math.random() * 0.004);
                newLng = pos.lng + (Math.random() * 0.001);
            }
            
            // Update marker position
            currentMarker.setLatLng([newLat, newLng]);
            
            // Update completed and remaining routes
            const newCurrentPos = [newLat, newLng];
            const newCompletedRoute = [...completedRoute.slice(0, -1), newCurrentPos];
            const newRemainingRoute = [newCurrentPos, ...remainingRoute.slice(1)];
            
            completedPath.setLatLngs(newCompletedRoute);
            remainingPath.setLatLngs(newRemainingRoute);
            
            // Update distance info
            const distanceTraveled = parseInt(document.getElementById('distanceTraveled').textContent) + Math.random() * 0.2;
            document.getElementById('distanceTraveled').textContent = distanceTraveled.toFixed(1) + ' km';
            
            const remainingDistance = parseInt(document.getElementById('remainingDistance').textContent) - Math.random() * 0.2;
            document.getElementById('remainingDistance').textContent = remainingDistance.toFixed(1) + ' km';
            
            // Update last seen
            document.querySelector('tr:last-child td:last-child').textContent = 'Just now';
        };
        
        // Run movement simulation every 5 seconds
        setInterval(simulateMovement, 5000);
    </script>
</body>

</html>