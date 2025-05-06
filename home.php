<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>বাংলার কৃষি - Agricultural Product Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Agriculture, Product Management, Grading, Packaging, Transportation" name="keywords">
    <meta content="A comprehensive system for agricultural product grading, packaging and transport management" name="description">

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Additional CSS for animations and features -->
    <style>
        .login-btn {
            background-color: #28a745;
            border-color: #28a745;
            transition: all 0.3s ease;
            padding: 8px 24px;
            font-weight: 600;
            border-radius: 30px;
        }

        .login-btn:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Hero section animation */
        .hero-slide {
            transition: all 0.8s ease;
        }
        
        .feature-box {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .feature-box:hover .feature-icon {
            transform: scale(1.1);
        }
        
        .counter-box {
            padding: 2rem;
            text-align: center;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .parallax-section {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #5cb85c 0%, #43A047 100%);
            border-radius: 10px;
            padding: 3rem;
        }
        
        .animated-card {
            transition: all 0.3s ease;
        }
        
        .animated-card:hover {
            transform: translateY(-10px);
        }
        
        .crop-card {
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }
        
        .crop-card img {
            transition: all 0.5s ease;
        }
        
        .crop-card:hover img {
            transform: scale(1.1);
        }
        
        /* Data visualization styling */
        .chart-container {
            height: 300px;
            width: 100%;
            position: relative;
        }
        
        /* Floating animation for some elements */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Progress tracker */
        .tracker-step {
            position: relative;
            padding-left: 30px;
        }
        
        .tracker-step:before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #5cb85c;
        }
        
        .tracker-step:after {
            content: "";
            position: absolute;
            left: 7px;
            top: 25px;
            width: 2px;
            height: calc(100% - 10px);
            background-color: #5cb85c;
        }
        
        .tracker-step:last-child:after {
            display: none;
        }

        /* Modal styles */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            border-bottom: none;
            padding: 2rem 2rem 0;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .form-control {
            border-radius: 30px;
            padding: 12px 20px;
            margin-bottom: 20px;
        }
        
        .btn-login {
            border-radius: 30px;
            padding: 10px 20px;
            background-color: #28a745;
            border-color: #28a745;
            font-weight: 600;
            width: 100%;
        }
        
        .btn-login:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Feature cards for button replacements */
        .feature-access-card {
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .feature-access-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
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
       
        .chart-container {
            width: 500px;
            margin: 20px auto;
        }

        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .chart-container {
            width: 400px;
            background: #f9f9f9;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .chart-container {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }

        .chart-container {
            width: 400px;
            margin: 20px auto;
            background: #f0f8ff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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

    <!-- Hero Start -->
    <div class="container-fluid p-0">
        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero-slide" style="min-height: 600px; background: linear-gradient(rgb(255, 255, 255, 0.5), rgba(0, 0, 0, 0.5)), url('img/revolution.jpg') center center no-repeat; background-size: cover;">
                        <div class="container h-100 d-flex align-items-center justify-content-center">
                            <div class="row">
                                <div class="col-lg-8 text-white text-center mt-5">                        
                                    <h1 class="display-2 mb-3 animate__animated animate__fadeInDown">Revolutionizing Agricultural Product Management</h1>
                                    <p class="fs-5 mb-5 animate__animated animate__fadeInUp">A comprehensive system for grading, packaging, and transport management</p>
                                    <a href="home.php" class="btn btn-primary py-3 px-5 animate__animated animate__fadeInUp">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="hero-slide" style="min-height: 600px; background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(0, 0, 0, 0.5)), url('img/quality.jpg') center center no-repeat; background-size: cover;">
                        <div class="container h-100 d-flex align-items-center justify-content-center">
                            <div class="row">
                                <div class="col-lg-8 text-white text-center mt-5"> 
                                    <h1 class="display-2 mb-3 animate__animated animate__fadeInDown">Standardized Quality Assessment</h1>
                                    <p class="fs-5 mb-5 animate__animated animate__fadeInUp">Ensuring consistent high-quality produce from farm to market</p>
                                    <a href="qualityReport.php" class="btn btn-primary py-3 px-5 animate__animated animate__fadeInUp">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="hero-slide" style="min-height: 600px; background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(0, 0, 0, 0.5)), url('img/real time.png') center center no-repeat; background-size: cover;">
                        <div class="container h-100 d-flex align-items-center justify-content-center">
                            <div class="row">
                                <div class="col-lg-8 text-white text-center mt-5"> 
                                    <h1 class="display-2 mb-3 animate__animated animate__fadeInDown">Real-time Tracking System</h1>
                                    <p class="fs-5 mb-5 animate__animated animate__fadeInUp">Monitor your products at every stage of the supply chain</p>
                                    <a href="trackingOfGradedProducts.php" class="btn btn-primary py-3 px-5 animate__animated animate__fadeInUp">Start Tracking</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Features Start -->
    <div class="container-fluid py-5" id="features">
        <div class="container">
            <div class="row g-0 mb-3">
                <div class="col-lg-5">
                    <div class="bg-primary h-100 d-flex align-items-center p-5">
                        <div class="text-white">
                            <h1 class="mb-4">Our Comprehensive System</h1>
                            <p class="mb-4">Banglar Krishi provides an end-to-end solution for agricultural product management, ensuring quality, transparency, and efficiency across the entire supply chain.</p>
                            <a href="about.php" class="btn btn-outline-light py-md-3 px-md-5">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="bg-light h-100 d-flex align-items-center p-5">
                        <div>
                            <h1 class="mb-4">Quality Assessment & Grading</h1>
                            <p class="mb-4">Our standardized quality assessment system ensures consistent grading of agricultural products based on well-defined criteria, benefiting both farmers and consumers.</p>
                            <a href="gradingCriteria.php" class="btn btn-primary py-md-3 px-md-5">Explore Grading Criteria</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-3">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box bg-white p-4 shadow-sm animated-card">
                        <div class="feature-icon text-primary">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4>Grading Criteria</h4>
                        <p>Standardized assessment criteria for various agricultural products ensuring consistent quality.</p>
                        <a href="gradingCriteria.php" class="btn btn-sm btn-primary mt-2">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box bg-white p-4 shadow-sm animated-card">
                        <div class="feature-icon text-primary">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h4>Quality Reports</h4>
                        <p>Detailed inspector reports for comprehensive quality assessment and verification.</p>
                        <a href="qualityReport.php" class="btn btn-sm btn-primary mt-2">View Reports</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box bg-white p-4 shadow-sm animated-card">
                        <div class="feature-icon text-primary">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Quality Trends</h4>
                        <p>Advanced analytics to identify quality trends and improvement opportunities.</p>
                        <a href="qualityTrendAnalysis.php" class="btn btn-sm btn-primary mt-2">See Analysis</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box bg-white p-4 shadow-sm animated-card">
                        <div class="feature-icon text-primary">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h4>Transportation Tracking</h4>
                        <p>Real-time tracking of product transportation throughout the supply chain.</p>
                        <a href="transportationTracking.php" class="btn btn-sm btn-primary mt-2">Track Transport</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box bg-white p-4 shadow-sm animated-card">
                        <div class="feature-icon text-primary">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <h4>Product Tracking</h4>
                        <p>End-to-end tracking system for graded agricultural products.</p>
                        <a href="trackingOfGradingProducts.php" class="btn btn-sm btn-primary mt-2">Track Products</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box bg-white p-4 shadow-sm animated-card">
                        <div class="feature-icon text-primary">
                            <i class="fas fa-box"></i>
                        </div>
                        <h4>Packaging Management</h4>
                        <p>Comprehensive packaging tracking system ensuring product integrity and safety.</p>
                        <a href="packagingTrackingSystem.php" class="btn btn-sm btn-primary mt-2">Packaging Solutions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- About Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="position-relative float-animation">
                        <img class="img-fluid rounded w-100" src="img/about.jpg" alt="">
                        <div class="position-absolute start-0 bottom-0 bg-primary rounded p-3" style="width: 150px; height: 150px;">
                            <h1 class="text-white text-center mb-0">2+</h1>
                            <h4 class="text-white text-center mt-0">Years Experience</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-4">The Leading Agricultural Product Management System in Bangladesh</h1>
                    <p class="mb-4">Banglar Krishi has pioneered standardized quality assessment and grading of agricultural produce in Bangladesh, providing a transparent and efficient system for farmers, distributors, and consumers.</p>
                    <div class="row g-4 mb-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <span>Standardized Quality Assessment</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <span>End-to-End Supply Chain Tracking</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <span>Advanced Analytics Dashboard</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <span>Real-time Monitoring System</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Product Categories Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="text-primary">Supported Agricultural Products</h1>
                <p class="text-muted">Our system provides specialized grading and tracking for a variety of agricultural products</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="crop-card rounded overflow-hidden shadow-sm">
                        <img class="img-fluid w-100" src="img/rice.jpg" alt="Rice">
                        <div class="p-4 text-center">
                            <h4>Rice</h4>
                            <p class="mb-0">Various rice varieties with specialized grading criteria</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="crop-card rounded overflow-hidden shadow-sm">
                        <img class="img-fluid w-100" src="img/fruit.jpeg" alt="Fruits">
                        <div class="p-4 text-center">
                            <h4>Fruits</h4>
                            <p class="mb-0">Quality assessment for local and export-grade fruits</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="crop-card rounded overflow-hidden shadow-sm">
                        <img class="img-fluid w-100" src="img/vegetables.jpg" alt="Vegetables">
                        <div class="p-4 text-center">
                            <h4>Vegetables</h4>
                            <p class="mb-0">Fresh produce monitoring and quality control</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="crop-card rounded overflow-hidden shadow-sm">
                        <img class="img-fluid w-100" src="img/spices.jpg" alt="Spices">
                        <div class="p-4 text-center">
                            <h4>Spices</h4>
                            <p class="mb-0">Premium spice grading and packaging systems</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Categories End -->

    <!-- Product Journey Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="text-primary">Product Journey</h1>
                <p class="text-muted">Follow the entire journey of agricultural products through our system</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="tracker-step p-4">
                        <div class="feature-box bg-white p-4 h-100">
                            <h4 class="mb-3">1. Quality Assessment</h4>
                            <p>Products are assessed according to standardized criteria by certified inspectors</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="tracker-step p-4">
                        <div class="feature-box bg-white p-4 h-100">
                            <h4 class="mb-3">2. Grading & Labeling</h4>
                            <p>Each product is graded and assigned a unique tracking ID for complete traceability</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="tracker-step p-4">
                        <div class="feature-box bg-white p-4 h-100">
                            <h4 class="mb-3">3. Packaging</h4>
                            <p>Products are packaged according to their grade and intended market destination</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="tracker-step p-4">
                        <div class="feature-box bg-white p-4 h-100">
                            <h4 class="mb-3">4. Transportation</h4>
                            <p>Real-time tracking throughout the transportation and delivery process</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Journey End -->
    
    <div style="text-align: center; margin-top: 30px;">
        <h2>Agriculture Quality Analytics</h2>
    </div>

    <div class="dashboard"> 
        <div class="chart-container">
            <h4>Crop Quantity by Grade</h4>
            <canvas id="quantityChart"></canvas>
        </div>
        <div class="chart-container">
            <h4>Average Size by Crop Grade</h4>
            <canvas id="sizeChart"></canvas>
        </div>
        <div class="chart-container">
            <h4>Infestation Level Distribution</h4>
            <canvas id="infestationChart"></canvas>
        </div>
    </div>

    <!-- Data Visualization Start -->
    <?php
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "agriculturesupplychain");

    // Fetch total quantity by grade
    $quantityResult = $conn->query("SELECT cropGrade, SUM(quantity) as total FROM farmer_crop_type_grade GROUP BY cropGrade");
    $quantityData = [];
    while ($row = $quantityResult->fetch_assoc()) {
        $quantityData[$row['cropGrade']] = (float)$row['total'];
    }

    // Fetch average size by grade
    $sizeResult = $conn->query("SELECT cropGrade, AVG(criteria_size) as avg_size FROM farmer_crop_type_grade GROUP BY cropGrade");
    $sizeData = [];
    while ($row = $sizeResult->fetch_assoc()) {
        $sizeData[$row['cropGrade']] = round((float)$row['avg_size'], 2);
    }

    // Infestation level distribution (0-2, 2-4, ..., 8-10)
    $infestationResult = $conn->query("
        SELECT 
            CASE 
                WHEN criteria_infestation BETWEEN 0 AND 2 THEN '0-2'
                WHEN criteria_infestation > 2 AND criteria_infestation <= 4 THEN '2-4'
                WHEN criteria_infestation > 4 AND criteria_infestation <= 6 THEN '4-6'
                WHEN criteria_infestation > 6 AND criteria_infestation <= 8 THEN '6-8'
                WHEN criteria_infestation > 8 THEN '8-10'
            END as range_label,
            COUNT(*) as count
        FROM farmer_crop_type_grade
        GROUP BY range_label
        ORDER BY range_label ASC
    ");
    $infestationData = [];
    while ($row = $infestationResult->fetch_assoc()) {
        $infestationData[$row['range_label']] = (int)$row['count'];
    }

    // Output as JS variables
    echo "<script>
        const quantityData = " . json_encode($quantityData) . ";
        const sizeData = " . json_encode($sizeData) . ";
        const infestationData = " . json_encode($infestationData) . ";
    </script>";
    ?>


    <!-- Testimonial Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="text-primary">What Our Users Say</h1>
                <p class="text-muted">Testimonials from farmers, inspectors, and distributors</p>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-card bg-white p-5">
                    <div class="mb-4">
                        <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>
                    <p class="fs-5 mb-4">The grading system has helped me get better prices for my premium rice. Buyers now trust the quality of my products.</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid rounded-circle flex-shrink-0" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;" alt="Farmer">
                        <div class="ps-3">
                            <h5 class="mb-1">Rahim Mia</h5>
                            <small>Farmer, Mymensingh</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card bg-white p-5">
                    <div class="mb-4">
                        <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>
                    <p class="fs-5 mb-4">The tracking system has drastically reduced losses during transportation. We can now monitor every shipment in real-time.</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid rounded-circle flex-shrink-0" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;" alt="Distributor">
                        <div class="ps-3">
                            <h5 class="mb-1">Asif Ahmed</h5>
                            <small>Distributor, Dhaka</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card bg-white p-5">
                    <div class="mb-4">
                        <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>
                    <p class="fs-5 mb-4">The standardized assessment tools make my job as an inspector more efficient and objective. The digital reporting system is excellent.</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid rounded-circle flex-shrink-0" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;" alt="Inspector">
                        <div class="ps-3">
                            <h5 class="mb-1">Nadia Islam</h5>
                            <small>Quality Inspector, Khulna</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-primary text-white py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Contact Us</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-white me-2"></i>Bashundhara R/A, Dhaka, Bangladesh</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-white me-2"></i>info@banglarkrishi.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-white me-2"></i>01794017804</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Follow Us</h3>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-outline-light btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-lg btn-outline-light btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-lg btn-outline-light btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-lg btn-outline-light btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white py-4" style="background: #051225;">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">Banglar Krishi</a>. All Rights Reserved</p>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- JavaScript for Charts -->
<?php
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "agriculturesupplychain");

    // Fetch total quantity by grade
    $quantityResult = $conn->query("SELECT cropGrade, SUM(quantity) as total FROM farmer_crop_type_grade GROUP BY cropGrade");
    $quantityData = [];
    while ($row = $quantityResult->fetch_assoc()) {
        $quantityData[$row['cropGrade']] = (float)$row['total'];
    }

    // Fetch average size by grade
    $sizeResult = $conn->query("SELECT cropGrade, AVG(criteria_size) as avg_size FROM farmer_crop_type_grade GROUP BY cropGrade");
    $sizeData = [];
    while ($row = $sizeResult->fetch_assoc()) {
        $sizeData[$row['cropGrade']] = round((float)$row['avg_size'], 2);
    }

    // Infestation level distribution (0-2, 2-4, ..., 8-10)
    $infestationResult = $conn->query("
        SELECT 
            CASE 
                WHEN criteria_infestation BETWEEN 0 AND 2 THEN '0-2'
                WHEN criteria_infestation > 2 AND criteria_infestation <= 4 THEN '2-4'
                WHEN criteria_infestation > 4 AND criteria_infestation <= 6 THEN '4-6'
                WHEN criteria_infestation > 6 AND criteria_infestation <= 8 THEN '6-8'
                WHEN criteria_infestation > 8 THEN '8-10'
            END as range_label,
            COUNT(*) as count
        FROM farmer_crop_type_grade
        GROUP BY range_label
        ORDER BY range_label ASC
    ");
    $infestationData = [];
    while ($row = $infestationResult->fetch_assoc()) {
        $infestationData[$row['range_label']] = (int)$row['count'];
    }

    // Output as JS variables
    echo "<script>
        const quantityData = " . json_encode($quantityData) . ";
        const sizeData = " . json_encode($sizeData) . ";
        const infestationData = " . json_encode($infestationData) . ";
    </script>";
    ?>

<canvas id="barChart" width="400" height="200"></canvas>
<canvas id="pieChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Chart 1: Total Quantity by Grade
        new Chart(document.getElementById("quantityChart"), {
            type: 'bar',
            data: {
                labels: Object.keys(quantityData),
                datasets: [{
                    label: "Total Quantity",
                    data: Object.values(quantityData),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Chart 2: Average Size by Crop Grade
        new Chart(document.getElementById("sizeChart"), {
            type: 'bar',
            data: {
                labels: Object.keys(sizeData),
                datasets: [{
                    label: "Average Size",
                    data: Object.values(sizeData),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Chart 3: Infestation Level Distribution
        new Chart(document.getElementById("infestationChart"), {
            type: 'bar',
            data: {
                labels: Object.keys(infestationData),
                datasets: [{
                    label: "Frequency",
                    data: Object.values(infestationData),
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
</body>
</html>
