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

<!-- Table Section Start -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Grading, Packaging & Transportation Details</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Past Problems</th>
                        <th>Present Situation</th>
                        <th>Changes/Pattern Recognition</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Lack of Infrastructure:</b> Absence of proper grading centers or quality control labs.</td>
                        <td>Increase in government and private sector-run grading centers, especially near major markets. Still inadequate in remote areas.</td>
                        <td>Digital transformation is slowly penetrating agriculture, especially in export-oriented or industrialized farming sectors.</td>
                    </tr>
                    <tr>
                        <td><b>Lack of Standardization:</b> No uniform grading system for many crops, especially in developing countries.</td>
                        <td>Many countries now follow national or international grading standards (e.g., AGMARK in India, USDA grades in the U.S.). However, adoption still lags in rural areas.</td>
                        <td>There's a growing emphasis on quality control and compliance, especially for global trade.

                        </td>
                    </tr>
                    <tr>
                        <td><b>Improper or Inadequate Packaging Materials:</b> Use of non-durable or non-food-grade materials.</td>
                        <td>Better-designed packaging solutions (e.g., ventilated crates, shock-absorbing boxes) are more common. But affordability remains a barrier.</td>
                        <td>Demand for eco-friendly, export-compliant, and protective packaging is rising.</td>
                    </tr>
                    <tr>
                        <td><b>Poor Road Infrastructure:</b> Rural areas often lack proper roads.</td>
                        <td>Improvements in rural infrastructure in our country through government schemes. Yet, last-mile connectivity is still poor in some areas.</td>
                        <td>Infrastructure improvements are happening, but rural-urban gaps still exist.

                        </td>
                    </tr>
                    <tr>
                        <td><b>Overloading and Poor Handling:</b> Overstuffed transport vehicles and careless loading/unloading.</td>
                        <td>Better training and use of purpose-built containers reduce damage, though poor handling persists in unregulated markets.</td>
                        <td>Cold chain tech is expanding, but adoption is still low at the smallholder level due to high costs.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<!-- Table Section End -->


    <!-- Testimonial Start -->
    <!-- <div class="container-fluid bg-testimonial py-5" style="margin: 90px 0 135px 0;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel p-5">
                        <div class="testimonial-item text-center text-white">
                            <img class="img-fluid mx-auto p-2 border border-5 border-secondary rounded-circle mb-4" src="img/testimonial-2.jpg" alt="">
                            <p class="fs-5">Dolores sed duo clita justo dolor et stet lorem kasd dolore lorem ipsum. At lorem lorem magna ut et, nonumy labore diam erat. Erat dolor rebum sit ipsum.</p>
                            <hr class="mx-auto w-25">
                            <h4 class="text-white mb-0">Client Name</h4>
                        </div>
                        <div class="testimonial-item text-center text-white">
                            <img class="img-fluid mx-auto p-2 border border-5 border-secondary rounded-circle mb-4" src="img/testimonial-2.jpg" alt="">
                            <p class="fs-5">Dolores sed duo clita justo dolor et stet lorem kasd dolore lorem ipsum. At lorem lorem magna ut et, nonumy labore diam erat. Erat dolor rebum sit ipsum.</p>
                            <hr class="mx-auto w-25">
                            <h4 class="text-white mb-0">Client Name</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Testimonial End -->
    

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